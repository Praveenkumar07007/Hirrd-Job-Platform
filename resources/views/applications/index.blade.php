@extends('layouts.app')

@section('title', 'My Applications')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-8">
            <h1>My Job Applications</h1>
            <p class="text-muted">Track the status of your job applications</p>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if($applications->count() > 0)
        <div class="card shadow-sm">
            <div class="list-group list-group-flush">
                @foreach($applications as $application)
                    <div class="list-group-item p-3">
                        <div class="row align-items-center">
                            <div class="col-md-8">
                                <h5 class="mb-1">
                                    <a href="{{ route('jobs.show', $application->job->id) }}" class="text-decoration-none">
                                        {{ $application->job->title }}
                                    </a>
                                </h5>
                                <p class="mb-1">
                                    <a href="{{ route('companies.show', $application->job->companyProfile->id) }}" class="text-decoration-none text-muted">
                                        {{ $application->job->companyProfile->company_name }}
                                    </a>
                                </p>
                                <div class="d-flex flex-wrap mt-2">
                                    <span class="badge bg-light text-dark me-2 mb-1">
                                        <i class="bi bi-geo-alt me-1"></i> {{ $application->job->location }}
                                    </span>
                                    <span class="badge bg-light text-dark me-2 mb-1">
                                        <i class="bi bi-clock me-1"></i> {{ ucfirst($application->job->type) }}
                                    </span>

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

                                    <small class="text-muted">
                                        Applied {{ $application->created_at->diffForHumans() }}
                                    </small>
                                </div>
                            </div>
                            <div class="col-md-4 text-md-end mt-2 mt-md-0">
                                <a href="{{ route('applications.show', $application->id) }}" class="btn btn-outline-primary">
                                    View Application
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $applications->links() }}
        </div>
    @else
        <div class="card shadow-sm">
            <div class="card-body text-center p-5">
                <i class="bi bi-file-earmark-text display-1 text-muted"></i>
                <h3 class="mt-3">No Applications Yet</h3>
                <p class="mb-4">You haven't applied to any jobs yet.</p>
                <a href="{{ route('jobs.index') }}" class="btn btn-primary">
                    Browse Available Jobs
                </a>
            </div>
        </div>
    @endif
</div>
@endsection
