@extends('layouts.app')

@section('title', 'Application Details')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-8">
            <h1>Application Details</h1>
            <p class="text-muted">
                Application for {{ $application->job->title }} at {{ $application->job->companyProfile->company_name }}
            </p>
        </div>
        <div class="col-md-4 text-md-end">
            <a href="{{ route('applications.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i> Back to Applications
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row">
        <div class="col-lg-8">
            <!-- Application Status -->
            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-light d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Application Status</h5>

                    @php
                        $statusClass = 'secondary';
                        if ($application->status == 'approved') {
                            $statusClass = 'success';
                        } elseif ($application->status == 'rejected') {
                            $statusClass = 'danger';
                        } elseif ($application->status == 'interviewing') {
                            $statusClass = 'info';
                        } elseif ($application->status == 'pending') {
                            $statusClass = 'warning';
                        }
                    @endphp

                    <span class="badge bg-{{ $statusClass }} me-2 mb-1">
                        {{ ucfirst($application->status) }}
                    </span>
                </div>
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-3">
                        <div class="flex-shrink-0">
                            <i class="bi bi-calendar-check text-primary fs-4"></i>
                        </div>
                        <div class="ms-3">
                            <h6 class="mb-1">Applied On</h6>
                            <p class="mb-0">{{ $application->created_at->format('F j, Y \a\t g:i A') }}</p>
                        </div>
                    </div>

                    @if($application->updated_at != $application->created_at)
                        <div class="d-flex align-items-center mb-3">
                            <div class="flex-shrink-0">
                                <i class="bi bi-clock-history text-primary fs-4"></i>
                            </div>
                            <div class="ms-3">
                                <h6 class="mb-1">Last Updated</h6>
                                <p class="mb-0">{{ $application->updated_at->format('F j, Y \a\t g:i A') }}</p>
                            </div>
                        </div>
                    @endif

                    @if(Auth::user()->user_type == 'employer' && $application->job->companyProfile->user_id == Auth::id())
                        <hr>
                        <form action="{{ route('applications.update-status', $application->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="row align-items-center">
                                <div class="col-md-8">
                                    <div class="mb-3 mb-md-0">
                                        <select name="status" class="form-select">
                                            <option value="pending" {{ $application->status == 'pending' ? 'selected' : '' }}>Pending Review</option>
                                            <option value="interviewing" {{ $application->status == 'interviewing' ? 'selected' : '' }}>Interviewing</option>
                                            <option value="approved" {{ $application->status == 'approved' ? 'selected' : '' }}>Approved</option>
                                            <option value="rejected" {{ $application->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary w-100">Update Status</button>
                                </div>
                            </div>
                        </form>
                    @endif
                </div>
            </div>

            <!-- Cover Letter -->
            @if($application->cover_letter)
                <div class="card mb-4 shadow-sm">
                    <div class="card-header bg-light">
                        <h5 class="card-title mb-0">Cover Letter</h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="cover-letter">
                            {!! nl2br(e($application->cover_letter)) !!}
                        </div>
                    </div>
                </div>
            @endif

            <!-- Resume -->
            @if($application->resume_path)
                <div class="card mb-4 shadow-sm">
                    <div class="card-header bg-light">
                        <h5 class="card-title mb-0">Resume/CV</h5>
                    </div>
                    <div class="card-body p-4 text-center">
                        <p class="mb-4">
                            <i class="bi bi-file-earmark-pdf fs-1 text-danger"></i>
                        </p>
                        <a href="{{ asset('storage/' . $application->resume_path) }}" class="btn btn-outline-primary" target="_blank">
                            <i class="bi bi-eye me-1"></i> View Resume
                        </a>
                        <a href="{{ asset('storage/' . $application->resume_path) }}" class="btn btn-outline-secondary ms-2" download>
                            <i class="bi bi-download me-1"></i> Download
                        </a>
                    </div>
                </div>
            @endif
        </div>

        <div class="col-lg-4">
            <!-- Job Information -->
            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-light">
                    <h5 class="card-title mb-0">Job Information</h5>
                </div>
                <div class="card-body p-4">
                    <h5 class="card-title">
                        <a href="{{ route('jobs.show', $application->job->id) }}" class="text-decoration-none">
                            {{ $application->job->title }}
                        </a>
                    </h5>
                    <p class="mb-3">
                        <a href="{{ route('companies.show', $application->job->companyProfile->id) }}" class="text-decoration-none text-muted">
                            {{ $application->job->companyProfile->company_name }}
                        </a>
                    </p>

                    <div class="d-flex align-items-center mb-3">
                        <div class="flex-shrink-0">
                            <i class="bi bi-geo-alt text-primary fs-4"></i>
                        </div>
                        <div class="ms-3">
                            <h6 class="mb-1">Location</h6>
                            <p class="mb-0">{{ $application->job->location }}</p>
                        </div>
                    </div>

                    <div class="d-flex align-items-center mb-3">
                        <div class="flex-shrink-0">
                            <i class="bi bi-clock text-primary fs-4"></i>
                        </div>
                        <div class="ms-3">
                            <h6 class="mb-1">Job Type</h6>
                            <p class="mb-0">{{ ucfirst($application->job->type) }}</p>
                        </div>
                    </div>

                    @if($application->job->salary_range)
                        <div class="d-flex align-items-center mb-3">
                            <div class="flex-shrink-0">
                                <i class="bi bi-cash text-primary fs-4"></i>
                            </div>
                            <div class="ms-3">
                                <h6 class="mb-1">Salary Range</h6>
                                <p class="mb-0">{{ $application->job->salary_range }}</p>
                            </div>
                        </div>
                    @endif

                    <div class="d-grid mt-4">
                        <a href="{{ route('jobs.show', $application->job->id) }}" class="btn btn-outline-primary">
                            View Job Details
                        </a>
                    </div>
                </div>
            </div>

            <!-- Applicant Information (for employers) -->
            @if(Auth::user()->user_type == 'employer' && $application->job->companyProfile->user_id == Auth::id())
                <div class="card mb-4 shadow-sm">
                    <div class="card-header bg-light">
                        <h5 class="card-title mb-0">Applicant Information</h5>
                    </div>
                    <div class="card-body p-4">
                        <h5 class="card-title">{{ $application->user->name }}</h5>
                        <p class="mb-3 text-muted">{{ $application->user->email }}</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
