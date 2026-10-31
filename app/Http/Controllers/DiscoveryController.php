<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Skill;
use App\Models\Job;

class DiscoveryController extends Controller
{
    public function careerExplorer()
    {
        $interests = [
            'Technology' => [
                'icon' => 'fa-laptop-code',
                'color' => 'linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%)',
                'careers' => [
                    ['title' => 'Software Engineer', 'demand' => 'High', 'desc' => 'Build robust applications and systems.'],
                    ['title' => 'Laravel Developer', 'demand' => 'Very High', 'desc' => 'Create beautiful web applications with PHP.'],
                    ['title' => 'Full Stack Developer', 'demand' => 'High', 'desc' => 'Master both frontend and backend development.'],
                    ['title' => 'Backend Developer', 'demand' => 'High', 'desc' => 'Architect and scale server-side logic.'],
                ]
            ],
            'Design' => [
                'icon' => 'fa-pen-nib',
                'color' => 'linear-gradient(135deg, #ec4899 0%, #f43f5e 100%)',
                'careers' => [
                    ['title' => 'UI/UX Designer', 'demand' => 'High', 'desc' => 'Craft intuitive user interfaces.'],
                    ['title' => 'Product Designer', 'demand' => 'Medium', 'desc' => 'Design end-to-end product experiences.'],
                    ['title' => 'Graphic Designer', 'demand' => 'Medium', 'desc' => 'Create compelling visual assets.'],
                ]
            ],
            'Business' => [
                'icon' => 'fa-chart-pie',
                'color' => 'linear-gradient(135deg, #f59e0b 0%, #ea580c 100%)',
                'careers' => [
                    ['title' => 'Product Manager', 'demand' => 'High', 'desc' => 'Lead product strategy and execution.'],
                    ['title' => 'Business Analyst', 'demand' => 'Medium', 'desc' => 'Analyze data to drive business decisions.'],
                ]
            ],
            'Marketing' => [
                'icon' => 'fa-bullhorn',
                'color' => 'linear-gradient(135deg, #10b981 0%, #059669 100%)',
                'careers' => [
                    ['title' => 'Growth Hacker', 'demand' => 'High', 'desc' => 'Scale user acquisition rapidly.'],
                    ['title' => 'Content Strategist', 'demand' => 'Medium', 'desc' => 'Plan and execute content marketing.'],
                ]
            ],
            'Finance' => [
                'icon' => 'fa-coins',
                'color' => 'linear-gradient(135deg, #0ea5e9 0%, #2563eb 100%)',
                'careers' => [
                    ['title' => 'Financial Analyst', 'demand' => 'Medium', 'desc' => 'Evaluate investment opportunities.'],
                    ['title' => 'Accountant', 'demand' => 'High', 'desc' => 'Manage financial records.']
                ]
            ],
            'Engineering' => [
                'icon' => 'fa-cogs',
                'color' => 'linear-gradient(135deg, #64748b 0%, #475569 100%)',
                'careers' => [
                    ['title' => 'Mechanical Engineer', 'demand' => 'Medium', 'desc' => 'Design physical systems.'],
                    ['title' => 'Civil Engineer', 'demand' => 'Medium', 'desc' => 'Build infrastructure.']
                ]
            ],
            'Healthcare' => [
                'icon' => 'fa-heart-pulse',
                'color' => 'linear-gradient(135deg, #ef4444 0%, #b91c1c 100%)',
                'careers' => [
                    ['title' => 'Registered Nurse', 'demand' => 'Very High', 'desc' => 'Provide medical care.'],
                    ['title' => 'Medical Assistant', 'demand' => 'High', 'desc' => 'Support clinical operations.']
                ]
            ],
            'Education' => [
                'icon' => 'fa-book-open',
                'color' => 'linear-gradient(135deg, #8b5cf6 0%, #6d28d9 100%)',
                'careers' => [
                    ['title' => 'Instructional Designer', 'demand' => 'Medium', 'desc' => 'Create learning experiences.'],
                    ['title' => 'Teacher', 'demand' => 'High', 'desc' => 'Educate the next generation.']
                ]
            ]
        ];

        return view('discovery.career-explorer', compact('interests'));
    }

    public function smartMatch()
    {
        $skills = Skill::orderBy('name')->get();
        return view('discovery.smart-match', compact('skills'));
    }

    public function calculateMatch(Request $request)
    {
        $userSkillIds = $request->input('skills', []);
        
        if (empty($userSkillIds)) {
            return response()->json([]);
        }

        $jobs = Job::with(['company', 'skills'])->get();
        $matches = [];

        foreach ($jobs as $job) {
            $jobSkillIds = $job->skills->pluck('id')->toArray();
            
            if (empty($jobSkillIds)) {
                continue; // Skip jobs with no skills defined
            }

            $intersection = array_intersect($userSkillIds, $jobSkillIds);
            $matchPercentage = round((count($intersection) / count($jobSkillIds)) * 100);

            if ($matchPercentage > 0) {
                $matches[] = [
                    'id' => $job->id,
                    'title' => $job->title,
                    'company' => $job->company->name ?? 'Unknown',
                    'logo' => $job->company->logo ? \Storage::url($job->company->logo) : 'https://ui-avatars.com/api/?name='.urlencode($job->company->name ?? 'U').'&background=EBF4FF&color=7F9CF5',
                    'location' => $job->location,
                    'match' => $matchPercentage,
                    'url' => route('jobs.show', $job->id)
                ];
            }
        }

        // Sort by highest match percentage
        usort($matches, function ($a, $b) {
            return $b['match'] <=> $a['match'];
        });

        // Return top 10 matches
        return response()->json(array_slice($matches, 0, 10));
    }
}
