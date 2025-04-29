@extends('layouts.app')

@section('title', 'Employer Dashboard')

@section('content')
<div class="row mb-4">
    <div class="col-md-12">
        <h1>Employer Dashboard</h1>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-4">
        <div class="card text-center">
            <div class="card-body">
                <h3 class="card-title">{{ $totalJobs }}</h3>
                <p class="card-text">Total Jobs Posted</p>
                <a href="{{ url('/employer/jobs') }}" class="btn btn-outline-primary">Manage Jobs</a>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card text-center">
            <div class="card-body">
                <h3 class="card-title">{{ $totalApplications }}</h3>
                <p class="card-text">Total Applications</p>
                <a href="{{ url('/employer/applications') }}" class="btn btn-outline-primary">View Applications</a>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card text-center">
            <div class="card-body">
                <h3 class="card-title">{{ $activeJobs }}</h3>
                <p class="card-text">Active Jobs</p>
                <a href="{{ url('/employer/jobs/create') }}" class="btn btn-primary">Post New Job</a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card mb-4">
            <div class="card-header bg-light">
                <h5 class="card-title mb-0">Recent Applications</h5>
            </div>
            <div class="card-body">
                @if($recentApplications->count() > 0)
                    <div class="list-group">
                        @foreach($recentApplications as $application)
                        <a href="{{ url('/employer/applications/'.$application->id) }}" class="list-group-item list-group-item-action">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">{{ $application->user->name }}</h5>
                                <small>{{ $application->created_at->diffForHumans() }}</small>
                            </div>
                            <p class="mb-1">Applied for: {{ $application->job->title }}</p>
                            <small class="text-muted">
                                Status:
                                @if($application->status == 'pending')
                                    <span class="badge bg-warning text-dark">Pending</span>
                                @elseif($application->status == 'reviewed')
                                    <span class="badge bg-info">Reviewed</span>
                                @elseif($application->status == 'rejected')
                                    <span class="badge bg-danger">Rejected</span>
                                @elseif($application->status == 'accepted')
                                    <span class="badge bg-success">Accepted</span>
                                @endif
                            </small>
                        </a>
                        @endforeach
                    </div>

                    <div class="mt-3">
                        <a href="{{ url('/employer/applications') }}" class="btn btn-sm btn-outline-primary">View All Applications</a>
                    </div>
                @else
                    <p class="text-muted">No recent applications.</p>
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card mb-4">
            <div class="card-header bg-light">
                <h5 class="card-title mb-0">Recent Jobs</h5>
            </div>
            <div class="card-body">
                @if($recentJobs->count() > 0)
                    <div class="list-group">
                        @foreach($recentJobs as $job)
                        <a href="{{ url('/jobs/'.$job->id) }}" class="list-group-item list-group-item-action">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">{{ $job->title }}</h5>
                                <small class="text-muted">{{ $job->created_at->diffForHumans() }}</small>
                            </div>
                            <p class="mb-1">{{ Str::limit($job->description, 100) }}</p>
                            <small class="text-muted">
                                <span class="badge bg-info">{{ $job->type }}</span>
                                <span class="badge bg-secondary">{{ $job->location }}</span>
                                <span class="badge bg-success">{{ $job->category->name }}</span>
                                {{ $job->applications->count() }} applications
                            </small>
                        </a>
                        @endforeach
                    </div>

                    <div class="mt-3">
                        <a href="{{ url('/employer/jobs') }}" class="btn btn-sm btn-outline-primary">View All Jobs</a>
                        <a href="{{ url('/employer/jobs/create') }}" class="btn btn-sm btn-primary float-end">Post New Job</a>
                    </div>
                @else
                    <p class="text-muted">No jobs posted yet.</p>
                    <a href="{{ url('/employer/jobs/create') }}" class="btn btn-primary">Post New Job</a>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
