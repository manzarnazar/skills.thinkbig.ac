<?php

namespace App\Providers;


use App\Models\User;
use App\Models\Deposit;
use App\Models\Frontend;
use App\Models\Language;
use App\Models\Instructor;
use App\Models\Withdrawal;
use App\Models\SupportTicket;
use App\Models\AdminNotification;
use Illuminate\Support\Collection;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\LengthAwarePaginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {

        Collection::macro('paginate', function ($perPage, $page = null, $pageName = 'page') {
            $page = $page ?: LengthAwarePaginator::resolveCurrentPage($pageName);
            return new LengthAwarePaginator(
                $this->forPage($page, $perPage), // $items
                $this->count(),                  // $total
                $perPage,
                $page,
                [                                // $options
                    'path' => LengthAwarePaginator::resolveCurrentPath(),
                    'pageName' => $pageName,
                ]
            );
        });

        $general = gs();
        $activeTemplate = activeTemplate();
        $viewShare['general'] = $general;
        $viewShare['activeTemplate'] = $activeTemplate;
        $viewShare['activeTemplateTrue'] = activeTemplate(true);
        $viewShare['languages'] = Language::all();
        $viewShare['emptyMessage'] = 'No data';
        view()->share($viewShare);

        view()->composer('admin.components.tabs.user', function ($view) {
            $view->with([
                'bannedUsersCount'           => User::banned()->count(),
                'emailUnverifiedUsersCount' => User::emailUnverified()->count(),
                'mobileUnverifiedUsersCount'   => User::mobileUnverified()->count(),
                'kycUnverifiedUsersCount'   => User::kycUnverified()->count(),
                'kycPendingUsersCount'   => User::kycPending()->count(),
            ]);
        });


        view()->composer('admin.components.tabs.instructor', function ($view) {
            $view->with([
                'bannedInstructorsCount'           => Instructor::banned()->count(),
                'emailUnverifiedInstructorsCount' => Instructor::emailUnverified()->count(),
                'mobileUnverifiedInstructorsCount'   => Instructor::mobileUnverified()->count(),
                'kycUnverifiedInstructorsCount'   => Instructor::kycUnverified()->count(),
                'kycPendingInstructorsCount'   => Instructor::kycPending()->count(),
            ]);
        });

        view()->composer('admin.components.sidenav', function ($view) {
            $view->with([
                'pendingTicketCount' => SupportTicket::where('user_id', '!=', 0)->where('instructor_id', '=', 0)->whereIN('status', [0, 2])->count(),
                'instructorPendingTicketCount' => SupportTicket::where('instructor_id', '!=', 0)->where('user_id', '=', 0)->whereIN('status', [0, 2])->count(),
            ]);
        });


        view()->composer('admin.components.tabs.deposit', function ($view) {
            $view->with([
                'pendingDepositsCount'    => Deposit::pending()->count(),
            ]);
        });
        view()->composer('admin.components.tabs.withdrawal', function ($view) {
            $view->with([
                'pendingWithdrawCount'    => Withdrawal::pending()->count(),
            ]);
        });
        //  ticket
        view()->composer('admin.components.tabs.ticket', function ($view) {
            $view->with([
                'pendingTicketCount' => SupportTicket::whereIN('status', [0, 2])->count(),
            ]);
        });

        view()->composer('admin.components.tabs.instructor_ticket', function ($view) {
            $view->with([
                'pendingTicketCount'   =>  SupportTicket::where('instructor_id', '!=', 0)->where('user_id', '=', 0)->whereIN('status', [0, 2])->count(),
            ]);
        });



        view()->composer('admin.components.sidenav', function ($view) {
            $view->with([
                'bannedUsersCount'           => User::banned()->count(),
                'emailUnverifiedUsersCount' => User::emailUnverified()->count(),
                'mobileUnverifiedUsersCount'   => User::mobileUnverified()->count(),
                'kycUnverifiedUsersCount'   => User::kycUnverified()->count(),
                'kycPendingUsersCount'   => User::kycPending()->count(),
                'pendingTicketCount'         => SupportTicket::whereIN('status', [0, 2])->count(),
                'pendingDepositsCount'    => Deposit::pending()->count(),
                'pendingWithdrawCount'    => Withdrawal::pending()->count(),
            ]);
        });

        view()->composer('admin.components.topnav', function ($view) {
            $view->with([
                'adminNotifications' => AdminNotification::where('read_status', 0)->with('user')->orderBy('id', 'desc')->take(10)->get(),
                'adminNotificationCount' => AdminNotification::where('read_status', 0)->count(),
            ]);
        });

        view()->composer('includes.seo', function ($view) {
            $seo = Frontend::where('data_keys', 'seo.data')->first();
            $view->with([
                'seo' => $seo ? $seo->data_values : $seo,
            ]);
        });

        if ($general->force_ssl) {
            \URL::forceScheme('https');
        }


        Paginator::useBootstrapFour();
    }
}
