<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\JobCategory;
use App\Models\CompanyProfile;
use Illuminate\Http\Request;

class JobController extends Controller
{
    /**
     * Constructor to apply middleware
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    /**
     * Display a listing of jobs
     */
    public function index()
    {
        $jobs = Job::with(['companyProfile', 'category'])
            ->latest()
            ->paginate(10);

        return view('admin.jobs.index', compact('jobs'));
    }

    /**
     * Show the form for creating a new job
     */
    public function create()
    {
        $categories = JobCategory::all();
        $companies = CompanyProfile::all();

        return view('admin.jobs.create', compact('categories', 'companies'));
    }

    /**
     * Store a newly created job
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'company_profile_id' => 'required|exists:company_profiles,id',
            'category_id' => 'required|exists:job_categories,id',
            'type' => 'required|in:full-time,part-time,contract,internship,remote',
            'location' => 'required|string|max:255',
            'description' => 'required|string',
            'requirements' => 'required|string',
            'salary_range' => 'nullable|string|max:100',
            'status' => 'required|in:active,inactive,draft',
        ]);

        $job = Job::create($request->all());

        return redirect()->route('admin.jobs.index')
            ->with('success', 'Job created successfully');
    }

    /**
     * Display the specified job
     */
    public function show(Job $job)
    {
        $job->load(['companyProfile', 'category', 'applications.user']);

        return view('admin.jobs.show', compact('job'));
    }

    /**
     * Show the form for editing the job
     */
    public function edit(Job $job)
    {
        $categories = JobCategory::all();
        $companies = CompanyProfile::all();

        return view('admin.jobs.edit', compact('job', 'categories', 'companies'));
    }

    /**
     * Update the job
     */
    public function update(Request $request, Job $job)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'company_profile_id' => 'required|exists:company_profiles,id',
            'category_id' => 'required|exists:job_categories,id',
            'type' => 'required|in:full-time,part-time,contract,internship,remote',
            'location' => 'required|string|max:255',
            'description' => 'required|string',
            'requirements' => 'required|string',
            'salary_range' => 'nullable|string|max:100',
            'status' => 'required|in:active,inactive,draft',
        ]);

        $job->update($request->all());

        return redirect()->route('admin.jobs.index')
            ->with('success', 'Job updated successfully');
    }

    /**
     * Remove the job
     */
    public function destroy(Job $job)
    {
        $job->delete();

        return redirect()->route('admin.jobs.index')
            ->with('success', 'Job deleted successfully');
    }
}
