<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\JobApplication;
use App\Models\JobCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class JobController extends Controller
{
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->middleware('auth')->only(['apply']);
    }

    /**
     * Display a listing of jobs
     */
    public function index(Request $request)
    {
        $query = Job::with(['companyProfile', 'category'])
            ->where('is_active', true); // Changed status to is_active

        // Filter by keyword (title, description, company)
        if ($request->filled('keyword')) {
            $keyword = $request->keyword;
            $query->where(function ($q) use ($keyword) {
                $q->where('title', 'like', '%' . $keyword . '%')
                    ->orWhere('description', 'like', '%' . $keyword . '%')
                    ->orWhereHas('companyProfile', function ($q) use ($keyword) {
                        $q->where('company_name', 'like', '%' . $keyword . '%');
                    });
            });
        }

        // Filter by location
        if ($request->filled('location')) {
            $query->where('location', 'like', '%' . $request->location . '%');
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // Filter by job type
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        // Sort results
        if ($request->sort == 'oldest') {
            $query->oldest();
        } else {
            $query->latest(); // default - newest first
        }

        $jobs = $query->paginate(10)->withQueryString();

        // Get data for filters
        $categories = JobCategory::all();
        $jobTypes = ['full-time', 'part-time', 'contract', 'internship', 'remote'];

        return view('jobs.index', compact('jobs', 'categories', 'jobTypes'));
    }

    /**
     * Display the specified job
     */
    public function show(Job $job)
    {
        // Check if job is active
        // Use boolean check for is_active
        if (!$job->is_active && !(Auth::check() && Auth::id() == $job->companyProfile->user_id)) {
            abort(404);
        }

        $job->load(['companyProfile', 'category']);

        // Check if the user has applied for this job
        $hasApplied = false;
        if (Auth::check()) {
            $hasApplied = JobApplication::where('user_id', Auth::id())
                ->where('job_id', $job->id)
                ->exists();
        }

        // Get related jobs
        $relatedJobs = Job::where('is_active', true)
            ->where('id', '!=', $job->id)
            ->where(function ($query) use ($job) {
                $query->where('category_id', $job->category_id)
                    ->orWhere('company_id', $job->company_id);
            })
            ->take(3)
            ->get();

        return view('jobs.show', compact('job', 'hasApplied', 'relatedJobs'));
    }

    /**
     * Apply for a job
     */
    public function apply(Request $request, Job $job)
    {
        try {
            // Ensure user is a job seeker
            if (Auth::user()->user_type != 'job_seeker') {
                return redirect()->back()->with('error', 'Only job seekers can apply for jobs');
            }

            // Check if job is still active
            if (!$job->is_active) {
                return redirect()->back()->with('error', 'This job is no longer accepting applications');
            }

            // Check if already applied
            $hasApplied = JobApplication::where('user_id', Auth::id())
                ->where('job_id', $job->id)
                ->exists();

            if ($hasApplied) {
                return redirect()->back()->with('error', 'You have already applied for this position');
            }

            // Validate the application
            $request->validate([
                'resume' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
                'cover_letter' => 'required|string'
            ]);

            // Create the application first without resume
            $application = new JobApplication();
            $application->user_id = Auth::id();
            $application->job_id = $job->id;
            $application->cover_letter = $request->cover_letter;
            $application->status = 'pending';

            // Try to save without file first
            $application->save();

            // Now try to handle the file upload separately
            if ($request->hasFile('resume')) {
                try {
                    // Check if the storage directory exists, if not create it
                    $storageDir = storage_path('app/public/resumes');
                    if (!file_exists($storageDir)) {
                        mkdir($storageDir, 0755, true);
                    }

                    $resumePath = $request->file('resume')->store('resumes', 'public');

                    // Update the application with the resume path
                    // Use 'resume' field instead of 'resume_path' to match the database column
                    if ($resumePath) {
                        $application->resume = $resumePath;
                        $application->save();
                    }
                } catch (\Exception $fileEx) {
                    // Log file upload error but continue with the application
                    \Log::error('File upload error: ' . $fileEx->getMessage());
                }
            }

            return redirect()->route('jobs.show', $job)->with('success', 'Thank you for your application! We have received your submission and will be in touch soon.');
        } catch (\Exception $e) {
            // Log detailed error information
            \Log::error('Application error: ' . $e->getMessage());
            \Log::error('Error trace: ' . $e->getTraceAsString());

            // Return with a more specific error message if possible
            $errorMessage = 'There was a problem submitting your application. Please try again.';

            if (app()->environment('local')) {
                $errorMessage .= ' Error: ' . $e->getMessage();
            }

            return redirect()->back()->with('error', $errorMessage);
        }
    }
}
