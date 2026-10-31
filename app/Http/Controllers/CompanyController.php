<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;

class CompanyController extends Controller
{
    public function index(Request $request)
    {
        $query = Company::withCount('jobs');

        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->has('industry') && $request->industry != '') {
            $query->where('industry', $request->industry);
        }

        if ($request->has('location') && $request->location != '') {
            $query->where('location', 'like', '%' . $request->location . '%');
        }

        $companies = $query->orderByDesc('jobs_count')->paginate(48)->appends($request->query());
        $industries = Company::select('industry')->distinct()->whereNotNull('industry')->pluck('industry');

        return view('companies.index', compact('companies', 'industries'));
    }

    public function show(Company $company)
    {
        $company->loadCount('jobs');
        $jobs = $company->jobs()->with('category')->latest()->paginate(10);
        
        return view('companies.show', compact('company', 'jobs'));
    }
}
