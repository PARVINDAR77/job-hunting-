<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\Category;
use App\Models\Company;

class HomeController extends Controller
{
    public function index()
    {
        $topJobs = Job::with('company')->latest()->limit(6)->get();
        $categories = Category::withCount('jobs')->orderByDesc('jobs_count')->limit(10)->get();
        $companies = Company::withCount('jobs')->orderByDesc('jobs_count')->limit(6)->get();

        return view('home', compact('topJobs', 'categories', 'companies'));
    }
}
