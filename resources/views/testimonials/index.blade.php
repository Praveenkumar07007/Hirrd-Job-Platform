@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <h1 class="mb-4 text-center">What Our Users Say</h1>

            <div class="row">
                {{-- Testimonial 1 --}}
                <div class="col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <blockquote class="blockquote mb-0">
                                <p>"This platform made finding my dream job incredibly easy. The interface is clean and the job listings are relevant."</p>
                                <footer class="blockquote-footer">Jane Doe, <cite title="Source Title">Software Engineer</cite></footer>
                            </blockquote>
                        </div>
                    </div>
                </div>

                {{-- Testimonial 2 --}}
                <div class="col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <blockquote class="blockquote mb-0">
                                <p>"As an employer, posting jobs and managing applications is straightforward. We found great candidates quickly."</p>
                                <footer class="blockquote-footer">John Smith, <cite title="Source Title">HR Manager at TechCorp</cite></footer>
                            </blockquote>
                        </div>
                    </div>
                </div>

                 {{-- Testimonial 3 --}}
                <div class="col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <blockquote class="blockquote mb-0">
                                <p>"The variety of job categories helped me explore different career paths I hadn't considered before."</p>
                                <footer class="blockquote-footer">Alex Johnson, <cite title="Source Title">Marketing Specialist</cite></footer>
                            </blockquote>
                        </div>
                    </div>
                </div>

                 {{-- Testimonial 4 --}}
                <div class="col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <blockquote class="blockquote mb-0">
                                <p>"Easy to navigate and apply. I appreciated the clear job descriptions and company profiles."</p>
                                <footer class="blockquote-footer">Samantha Lee, <cite title="Source Title">Graphic Designer</cite></footer>
                            </blockquote>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
