<?php

namespace App\Http\Controllers;

use App\Models\CompanyProfile;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
    /**
     * Constructor to apply middleware
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of companies
     */
    public function index(Request $request)
    {
        $query = CompanyProfile::query();

        // Filter by name/industry
        if ($request->filled('keyword')) {
            $keyword = $request->keyword;
            $query->where(function ($q) use ($keyword) {
                $q->where('company_name', 'like', '%' . $keyword . '%')
                    ->orWhere('industry', 'like', '%' . $keyword . '%')
                    ->orWhere('description', 'like', '%' . $keyword . '%');
            });
        }

        // Filter by industry
        if ($request->filled('industry')) {
            $query->where('industry', $request->industry);
        }

        $companies = $query->paginate(12)->withQueryString();

        // Get list of unique industries for filter
        $industries = CompanyProfile::distinct()->pluck('industry')->filter()->sort();

        return view('companies.index', compact('companies', 'industries'));
    }

    /**
     * Display the specified company
     */
    public function show(CompanyProfile $company)
    {
        // Get active jobs for this company
        $jobs = Job::where('company_profile_id', $company->id)
            ->where('status', 'active')
            ->latest()
            ->get();

        return view('companies.show', compact('company', 'jobs'));
    }

    /**
     * Show the form for editing the company profile
     */
    public function edit()
    {
        $company = CompanyProfile::where('user_id', Auth::id())->first();

        if (!$company && Auth::user()->user_type === 'employer') {
            return redirect()->route('companies.create');
        }

        return view('companies.edit', compact('company'));
    }

    /**
     * Update the company profile
     */
    public function update(Request $request)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'website' => 'nullable|url',
            'industry' => 'required|string|max:100',
            'description' => 'required|string',
            'address' => 'required|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $company = CompanyProfile::where('user_id', Auth::id())->first();

        if ($company) {
            $company->update($request->except('logo'));

            if ($request->hasFile('logo')) {
                $path = $request->file('logo')->store('company_logos', 'public');
                $company->logo = $path;
                $company->save();
            }

            return redirect()->route('companies.show', $company)->with('success', 'Company profile updated successfully');
        }

        return back()->with('error', 'Company profile not found');
    }

    /**
     * Show the form for creating a new company profile
     */
    public function create()
    {
        if (CompanyProfile::where('user_id', Auth::id())->exists()) {
            return redirect()->route('companies.edit');
        }

        return view('companies.create');
    }

    /**
     * Store a newly created company profile
     */
    public function store(Request $request)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'website' => 'nullable|url',
            'industry' => 'required|string|max:100',
            'description' => 'required|string',
            'address' => 'required|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $company = new CompanyProfile();
        $company->fill($request->except('logo'));
        $company->user_id = Auth::id();

        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('company_logos', 'public');
            $company->logo = $path;
        }

        $company->save();

        return redirect()->route('companies.show', $company)->with('success', 'Company profile created successfully');
    }
}
