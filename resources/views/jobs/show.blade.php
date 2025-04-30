@extends('layouts.app')

@section('title', $job->title . ' - ' . $job->companyProfile->company_name)

@section('content')
<div class="container">
    @if(session('success'))
        <div class="alert alert-success shadow-sm mb-4">
            <div class="d-flex align-items-center">
                <div class="me-3">
                    <i class="bi bi-check-circle-fill fs-3"></i>
                </div>
                <div>
                    <h5 class="mb-1">Application Submitted!</h5>
                    {{ session('success') }}
                </div>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger shadow-sm mb-4">
            <div class="d-flex align-items-center">
                <div class="me-3">
                    <i class="bi bi-exclamation-circle-fill fs-3"></i>
                </div>
                <div>
                    <h5 class="mb-1">Error</h5>
                    {{ session('error') }}
                </div>
            </div>
        </div>
    @endif

    <div class="row mb-4">
        <div class="col-md-8">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('jobs.index') }}">Jobs</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $job->title }}</li>
                </ol>
            </nav>
        </div>
        <div class="col-md-4 text-md-end">
            <a href="{{ route('jobs.index') }}" class="btn btn-outline-primary">
                <i class="bi bi-arrow-left me-2"></i>Back to Jobs
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <!-- Job Details -->
            <div class="card shadow-sm mb-4">
                <!-- Job Image Banner -->
                <img src="{{ $job->job_image_url }}" class="card-img-top" alt="{{ $job->title }} image" style="height: 200px; object-fit: cover;">

                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-4">
                        <div class="flex-shrink-0 me-3">
                            <img src="{{ $job->companyProfile->company_logo_url }}" alt="{{ $job->companyProfile->company_name }}" class="rounded" width="80" height="80" style="object-fit: cover;">
                        </div>

                        <div>
                            <h1 class="h2 mb-1">{{ $job->title }}</h1>
                            <p class="text-muted mb-0">
                                <a href="{{ route('companies.show', $job->companyProfile->id) }}" class="text-decoration-none text-muted">
                                    {{ $job->companyProfile->company_name }} · {{ $job->location }}
                                </a>
                            </p>
                        </div>
                    </div>

                    <div class="d-flex flex-wrap mb-4">
                        <span class="badge bg-light text-dark me-2 mb-2">
                            <i class="bi bi-geo-alt me-1"></i> {{ $job->location }}
                        </span>
                        <span class="badge bg-light text-dark me-2 mb-2">
                            <i class="bi bi-clock me-1"></i> {{ ucfirst($job->type) }}
                        </span>
                        @if($job->salary_range)
                            <span class="badge bg-light text-dark me-2 mb-2">
                                <i class="bi bi-cash me-1"></i> {{ $job->salary_range }}
                            </span>
                        @endif
                        <span class="badge bg-primary me-2 mb-2">{{ $job->category->name }}</span>
                    </div>

                    <div class="job-description mb-5">
                        <h4>Job Description</h4>
                        <div class="mb-4">
                            {!! nl2br(e($job->description)) !!}
                        </div>

                        <h4>Requirements</h4>
                        <div class="mb-4">
                            {!! nl2br(e($job->requirements)) !!}
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-white p-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <small class="text-muted">Posted {{ $job->created_at->diffForHumans() }}</small>
                        </div>
                        <div class="d-flex">
                            <button type="button" class="btn btn-outline-secondary me-2" onclick="shareJob()">
                                <i class="bi bi-share me-1"></i> Share
                            </button>
                            @if(!$hasApplied)
                                <a href="#apply-section" class="btn btn-primary">Apply Now</a>
                            @else
                                <button class="btn btn-success" disabled>
                                    <i class="bi bi-check2-circle me-1"></i> Applied
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Application Form -->
            @if(Auth::check() && Auth::user()->user_type == 'job_seeker')
                <div id="apply-section">
                    @if(!$hasApplied)
                        @include('jobs.apply-form')
                    @else
                        <div class="card shadow-sm mb-4">
                            <div class="card-body p-4 text-center">
                                <div class="mb-3">
                                    <i class="bi bi-check-circle-fill text-success fs-1"></i>
                                </div>
                                <h4>You've Already Applied</h4>
                                <p class="text-muted mb-4">You've already submitted an application for this position.</p>
                                <a href="{{ route('applications.index') }}" class="btn btn-outline-primary">
                                    View Your Application
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            @elseif(Auth::check() && Auth::user()->user_type == 'employer')
                <div class="card shadow-sm mb-4">
                    <div class="card-body p-4 text-center">
                        <h4>You're logged in as an employer</h4>
                        <p class="text-muted mb-0">Switch to a job seeker account to apply for positions.</p>
                    </div>
                </div>
            @else
                <div class="card shadow-sm mb-4">
                    <div class="card-body p-4 text-center">
                        <h4>Want to apply for this job?</h4>
                        <p class="text-muted mb-4">You need to sign in to apply for this position.</p>
                        <div>
                            <a href="{{ route('login') }}" class="btn btn-primary me-2">Sign In</a>
                            <a href="{{ route('register') }}" class="btn btn-outline-secondary">Create Account</a>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <div class="col-lg-4">
            <!-- Company Info -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-light">
                    <h5 class="card-title mb-0">About the Company</h5>
                </div>
                <div class="card-body p-4">
                    <div class="text-center mb-4">
                        <img src="{{ $job->companyProfile->company_logo_url }}" alt="{{ $job->companyProfile->company_name }}" class="img-fluid mb-3" style="max-height: 100px;">
                        <h5 class="card-title">{{ $job->companyProfile->company_name }}</h5>
                        <p class="text-muted">{{ $job->companyProfile->industry }}</p>
                    </div>

                    <p class="card-text small">{{ Str::limit($job->companyProfile->description, 150) }}</p>

                    <div class="d-grid">
                        <a href="{{ route('companies.show', $job->companyProfile->id) }}" class="btn btn-outline-primary">
                            View Company Profile
                        </a>
                    </div>
                </div>
            </div>

            <!-- Related Jobs -->
            @if($relatedJobs->count() > 0)
                <div class="card shadow-sm">
                    <div class="card-header bg-light">
                        <h5 class="card-title mb-0">Similar Jobs</h5>
                    </div>
                    <div class="list-group list-group-flush">
                        @foreach($relatedJobs as $relatedJob)
                            <a href="{{ route('jobs.show', $relatedJob) }}" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-1">{{ $relatedJob->title }}</h6>
                                </div>
                                <p class="mb-1 small text-muted">{{ $relatedJob->companyProfile->company_name }}</p>
                                <small>
                                    <i class="bi bi-geo-alt"></i> {{ $relatedJob->location }} ·
                                    <i class="bi bi-clock"></i> {{ ucfirst($relatedJob->type) }}
                                </small>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

@push('scripts')
<script>
    function shareJob() {
        if (navigator.share) {
            navigator.share({
                title: '{{ $job->title }} - {{ $job->companyProfile->company_name }}',
                text: 'Check out this job opportunity: {{ $job->title }} at {{ $job->companyProfile->company_name }}',
                url: window.location.href,
            });
        } else {
            // Copy to clipboard as fallback
            navigator.clipboard.writeText(window.location.href)
                .then(() => alert('Link copied to clipboard!'))
                .catch(err => console.error('Could not copy text: ', err));
        }
    }
</script>
@endpush
@endsection
