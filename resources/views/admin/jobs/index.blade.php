@extends('layouts.app')

@section('title', 'Manage Jobs')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-8">
            <h1>Manage Jobs</h1>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('admin.jobs.create') }}" class="btn btn-primary">Add New Job</a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Company</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Posted</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($jobs as $job)
                            <tr>
                                <td>{{ $job->id }}</td>
                                <td>
                                    <a href="{{ route('admin.jobs.show', $job) }}">{{ $job->title }}</a>
                                    <div class="small text-muted">{{ Str::limit($job->type, 20) }} • {{ Str::limit($job->location, 20) }}</div>
                                </td>
                                <td>{{ $job->companyProfile->company_name }}</td>
                                <td>{{ $job->category->name }}</td>
                                <td>
                                    <span class="badge bg-{{ $job->status == 'active' ? 'success' : ($job->status == 'draft' ? 'warning' : 'secondary') }}">
                                        {{ ucfirst($job->status) }}
                                    </span>
                                </td>
                                <td>{{ $job->created_at->format('M d, Y') }}</td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('admin.jobs.show', $job) }}" class="btn btn-info">View</a>
                                        <a href="{{ route('admin.jobs.edit', $job) }}" class="btn btn-primary">Edit</a>
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $job->id }}">
                                            Delete
                                        </button>
                                    </div>

                                    <!-- Delete Modal -->
                                    <div class="modal fade" id="deleteModal{{ $job->id }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to delete "{{ $job->title }}"?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                    <form action="{{ route('admin.jobs.destroy', $job) }}" method="POST" style="display: inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">No jobs found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-4">
                {{ $jobs->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
