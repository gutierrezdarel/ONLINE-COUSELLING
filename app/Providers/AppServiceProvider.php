<?php

namespace App\Providers;

use App\Models\InquiryReceiver;
use App\Models\ReactivatedUsers;
use App\Models\Section;
use App\Models\TermCondition;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Auth;

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
        if (Schema::hasTable('term_conditions')) {
            $term = TermCondition::all()->first();
        // $user = Auth::user()->id;
            //$check = ReactivatedUsers::where('user_id', $user)->first();
            //I dont know why but paginator links in table showing weird arrows.
            Paginator::useBootstrap();

            $layout = array(
                'app' => 'layouts/app',
            );

            $data = array(
                'term' => TermCondition::all()->first(),
                'configRecepient'   => InquiryReceiver::count(),
            );

            view()->composer($layout, function ($view) use ($data) {
                $view->with($data);
            });
        }
        
    }
}
