<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class JobFactory extends Factory
{
    public function definition(): array
    {
        $realisticTitles = [
            'Full Stack Developer', 'Frontend Developer', 'Backend Developer', 'UI/UX Designer',
            'Data Scientist', 'Machine Learning Engineer', 'Product Manager', 'Project Manager',
            'Marketing Specialist', 'Sales Representative', 'Customer Success Manager',
            'DevOps Engineer', 'Cloud Architect', 'Cybersecurity Analyst', 'Quality Assurance (QA) Tester',
            'Business Analyst', 'Human Resources Manager', 'Accountant', 'Financial Analyst',
            'Graphic Designer', 'Content Writer', 'SEO Specialist', 'Social Media Manager'
        ];
        $title = fake()->randomElement($realisticTitles);
        return [
            'company_id' => Company::inRandomOrder()->value('id') ?: Company::factory(),
            'category_id' => Category::inRandomOrder()->value('id') ?: Category::factory(),
            'title' => $title,
            'slug' => Str::slug($title . '-' . Str::random(5)),
            'location' => fake()->randomElement([
                // Gujarat
                'Ahmedabad', 'Surat', 'Vadodara', 'Rajkot', 'Gandhinagar',
                // Maharashtra
                'Mumbai', 'Pune', 'Nagpur', 'Nashik', 'Aurangabad', 'Thane',
                // Karnataka
                'Bangalore', 'Mysore', 'Mangalore', 'Hubli', 'Belgaum',
                // Telangana / AP
                'Hyderabad', 'Visakhapatnam', 'Vijayawada', 'Warangal',
                // Delhi / NCR
                'Delhi', 'Noida', 'Gurgaon', 'Faridabad', 'Ghaziabad',
                // Tamil Nadu
                'Chennai', 'Coimbatore', 'Madurai', 'Salem', 'Trichy',
                // West Bengal
                'Kolkata', 'Howrah', 'Durgapur', 'Asansol',
                // Rajasthan
                'Jaipur', 'Jodhpur', 'Udaipur', 'Kota', 'Ajmer',
                // Uttar Pradesh
                'Lucknow', 'Kanpur', 'Agra', 'Varanasi', 'Allahabad', 'Meerut',
                // Madhya Pradesh
                'Bhopal', 'Indore', 'Jabalpur', 'Gwalior',
                // Punjab / Haryana / HP
                'Chandigarh', 'Ludhiana', 'Amritsar', 'Ambala',
                // Bihar / Jharkhand / Odisha
                'Patna', 'Ranchi', 'Bhubaneswar', 'Cuttack',
                // Kerala
                'Kochi', 'Thiruvananthapuram', 'Kozhikode', 'Thrissur',
                // Assam / NE
                'Guwahati',
                // Other
                'Ahmedabad', 'Mumbai', 'Bangalore', 'Delhi', 'Hyderabad',
                'Chennai', 'Pune', 'Kolkata', 'Remote',
                // Double-weight top cities for more realistic distribution
                'Mumbai', 'Bangalore', 'Delhi', 'Hyderabad', 'Pune', 'Ahmedabad', 'Chennai',
            ]),
            'salary_min' => fake()->randomElement([0, 300000, 500000, 700000, 1000000, 2000000]),
            'salary_max' => fake()->randomElement([600000, 900000, 1200000, 2000000, 3000000, 5000000]),
            'job_type' => fake()->randomElement(['Full Time', 'Part Time', 'Internship', 'Contract', 'Freelance', 'Remote']),
            'experience' => fake()->randomElement(['Entry Level', 'Mid Level', 'Senior Level', 'Lead / Manager', 'Director']),
            'description' => fake()->paragraphs(4, true),
            'responsibilities' => fake()->paragraphs(2, true),
            'requirements' => fake()->paragraphs(2, true),
            'benefits' => fake()->paragraphs(2, true),
            'deadline' => fake()->dateTimeBetween('now', '+2 months'),
        ];
    }
}
