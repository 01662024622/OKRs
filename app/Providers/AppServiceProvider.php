<?php

namespace App\Providers;

use App\Models\HT20\Apartment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
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
        Schema::defaultStringLength(191);
        view()->composer('*', function ($view)
        {
            if (Auth::check()){
                DB::select('SELECT id FROM ht00_categories WHERE role < 2 AND id NOT IN(
                SELECT DISTINCT(category_id) as id FROM ht00_category_user us where us.role=2 AND us.user_id=93 UNION
                SELECT ap.category_id as id FROM ht00_category_apartment ap where ap.role=2 and ap.apartment_id=24 AND ap.category_id NOT IN(
                SELECT us.category_id as id FROM ht00_category_user us WHERE us.role=1 and us.user_id=93))
                UNION
                SELECT id FROM ht00_categories WHERE role = 2 AND id IN(
                SELECT DISTINCT(category_id) as id FROM ht00_category_user us where us.role=1 AND us.user_id=93 UNION
                SELECT ap.category_id as id FROM ht00_category_apartment ap where ap.role=1 and ap.apartment_id=24 AND ap.category_id NOT IN(
                SELECT us.category_id as id FROM ht00_category_user us WHERE us.role=2 and us.user_id=93))')->pluck('id')->toArray();
            $apartment_user = Apartment::select('id')->where('status',0)->where('user_id',Auth::id())->get()->pluck('id')->toArray();
            $view->with('apartment_user', $apartment_user);
            }
        });
    }
}
