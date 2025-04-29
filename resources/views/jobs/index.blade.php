@extends('layouts.app')

@section('title', 'Jobs')

@section('content')
<div class="row">
    <div class="col-md-3">
        <!-- Filter Sidebar -->
        <div class="mb-3 card">
            <div class="text-white card-header bg-primary">
                <h5 class="mb-0 card-title">Filter Jobs</h5>
            </div>
            <div class="card-body">
                <form action="{{ url('/jobs') }}" method="GET">
                    <div class="mb-3">
                        <label for="keyword" class="form-label">Keyword</label>
                        <input type="text" name="keyword" id="keyword" class="form-control" value="{{ request('keyword') }}">
                    </div>

                    <div class="mb-3">
                        <label for="category" class="form-label">Category</label>
                        <select name="category" id="category" class="form-select">
                            <option value="">All Categories</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="type" class="form-label">Job Type</label>
                        <select name="type" id="type" class="form-select">
                            <option value="">All Types</option>
                            <option value="full-time" {{ request('type') == 'full-time' ? 'selected' : '' }}>Full Time</option>
                            <option value="part-time" {{ request('type') == 'part-time' ? 'selected' : '' }}>Part Time</option>
                            <option value="remote" {{ request('type') == 'remote' ? 'selected' : '' }}>Remote</option>
                            <option value="contract" {{ request('type') == 'contract' ? 'selected' : '' }}>Contract</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="location" class="form-label">Location</label>
                        <input type="text" name="location" id="location" class="form-control" value="{{ request('location') }}">
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Apply Filters</button>

                    @if(request()->anyFilled(['keyword', 'category', 'type', 'location']))
                        <a href="{{ url('/jobs') }}" class="mt-2 btn btn-outline-secondary w-100">Clear Filters</a>
                    @endif
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-9">
        <h1 class="mb-4">Available Jobs</h1>

        @if($jobs->count() > 0)
            @foreach($jobs as $job)
                <div class="mb-3 card job-card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-9">
                                <h4 class="card-title">{{ $job->title }}</h4>
                                <h6 class="mb-2 card-subtitle text-muted">{{ $job->companyProfile->name }}</h6>
                                <p class="card-text">{{ Str::limit($job->description, 150) }}</p>

                                <div class="flex-wrap gap-2 d-flex">
                                    <span class="badge bg-info">{{ $job->type }}</span>
                                    <span class="badge bg-secondary">{{ $job->location }}</span>
                                    <span class="badge bg-success">{{ $job->category->name }}</span>
                                    @if($job->salary)
                                        <span class="badge bg-warning text-dark">${{ number_format($job->salary) }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-3 text-end">
                                <a href="{{ url('/jobs/'.$job->id) }}" class="btn btn-primary">View Details</a>

                                @if($job->deadline)
                                    <p class="mt-2 mb-0 text-danger">
                                        <small>Deadline: {{ \Carbon\Carbon::parse($job->deadline)->format('M d, Y') }}</small>
                                    </p>
                                @endif

                                <p class="mt-1 mb-0 text-muted">
                                    <small>Posted {{ $job->created_at->diffForHumans() }}</small>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="mt-4 d-flex justify-content-center">
                {{ $jobs->appends(request()->query())->links() }}
            </div>
        @else
            <div class="alert alert-info">
                No jobs found matching your criteria. Try adjusting your filters.
            </div>
        @endif
    </div>
</div>
@endsection
