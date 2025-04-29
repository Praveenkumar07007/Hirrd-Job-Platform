<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\JobCategory;
use App\Models\JobApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class JobController extends Controller
{
    /**
     * Display a listing of the jobs.
     */
    public function index(Request $request)
    {
        $query = Job::query()->where('is_active', true);

        // Filter by keyword
        if ($request->has('keyword') && !empty($request->keyword)) {
            $keyword = $request->keyword;
            $query->where(function ($q) use ($keyword) {
                $q->where('title', 'like', "%{$keyword}%")
                    ->orWhere('description', 'like', "%{$keyword}%")
                    ->orWhere('location', 'like', "%{$keyword}%");
            });
        }

        // Filter by category
        if ($request->has('category') && !empty($request->category)) {
            $query->where('category_id', $request->category);
        }

        // Filter by type
        if ($request->has('type') && !empty($request->type)) {
            $query->where('type', $request->type);
        }

        // Filter by location
        if ($request->has('location') && !empty($request->location)) {
            $query->where('location', 'like', "%{$request->location}%");
        }

        $jobs = $query->with(['companyProfile', 'category'])
            ->latest()
            ->paginate(10);

        $categories = JobCategory::all();

        return view('jobs.index', compact('jobs', 'categories'));
    }

    /**
     * Display the specified job.
     */
    public function show(Job $job)
    {
        $job->load(['companyProfile', 'category']);

        $hasApplied = false;

        if (Auth::check() && Auth::user()->user_type == 'job_seeker') {
            $hasApplied = JobApplication::where('job_id', $job->id)
                ->where('user_id', Auth::id())
                ->exists();
        }

        return view('jobs.show', compact('job', 'hasApplied'));
    }

    /**
     * Apply for a job.
     */
    public function apply(Request $request, Job $job)
    {
        // Validate user is a job seeker and logged in
        if (!Auth::check() || Auth::user()->user_type != 'job_seeker') {
            return redirect()->route('login');
        }

        // Check if already applied
        $hasApplied = JobApplication::where('job_id', $job->id)
            ->where('user_id', Auth::id())
            ->exists();

        if ($hasApplied) {
            return redirect()->back()->with('error', 'You have already applied for this job.');
        }

        // Validate form data
        $validated = $request->validate([
            'cover_letter' => 'required|string',
            'resume' => 'required|file|mimes:pdf|max:2048',
        ]);

        // Store resume file
        $resumePath = $request->file('resume')->store('resumes', 'public');

        // Create job application
        JobApplication::create([
            'job_id' => $job->id,
            'user_id' => Auth::id(),
            'cover_letter' => $validated['cover_letter'],
            'resume' => $resumePath,
            'status' => 'pending',
        ]);

        return redirect()->route('applications.index')->with('success', 'Your application has been submitted successfully!');
    }
}
