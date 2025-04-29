@extends('layouts.app')

@section('title', 'Find Jobs')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-8">
            <h1 class="h2">Find Your Next Career Opportunity</h1>
            <p class="text-muted">Browse through our latest job openings</p>
        </div>
        <div class="col-md-4 text-md-end">
            <a href="{{ route('home') }}" class="btn btn-link">
                <i class="bi bi-arrow-left me-1"></i> Back to Home
            </a>
        </div>
    </div>

    <div class="row">
        <!-- Search Filters Sidebar -->
        <div class="col-lg-4 mb-4 mb-lg-0">
            <div class="card shadow-sm mb-4">
                <div class="card-body p-4">
                    <h5 class="card-title mb-3">Search & Filters</h5>
                    <form action="{{ route('jobs.index') }}" method="GET">
                        <div class="mb-3">
                            <label for="keyword" class="form-label">Keywords</label>
                            <input type="text" class="form-control" id="keyword" name="keyword"
                                placeholder="Job title, skills, or company" value="{{ request('keyword') }}">
                        </div>

                        <div class="mb-3">
                            <label for="location" class="form-label">Location</label>
                            <input type="text" class="form-control" id="location" name="location"
                                placeholder="City, state, or remote" value="{{ request('location') }}">
                        </div>

                        <div class="mb-3">
                            <label for="category" class="form-label">Category</label>
                            <select class="form-select" id="category" name="category">
                                <option value="">All Categories</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ request('category') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="type" class="form-label">Job Type</label>
                            <select class="form-select" id="type" name="type">
                                <option value="">All Types</option>
                                @foreach($jobTypes as $type)
                                    <option value="{{ $type }}" {{ request('type') == $type ? 'selected' : '' }}>
                                        {{ ucfirst($type) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-search me-1"></i> Search Jobs
                            </button>
                            <a href="{{ route('jobs.index') }}" class="btn btn-outline-secondary">Reset Filters</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Job Listings -->
        <div class="col-lg-8">
            <!-- Results Summary -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <p class="mb-0">
                    Showing <strong>{{ $jobs->firstItem() ?? 0 }}</strong> -
                    <strong>{{ $jobs->lastItem() ?? 0 }}</strong> of
                    <strong>{{ $jobs->total() }}</strong> jobs
                </p>
            </div>

            <!-- No Results Message -->
            @if($jobs->isEmpty())
                <div class="card shadow-sm">
                    <div class="card-body p-5 text-center">
                        <div class="mb-3">
                            <i class="bi bi-search fs-1 text-muted"></i>
                        </div>
                        <h4>No Jobs Found</h4>
                        <p class="text-muted mb-4">
                            We couldn't find any jobs matching your search criteria.
                            Try adjusting your filters or search terms.
                        </p>
                        <a href="{{ route('jobs.index') }}" class="btn btn-outline-primary">
                            Clear Filters
                        </a>
                    </div>
                </div>
            @endif

            <!-- Job Listings -->
            <div class="job-listings">
                @foreach($jobs as $job)
                    <div class="card shadow-sm mb-4">
                        <div class="card-body p-4">
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0 me-3">
                                            @if($job->companyProfile->logo)
                                                <img src="{{ asset('storage/' . $job->companyProfile->logo) }}"
                                                     alt="{{ $job->companyProfile->company_name }}" class="rounded" width="60">
                                            @else
                                                <div class="bg-light rounded d-flex align-items-center justify-content-center"
                                                     style="width: 60px; height: 60px;">
                                                    <span class="h4 mb-0 text-secondary">
                                                        {{ substr($job->companyProfile->company_name, 0, 1) }}
                                                    </span>
                                                </div>
                                            @endif
                                        </div>
                                        <div>
                                            <h5 class="card-title mb-1">
                                                <a href="{{ route('jobs.show', $job) }}" class="text-decoration-none text-dark">
                                                    {{ $job->title }}
                                                </a>
                                            </h5>
                                            <p class="mb-2">
                                                <a href="{{ route('companies.show', $job->companyProfile->id) }}"
                                                   class="text-decoration-none text-muted">
                                                    {{ $job->companyProfile->company_name }}
                                                </a>
                                            </p>
                                            <div class="d-flex flex-wrap">
                                                <span class="badge bg-light text-dark me-2 mb-1">
                                                    <i class="bi bi-geo-alt"></i> {{ $job->location }}
                                                </span>
                                                <span class="badge bg-light text-dark me-2 mb-1">
                                                    <i class="bi bi-clock"></i> {{ ucfirst($job->type) }}
                                                </span>
                                                @if($job->salary_range)
                                                    <span class="badge bg-light text-dark me-2 mb-1">
                                                        <i class="bi bi-cash"></i> {{ $job->salary_range }}
                                                    </span>
                                                @endif
                                                <span class="badge bg-primary mb-1">{{ $job->category->name }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="card-text text-muted small mt-3">
                                        {{ Str::limit($job->description, 150) }}
                                    </p>
                                </div>
                                <div class="col-md-3 mt-3 mt-md-0 d-flex flex-column justify-content-between">
                                    <div class="text-md-end">
                                        <small class="text-muted">Posted {{ $job->created_at->diffForHumans() }}</small>
                                    </div>
                                    <div class="mt-auto text-md-end">
                                        <a href="{{ route('jobs.show', $job) }}" class="btn btn-outline-primary">
                                            View Details
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {{ $jobs->withQueryString()->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
