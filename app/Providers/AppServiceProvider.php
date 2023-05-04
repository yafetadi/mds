<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        config(['app.locale' => 'id']);
	    Carbon::setLocale('id');

        Schema::defaultStringLength(191);

        Gate::define('isGudang', function($user) {
            return $user->role == 'Gudang';
        });

        Gate::define('isPurchase', function($user) {
            return $user->role == 'Purchase';
        });

        Gate::define('isFinance', function($user) {
            return $user->role == 'Finance';
        });

        Gate::define('isAdmin', function($user) {
            return $user->role == 'Admin';
        });

        Gate::define('isManager', function($user) {
            return $user->role == 'Manager';
        });

        Gate::define('isOwner', function($user) {
            return $user->role == 'Owner';
        });

        Blade::directive('currency', function ($expression) {
            return "Rp. <?php echo number_format($expression, 0, '.', ','); ?>";
        });

        Paginator::useBootstrap();
    }
}
