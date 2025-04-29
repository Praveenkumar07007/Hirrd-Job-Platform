<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    /**
     * Display the testimonials page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // For now, just return the view. We can add dynamic data later.
        return view('testimonials.index');
    }
}
