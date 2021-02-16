<?php

namespace App\Providers;

use App\CompanyEmployee;
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

            if(Auth::check())
            {
                $myNotification = Notification::leftJoin('backlog', 'backlog.backlog_id', 'notification.task_id')
                    ->where('assigned_emp_id', Auth::user()->userId)
                    ->where('seen', '0')
                    ->count();

                $MY_Companies=CompanyEmployee::select('company.companyName','company.companyId')
                    ->where('employeeUserId',Auth::user()->userId)
                    ->leftJoin('company','company.companyId','companyemployee.fk_companyId')
                    ->get();

                $view->with('myNotification', $myNotification);
                $view->with('MY_Companies', $MY_Companies);
            }



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
