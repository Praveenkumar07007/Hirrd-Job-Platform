@extends('layouts.app')

@section('title', 'Browse Companies')

@section('content')
<div class="container py-5">
    <!-- Header with better styling -->
    <div class="row mb-5">
        <div class="col-md-8">
            <h1 class="display-4 fw-bold mb-2">Browse Companies</h1>
            <p class="lead text-muted">Discover leading companies that are hiring talented professionals</p>
        </div>
        <div class="col-md-4">
            <div class="card shadow border-0 rounded-3">
                <div class="card-body">
                    <form action="{{ route('companies.index') }}" method="GET">
                        <div class="input-group">
                            <input type="text" name="keyword" class="form-control border-end-0" placeholder="Search companies..." value="{{ request('keyword') }}">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-search"></i>
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
                            <span class="fw-bold text-dark"><i class="bi bi-filter me-1"></i> Industries:</span>
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

    <!-- Companies grid with improved cards -->
    <div class="row g-4">
        @if($companies->count() > 0)
            @foreach($companies as $company)
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm hover-shadow border-0 rounded-3 overflow-hidden">
                        <div class="card-body p-0">
                            <!-- Company header with background -->
                            <div class="bg-light p-4 text-center">
                                @if($company->logo)
                                    <img src="{{ asset('storage/' . $company->logo) }}" alt="{{ $company->company_name }}" class="img-fluid mb-3" style="max-height: 80px;">
                                @else
                                    <div class="bg-white rounded-circle shadow-sm d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 80px; height: 80px;">
                                        <span class="h2 mb-0 text-primary fw-bold">{{ substr($company->company_name, 0, 1) }}</span>
                                    </div>
                                @endif
                                <h5 class="card-title fw-bold mb-1">{{ $company->company_name }}</h5>
                                <p class="text-muted mb-0">
                                    <i class="bi bi-briefcase me-1"></i>{{ $company->industry }}
                                </p>
                            </div>
                            <!-- Company description -->
                            <div class="p-4">
                                <p class="card-text text-muted mb-4">{{ Str::limit($company->description, 120) }}</p>
                                <div class="d-grid">
                                    <a href="{{ route('companies.show', $company->id) }}" class="btn btn-outline-primary">
                                        <i class="bi bi-building me-1"></i> View Company Profile
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
                    <i class="bi bi-info-circle display-4 d-block mb-3 text-info"></i>
                    <h4 class="alert-heading">No Companies Found</h4>
                    <p>We couldn't find any companies matching your criteria.</p>
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
    <div class="d-flex justify-content-center mt-5">
        <div class="shadow-sm rounded-3 p-2 bg-white">
            {{ $companies->links() }}
        </div>
    </div>
</div>

<style>
    .hover-shadow:hover {
        transform: translateY(-5px);
        transition: transform 0.3s ease;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
    }
</style>
@endsection
