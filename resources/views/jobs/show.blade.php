<?php
@extends('layouts.app')

@section('title', $job->title)

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="mb-4 card">
            <div class="card-body">
                <h1 class="mb-4 card-title">{{ $job->title }}</h1>
                <div class="flex-wrap gap-2 mb-4 d-flex">
                    <span class="badge bg-info">{{ $job->type }}</span>
                    <span class="badge bg-secondary">{{ $job->location }}</span>
                    <span class="badge bg-success">{{ $job->category->name }}</span>
                    @if($job->salary)
                        <span class="badge bg-warning text-dark">${{ number_format($job->salary) }}</span>
                    @endif
                </div>

                <div class="mb-4">
                    <h5>Job Description</h5>
                    <div class="job-description">
                        {{ $job->description }}
                    </div>
                </div>

                @if($job->deadline)
                <div class="alert alert-warning">
                    <strong>Application Deadline:</strong> {{ \Carbon\Carbon::parse($job->deadline)->format('F d, Y') }}
                </div>
                @endif

                <div class="mt-4">
                    @guest
                        <div class="alert alert-info">
                            <a href="{{ route('login') }}">Login</a> or <a href="{{ route('register') }}">Register</a> to apply for this job.
                        </div>
                    @else
                        @if(Auth::user()->user_type == 'job_seeker')
                            @if($hasApplied)
                                <div class="alert alert-success">
                                    You have already applied for this job.
                                    <a href="{{ url('/applications') }}">View your applications</a>
                                </div>
                            @else
                                <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#applyModal">
                                    Apply Now
                                </button>
                            @endif
                        @elseif(Auth::user()->user_type == 'employer' && Auth::id() == $job->companyProfile->user_id)
                            <div class="alert alert-info">
                                This is your job posting.
                                <a href="{{ url('/employer/jobs/'.$job->id.'/applications') }}">View Applications</a>
                            </div>
                        @endif
                    @endguest
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="mb-4 card">
            <div class="card-header bg-light">
                <h5 class="mb-0 card-title">Company Information</h5>
            </div>
            <div class="card-body">
                <div class="mb-3 text-center">
                    @if($job->companyProfile->logo)
                        <img src="{{ asset('storage/'.$job->companyProfile->logo) }}" alt="{{ $job->companyProfile->name }}" class="mb-3 img-fluid" style="max-height: 100px;">
                    @endif
                    <h5>{{ $job->companyProfile->name }}</h5>
                </div>

                <div class="mb-3">
                    <p>{{ $job->companyProfile->description }}</p>
                </div>

                @if($job->companyProfile->website)
                <div class="mb-2">
                    <strong>Website:</strong>
                    <a href="{{ $job->companyProfile->website }}" target="_blank" rel="noopener noreferrer">
                        {{ $job->companyProfile->website }}
                    </a>
                </div>
                @endif

                @if($job->companyProfile->location)
                <div class="mb-2">
                    <strong>Location:</strong> {{ $job->companyProfile->location }}
                </div>
                @endif

                <div class="mt-3">
                    <a href="{{ url('/companies/'.$job->companyProfile->id) }}" class="btn btn-outline-primary w-100">
                        View All Jobs From This Company
                    </a>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header bg-light">
                <h5 class="mb-0 card-title">Job Details</h5>
            </div>
            <div class="card-body">
                <div class="mb-2">
                    <strong>Posted:</strong> {{ $job->created_at->format('F d, Y') }}
                </div>
                <div class="mb-2">
                    <strong>Job Type:</strong> {{ $job->type }}
                </div>
                <div class="mb-2">
                    <strong>Category:</strong> {{ $job->category->name }}
                </div>
                <div class="mb-2">
                    <strong>Location:</strong> {{ $job->location }}
                </div>
                @if($job->salary)
                <div class="mb-2">
                    <strong>Salary:</strong> ${{ number_format($job->salary) }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Apply Modal -->
<div class="modal fade" id="applyModal" tabindex="-1" aria-labelledby="applyModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="applyModalLabel">Apply for {{ $job->title }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ url('/jobs/'.$job->id.'/apply') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="cover_letter" class="form-label">Cover Letter</label>
                        <textarea name="cover_letter" id="cover_letter" rows="5" class="form-control" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="resume" class="form-label">Resume (PDF only)</label>
                        <input type="file" name="resume" id="resume" class="form-control" accept=".pdf" required>
                    </div>

                    <div class="text-end">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Submit Application</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
