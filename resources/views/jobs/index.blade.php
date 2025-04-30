@extends('layouts.app')

@section('content')
<div class="bg-light">
    <div class="container py-5">
        <div class="row">
            <!-- Page Header -->
            <div class="mb-4 col-12">
                <h1 class="display-5 fw-bold">Find Your Perfect Job</h1>
                <p class="lead text-muted">Browse thousands of job openings from top companies</p>
            </div>

            <!-- Search and Filter Section -->
            <div class="mb-4 col-12">
                <div class="border-0 shadow-sm card">
                    <div class="p-4 card-body">
                        <form action="{{ route('jobs.index') }}" method="GET">
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label for="search" class="form-label">Keyword</label>
                                    <div class="input-group">
                                        <span class="bg-white input-group-text"><i class="bi bi-search"></i></span>
                                        <input type="text" class="form-control" id="search" name="search" placeholder="Job title, company or keywords" value="{{ request('search') }}">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <label for="category" class="form-label">Category</label>
                                    <select class="form-select" id="category" name="category">
                                        <option value="">All Categories</option>
                                        @foreach($categories ?? [] as $category)
                                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-3">
                                    <label for="location" class="form-label">Location</label>
                                    <div class="input-group">
                                        <span class="bg-white input-group-text"><i class="bi bi-geo-alt"></i></span>
                                        <input type="text" class="form-control" id="location" name="location" placeholder="City or remote" value="{{ request('location') }}">
                                    </div>
                                </div>

                                <div class="col-md-2 d-flex align-items-end">
                                    <button type="submit" class="btn btn-primary w-100">
                                        Search Jobs
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Sidebar Filters -->
            <div class="mb-4 col-lg-3">
                <div class="mb-4 border-0 shadow-sm card">
                    <div class="card-body">
                        <h5 class="card-title">Filter By</h5>
                        <hr>

                        <h6 class="mb-2">Job Type</h6>
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="fullTime" name="job_type[]" value="Full-time">
                                <label class="form-check-label" for="fullTime">Full-time</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="partTime" name="job_type[]" value="Part-time">
                                <label class="form-check-label" for="partTime">Part-time</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="contract" name="job_type[]" value="Contract">
                                <label class="form-check-label" for="contract">Contract</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="remote" name="job_type[]" value="Remote">
                                <label class="form-check-label" for="remote">Remote</label>
                            </div>
                        </div>

                        <h6 class="mb-2">Experience Level</h6>
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="entry" name="experience_level[]" value="Entry Level">
                                <label class="form-check-label" for="entry">Entry Level</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="mid" name="experience_level[]" value="Mid Level">
                                <label class="form-check-label" for="mid">Mid Level</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="senior" name="experience_level[]" value="Senior Level">
                                <label class="form-check-label" for="senior">Senior Level</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="executive" name="experience_level[]" value="Executive">
                                <label class="form-check-label" for="executive">Executive</label>
                            </div>
                        </div>

                        <h6 class="mb-2">Salary Range</h6>
                        <div class="mb-3">
                            <input type="range" class="form-range" id="salaryRange" min="0" max="200000" step="10000">
                            <div class="d-flex justify-content-between">
                                <span class="small">$0</span>
                                <span class="small">$200k+</span>
                            </div>
                        </div>

                        <button type="submit" class="mt-3 btn btn-outline-primary w-100">Apply Filters</button>
                    </div>
                </div>

                <div class="border-0 shadow-sm card">
                    <div class="card-body">
                        <h5 class="card-title">Popular Categories</h5>
                        <hr>
                        <div class="d-flex flex-column">
                            <a href="#" class="mb-2 text-decoration-none">Technology</a>
                            <a href="#" class="mb-2 text-decoration-none">Marketing</a>
                            <a href="#" class="mb-2 text-decoration-none">Finance</a>
                            <a href="#" class="mb-2 text-decoration-none">Healthcare</a>
                            <a href="#" class="text-decoration-none">Education</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Job Listings -->
            <div class="col-lg-9">
                @forelse($jobs ?? [] as $job)
                    <div class="mb-4 border-0 shadow-sm card hover-lift">
                        <div class="p-4 card-body">
                            <div class="row align-items-center">
                                <div class="mb-3 text-center col-md-2 mb-md-0">
                                    <div class="p-3 rounded bg-light d-inline-flex align-items-center justify-content-center" style="width: 70px; height: 70px;">
                                        <img src="{{ $job->company->logo ?? 'https://via.placeholder.com/70' }}" alt="{{ $job->company->name ?? 'Company' }}" class="img-fluid" style="max-width: 50px; max-height: 50px;">
                                    </div>
                                </div>

                                <div class="mb-3 col-md-7 mb-md-0">
                                    <h5 class="mb-1 card-title">{{ $job->title ?? 'Software Engineer' }}</h5>
                                    <p class="mb-2 text-muted">{{ $job->company->name ?? 'Tech Company' }}</p>
                                    <div class="flex-wrap gap-2 d-flex small">
                                        <span class="badge bg-light text-dark">{{ $job->location ?? 'San Francisco, CA' }}</span>
                                        <span class="badge bg-light text-dark">{{ $job->job_type ?? 'Full-time' }}</span>
                                        <span class="badge bg-light text-dark">${{ $job->salary_min ?? '80k' }} - ${{ $job->salary_max ?? '120k' }}</span>
                                    </div>
                                </div>

                                <div class="col-md-3 text-md-end">
                                    <a href="{{ route('jobs.show', $job->id ?? 1) }}" class="btn btn-outline-primary">View Details</a>
                                </div>
                            </div>

                            <div class="mt-3 row">
                                <div class="col-12">
                                    <p class="mb-0 card-text text-truncate">{{ $job->description ?? 'This position requires expertise in modern web frameworks and development practices.' }}</p>
                                    <div class="mt-2 small text-muted">Posted {{ $job->created_at ? $job->created_at->diffForHumans() : '2 days ago' }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="border-0 shadow-sm card">
                        <div class="p-5 text-center card-body">
                            <div class="mb-4">
                                <i class="bi bi-search" style="font-size: 3rem;"></i>
                            </div>
                            <h3>No Jobs Found</h3>
                            <p class="mb-4 text-muted">We couldn't find any jobs matching your criteria. Try adjusting your search filters or check back later.</p>

                            <!-- Sample Jobs (Static Data) -->
                            <h4 class="mt-5 mb-4">Sample Job Listings</h4>
                            <div class="row g-4">
                                <!-- Sample Job 1 -->
                                <div class="col-md-6">
                                    <div class="border-0 shadow-sm card h-100">
                                        <div class="p-4 card-body">
                                            <div class="mb-3 d-flex align-items-center">
                                                <div class="p-2 rounded bg-light me-3">
                                                    <img src="https://via.placeholder.com/40" alt="Company" class="img-fluid" style="width: 40px; height: 40px;">
                                                </div>
                                                <div>
                                                    <h5 class="mb-0 card-title">Full Stack Developer</h5>
                                                    <p class="mb-0 text-muted small">Innovate Solutions Inc.</p>
                                                </div>
                                            </div>
                                            <div class="flex-wrap gap-2 mb-3 d-flex small">
                                                <span class="badge bg-light text-dark">San Francisco, CA</span>
                                                <span class="badge bg-light text-dark">Full-time</span>
                                                <span class="badge bg-light text-dark">$90k - $130k</span>
                                            </div>
                                            <p class="card-text small">Join our engineering team to build scalable web applications using React, Node.js, and cloud infrastructure. Position requires 3+ years of experience.</p>
                                            <a href="#" class="btn btn-sm btn-outline-primary">View Details</a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Sample Job 2 -->
                                <div class="col-md-6">
                                    <div class="border-0 shadow-sm card h-100">
                                        <div class="p-4 card-body">
                                            <div class="mb-3 d-flex align-items-center">
                                                <div class="p-2 rounded bg-light me-3">
                                                    <img src="https://via.placeholder.com/40" alt="Company" class="img-fluid" style="width: 40px; height: 40px;">
                                                </div>
                                                <div>
                                                    <h5 class="mb-0 card-title">Digital Marketing Manager</h5>
                                                    <p class="mb-0 text-muted small">Amplify Digital Group</p>
                                                </div>
                                            </div>
                                            <div class="flex-wrap gap-2 mb-3 d-flex small">
                                                <span class="badge bg-light text-dark">Remote</span>
                                                <span class="badge bg-light text-dark">Full-time</span>
                                                <span class="badge bg-light text-dark">$75k - $95k</span>
                                            </div>
                                            <p class="card-text small">Lead strategic marketing initiatives across digital channels. Seeking professional with experience in SEO/SEM, social media marketing, and analytics.</p>
                                            <a href="#" class="btn btn-sm btn-outline-primary">View Details</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforelse

                <!-- Pagination -->
                <div class="mt-4 d-flex justify-content-center">
                    <nav aria-label="Page navigation">
                        <ul class="pagination">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .hover-lift {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .hover-lift:hover {
        transform: translateY(-5px);
        box-shadow: 0 1rem 3rem rgba(0,0,0,.175)!important;
    }
</style>
@endsection
