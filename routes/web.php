<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\JobController as AdminJobController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\CompanyController as AdminCompanyController;
use App\Http\Controllers\Employer\DashboardController as EmployerDashboardController;
use App\Http\Controllers\Employer\JobController as EmployerJobController;
use App\Http\Controllers\Employer\CompanyController as EmployerCompanyController;
use App\Http\Controllers\Employer\ApplicationController as EmployerApplicationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index');
Route::get('/jobs/{job}', [JobController::class, 'show'])->name('jobs.show');

// Companies routes (public)
Route::get('/companies', [CompanyController::class, 'index'])->name('companies.index');
Route::get('/companies/{company}', [CompanyController::class, 'show'])->name('companies.show');

// Authentication routes
Auth::routes();

// Protected routes for all authenticated users
Route::middleware(['auth'])->group(function () {
    // Job application routes
    Route::post('/jobs/{job}/apply', [JobController::class, 'apply'])->name('jobs.apply');

    // Job seeker routes
    Route::get('/applications', [JobApplicationController::class, 'index'])->name('applications.index');
    Route::get('/applications/{application}', [JobApplicationController::class, 'show'])->name('applications.show');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Company management for employers
    Route::middleware(['auth'])->group(function () {
        Route::get('/company/create', [CompanyController::class, 'create'])->name('companies.create');
        Route::post('/company', [CompanyController::class, 'store'])->name('companies.store');
        Route::get('/company/edit', [CompanyController::class, 'edit'])->name('companies.edit');
        Route::put('/company', [CompanyController::class, 'update'])->name('companies.update');
    });

    // Employer routes
    Route::prefix('employer')->name('employer.')->group(function () {
        Route::get('/dashboard', [EmployerDashboardController::class, 'index'])->name('dashboard');

        // Employer job management
        Route::resource('jobs', EmployerJobController::class);

        // Employer company profile
        Route::get('/company', [EmployerCompanyController::class, 'edit'])->name('company.edit');
        Route::put('/company', [EmployerCompanyController::class, 'update'])->name('company.update');
        Route::get('/company/create', [EmployerCompanyController::class, 'create'])->name('company.create');
        Route::post('/company', [EmployerCompanyController::class, 'store'])->name('company.store');

        // Job applications management for employers
        Route::get('/applications', [EmployerApplicationController::class, 'index'])->name('applications.index');
        Route::get('/applications/{application}', [EmployerApplicationController::class, 'show'])->name('applications.show');
        Route::put('/applications/{application}/status', [EmployerApplicationController::class, 'updateStatus'])->name('applications.update-status');
    });

    // Admin routes
    Route::middleware(['admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        // Admin user management
        Route::resource('users', AdminUserController::class);

        // Admin job management
        Route::resource('jobs', AdminJobController::class);

        // Admin company management
        Route::resource('companies', AdminCompanyController::class);
    });
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
