<?php
namespace App\Http\Controllers\Api;

use App\Manager\Contract\{
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
     * User Manager
     * @var \App\Manager\Contract\UserManager
     */
    protected $userManager;
    /**
     * Car Manager
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
     * Get and show the list of all cars
     *
     * @return JsonResponse
     */
    public function index()
    {
        $cars = $this->carManager->findAll();
        return response()->json($cars);
    }

    /**
     * Get and show the full information about the car by its id
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $car = $this->carManager->findById($id);

        if ($car === null) {
            return response()->json([
                'message' => "The car #$id not found",
            ], 404);
        }
        return response()->json($car);
    }
}
