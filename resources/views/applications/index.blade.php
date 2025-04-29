@extends('layouts.app')

@section('title', 'My Applications')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h5>{{ __('My Applications') }}</h5>
                    </div>
                </div>

                <div class="card-body">
                    @if($applications->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Job Title</th>
                                        <th>Company</th>
                                        <th>Status</th>
                                        <th>Applied On</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($applications as $application)
                                        <tr>
                                            <td>{{ $application->job->title }}</td>
                                            <td>{{ $application->job->companyProfile->company_name }}</td>
                                            <td>
                                                <span class="badge bg-{{ $application->status == 'pending' ? 'warning' : ($application->status == 'accepted' ? 'success' : 'danger') }}">
                                                    {{ ucfirst($application->status) }}
                                                </span>
                                            </td>
                                            <td>{{ $application->created_at->format('M d, Y') }}</td>
                                            <td>
                                                <a href="{{ route('applications.show', $application->id) }}" class="btn btn-sm btn-primary">View Details</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-4 d-flex justify-content-center">
                            {{ $applications->links() }}
                        </div>
                    @else
                        <div class="alert alert-info">
                            <p class="mb-0">You haven't applied for any jobs yet. <a href="{{ route('jobs.index') }}">Browse jobs</a> to get started!</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
