<?php

namespace App\Http\Controllers;

use App\Models\JobApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobApplicationController extends Controller
{
    /**
     * Constructor to apply middleware
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of job applications for job seeker.
     */
    public function index()
    {
        // Ensure user is a job seeker
        if (Auth::user()->user_type != 'job_seeker') {
            return redirect()->route('home');
        }

        $applications = JobApplication::where('user_id', Auth::id())
            ->with(['job', 'job.companyProfile'])
            ->latest()
            ->paginate(10);

        return view('applications.index', compact('applications'));
    }

    /**
     * Display the specified application.
     */
    public function show(JobApplication $application)
    {
        // Ensure user is the owner of the application or the employer
        if (Auth::user()->user_type == 'job_seeker' && $application->user_id != Auth::id()) {
            abort(403);
        }

        if (Auth::user()->user_type == 'employer' && $application->job->companyProfile->user_id != Auth::id()) {
            abort(403);
        }

        $application->load(['job', 'job.companyProfile', 'user']);

        return view('applications.show', compact('application'));
    }
}
