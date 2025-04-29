<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\JobCategory;
use App\Models\CompanyProfile;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Home page is public, so no middleware here
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Fetch job categories with job count
        $categories = JobCategory::withCount('jobs')->get();

        // Get featured jobs (active jobs, latest first, limited to 6)
        $featuredJobs = Job::with(['companyProfile', 'category'])
            ->where('is_active', true) // Changed 'status' to 'is_active' and 'active' to true
            ->latest()
            ->take(6)
            ->get();

        // Get featured companies (those with at least one active job)
        // Eloquent will now correctly infer the keys based on updated model relationships
        $featuredCompanies = CompanyProfile::whereHas('jobs', function ($query) {
            $query->where('is_active', true);
        })
            ->take(4)
            ->get();

        return view('home', compact('categories', 'featuredJobs', 'featuredCompanies'));
    }
}
