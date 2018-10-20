<?php

namespace Hostingprecisie\VoyagerAlbums;

use Hostingprecisie\VoyagerForm\Models\Form;
use Hostingprecisie\VoyagerForm\Policies\FormPolicy;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Gate;

class VoyagerAlbumsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // $this->loadRoutesFrom(__DIR__."/routes/route.php");
        $this->loadViewsFrom(__DIR__."/Views","voyagerAlbums");
        $this->loadMigrationsFrom(__DIR__."/Migrations");

        $this->publishes([__DIR__."/Views" => resource_path("views/vendor/voyager/")]);

        // Gate::policy(Form::class, FormPolicy::class);

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
