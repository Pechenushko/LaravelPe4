<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        /**
         * Contextual Binding
         */
        $this->app->when('App\Http\Controllers\AuthorController')
            ->needs('App\Repositories\RepositoryInterface')
            ->give('App\Repositories\AuthorRepository');

        $this->app->when('App\Http\Controllers\BookController')
            ->needs('App\Repositories\RepositoryInterface')
            ->give('App\Repositories\BookRepository');
    }
}
