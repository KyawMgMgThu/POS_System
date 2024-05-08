<?php

namespace App\Providers;

use App\Models\ModelsSetting;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        // 'key' => 'value';
        $settings = ModelsSetting::all('key', 'value')->keyBy('key')->transform(function ($setting) {
            return $setting->value;
        })->toArray();
        config([
            'settings' => $settings
        ]);
        config(['app.name' => config('settings.app_name')]);
        Paginator::useBootstrap();
    }
}
