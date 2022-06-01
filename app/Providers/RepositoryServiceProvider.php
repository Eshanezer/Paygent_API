<?php
namespace App\Providers;


use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider {
    public function register()
    {
        $this->app->bind(
            // open id - Interface must be declared first
            'App\Interfaces\OpenIdInterface',
            'App\Repositories\OpenIdRepository',
        );
    }
}

