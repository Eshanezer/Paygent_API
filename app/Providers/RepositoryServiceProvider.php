<?php
namespace App\Providers;

use App\Interfaces\MKDBInterface;
use App\Interfaces\SFDCInterface;
use App\Repositories\MKDBRepository;
use App\Repositories\SFDCRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider {
    public function register()
    {
        $this->app->bind(
            // open id - Interface must be declared first
            'App\Interfaces\OpenIdInterface',
            'App\Repositories\OpenIdRepository'
        );

        $this->app->bind(SFDCInterface::class,SFDCRepository::class);
        $this->app->bind(MKDBInterface::class,MKDBRepository::class);
    }
}

