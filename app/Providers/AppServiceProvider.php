<?php

namespace App\Providers;

use Illuminate\Contracts\Http\Kernel;
use Carbon\CarbonInterval;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

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
    public function boot(): void
    {
        Model::shouldBeStrict(app()->isLocal());
        app(Kernel::class)->whenRequestLifecycleIsLongerThan(
            CarbonInterval::milliseconds(5000),
            function () {
                logger()->channel('telegram')->debug('whenRequestLifecycleIsLongerThan: ' . request()->url());
            }
        );
    }
}
