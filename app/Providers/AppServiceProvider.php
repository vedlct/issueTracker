<?php

namespace App\Providers;

use App\Notification;
use Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
       Schema::defaultStringLength(191);


        view()->composer('*', function($view) {

            $myNotification = Notification::leftJoin('backlog', 'backlog.backlog_id', 'notification.task_id')
                                          ->where('assigned_emp_id', Auth::user()->userId)
                                          ->where('seen', '0')
                                          ->get();

            $view->with('myNotification', $myNotification);

        });


    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
