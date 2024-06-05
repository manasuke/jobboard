<?php

namespace App\Providers;

use App\Models\Idea;
use App\Models\User;
use App\Policies\IdeaPermission;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
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
        Paginator::useBootstrapFive();
        Gate::define('admin', function (User $user) {
            return $user->is_admin;
        });

        // Cache::forget('topUsers');

        $topUsers = Cache::remember('topUsers', now()->addMinutes(2), function () {
            return User::withCount('ideas')->orderBy('ideas_count', 'DESC')->limit(5)->get();
        });

        // Cache::flush();

        View::share('topUsers', $topUsers);
    }
}
