@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-12">
            <h1>Admin Dashboard</h1>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-md-3 mb-4">
            <div class="card text-center bg-primary text-white">
                <div class="card-body">
                    <h3 class="card-title">{{ $stats['totalUsers'] }}</h3>
                    <p class="card-text">Total Users</p>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-light">View All</a>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card text-center bg-success text-white">
                <div class="card-body">
                    <h3 class="card-title">{{ $stats['totalJobs'] }}</h3>
                    <p class="card-text">Total Jobs</p>
                    <a href="{{ route('admin.jobs.index') }}" class="btn btn-sm btn-light">View All</a>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card text-center bg-info text-white">
                <div class="card-body">
                    <h3 class="card-title">{{ $stats['totalApplications'] }}</h3>
                    <p class="card-text">Applications</p>
                    <small>{{ $stats['pendingApplications'] }} Pending</small>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card text-center bg-warning text-dark">
                <div class="card-body">
                    <h3 class="card-title">{{ $stats['totalCompanies'] }}</h3>
                    <p class="card-text">Companies</p>
                    <a href="{{ route('admin.companies.index') }}" class="btn btn-sm btn-dark">View All</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Recent Jobs -->
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header bg-light">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Recent Job Postings</h5>
                        <a href="{{ route('admin.jobs.index') }}" class="btn btn-sm btn-primary">View All</a>
                    </div>
                </div>
                <div class="card-body">
                    @if(count($recentJobs) > 0)
                        <div class="list-group">
                            @foreach($recentJobs as $job)
                                <a href="{{ route('admin.jobs.show', $job) }}" class="list-group-item list-group-item-action">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1">{{ $job->title }}</h5>
                                        <small class="text-muted">{{ $job->created_at->diffForHumans() }}</small>
                                    </div>
                                    <p class="mb-1">{{ $job->companyProfile->company_name }}</p>
                                    <small>
                                        <span class="badge bg-{{ $job->status == 'active' ? 'success' : ($job->status == 'draft' ? 'warning' : 'secondary') }}">
                                            {{ ucfirst($job->status) }}
                                        </span>
                                    </small>
                                </a>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted">No recent jobs found.</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Recent Users -->
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header bg-light">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Recent Users</h5>
                        <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-primary">View All</a>
                    </div>
                </div>
                <div class="card-body">
                    @if(count($recentUsers) > 0)
                        <div class="list-group">
                            @foreach($recentUsers as $user)
                                <a href="{{ route('admin.users.show', $user) }}" class="list-group-item list-group-item-action">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1">{{ $user->name }}</h5>
                                        <small class="text-muted">{{ $user->created_at->diffForHumans() }}</small>
                                    </div>
                                    <p class="mb-1">{{ $user->email }}</p>
                                    <small>
                                        <span class="badge bg-info">{{ ucfirst(str_replace('_', ' ', $user->user_type)) }}</span>
                                    </small>
                                </a>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted">No recent users found.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
