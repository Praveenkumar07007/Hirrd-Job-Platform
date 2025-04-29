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

        // Filter by name/description
        if ($request->filled('keyword')) {
            $keyword = $request->keyword;
            $query->where(function ($q) use ($keyword) {
                $q->where('name', 'like', '%' . $keyword . '%')
                    ->orWhere('description', 'like', '%' . $keyword . '%');
            });
        }

        $companies = $query->paginate(12)->withQueryString();

        // Pass an empty collection if the view expects it
        $industries = collect();

        return view('companies.index', compact('companies', 'industries'));
    }

    /**
     * Display the specified company
     */
    public function show(CompanyProfile $company)
    {
        // Get active jobs for this company (using the relationship defined in the model)
        $jobs = $company->jobs()->where('is_active', true)->latest()->get();

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
        $company = CompanyProfile::where('user_id', Auth::id())->firstOrFail();

        $request->validate([
            'name' => 'required|string|max:255',
            'website' => 'nullable|url',
            'description' => 'required|string',
            'location' => 'required|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $company->update($request->except('logo'));

        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('company_logos', 'public');
            $company->logo = $path;
            $company->save();
        }

        return redirect()->route('companies.show', $company)->with('success', 'Company profile updated successfully');
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
            'name' => 'required|string|max:255',
            'website' => 'nullable|url',
            'description' => 'required|string',
            'location' => 'required|string',
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
