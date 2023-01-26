<?php

namespace App\Providers;

use Illuminate\Contracts\Http\Kernel;
use Carbon\CarbonInterval;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Connection;
use Illuminate\Database\Events\QueryExecuted;

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
        Model::preventLazyLoading(!app()->isProduction());
        Model::preventSilentlyDiscardingAttributes(!app()->isProduction());
        $kernel = app(Kernel::class);
        DB::whenQueryingForLongerThan(500, function (Connection $connection, QueryExecuted $event) {
            logger()->channel('telegram')->debug('whenQueryingForLongerThan: ' . $connection->query()->toSql());
        });
        $kernel->whenRequestLifecycleIsLongerThan(
            CarbonInterval::milliseconds(5000),
            function () {
                logger()->channel('telegram')->debug('whenRequestLifecycleIsLongerThan: ' . request()->url());
            }
        );
    }
}
