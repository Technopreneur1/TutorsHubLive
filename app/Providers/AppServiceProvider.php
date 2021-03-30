<?php

namespace App\Providers;

use App\AdminSetting;
use App\Session;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Schema::defaultStringLength(191);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('admin.layouts.master', function($view) {
            $sessionsCount = Session::count();
            $requestedSessionsCount = Session::where('accept', 0)->whereNull('cancel_request')->count();
            $pendingSessionsCount = Session::where('accept', 1)
                                        ->where('payment_status', 0)
                                        ->where('completed', 0)
                                        ->count();
            $upcomingSessionsCount = Session::where('accept', 1)
                                    ->where('completed', 0)
                                    ->where('payment_status', 1)
                                    ->whereNull('cancel_request')
                                    ->count();
            $completedSessionsCount = Session::where('payment_status', 1)->where('completed', 1)->count();
            $cancelledSessionsCount = Session::whereNotNull('cancel_request')->count();
            $view->with(compact('sessionsCount', 'requestedSessionsCount', 'pendingSessionsCount', 'upcomingSessionsCount', 'completedSessionsCount', 'cancelledSessionsCount'));
        });

        view()->composer('partials.footer', function($view) {
            $settings = AdminSetting::first();
            $view->with(compact('settings'));
        });
    }
}
