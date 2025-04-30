@extends('layouts.app')

@section('title', $company->name ?? $company->company_name)

@section('content')
<div class="container py-5">
    @if(session('success'))
        <div class="border-0 shadow-sm alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Company Header with Enhanced Hero Section -->
    <div class="mb-5 overflow-hidden border-0 shadow card rounded-4">
        <div class="p-0 card-body">
            <!-- Company Banner with improved design -->
            <div class="p-5 text-white bg-primary bg-gradient position-relative company-header">
                <div class="row align-items-center position-relative z-index-1">
                    <div class="mb-4 text-center col-md-2 mb-md-0">
                        @if($company->logo)
                            <div class="p-3 bg-white shadow rounded-circle d-inline-block company-logo-container">
                                <img src="{{ asset('storage/' . $company->logo) }}" alt="{{ $company->name ?? $company->company_name }}" class="company-logo">
                            </div>
                        @else
                            <div class="bg-white shadow rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 100px; height: 100px;">
                                <span class="h1 mb-0 text-primary fw-bold">{{ substr($company->name ?? $company->company_name ?? 'C', 0, 1) }}</span>
                            </div>
                        @endif
                    </div>
                    <div class="col-md-10">
                        <div class="flex-wrap d-flex justify-content-between align-items-start">
                            <div>
                                <h1 class="mb-1 display-5 fw-bold">{{ $company->name ?? $company->company_name }}</h1>
                                <p class="mb-3 opacity-75 fs-5">{{ $company->industry ?? 'Industry Not Specified' }}</p>

                                <div class="flex-wrap mb-3 d-flex">
                                    @if($company->website)
                                        <a href="{{ $company->website }}" class="mb-2 btn btn-light btn-sm me-2" target="_blank" rel="noopener noreferrer">
                                            <i class="bi bi-globe me-1"></i> Corporate Website
                                        </a>
                                    @endif
                                    <button class="mb-2 btn btn-light btn-sm me-2">
                                        <i class="bi bi-geo-alt me-1"></i> {{ $company->location ?? $company->address ?? 'Location Not Specified' }}
                                    </button>
                                    <button class="mb-2 btn btn-light btn-sm me-2">
                                        <i class="bi bi-briefcase me-1"></i> {{ $jobs->count() }} Available Positions
                                    </button>
                                </div>
                            </div>

                            @if(Auth::check() && Auth::id() == $company->user_id)
                                <div>
                                    <a href="{{ route('companies.edit') }}" class="btn btn-light">
                                        <i class="bi bi-pencil me-1"></i> Edit Organization Profile
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <!-- Company Description with improved content display -->
        <div class="col-lg-8">
            <div class="border-0 shadow-sm card rounded-4 h-100">
                <div class="p-4 bg-white card-header border-bottom">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-info-circle-fill text-primary fs-4 me-2"></i>
                        <h3 class="mb-0 card-title fw-bold">About {{ $company->name ?? $company->company_name }}</h3>
                    </div>
                </div>
                <div class="p-4 card-body">
                    <div class="company-description lh-lg">
                        @if($company->description)
                            {!! nl2br(e($company->description)) !!}
                        @else
                            <p class="text-muted">This organization has not provided a detailed description yet.</p>
                        @endif
                    </div>

                    <!-- Enhanced with mission and culture section if available -->
                    @if(isset($company->mission) || isset($company->culture))
                        <div class="mt-4 pt-4 border-top">
                            @if(isset($company->mission))
                                <h4 class="fw-bold mb-3">Our Mission</h4>
                                <p class="mb-4">{{ $company->mission }}</p>
                            @endif

                            @if(isset($company->culture))
                                <h4 class="fw-bold mb-3">Our Culture</h4>
                                <p>{{ $company->culture }}</p>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Company Stats with improved visualization -->
        <div class="col-lg-4">
            <div class="border-0 shadow-sm card rounded-4 h-100">
                <div class="p-4 bg-white card-header border-bottom">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-building-fill text-primary fs-4 me-2"></i>
                        <h3 class="mb-0 card-title fw-bold">Organization Overview</h3>
                    </div>
                </div>
                <div class="p-4 card-body">
                    <ul class="list-unstyled">
                        <li class="mb-4">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <div class="p-3 bg-light rounded-circle d-inline-flex justify-content-center align-items-center">
                                        <i class="bi bi-briefcase text-primary fs-4"></i>
                                    </div>
                                </div>
                                <div class="ms-3">
                                    <h6 class="mb-1 fw-bold">Industry Sector</h6>
                                    <p class="mb-0">{{ $company->industry ?? 'Not Specified' }}</p>
                                </div>
                            </div>
                        </li>
                        <li class="mb-4">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <div class="p-3 bg-light rounded-circle d-inline-flex justify-content-center align-items-center">
                                        <i class="bi bi-geo-alt text-primary fs-4"></i>
                                    </div>
                                </div>
                                <div class="ms-3">
                                    <h6 class="mb-1 fw-bold">Location</h6>
                                    <p class="mb-0">{{ $company->location ?? $company->address ?? 'Not Specified' }}</p>
                                </div>
                            </div>
                        </li>
                        @if($company->company_size)
                            <li class="mb-4">
                                <div class="d-flex">
                                    <div class="flex-shrink-0">
                                        <div class="p-3 bg-light rounded-circle d-inline-flex justify-content-center align-items-center">
                                            <i class="bi bi-people text-primary fs-4"></i>
                                        </div>
                                    </div>
                                    <div class="ms-3">
                                        <h6 class="mb-1 fw-bold">Organization Size</h6>
                                        <p class="mb-0">{{ $company->company_size }}</p>
                                    </div>
                                </div>
                            </li>
                        @endif
                        @if($company->website)
                            <li class="mb-4">
                                <div class="d-flex">
                                    <div class="flex-shrink-0">
                                        <div class="p-3 bg-light rounded-circle d-inline-flex justify-content-center align-items-center">
                                            <i class="bi bi-globe text-primary fs-4"></i>
                                        </div>
                                    </div>
                                    <div class="ms-3">
                                        <h6 class="mb-1 fw-bold">Website</h6>
                                        <p class="mb-0">
                                            <a href="{{ $company->website }}" class="text-decoration-none" target="_blank" rel="noopener noreferrer">
                                                {{ $company->website }}
                                            </a>
                                        </p>
                                    </div>
                                </div>
                            </li>
                        @endif
                        <li>
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <div class="p-3 bg-light rounded-circle d-inline-flex justify-content-center align-items-center">
                                        <i class="bi bi-calendar-check text-primary fs-4"></i>
                                    </div>
                                </div>
                                <div class="ms-3">
                                    <h6 class="mb-1 fw-bold">Open Positions</h6>
                                    <p class="mb-0">{{ $jobs->count() }} active job listings</p>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Open Positions with enhanced search and card presentation -->
    <div class="mt-5">
        <div class="mb-4 d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <div class="p-2 me-3 bg-primary bg-opacity-10 rounded-circle">
                    <i class="bi bi-briefcase-fill text-primary fs-3"></i>
                </div>
                <h2 class="mb-0 fw-bold">Available Positions</h2>
            </div>

            @if($jobs->count() > 0)
                <button class="btn btn-outline-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseJobFilters">
                    <i class="bi bi-funnel me-1"></i> Filter Opportunities
                </button>
            @endif
        </div>

        @if($jobs->count() > 0)
            <div class="mb-4 collapse" id="collapseJobFilters">
                <div class="border-0 shadow-sm card card-body rounded-4">
                    <form action="{{ route('companies.show', $company->id) }}" method="GET" class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label"><i class="bi bi-briefcase me-1"></i> Role Type</label>
                            <select name="job_type" class="form-select">
                                <option value="">All Types</option>
                                <option value="full-time" {{ request('job_type') == 'full-time' ? 'selected' : '' }}>Full-time</option>
                                <option value="part-time" {{ request('job_type') == 'part-time' ? 'selected' : '' }}>Part-time</option>
                                <option value="contract" {{ request('job_type') == 'contract' ? 'selected' : '' }}>Contract</option>
                                <option value="internship" {{ request('job_type') == 'internship' ? 'selected' : '' }}>Internship</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label"><i class="bi bi-tag me-1"></i> Department</label>
                            <select name="category" class="form-select">
                                <option value="">All Departments</option>
                                <!-- Populate from your categories -->
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label"><i class="bi bi-geo-alt me-1"></i> Location</label>
                            <input type="text" name="location" class="form-control" placeholder="Any location" value="{{ request('location') }}">
                        </div>
                        <div class="col-12 text-end">
                            <button type="submit" class="btn btn-primary">Apply Filters</button>
                            <a href="{{ route('companies.show', $company->id) }}" class="btn btn-outline-secondary ms-2">Clear</a>
                        </div>
                    </form>
                </div>
            </div>

            <div class="row g-4">
                @foreach($jobs as $job)
                    <div class="col-md-6">
                        <div class="border-0 shadow-sm card h-100 rounded-4 hover-card">
                            <div class="p-4 card-body">
                                <div class="mb-3 d-flex justify-content-between align-items-start">
                                    <h5 class="mb-1 card-title fw-bold">
                                        <a href="{{ route('jobs.show', $job) }}" class="text-decoration-none text-dark job-title">{{ $job->title }}</a>
                                    </h5>
                                    <span class="badge bg-primary rounded-pill">{{ $job->category->name ?? 'General' }}</span>
                                </div>

                                <div class="flex-wrap mb-3 d-flex">
                                    <span class="p-2 mb-2 badge bg-light text-dark me-2">
                                        <i class="bi bi-geo-alt me-1"></i> {{ $job->location ?? 'Multiple Locations' }}
                                    </span>
                                    <span class="p-2 mb-2 badge bg-light text-dark me-2">
                                        <i class="bi bi-clock me-1"></i> {{ ucfirst($job->type ?? $job->job_type ?? 'Full-time') }}
                                    </span>
                                    @if(isset($job->salary_min) && isset($job->salary_max))
                                        <span class="p-2 mb-2 badge bg-light text-dark me-2">
                                            <i class="bi bi-cash me-1"></i> ${{ number_format($job->salary_min) }} - ${{ number_format($job->salary_max) }}
                                        </span>
                                    @elseif($job->salary_range)
                                        <span class="p-2 mb-2 badge bg-light text-dark me-2">
                                            <i class="bi bi-cash me-1"></i> {{ $job->salary_range }}
                                        </span>
                                    @endif
                                </div>

                                <p class="mb-4 card-text text-muted">{{ Str::limit($job->description, 120) }}</p>

                                <div class="d-flex justify-content-between align-items-center">
                                    <small class="text-muted">Posted {{ $job->created_at->diffForHumans() }}</small>
                                    <a href="{{ route('jobs.show', $job) }}" class="btn btn-sm btn-outline-primary">View Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="border-0 shadow-sm card rounded-4">
                <div class="p-5 text-center card-body">
                    <div class="py-5">
                        <i class="mb-4 bi bi-briefcase display-1 text-muted opacity-50"></i>
                        <h3 class="mb-3 fw-bold">No Open Positions</h3>
                        <p class="mb-4 text-muted">This organization doesn't have any active job listings at the moment. We recommend checking back soon as new opportunities may become available.</p>
                        <a href="{{ route('companies.index') }}" class="btn btn-primary">
                            <i class="bi bi-buildings me-1"></i> Explore Other Organizations
                        </a>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

<style>
    /* Enhanced styling with professional color scheme */
    .company-header {
        background-color: #4361ee;
        background-image: linear-gradient(135deg, #4361ee 0%, #3a0ca3 100%);
    }

    .company-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='100' height='100' viewBox='0 0 100 100'%3E%3Cg fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath opacity='.5' d='M96 95h4v1h-4v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9zm-1 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-9-10h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm9-10v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-9-10h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm9-10v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-9-10h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9z'/%3E%3Cpath d='M6 5V0H5v5H0v1h5v94h1V6h94V5H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        z-index: 0;
    }

    .z-index-1 {
        z-index: 1;
    }

    .hover-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .hover-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.175) !important;
    }

    .job-title:hover {
        color: #4361ee !important;
    }

    .company-logo-container {
        width: 100px;
        height: 100px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .company-logo {
        max-width: 80px;
        max-height: 80px;
        object-fit: contain;
    }

    .company-description {
        font-size: 1.05rem;
        line-height: 1.8;
    }

    .bg-primary {
        background-color: #4361ee !important;
    }

    .text-primary {
        color: #4361ee !important;
    }

    .btn-outline-primary {
        color: #4361ee;
        border-color: #4361ee;
    }

    .btn-outline-primary:hover {
        background-color: #4361ee;
        border-color: #4361ee;
    }

    .btn-primary {
        background-color: #4361ee;
        border-color: #4361ee;
    }

    .btn-primary:hover {
        background-color: #3a52d8;
        border-color: #3a52d8;
    }
</style>
@endsection
