<?php
@extends('layouts.app')

@section('title', 'Post a New Job')

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="text-white card-header bg-primary">
                <h4 class="mb-0 card-title">Post a New Job</h4>
            </div>
            <div class="card-body">
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ url('/employer/jobs') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="title" class="form-label">Job Title *</label>
                        <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="category_id" class="form-label">Job Category *</label>
                        <select name="category_id" id="category_id" class="form-select" required>
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="type" class="form-label">Job Type *</label>
                        <select name="type" id="type" class="form-select" required>
                            <option value="">Select Job Type</option>
                            <option value="full-time" {{ old('type') == 'full-time' ? 'selected' : '' }}>Full Time</option>
                            <option value="part-time" {{ old('type') == 'part-time' ? 'selected' : '' }}>Part Time</option>
                            <option value="remote" {{ old('type') == 'remote' ? 'selected' : '' }}>Remote</option>
                            <option value="contract" {{ old('type') == 'contract' ? 'selected' : '' }}>Contract</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="location" class="form-label">Location *</label>
                        <input type="text" name="location" id="location" class="form-control" value="{{ old('location') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="salary" class="form-label">Salary (USD)</label>
                        <input type="number" name="salary" id="salary" class="form-control" value="{{ old('salary') }}" step="0.01">
                        <div class="form-text">Leave empty if you don't want to disclose the salary</div>
                    </div>

                    <div class="mb-3">
                        <label for="deadline" class="form-label">Application Deadline</label>
                        <input type="date" name="deadline" id="deadline" class="form-control" value="{{ old('deadline') }}">
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Job Description *</label>
                        <textarea name="description" id="description" class="form-control" rows="10" required>{{ old('description') }}</textarea>
                    </div>

                    <div class="mb-3 form-check">
                        <input type="checkbox" name="is_active" id="is_active" class="form-check-input" value="1" {{ old('is_active') ? 'checked' : '' }}>
                        <label for="is_active" class="form-check-label">Publish immediately</label>
                    </div>

                    <div class="gap-2 d-grid">
                        <button type="submit" class="btn btn-primary">Post Job</button>
                        <a href="{{ url('/employer/jobs') }}" class="btn btn-outline-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
