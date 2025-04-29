@extends('layouts.app')

@section('title', 'Browse Companies')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-8">
            <h1>Browse Companies</h1>
            <p class="lead text-muted">Discover leading companies that are hiring</p>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form action="{{ route('companies.index') }}" method="GET">
                        <div class="input-group">
                            <input type="text" name="keyword" class="form-control" placeholder="Search companies..." value="{{ request('keyword') }}">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Industry filters -->
    @if($industries->count() > 0)
        <div class="mb-4 d-flex flex-wrap">
            <div class="me-2 mb-2">
                <strong>Industries:</strong>
            </div>
            <div class="d-flex flex-wrap">
                <a href="{{ route('companies.index') }}" class="badge bg-{{ !request('industry') ? 'primary' : 'light text-dark' }} me-2 mb-2 text-decoration-none">
                    All
                </a>
                @foreach($industries as $industry)
                    <a href="{{ route('companies.index', ['industry' => $industry]) }}" class="badge bg-{{ request('industry') == $industry ? 'primary' : 'light text-dark' }} me-2 mb-2 text-decoration-none">
                        {{ $industry }}
                    </a>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Companies grid -->
    <div class="row">
        @if($companies->count() > 0)
            @foreach($companies as $company)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body p-4 text-center">
                            <div class="mb-3" style="height: 100px; display: flex; align-items: center; justify-content: center;">
                                @if($company->logo)
                                    <img src="{{ asset('storage/' . $company->logo) }}" alt="{{ $company->company_name }}" class="img-fluid" style="max-height: 80px;">
                                @else
                                    <div class="bg-light rounded-circle d-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                                        <span class="h2 mb-0 text-secondary">{{ substr($company->company_name, 0, 1) }}</span>
                                    </div>
                                @endif
                            </div>
                            <h5 class="card-title">{{ $company->company_name }}</h5>
                            <p class="text-muted mb-3">{{ $company->industry }}</p>
                            <p class="card-text small text-muted mb-4">{{ Str::limit($company->description, 120) }}</p>
                            <div class="d-grid">
                                <a href="{{ route('companies.show', $company->id) }}" class="btn btn-outline-primary">View Profile</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="col-12">
                <div class="alert alert-info text-center">
                    <i class="bi bi-info-circle display-4 d-block mb-3"></i>
                    <h4>No Companies Found</h4>
                    <p>We couldn't find any companies matching your criteria.</p>
                    @if(request()->anyFilled(['keyword', 'industry']))
                        <a href="{{ route('companies.index') }}" class="btn btn-primary mt-2">Clear Filters</a>
                    @endif
                </div>
            </div>
        @endif
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        {{ $companies->links() }}
    </div>
</div>
@endsection
