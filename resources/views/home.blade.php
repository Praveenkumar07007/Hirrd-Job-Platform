@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section class="py-5 text-white hero-section bg-gradient-primary">
    <div class="container">
        <div class="row align-items-center">
            <div class="mb-5 col-lg-6 mb-lg-0">
                <h1 class="mb-3 display-4 fw-bold">Find Your Dream Job Today</h1>
                <p class="mb-4 lead">Connect with top companies and discover opportunities that match your skills and ambitions</p>
                <div class="flex-wrap gap-3 d-flex">
                    <a href="{{ route('jobs.index') }}" class="btn btn-light btn-lg">Browse Jobs</a>
                    <a href="{{ route('register') }}" class="btn btn-outline-light btn-lg">Sign Up</a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="position-relative">
                    <img src="https://images.unsplash.com/photo-1551434678-e076c223a692?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80"
                        class="rounded-lg shadow img-fluid" alt="Professional team working">
                    <div class="p-3 bg-white rounded-lg shadow position-absolute d-none d-md-block" style="bottom: 20px; left: 20px; max-width: 200px;">
                        <div class="d-flex align-items-center">
                            <div class="p-2 bg-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 45px; height: 45px;">
                                <i class="text-white bi bi-briefcase fs-5"></i>
                            </div>
                            <div class="ms-3">
                                <h6 class="mb-0 text-dark">1000+ Jobs</h6>
                                <small class="text-muted">Updated daily</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="mb-5 text-center">
            <h2 class="fw-bold">Why Choose Us</h2>
            <p class="text-muted">Discover how our platform makes job searching and hiring easier</p>
        </div>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="border-0 shadow-sm card h-100 hover-lift">
                    <div class="p-4 text-center card-body">
                        <div class="p-3 mb-3 rounded-circle bg-primary bg-opacity-10 d-inline-flex">
                            <i class="bi bi-search text-primary fs-3"></i>
                        </div>
                        <h4>Smart Matching</h4>
                        <p class="text-muted">Our intelligent algorithm matches your skills with the perfect job opportunities</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="border-0 shadow-sm card h-100 hover-lift">
                    <div class="p-4 text-center card-body">
                        <div class="p-3 mb-3 rounded-circle bg-primary bg-opacity-10 d-inline-flex">
                            <i class="bi bi-lightning text-primary fs-3"></i>
                        </div>
                        <h4>Fast Application</h4>
                        <p class="text-muted">Apply to multiple jobs with just a few clicks using our streamlined process</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="border-0 shadow-sm card h-100 hover-lift">
                    <div class="p-4 text-center card-body">
                        <div class="p-3 mb-3 rounded-circle bg-primary bg-opacity-10 d-inline-flex">
                            <i class="bi bi-graph-up text-primary fs-3"></i>
                        </div>
                        <h4>Track Progress</h4>
                        <p class="text-muted">Monitor your applications and get updates on your job search progress</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="py-5">
    <div class="container">
        <div class="mb-5 text-center">
            <h2 class="fw-bold">What Our Users Say</h2>
            <p class="text-muted">Hear from the people who have found success using our platform</p>
        </div>

        <div class="row">
            <div class="mx-auto col-lg-10">
                <div class="testimonials-slider">
                    <div class="row">
                        <div class="mb-4 col-md-6">
                            <div class="border-0 shadow-sm card h-100">
                                <div class="p-4 card-body">
                                    <div class="mb-3 d-flex">
                                        <i class="bi bi-star-fill text-warning me-1"></i>
                                        <i class="bi bi-star-fill text-warning me-1"></i>
                                        <i class="bi bi-star-fill text-warning me-1"></i>
                                        <i class="bi bi-star-fill text-warning me-1"></i>
                                        <i class="bi bi-star-fill text-warning"></i>
                                    </div>
                                    <blockquote class="mb-4 blockquote">
                                        <p class="fst-italic">"This platform made finding my dream job incredibly easy. The interface is clean and the job listings are relevant and up-to-date."</p>
                                    </blockquote>
                                    <div class="d-flex align-items-center">
                                        <img src="https://randomuser.me/api/portraits/women/12.jpg" alt="Jane Doe" class="rounded-circle me-3" width="50" height="50">
                                        <div>
                                            <h6 class="mb-0">Jane Doe</h6>
                                            <small class="text-muted">Software Engineer</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4 col-md-6">
                            <div class="border-0 shadow-sm card h-100">
                                <div class="p-4 card-body">
                                    <div class="mb-3 d-flex">
                                        <i class="bi bi-star-fill text-warning me-1"></i>
                                        <i class="bi bi-star-fill text-warning me-1"></i>
                                        <i class="bi bi-star-fill text-warning me-1"></i>
                                        <i class="bi bi-star-fill text-warning me-1"></i>
                                        <i class="bi bi-star-fill text-warning"></i>
                                    </div>
                                    <blockquote class="mb-4 blockquote">
                                        <p class="fst-italic">"As an employer, posting jobs and managing applications is straightforward. We found great candidates quickly."</p>
                                    </blockquote>
                                    <div class="d-flex align-items-center">
                                        <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="John Smith" class="rounded-circle me-3" width="50" height="50">
                                        <div>
                                            <h6 class="mb-0">John Smith</h6>
                                            <small class="text-muted">HR Manager at TechCorp</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-3 text-center">
                        <a href="{{ route('testimonials') }}" class="btn btn-outline-primary">View All Testimonials</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="mb-5 text-center">
            <h2 class="fw-bold">Frequently Asked Questions</h2>
            <p class="text-muted">Find answers to common questions about our platform</p>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="accordion" id="faqAccordion">
                    <div class="mb-3 border-0 shadow-sm accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                How do I create an account?
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Creating an account is simple! Click on the "Register" button in the top right corner of the page, fill in your details, and you're ready to go. You can sign up as a job seeker or an employer.
                            </div>
                        </div>
                    </div>

                    <div class="mb-3 border-0 shadow-sm accordion-item">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Is it free to apply for jobs?
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Yes! Job seekers can browse and apply for jobs completely free of charge. We believe in connecting talent with opportunities without any barriers.
                            </div>
                        </div>
                    </div>

                    <div class="mb-3 border-0 shadow-sm accordion-item">
                        <h2 class="accordion-header" id="headingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                How do I post a job as an employer?
                            </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                After creating an employer account, go to your dashboard and click on "Post a New Job." Fill in the job details, requirements, and company information, then publish it for job seekers to find.
                            </div>
                        </div>
                    </div>

                    <div class="mb-3 border-0 shadow-sm accordion-item">
                        <h2 class="accordion-header" id="headingFour">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                How can I update my profile?
                            </button>
                        </h2>
                        <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Once logged in, click on your name in the top right corner and select "Profile" from the dropdown menu. From there, you can edit your personal information, upload a resume, or update your skills.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="py-5 text-center text-white bg-gradient-primary">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h2 class="mb-3 display-6 fw-bold">Ready to Take the Next Step in Your Career?</h2>
                <p class="mb-4 lead">Join thousands of professionals who have found their dream jobs on our platform</p>
                <div class="gap-3 d-flex justify-content-center">
                    <a href="{{ route('register') }}" class="px-4 btn btn-light btn-lg">Get Started</a>
                    <a href="{{ route('jobs.index') }}" class="px-4 btn btn-outline-light btn-lg">Browse Jobs</a>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .bg-gradient-primary {
        background: linear-gradient(135deg, #4f46e5 0%, #805ad5 100%);
    }

    .hover-lift {
        transition: transform 0.3s ease;
    }

    .hover-lift:hover {
        transform: translateY(-5px);
    }

    .accordion-button:not(.collapsed) {
        background-color: rgba(79, 70, 229, 0.1);
        color: #4f46e5;
    }

    .accordion-button:focus {
        box-shadow: 0 0 0 0.25rem rgba(79, 70, 229, 0.25);
    }
</style>
@endsection
