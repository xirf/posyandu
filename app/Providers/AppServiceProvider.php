<?php

namespace App\Providers;

use App\Models\SiteInfo;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider {
    /**
     * Register any application services.
     */
    public function register(): void {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void {
        View::composer('*', function ($view) {
            $siteInfo = Cache::remember('siteInfo', 120, function () {
                return SiteInfo::select(
                    'name',
                    'address',
                    'phone',
                    'email',
                )->first();
            });
            $view->with('siteInfo', $siteInfo);
        });
    }
}
