<?php
namespace App\Providers;

use Laravel\Dusk\DuskServiceProvider;
use Illuminate\Support\ServiceProvider;
use App\Manager\{UserManager, CarManager};
use App\Manager\Contract\CarManager as CarManagerContract;
use App\Manager\Contract\UserManager as UserManagerContract;

/**
 * Class AppServiceProvider
 * @package App\Providers
 */
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        // Registration of UserManager and CarManager
        $this->app->bind(UserManagerContract::class, UserManager::class);
        $this->app->bind(CarManagerContract::class, CarManager::class);

        if ($this->app->environment('local', 'testing')) {
            $this->app->register(DuskServiceProvider::class);
        }
    }
}
