@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h5>{{ __('Application Details') }}</h5>
                        <a href="{{ route('applications.index') }}" class="btn btn-sm btn-secondary">{{ __('Back to List') }}</a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <h4>{{ $application->job->title }}</h4>
                            <h6 class="text-muted">{{ $application->job->companyProfile->company_name }}</h6>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <p><strong>{{ __('Status:') }}</strong>
                                <span class="badge bg-{{ $application->status == 'pending' ? 'warning' : ($application->status == 'accepted' ? 'success' : 'danger') }}">
                                    {{ ucfirst($application->status) }}
                                </span>
                            </p>
                            <p><strong>{{ __('Applied on:') }}</strong> {{ $application->created_at->format('M d, Y') }}</p>
                        </div>
                        <div class="col-md-6">
                            @if(Auth::user()->user_type == 'employer')
                                <p><strong>{{ __('Applicant:') }}</strong> {{ $application->user->name }}</p>
                                <p><strong>{{ __('Email:') }}</strong> {{ $application->user->email }}</p>
                            @endif
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header bg-light">
                                    <h6>{{ __('Cover Letter') }}</h6>
                                </div>
                                <div class="card-body">
                                    <p>{!! nl2br(e($application->cover_letter)) !!}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if(Auth::user()->user_type == 'employer')
                        <div class="row">
                            <div class="col-md-12">
                                <form action="{{ route('employer.applications.update-status', $application->id) }}" method="POST" class="mt-3">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-md-4">
                                            <select name="status" class="form-select">
                                                <option value="pending" {{ $application->status == 'pending' ? 'selected' : '' }}>{{ __('Pending') }}</option>
                                                <option value="accepted" {{ $application->status == 'accepted' ? 'selected' : '' }}>{{ __('Accept') }}</option>
                                                <option value="rejected" {{ $application->status == 'rejected' ? 'selected' : '' }}>{{ __('Reject') }}</option>
                                            </select>
                                        </div>
                                        <div class="col-md-8">
                                            <button type="submit" class="btn btn-primary">{{ __('Update Status') }}</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
