<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Database\Query\Builder;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Builder::macro('orderByRandom', function () {

            $randomFunctions = [
                'mysql'  => 'RAND()',
                'pgsql'  => 'RANDOM()',
                'sqlite' => 'RANDOM()',
                'sqlsrv' => 'NEWID()',
            ];
        
            $driver = $this->getConnection()->getDriverName();
        
            return $this->orderByRaw($randomFunctions[$driver]);
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
