<?php
namespace App\Providers;

use App\Manager\Contract\{
    CarManager as CarManagerContract,
    UserManager as UserManagerContract
};
use Laravel\Dusk\DuskServiceProvider;
use Illuminate\Support\ServiceProvider;
use App\Manager\{UserManager, CarManager};

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
