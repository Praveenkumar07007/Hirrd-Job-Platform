@extends('layouts.app')

@section('title', 'Companies')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h1 class="mb-4">Companies</h1>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if($companies->count() > 0)
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    @foreach($companies as $company)
                        <div class="col">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="text-center mb-3">
                                        @if($company->logo)
                                            <img src="{{ asset('storage/' . $company->logo) }}" alt="{{ $company->company_name }}" class="img-fluid company-logo" style="max-height: 100px;">
                                        @else
                                            <div class="company-placeholder">
                                                {{ substr($company->company_name, 0, 1) }}
                                            </div>
                                        @endif
                                    </div>
                                    <h5 class="card-title">{{ $company->company_name }}</h5>
                                    <p class="card-text text-muted mb-2">{{ $company->industry }}</p>
                                    <p class="card-text">{{ Str::limit($company->description, 150) }}</p>
                                </div>
                                <div class="card-footer bg-transparent">
                                    <a href="{{ route('companies.show', $company) }}" class="btn btn-outline-primary">View Profile</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="d-flex justify-content-center mt-4">
                    {{ $companies->links() }}
                </div>
            @else
                <div class="alert alert-info">
                    No companies found.
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
