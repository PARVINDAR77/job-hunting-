<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\Category;

class JobController extends Controller
{
    public function index(Request $request)
    {
        $query = Job::with(['company', 'category']);

        // Filter by Keyword - split into tokens so "front end developer" matches "Frontend Developer"
        if ($request->filled('q')) {
            $rawKeyword = $request->q;
            // Split on spaces, filter empty tokens
            $tokens = array_filter(explode(' ', $rawKeyword));

            $query->where(function($outerQ) use ($tokens, $rawKeyword) {
                // First try to match the full phrase (best match)
                $outerQ->where('title', 'like', "%{$rawKeyword}%")
                    ->orWhere('description', 'like', "%{$rawKeyword}%");

                // Then match any individual token (handles "front end developer" -> "Frontend Developer")
                foreach ($tokens as $token) {
                    if (strlen($token) >= 2) { // skip very short tokens
                        $outerQ->orWhere('title', 'like', "%{$token}%")
                               ->orWhere('description', 'like', "%{$token}%")
                               ->orWhereHas('company', function($q) use ($token) {
                                   $q->where('name', 'like', "%{$token}%");
                               })
                               ->orWhereHas('skills', function($q) use ($token) {
                                   $q->where('name', 'like', "%{$token}%");
                               });
                    }
                }
            });
        }

        // Filter by Location — supports city names, state names, alternate spellings, and typos
        if ($request->filled('location')) {
            $loc = trim($request->location);
            $lower = strtolower($loc);

            // STATE → cities stored in DB
            $stateMap = [
                // Gujarat
                'gujarat'               => ['Ahmedabad','Surat','Vadodara','Rajkot','Gandhinagar'],
                // Maharashtra
                'maharashtra'           => ['Mumbai','Pune','Nagpur','Nashik','Aurangabad','Thane'],
                // Karnataka
                'karnataka'             => ['Bangalore','Mysore','Mangalore','Hubli','Belgaum'],
                // Telangana
                'telangana'             => ['Hyderabad','Warangal'],
                // Andhra Pradesh
                'andhra pradesh'        => ['Hyderabad','Visakhapatnam','Vijayawada'],
                'ap'                    => ['Hyderabad','Visakhapatnam','Vijayawada'],
                // Delhi / NCR
                'delhi'                 => ['Delhi','Noida','Gurgaon','Faridabad','Ghaziabad'],
                'ncr'                   => ['Delhi','Noida','Gurgaon','Faridabad','Ghaziabad'],
                'new delhi'             => ['Delhi'],
                // Tamil Nadu
                'tamil nadu'            => ['Chennai','Coimbatore','Madurai','Salem','Trichy'],
                'tamilnadu'             => ['Chennai','Coimbatore','Madurai','Salem','Trichy'],
                'tn'                    => ['Chennai','Coimbatore','Madurai'],
                // West Bengal
                'west bengal'           => ['Kolkata','Howrah','Durgapur','Asansol'],
                'wb'                    => ['Kolkata','Howrah'],
                // Rajasthan
                'rajasthan'             => ['Jaipur','Jodhpur','Udaipur','Kota','Ajmer'],
                // Uttar Pradesh
                'uttar pradesh'         => ['Lucknow','Kanpur','Agra','Varanasi','Allahabad','Meerut','Noida'],
                'up'                    => ['Lucknow','Kanpur','Agra','Varanasi','Noida'],
                // Madhya Pradesh
                'madhya pradesh'        => ['Bhopal','Indore','Jabalpur','Gwalior'],
                'mp'                    => ['Bhopal','Indore','Jabalpur','Gwalior'],
                // Punjab
                'punjab'                => ['Chandigarh','Ludhiana','Amritsar'],
                // Haryana
                'haryana'               => ['Chandigarh','Gurgaon','Faridabad','Ambala'],
                // Bihar
                'bihar'                 => ['Patna'],
                // Jharkhand
                'jharkhand'             => ['Ranchi'],
                // Odisha
                'odisha'                => ['Bhubaneswar','Cuttack'],
                'orissa'                => ['Bhubaneswar','Cuttack'],
                // Kerala
                'kerala'                => ['Kochi','Thiruvananthapuram','Kozhikode','Thrissur'],
                // Assam
                'assam'                 => ['Guwahati'],
                // Himachal Pradesh
                'himachal pradesh'      => ['Chandigarh'],
                'hp'                    => ['Chandigarh'],
                // Uttarakhand
                'uttarakhand'           => ['Delhi'],
                // Goa
                'goa'                   => ['Remote'],
                // Chhattisgarh
                'chhattisgarh'          => ['Nagpur'],
                // Jammu & Kashmir
                'jammu'                 => ['Delhi'],
                'kashmir'               => ['Delhi'],
                'j&k'                   => ['Delhi'],
                // Manipur / Meghalaya / Tripura / NE states
                'manipur'               => ['Guwahati'],
                'meghalaya'             => ['Guwahati'],
                'tripura'               => ['Guwahati'],
                'nagaland'              => ['Guwahati'],
                'mizoram'               => ['Guwahati'],
                'arunachal pradesh'     => ['Guwahati'],
                'sikkim'                => ['Guwahati'],
            ];

            // CITY alternate names / typos → correct DB city name
            $cityMap = [
                // Ahmedabad typos
                'ahmdabad'          => 'Ahmedabad',
                'ahemdabad'         => 'Ahmedabad',
                'ahemadabad'        => 'Ahmedabad',
                'amdavad'           => 'Ahmedabad',
                // Bangalore
                'bengaluru'         => 'Bangalore',
                'bengalore'         => 'Bangalore',
                'banglore'          => 'Bangalore',
                'bangaluru'         => 'Bangalore',
                'blr'               => 'Bangalore',
                // Hyderabad
                'hydrabad'          => 'Hyderabad',
                'hyd'               => 'Hyderabad',
                'secunderabad'      => 'Hyderabad',
                // Mumbai
                'mumabi'            => 'Mumbai',
                'bombay'            => 'Mumbai',
                'bom'               => 'Mumbai',
                'navi mumbai'       => 'Mumbai',
                // Delhi
                'dilli'             => 'Delhi',
                'ndls'              => 'Delhi',
                // Chennai
                'madras'            => 'Chennai',
                'maa'               => 'Chennai',
                // Kolkata
                'calcutta'          => 'Kolkata',
                'cal'               => 'Kolkata',
                // Pune
                'poona'             => 'Pune',
                // Gurgaon
                'gurugram'          => 'Gurgaon',
                // Visakhapatnam
                'vizag'             => 'Visakhapatnam',
                'vishakhapatnam'    => 'Visakhapatnam',
                // Thiruvananthapuram
                'trivandrum'        => 'Thiruvananthapuram',
                // Kochi
                'cochin'            => 'Kochi',
                'ernakulam'         => 'Kochi',
                // Allahabad
                'prayagraj'         => 'Allahabad',
            ];

            if (isset($stateMap[$lower])) {
                // State name → OR match on all cities in that state
                $cities = $stateMap[$lower];
                $query->where(function($q) use ($cities) {
                    foreach ($cities as $city) {
                        $q->orWhere('location', 'like', "%{$city}%");
                    }
                });
            } elseif (isset($cityMap[$lower])) {
                // Typo/alternate city name → corrected city
                $query->where('location', 'like', "%{$cityMap[$lower]}%");
            } else {
                // Direct LIKE match — works for correctly spelled city names
                $query->where('location', 'like', "%{$loc}%");
            }
        }

        // Filter by Category
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // Filter by Job Types
        if ($request->filled('type') && is_array($request->type)) {
            $query->whereIn('job_type', $request->type);
        }

        // Filter by Experience
        if ($request->filled('experience') && is_array($request->experience)) {
            $query->whereIn('experience', $request->experience);
        }

        // Filter by Salary
        if ($request->filled('salary')) {
            $salary = (int) $request->salary;
            $query->where('salary_min', '>=', $salary);
        }

        // Sorting
        if ($request->filled('sort')) {
            switch ($request->sort) {
                case 'salary_asc':
                    $query->orderBy('salary_min', 'asc');
                    break;
                case 'salary_desc':
                    $query->orderBy('salary_min', 'desc');
                    break;
                case 'latest':
                default:
                    $query->latest();
                    break;
            }
        } else {
            $query->latest();
        }

        $jobs = $query->paginate(20)->appends($request->query());
        $categories = Category::orderBy('name')->get();

        return view('jobs.index', compact('jobs', 'categories'));
    }

    public function show(Job $job)
    {
        $job->load(['company', 'category', 'skills']);
        
        $relatedJobs = Job::with('company')
                          ->where('category_id', $job->category_id)
                          ->where('id', '!=', $job->id)
                          ->latest()
                          ->limit(3)
                          ->get();

        return view('jobs.show', compact('job', 'relatedJobs'));
    }

    public function toggleSave(Request $request, Job $job)
    {
        $user = $request->user();
        
        if ($user->savedJobs()->where('job_id', $job->id)->exists()) {
            $user->savedJobs()->detach($job->id);
            $isSaved = false;
        } else {
            $user->savedJobs()->attach($job->id);
            $isSaved = true;
        }

        return response()->json([
            'status' => 'success',
            'saved' => $isSaved
        ]);
    }
}
