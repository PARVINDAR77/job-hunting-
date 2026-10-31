<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\AdminController;


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index');

// Job Details & Interactions
Route::get('/jobs/{job}', [JobController::class, 'show'])->name('jobs.show');
Route::post('/jobs/{job}/save', [JobController::class, 'toggleSave'])->name('jobs.save')->middleware('auth');

// Applications
Route::get('/jobs/{job}/apply', [ApplicationController::class, 'create'])->name('applications.create')->middleware('auth');
Route::post('/jobs/{job}/apply', [ApplicationController::class, 'store'])->name('applications.store')->middleware('auth');
Route::get('/applications/success', [ApplicationController::class, 'success'])->name('applications.success')->middleware('auth');

// Auth Routes
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
    Route::post('/login', [AuthController::class, 'login'])->middleware('guest');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Password Reset Routes
Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('password.request')->middleware('guest');
Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email')->middleware('guest');
Route::get('/reset-password/{token}', [AuthController::class, 'showResetForm'])->name('password.reset')->middleware('guest');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update')->middleware('guest');

// Dashboard
use App\Http\Controllers\DashboardController;
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

// Profile System
use App\Http\Controllers\ProfileController;
Route::middleware('auth')->group(function() {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/edit', [ProfileController::class, 'update'])->name('profile.update');
    
    Route::get('/saved-jobs', [ProfileController::class, 'savedJobs'])->name('profile.saved_jobs');
    Route::post('/saved-jobs/{job}/remove', [ProfileController::class, 'removeSavedJob'])->name('profile.remove_saved_job');
    
    Route::get('/applications', [ApplicationController::class, 'index'])->name('applications.index');
    Route::get('/applications/view/{application}', [ApplicationController::class, 'show'])->name('applications.show');
});

// Discovery
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\DiscoveryController;

Route::get('/companies', [CompanyController::class, 'index'])->name('companies.index');
Route::get('/companies/{company}', [CompanyController::class, 'show'])->name('companies.show');
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/{slug}/jobs', [CategoryController::class, 'jobs'])->name('categories.jobs');
Route::get('/locations', [LocationController::class, 'index'])->name('locations.index');

// Onboarding & Discovery
Route::get('/build-profile', [ProfileController::class, 'onboarding'])->name('profile.onboarding');
Route::post('/build-profile', [ProfileController::class, 'storeOnboarding'])->name('profile.onboarding.store');

Route::get('/career-explorer', [DiscoveryController::class, 'careerExplorer'])->name('discovery.explorer');
Route::redirect('/smart-match', '/build-profile');

// Content Pages
use App\Http\Controllers\BlogController;
use App\Http\Controllers\PageController;

Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{id}', [BlogController::class, 'show'])->name('blog.show');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::post('/contact', [PageController::class, 'storeContact'])->name('contact.store');



// Admin Routes
use App\Http\Controllers\Admin\JobController as AdminJobController;
use App\Http\Controllers\Admin\CandidateController as AdminCandidateController;
use App\Http\Controllers\Admin\CompanyController as AdminCompanyController;
use App\Http\Controllers\Admin\ApplicationController as AdminApplicationController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\UserController as AdminUserController;

use App\Http\Controllers\Admin\AdminAuthController;

Route::prefix('admin')->name('admin.')->group(function() {
    // This handles both login display and dashboard display under the same URL
    Route::get('/', [AdminController::class, 'index'])->name('index');
    Route::redirect('/dashboard', '/admin');
    Route::redirect('/login', '/admin');
    Route::redirect('/profile', '/profile');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('login.submit');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');
});

Route::prefix('admin')->name('admin.')->middleware(['admin'])->group(function() {
    // Settings
    Route::get('/settings', [AdminController::class, 'settings'])->name('settings');
    Route::post('/settings', [AdminController::class, 'updateSettings'])->name('settings.update');
    
    // Admin Resources
    Route::resource('jobs', AdminJobController::class);
    Route::resource('candidates', AdminCandidateController::class);
    Route::resource('companies', AdminCompanyController::class);
    Route::resource('applications', AdminApplicationController::class);
    Route::resource('categories', AdminCategoryController::class);
    Route::resource('users', AdminUserController::class);
    Route::resource('messages', \App\Http\Controllers\Admin\ContactMessageController::class)->only(['index', 'show', 'destroy']);
});