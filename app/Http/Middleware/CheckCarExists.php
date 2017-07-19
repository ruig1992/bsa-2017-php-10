<?php
namespace App\Http\Middleware;

use Closure;
use App\Entities\Car;
use Illuminate\Http\Request;
use App\Manager\Contracts\CarManager as CarManagerContract;

/**
 * Class CheckCarExists
 * @package App\Http\Middleware
 */
class CheckCarExists
{
    /**
     * @var \App\Manager\Contracts\CarManager
     */
    protected $carManager;

    /**
     * @param \App\Manager\Contracts\CarManager $carsRepository
     */
    public function __construct(CarManagerContract $carManager)
    {
        $this->carManager = $carManager;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $id = $request->car;

        $validator = validator(
            ['id' => $id],
            ['id' => 'required|integer|min:1']
        );
        if ($validator->fails()) {
            abort(404, "Invalid car's id format");
        }

        $car = $this->carManager->findById($id);
        if ($car === null) {
            abort(404, "The car #$id not found. But, there are other ones! :-)");
        }

        /**
         * In case of successful checks instantiate the car
         * in the app for further use in the controller
         */
        app()->instance(Car::class, $car);

        return $next($request);
    }
}
