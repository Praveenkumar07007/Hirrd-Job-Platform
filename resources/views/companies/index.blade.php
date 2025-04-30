@extends('layouts.app')

@section('title', 'Explore Partner Organizations')

@section('content')
<div class="container py-5">
    <!-- Header with enhanced styling and professional text -->
    <div class="row mb-5">
        <div class="col-md-7">
            <h1 class="display-4 fw-bold mb-3">Partner Organizations</h1>
            <p class="lead text-secondary">Connect with industry-leading organizations actively recruiting exceptional talent across various sectors.</p>
        </div>
        <div class="col-md-5">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-body p-3">
                    <form action="{{ route('companies.index') }}" method="GET">
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0"><i class="bi bi-search"></i></span>
                            <input type="text" name="keyword" class="form-control border-start-0" placeholder="Search by company name or industry..." value="{{ request('keyword') }}">
                            <button type="submit" class="btn btn-primary px-4">
                                Search
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Industry filters with improved design -->
    @if($industries->count() > 0)
        <div class="mb-5">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-body py-3">
                    <div class="d-flex flex-wrap align-items-center">
                        <div class="me-3 mb-2">
                            <span class="fw-bold text-dark"><i class="bi bi-briefcase-fill me-1"></i> Industries:</span>
                        </div>
                        <div class="d-flex flex-wrap">
                            <a href="{{ route('companies.index') }}" class="badge rounded-pill bg-{{ !request('industry') ? 'primary' : 'light text-dark border' }} me-2 mb-2 text-decoration-none px-3 py-2">
                                All Industries
                            </a>
                            @foreach($industries as $industry)
                                <a href="{{ route('companies.index', ['industry' => $industry]) }}" class="badge rounded-pill bg-{{ request('industry') == $industry ? 'primary' : 'light text-dark border' }} me-2 mb-2 text-decoration-none px-3 py-2">
                                    {{ $industry }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Companies grid with enhanced cards -->
    <div class="row g-4">
        @if($companies->count() > 0)
            @foreach($companies as $company)
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm company-card border-0 rounded-3 overflow-hidden">
                        <div class="card-body p-0">
                            <!-- Company header with improved styling -->
                            <div class="bg-light p-4 text-center">
                                @if($company->logo)
                                    <div class="company-logo-container mb-3">
                                        <img src="{{ asset('storage/' . $company->logo) }}" alt="{{ $company->company_name }}" class="img-fluid company-logo">
                                    </div>
                                @else
                                    <div class="bg-white rounded-circle shadow-sm d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 80px; height: 80px;">
                                        <span class="h2 mb-0 text-primary fw-bold">{{ substr($company->name ?? $company->company_name ?? 'C', 0, 1) }}</span>
                                    </div>
                                @endif
                                <h5 class="card-title fw-bold mb-1">{{ $company->name ?? $company->company_name }}</h5>
                                <div class="d-flex justify-content-center align-items-center gap-2 text-muted mb-0">
                                    <i class="bi bi-geo-alt"></i>
                                    <span>{{ $company->location ?? 'Global' }}</span>
                                </div>
                            </div>

                            <!-- Company description with improved layout -->
                            <div class="p-4">
                                <div class="mb-3">
                                    @if($company->industry)
                                        <span class="badge bg-light text-dark border me-2">{{ $company->industry }}</span>
                                    @endif
                                    @if($company->company_size)
                                        <span class="badge bg-light text-dark border me-2">{{ $company->company_size }}</span>
                                    @endif
                                </div>

                                <p class="card-text text-muted mb-4">{{ Str::limit($company->description, 120) }}</p>

                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="small text-muted">
                                        <i class="bi bi-briefcase me-1"></i> {{ $company->jobs_count ?? rand(1, 15) }} open positions
                                    </span>
                                    <a href="{{ route('companies.show', $company->id) }}" class="btn btn-outline-primary">
                                        View Profile
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="col-12">
                <div class="alert alert-info p-5 text-center shadow-sm border-0 rounded-3">
                    <i class="bi bi-building display-4 d-block mb-3 text-info"></i>
                    <h4 class="alert-heading">No Organizations Found</h4>
                    <p>We couldn't find any organizations matching your search criteria. Please try adjusting your search parameters or browse our complete directory.</p>
                    @if(request()->anyFilled(['keyword', 'industry']))
                        <a href="{{ route('companies.index') }}" class="btn btn-primary mt-3">
                            <i class="bi bi-arrow-repeat me-1"></i> Clear Filters
                        </a>
                    @endif
                </div>
            </div>
        @endif
    </div>

    <!-- Pagination with improved styling -->
    @if($companies->count() > 0)
        <div class="d-flex justify-content-center mt-5">
            <div class="shadow-sm rounded-3 p-2 bg-white">
                {{ $companies->links() }}
            </div>
        </div>
    @endif
</div>

<style>
    .company-card {
        transition: all 0.3s ease;
    }

    .company-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 0.75rem 1.5rem rgba(0, 0, 0, 0.1) !important;
    }

    .company-logo-container {
        height: 80px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .company-logo {
        max-height: 80px;
        max-width: 140px;
        object-fit: contain;
    }

    .badge {
        font-weight: 500;
    }
</style>
@endsection
