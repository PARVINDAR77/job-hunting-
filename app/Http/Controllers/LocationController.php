<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;

class LocationController extends Controller
{
    public function index()
    {
        $cities = [
            [
                'name'     => 'Mumbai',
                'state'    => 'Maharashtra',
                'emoji'    => '🌊',
                'icon'     => 'fa-solid fa-water',
                'tagline'  => 'Financial capital & tech giant',
                'gradient' => 'linear-gradient(135deg, #667eea 0%, #764ba2 100%)',
                'glow'     => 'rgba(102,126,234,0.5)',
            ],
            [
                'name'     => 'Bangalore',
                'state'    => 'Karnataka',
                'emoji'    => '🌿',
                'icon'     => 'fa-solid fa-microchip',
                'tagline'  => 'Silicon Valley of India',
                'gradient' => 'linear-gradient(135deg, #11998e 0%, #38ef7d 100%)',
                'glow'     => 'rgba(17,153,142,0.5)',
            ],
            [
                'name'     => 'Delhi',
                'state'    => 'NCR',
                'emoji'    => '🏛️',
                'icon'     => 'fa-solid fa-landmark',
                'tagline'  => 'Power hub of North India',
                'gradient' => 'linear-gradient(135deg, #f093fb 0%, #f5576c 100%)',
                'glow'     => 'rgba(240,147,251,0.5)',
            ],
            [
                'name'     => 'Hyderabad',
                'state'    => 'Telangana',
                'emoji'    => '💎',
                'icon'     => 'fa-solid fa-gem',
                'tagline'  => 'City of Pearls & Startups',
                'gradient' => 'linear-gradient(135deg, #4facfe 0%, #00f2fe 100%)',
                'glow'     => 'rgba(79,172,254,0.5)',
            ],
            [
                'name'     => 'Pune',
                'state'    => 'Maharashtra',
                'emoji'    => '🎓',
                'icon'     => 'fa-solid fa-graduation-cap',
                'tagline'  => 'Oxford of the East',
                'gradient' => 'linear-gradient(135deg, #fa709a 0%, #fee140 100%)',
                'glow'     => 'rgba(250,112,154,0.5)',
            ],
            [
                'name'     => 'Chennai',
                'state'    => 'Tamil Nadu',
                'emoji'    => '🚗',
                'icon'     => 'fa-solid fa-industry',
                'tagline'  => 'Detroit of South Asia',
                'gradient' => 'linear-gradient(135deg, #f7971e 0%, #ffd200 100%)',
                'glow'     => 'rgba(247,151,30,0.5)',
            ],
            [
                'name'     => 'Kolkata',
                'state'    => 'West Bengal',
                'emoji'    => '🎨',
                'icon'     => 'fa-solid fa-palette',
                'tagline'  => 'Cultural capital of India',
                'gradient' => 'linear-gradient(135deg, #e96c4c 0%, #f7c59f 100%)',
                'glow'     => 'rgba(233,108,76,0.5)',
            ],
            [
                'name'     => 'Noida',
                'state'    => 'Uttar Pradesh',
                'emoji'    => '🏢',
                'icon'     => 'fa-solid fa-city',
                'tagline'  => 'NCR\'s fast-growing IT corridor',
                'gradient' => 'linear-gradient(135deg, #3a7bd5 0%, #3a6073 100%)',
                'glow'     => 'rgba(58,123,213,0.5)',
            ],
            [
                'name'     => 'Gurgaon',
                'state'    => 'Haryana',
                'emoji'    => '🏙️',
                'icon'     => 'fa-solid fa-building-columns',
                'tagline'  => 'Millennium City of India',
                'gradient' => 'linear-gradient(135deg, #56ccf2 0%, #2f80ed 100%)',
                'glow'     => 'rgba(86,204,242,0.5)',
            ],
            [
                'name'     => 'Jaipur',
                'state'    => 'Rajasthan',
                'emoji'    => '🌹',
                'icon'     => 'fa-solid fa-fort-awesome',
                'tagline'  => 'Pink City turning tech-pink',
                'gradient' => 'linear-gradient(135deg, #f953c6 0%, #b91d73 100%)',
                'glow'     => 'rgba(249,83,198,0.5)',
            ],
            [
                'name'     => 'Kochi',
                'state'    => 'Kerala',
                'emoji'    => '⛵',
                'icon'     => 'fa-solid fa-anchor',
                'tagline'  => 'Queen of the Arabian Sea',
                'gradient' => 'linear-gradient(135deg, #1d976c 0%, #93f9b9 100%)',
                'glow'     => 'rgba(29,151,108,0.5)',
            ],
            [
                'name'     => 'Coimbatore',
                'state'    => 'Tamil Nadu',
                'emoji'    => '🏭',
                'icon'     => 'fa-solid fa-gears',
                'tagline'  => 'Manchester of South India',
                'gradient' => 'linear-gradient(135deg, #c94b4b 0%, #4b134f 100%)',
                'glow'     => 'rgba(201,75,75,0.5)',
            ],
            [
                'name'     => 'Nagpur',
                'state'    => 'Maharashtra',
                'emoji'    => '🍊',
                'icon'     => 'fa-solid fa-seedling',
                'tagline'  => 'Orange City of India',
                'gradient' => 'linear-gradient(135deg, #f7971e 0%, #ff5722 100%)',
                'glow'     => 'rgba(255,87,34,0.5)',
            ],
            [
                'name'     => 'Indore',
                'state'    => 'Madhya Pradesh',
                'emoji'    => '🌟',
                'icon'     => 'fa-solid fa-star',
                'tagline'  => 'Cleanest city, smartest tech',
                'gradient' => 'linear-gradient(135deg, #614385 0%, #516395 100%)',
                'glow'     => 'rgba(97,67,133,0.5)',
            ],
            [
                'name'     => 'Lucknow',
                'state'    => 'Uttar Pradesh',
                'emoji'    => '🕌',
                'icon'     => 'fa-solid fa-mosque',
                'tagline'  => 'City of Nawabs & Startups',
                'gradient' => 'linear-gradient(135deg, #c471ed 0%, #12c2e9 100%)',
                'glow'     => 'rgba(196,113,237,0.5)',
            ],
            [
                'name'     => 'Visakhapatnam',
                'state'    => 'Andhra Pradesh',
                'emoji'    => '🌊',
                'icon'     => 'fa-solid fa-ship',
                'tagline'  => 'Jewel of the East Coast',
                'gradient' => 'linear-gradient(135deg, #005c97 0%, #363795 100%)',
                'glow'     => 'rgba(0,92,151,0.5)',
            ],
            [
                'name'     => 'Chandigarh',
                'state'    => 'Punjab / Haryana',
                'emoji'    => '🌳',
                'icon'     => 'fa-solid fa-tree',
                'tagline'  => 'The City Beautiful',
                'gradient' => 'linear-gradient(135deg, #56ab2f 0%, #a8e063 100%)',
                'glow'     => 'rgba(86,171,47,0.5)',
            ],
            [
                'name'     => 'Surat',
                'state'    => 'Gujarat',
                'emoji'    => '💍',
                'icon'     => 'fa-solid fa-ring',
                'tagline'  => 'Diamond & Textile capital',
                'gradient' => 'linear-gradient(135deg, #f2994a 0%, #f2c94c 100%)',
                'glow'     => 'rgba(242,153,74,0.5)',
            ],
            [
                'name'     => 'Ahmedabad',
                'state'    => 'Gujarat',
                'emoji'    => '🏗️',
                'icon'     => 'fa-solid fa-building',
                'tagline'  => 'Manchester of India',
                'gradient' => 'linear-gradient(135deg, #a18cd1 0%, #fbc2eb 100%)',
                'glow'     => 'rgba(161,140,209,0.5)',
            ],
            [
                'name'     => 'Remote',
                'state'    => 'Work from Anywhere',
                'emoji'    => '🌍',
                'icon'     => 'fa-solid fa-globe',
                'tagline'  => 'Freedom to work globally',
                'gradient' => 'linear-gradient(135deg, #43e97b 0%, #38f9d7 100%)',
                'glow'     => 'rgba(67,233,123,0.5)',
            ],
        ];

        $locationData = [];
        foreach ($cities as $city) {
            $locationData[] = array_merge($city, [
                'job_count' => Job::where('location', 'like', '%' . $city['name'] . '%')->count(),
            ]);
        }

        return view('locations.index', compact('locationData'));
    }
}
