@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Hero Section -->
    <div class="mb-5 row">
        <div class="col-md-12">
            <div class="p-5 text-white rounded shadow bg-primary">
                <div class="row align-items-center">
                    <div class="col-md-7">
                        <h1 class="display-4">Find Your Dream Job</h1>
                        <p class="lead">Discover thousands of job opportunities with the best companies</p>

                        <form action="{{ route('jobs.index') }}" method="GET" class="mt-4">
                            <div class="row g-2">
                                <div class="col-md-5">
                                    <input type="text" name="keyword" class="form-control form-control-lg" placeholder="Job title or keyword" value="{{ request('keyword') }}">
                                </div>
                                <div class="col-md-5">
                                    <input type="text" name="location" class="form-control form-control-lg" placeholder="Location" value="{{ request('location') }}">
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-light btn-lg w-100">Search</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-5 d-none d-md-block">
                        <img src="https://via.placeholder.com/500x300?text=Find+Your+Career" alt="Find your career" class="rounded img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Job Categories Section -->
    <div class="mb-5 row">
        <div class="mb-4 col-md-12">
            <div class="d-flex justify-content-between align-items-center">
                <h2>Browse by Category</h2>
                <a href="{{ route('jobs.index') }}" class="btn btn-outline-primary">View All Categories</a>
            </div>
        </div>

        @if(isset($categories) && $categories->count() > 0)
            @foreach($categories->take(8) as $category)
                <div class="mb-4 col-md-3 col-sm-6">
                    <a href="{{ route('jobs.index', ['category' => $category->id]) }}" class="text-decoration-none">
                        <div class="border-0 shadow-sm card h-100">
                            <div class="p-4 text-center card-body">
                                <div class="mx-auto mb-3 rounded-circle bg-light d-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                                    <i class="bi bi-briefcase fs-3 text-primary"></i>
                                </div>
                                <h5 class="card-title">{{ $category->name }}</h5>
                                <p class="text-muted small">{{ $category->jobs_count ?? 0 }} jobs available</p>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        @else
            <div class="col-12">
                <div class="alert alert-info">No categories available yet.</div>
            </div>
        @endif
    </div>

    <!-- Featured Jobs Section -->
    <div class="mb-5 row">
        <div class="mb-4 col-md-12">
            <div class="d-flex justify-content-between align-items-center">
                <h2>Featured Jobs</h2>
                <a href="{{ route('jobs.index') }}" class="btn btn-outline-primary">View All Jobs</a>
            </div>
        </div>

        @if(isset($featuredJobs) && $featuredJobs->count() > 0)
            @foreach($featuredJobs as $job)
                <div class="mb-4 col-md-6">
                    <div class="border-0 shadow-sm card h-100">
                        <div class="p-4 card-body">
                            <div class="mb-3 d-flex align-items-center">
                                @if($job->companyProfile->logo)
                                    <img src="{{ asset('storage/' . $job->companyProfile->logo) }}" alt="{{ $job->companyProfile->company_name }}" class="me-3" style="width: 60px; height: 60px; object-fit: contain;">
                                @else
                                    <div class="rounded bg-light d-flex align-items-center justify-content-center me-3" style="width: 60px; height: 60px;">
                                        <span class="m-0 h3 text-secondary">{{ substr($job->companyProfile->company_name, 0, 1) }}</span>
                                    </div>
                                @endif
                                <div>
                                    <h5 class="mb-1">{{ $job->title }}</h5>
                                    <div class="text-muted">{{ $job->companyProfile->company_name }}</div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="mb-2 d-flex align-items-center">
                                    <i class="bi bi-geo-alt me-2 text-muted"></i>
                                    <span>{{ $job->location }}</span>
                                </div>
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-clock me-2 text-muted"></i>
                                    <span>{{ $job->type }}</span>

                                    @if($job->salary_range)
                                        <i class="bi bi-cash ms-3 me-2 text-muted"></i>
                                        <span>{{ $job->salary_range }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <span class="badge bg-primary me-1">{{ $job->category->name }}</span>
                                    <small class="text-muted">Posted {{ $job->created_at->diffForHumans() }}</small>
                                </div>
                                <a href="{{ route('jobs.show', $job->id) }}" class="btn btn-sm btn-outline-primary">View Details</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="col-12">
                <div class="alert alert-info">No featured jobs available right now.</div>
            </div>
        @endif
    </div>

    <!-- Featured Companies Section -->
    <div class="mb-5 row">
        <div class="mb-4 col-md-12">
            <div class="d-flex justify-content-between align-items-center">
                <h2>Featured Companies</h2>
                <a href="{{ route('companies.index') }}" class="btn btn-outline-primary">View All Companies</a>
            </div>
        </div>

        @if(isset($featuredCompanies) && $featuredCompanies->count() > 0)
            @foreach($featuredCompanies->take(4) as $company)
                <div class="mb-4 col-md-3 col-sm-6">
                    <div class="border-0 shadow-sm card h-100">
                        <div class="p-4 text-center card-body">
                            <div class="mb-3">
                                @if($company->logo)
                                    <img src="{{ asset('storage/' . $company->logo) }}" alt="{{ $company->company_name }}" class="mb-3 img-fluid" style="max-height: 80px;">
                                @else
                                    <div class="mx-auto mb-3 bg-light rounded-circle d-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                                        <span class="m-0 h3 text-secondary">{{ substr($company->company_name, 0, 1) }}</span>
                                    </div>
                                @endif
                            </div>
                            <h5 class="card-title">{{ $company->company_name }}</h5>
                            <p class="text-muted small">{{ $company->industry }}</p>
                            <a href="{{ route('companies.show', $company->id) }}" class="btn btn-sm btn-outline-primary">View Profile</a>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="col-12">
                <div class="alert alert-info">No featured companies available yet.</div>
            </div>
        @endif
    </div>
</div>
@endsection
