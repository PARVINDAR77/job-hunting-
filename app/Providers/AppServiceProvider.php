<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Use our custom pagination view everywhere by default
        Paginator::defaultView('components.pagination');
        Paginator::defaultSimpleView('components.pagination');

        // Load settings from JSON and share globally
        $settingsPath = storage_path('app/settings.json');
        $siteSettings = [
            'site_name' => 'JobFinder',
            'site_description' => 'Find your next career opportunity today.',
            'contact_email' => 'support@jobfinder.com',
            'contact_phone' => '+1 234 567 8900',
            'social_facebook' => '#',
            'social_twitter' => '#',
            'social_linkedin' => '#',
            'social_instagram' => '#'
        ];
        
        if (file_exists($settingsPath)) {
            $savedSettings = json_decode(file_get_contents($settingsPath), true);
            if (is_array($savedSettings)) {
                $siteSettings = array_merge($siteSettings, $savedSettings);
            }
        }
        
        \Illuminate\Support\Facades\View::share('siteSettings', $siteSettings);
    }
}
