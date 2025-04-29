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
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group.
|
*/

// Landing & Home Page
Route::get('/', [HomeController::class, 'index'])->name('home');

// Authentication routes (Laravel's default auth routes)
Auth::routes();

// Job Routes
Route::prefix('jobs')->group(function () {
    Route::get('/', [JobController::class, 'index'])->name('jobs.index');
    Route::get('/{job}', [JobController::class, 'show'])->name('jobs.show');
    Route::post('/{job}/apply', [JobController::class, 'apply'])->name('jobs.apply');
});

// Company Routes
Route::prefix('companies')->group(function () {
    Route::get('/', [CompanyController::class, 'index'])->name('companies.index');
    Route::get('/create', [CompanyController::class, 'create'])->name('companies.create');
    Route::post('/', [CompanyController::class, 'store'])->name('companies.store');
    Route::get('/edit', [CompanyController::class, 'edit'])->name('companies.edit');
    Route::put('/', [CompanyController::class, 'update'])->name('companies.update');
    Route::get('/{company}', [CompanyController::class, 'show'])->name('companies.show');
});

// Job Applications Routes
Route::prefix('applications')->group(function () {
    Route::get('/', [JobApplicationController::class, 'index'])->name('applications.index');
    Route::get('/{application}', [JobApplicationController::class, 'show'])->name('applications.show');
    Route::patch('/{application}/status', [JobApplicationController::class, 'updateStatus'])->name('applications.update-status');
});

// Protected routes for all authenticated users
Route::middleware(['auth'])->group(function () {
    // Job seeker routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

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
