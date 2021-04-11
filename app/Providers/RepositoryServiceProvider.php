<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register all repositories are registered in this map.
     *
     * @return void
     */
    public function register()
    {
        $toBind = [
            UserRepository::class => UserRepositoryEloquent::class,
        ];

        foreach ($toBind as $interface => $implementation) {
            $this->app->bind($interface, $implementation);
        }
    }
}
