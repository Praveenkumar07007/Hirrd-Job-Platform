<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\JobApplication;
use App\Models\CompanyProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
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
     * Show the employer dashboard.
     */
    public function index()
    {
        // Get the employer's company profile
        $companyProfile = CompanyProfile::where('user_id', Auth::id())->first();

        if (!$companyProfile) {
            return redirect()->route('employer.company.create')
                ->with('message', 'Please complete your company profile first.');
        }

        // Get stats and data for the dashboard
        $totalJobs = Job::where('company_id', $companyProfile->id)->count();
        $activeJobs = Job::where('company_id', $companyProfile->id)
            ->where('is_active', true)
            ->count();

        $jobIds = Job::where('company_id', $companyProfile->id)->pluck('id');
        $totalApplications = JobApplication::whereIn('job_id', $jobIds)->count();

        $recentJobs = Job::where('company_id', $companyProfile->id)
            ->with(['category', 'applications'])
            ->latest()
            ->take(5)
            ->get();

        $recentApplications = JobApplication::whereIn('job_id', $jobIds)
            ->with(['user', 'job'])
            ->latest()
            ->take(5)
            ->get();

        return view('employer.dashboard', compact(
            'totalJobs',
            'activeJobs',
            'totalApplications',
            'recentJobs',
            'recentApplications'
        ));
    }
}
