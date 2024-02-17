<?php

namespace App\Providers;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use App\Models\Message;
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
    public function boot()
    {
        Paginator::useBootstrapFour();
        view()->composer("admin.includes.nav", function ($view) {
            $counts = Message::where("unread_count", 0)->count();
            $view->with("unread", $counts);
        });
    }
}
