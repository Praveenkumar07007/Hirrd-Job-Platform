<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\JobCategory;
use App\Models\CompanyProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    /**
     * Constructor to apply middleware
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('employer');
    }

    /**
     * Display a listing of the jobs.
     */
    public function index()
    {
        // Get the employer's company profile
        $companyProfile = CompanyProfile::where('user_id', Auth::id())->first();

        if (!$companyProfile) {
            return redirect()->route('employer.company.create')
                ->with('message', 'Please complete your company profile first.');
        }

        $jobs = Job::where('company_id', $companyProfile->id)
            ->with('category')
            ->latest()
            ->paginate(10);

        return view('employer.jobs.index', compact('jobs'));
    }

    /**
     * Show the form for creating a new job.
     */
    public function create()
    {
        // Check if employer has a company profile
        $companyProfile = CompanyProfile::where('user_id', Auth::id())->first();

        if (!$companyProfile) {
            return redirect()->route('employer.company.create')
                ->with('message', 'Please complete your company profile before posting a job.');
        }

        $categories = JobCategory::all();

        return view('employer.jobs.create', compact('categories'));
    }

    /**
     * Store a newly created job in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:job_categories,id',
            'type' => 'required|string|in:full-time,part-time,remote,contract',
            'location' => 'required|string|max:255',
            'salary' => 'nullable|numeric|min:0',
            'deadline' => 'nullable|date|after:today',
            'description' => 'required|string',
            'is_active' => 'nullable|boolean',
        ]);

        // Get the employer's company profile
        $companyProfile = CompanyProfile::where('user_id', Auth::id())->firstOrFail();

        // Create the job
        $job = new Job();
        $job->title = $validated['title'];
        $job->description = $validated['description'];
        $job->company_id = $companyProfile->id;
        $job->category_id = $validated['category_id'];
        $job->location = $validated['location'];
        $job->type = $validated['type'];
        $job->salary = $validated['salary'] ?? null;
        $job->deadline = $validated['deadline'] ?? null;
        $job->is_active = isset($validated['is_active']) ? true : false;
        $job->save();

        return redirect()->route('employer.jobs.index')
            ->with('success', 'Job posted successfully!');
    }

    /**
     * Show the form for editing the specified job.
     */
    public function edit(Job $job)
    {
        // Ensure the job belongs to the employer
        $companyProfile = CompanyProfile::where('user_id', Auth::id())->firstOrFail();

        if ($job->company_id != $companyProfile->id) {
            abort(403);
        }

        $categories = JobCategory::all();

        return view('employer.jobs.edit', compact('job', 'categories'));
    }

    /**
     * Update the specified job in storage.
     */
    public function update(Request $request, Job $job)
    {
        // Ensure the job belongs to the employer
        $companyProfile = CompanyProfile::where('user_id', Auth::id())->firstOrFail();

        if ($job->company_id != $companyProfile->id) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:job_categories,id',
            'type' => 'required|string|in:full-time,part-time,remote,contract',
            'location' => 'required|string|max:255',
            'salary' => 'nullable|numeric|min:0',
            'deadline' => 'nullable|date',
            'description' => 'required|string',
            'is_active' => 'nullable|boolean',
        ]);

        // Update the job
        $job->title = $validated['title'];
        $job->description = $validated['description'];
        $job->category_id = $validated['category_id'];
        $job->location = $validated['location'];
        $job->type = $validated['type'];
        $job->salary = $validated['salary'] ?? null;
        $job->deadline = $validated['deadline'] ?? null;
        $job->is_active = isset($validated['is_active']) ? true : false;
        $job->save();

        return redirect()->route('employer.jobs.index')
            ->with('success', 'Job updated successfully!');
    }

    /**
     * Remove the specified job from storage.
     */
    public function destroy(Job $job)
    {
        // Ensure the job belongs to the employer
        $companyProfile = CompanyProfile::where('user_id', Auth::id())->firstOrFail();

        if ($job->company_id != $companyProfile->id) {
            abort(403);
        }

        $job->delete();

        return redirect()->route('employer.jobs.index')
            ->with('success', 'Job deleted successfully!');
    }
}
