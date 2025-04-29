<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\JobApplication;
use App\Models\CompanyProfile;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
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
     * Display admin dashboard with statistics
     */
    public function index()
    {
        $stats = [
            'totalUsers' => User::count(),
            'totalJobs' => Job::count(),
            'totalApplications' => JobApplication::count(),
            'totalCompanies' => CompanyProfile::count(),
            'employerUsers' => User::where('user_type', 'employer')->count(),
            'jobSeekerUsers' => User::where('user_type', 'job_seeker')->count(),
            'activeJobs' => Job::where('status', 'active')->count(),
            'pendingApplications' => JobApplication::where('status', 'pending')->count()
        ];

        $recentUsers = User::latest()->take(5)->get();
        $recentJobs = Job::with('companyProfile')->latest()->take(5)->get();
        $recentApplications = JobApplication::with(['user', 'job'])->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentUsers', 'recentJobs', 'recentApplications'));
    }
}
