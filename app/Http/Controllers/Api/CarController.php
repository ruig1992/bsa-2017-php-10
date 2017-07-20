<?php
namespace App\Http\Controllers\Api;

use App\Entity\Car;
use App\Manager\Contracts\{
    CarManager as CarManagerContract,
    UserManager as UserManagerContract
};
use App\Http\Controllers\Controller;
use Illuminate\Http\{Request, JsonResponse};

/**
 * Class CarController
 * @package App\Http\Controllers\Api
 */
class CarController extends Controller
{
    /**
     * @var \App\Manager\Contract\UserManager
     */
    protected $userManager;
    /**
     * @var \App\Manager\Contract\CarManager
     */
    protected $carManager;

    /**
     * @param \App\Manager\Contract\UserManager $userManager
     * @param \App\Manager\Contract\CarManager $carManager
     */
    public function __construct(
        UserManagerContract $userManager,
        CarManagerContract $carManager
    ) {
        $this->userManager = $userManager;
        $this->carManager = $carManager;
    }

    /**
     * Gets and displays the list of all cars.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $cars = $this->carManager->findAll();

        return response()->json($cars);
    }

    /**
     * Gets and displays the full information about the car by its id.
     *
     * @param  \App\Entity\Car $car
     * @return JsonResponse
     */
    public function show(Car $car): JsonResponse
    {
        //$car->user;

        return response()->json($car);
    }
}
