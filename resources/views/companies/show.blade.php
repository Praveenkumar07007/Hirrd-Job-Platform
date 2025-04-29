@extends('layouts.app')

@section('title', $company->company_name)

@section('content')
<div class="container">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Company Header -->
    <div class="card mb-4 shadow-sm">
        <div class="card-body p-4">
            <div class="row align-items-center">
                <div class="col-md-2 text-center mb-3 mb-md-0">
                    @if($company->logo)
                        <img src="{{ asset('storage/' . $company->logo) }}" alt="{{ $company->company_name }}" class="img-fluid" style="max-height: 120px;">
                    @else
                        <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mx-auto" style="width: 120px; height: 120px;">
                            <span class="display-4 text-secondary">{{ substr($company->company_name, 0, 1) }}</span>
                        </div>
                    @endif
                </div>
                <div class="col-md-10">
                    <h1 class="mb-1">{{ $company->company_name }}</h1>
                    <p class="text-muted mb-2">{{ $company->industry }}</p>

                    <div class="d-flex flex-wrap mb-3">
                        @if($company->website)
                            <a href="{{ $company->website }}" class="me-3 text-decoration-none" target="_blank" rel="noopener noreferrer">
                                <i class="bi bi-globe me-1"></i> Website
                            </a>
                        @endif
                        <span class="text-muted">
                            <i class="bi bi-geo-alt me-1"></i> {{ $company->address }}
                        </span>
                    </div>

                    @if(Auth::check() && Auth::id() == $company->user_id)
                        <a href="{{ route('companies.edit') }}" class="btn btn-outline-primary">
                            <i class="bi bi-pencil me-1"></i> Edit Profile
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Company Description -->
        <div class="col-lg-8 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-light">
                    <h5 class="card-title mb-0">About {{ $company->company_name }}</h5>
                </div>
                <div class="card-body p-4">
                    <div class="company-description">
                        {!! nl2br(e($company->description)) !!}
                    </div>
                </div>
            </div>
        </div>

        <!-- Company Stats -->
        <div class="col-lg-4 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-light">
                    <h5 class="card-title mb-0">Company Information</h5>
                </div>
                <div class="card-body p-4">
                    <ul class="list-unstyled">
                        <li class="mb-3">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <i class="bi bi-briefcase text-primary fs-4"></i>
                                </div>
                                <div class="ms-3">
                                    <h6 class="mb-1">Industry</h6>
                                    <p>{{ $company->industry }}</p>
                                </div>
                            </div>
                        </li>
                        <li class="mb-3">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <i class="bi bi-geo-alt text-primary fs-4"></i>
                                </div>
                                <div class="ms-3">
                                    <h6 class="mb-1">Address</h6>
                                    <p>{{ $company->address }}</p>
                                </div>
                            </div>
                        </li>
                        @if($company->website)
                            <li class="mb-3">
                                <div class="d-flex">
                                    <div class="flex-shrink-0">
                                        <i class="bi bi-globe text-primary fs-4"></i>
                                    </div>
                                    <div class="ms-3">
                                        <h6 class="mb-1">Website</h6>
                                        <p>
                                            <a href="{{ $company->website }}" target="_blank" rel="noopener noreferrer">
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
                                    <i class="bi bi-calendar-check text-primary fs-4"></i>
                                </div>
                                <div class="ms-3">
                                    <h6 class="mb-1">Open Positions</h6>
                                    <p>{{ $jobs->count() }} active job listings</p>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Open Positions -->
    <div class="mb-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Open Positions</h2>
        </div>

        @if($jobs->count() > 0)
            <div class="row">
                @foreach($jobs as $job)
                    <div class="col-md-6 mb-4">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body p-4">
                                <h5 class="card-title mb-1">
                                    <a href="{{ route('jobs.show', $job) }}" class="text-decoration-none">{{ $job->title }}</a>
                                </h5>

                                <div class="d-flex flex-wrap my-2">
                                    <span class="badge bg-light text-dark me-2 mb-1">
                                        <i class="bi bi-geo-alt me-1"></i> {{ $job->location }}
                                    </span>
                                    <span class="badge bg-light text-dark me-2 mb-1">
                                        <i class="bi bi-clock me-1"></i> {{ ucfirst($job->type) }}
                                    </span>
                                    @if($job->salary_range)
                                        <span class="badge bg-light text-dark me-2 mb-1">
                                            <i class="bi bi-cash me-1"></i> {{ $job->salary_range }}
                                        </span>
                                    @endif
                                </div>

                                <p class="card-text small text-muted mb-3">{{ Str::limit($job->description, 100) }}</p>

                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="badge bg-primary">{{ $job->category->name }}</span>
                                    <small class="text-muted">Posted {{ $job->created_at->diffForHumans() }}</small>
                                </div>
                            </div>
                            <div class="card-footer bg-white text-center p-3">
                                <a href="{{ route('jobs.show', $job) }}" class="btn btn-outline-primary">View Details</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="card">
                <div class="card-body text-center p-5">
                    <i class="bi bi-briefcase display-1 text-muted"></i>
                    <h3 class="mt-3">No Open Positions</h3>
                    <p class="text-muted">This company doesn't have any active job listings at the moment.</p>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
