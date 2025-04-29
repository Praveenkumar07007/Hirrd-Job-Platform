@extends('layouts.app')

@section('title', $company->company_name)

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 text-center mb-4 mb-md-0">
                            @if($company->logo)
                                <img src="{{ asset('storage/' . $company->logo) }}" alt="{{ $company->company_name }}" class="img-fluid company-logo mb-3" style="max-height: 150px;">
                            @else
                                <div class="company-placeholder mb-3" style="width: 150px; height: 150px; margin: 0 auto; background-color: #f0f0f0; display: flex; align-items: center; justify-content: center; font-size: 42px;">
                                    {{ substr($company->company_name, 0, 1) }}
                                </div>
                            @endif

                            @if($company->website)
                                <a href="{{ $company->website }}" class="btn btn-outline-primary btn-sm" target="_blank">
                                    <i class="fas fa-globe"></i> Visit Website
                                </a>
                            @endif
                        </div>
                        <div class="col-md-9">
                            <h2 class="mb-3">{{ $company->company_name }}</h2>
                            <p class="text-muted mb-4">Industry: {{ $company->industry }}</p>

                            <h5>About the Company</h5>
                            <p>{{ $company->description }}</p>

                            <div class="mt-4">
                                <h5>Company Info</h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <p><strong>Location:</strong> {{ $company->address }}</p>
                                    </div>
                                    @if(isset($company->user->email))
                                    <div class="col-md-6">
                                        <p><strong>Contact:</strong> {{ $company->user->email }}</p>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <h3 class="mb-4">Current Job Openings</h3>

            @if($company->jobs && $company->jobs->count() > 0)
                <div class="row">
                    @foreach($company->jobs as $job)
                        <div class="col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $job->title }}</h5>
                                    <p class="card-text mb-0"><span class="badge bg-info">{{ $job->type }}</span> <span class="badge bg-secondary">{{ $job->location }}</span></p>
                                    <p class="text-muted mt-2"><small>Posted {{ $job->created_at->diffForHumans() }}</small></p>
                                    <p class="card-text">{{ Str::limit($job->description, 120) }}</p>
                                </div>
                                <div class="card-footer bg-transparent">
                                    <a href="{{ route('jobs.show', $job) }}" class="btn btn-primary">View Details</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="alert alert-info">
                    This company has no active job openings at the moment.
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
