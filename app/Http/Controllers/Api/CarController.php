<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Manager\Contract\CarManager as CarManagerContract;
use App\Manager\Contract\UserManager as UserManagerContract;

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
        return 'index';

        foreach ($this->carsRepository->getAll() as $car) {
            $data[] = array_only($car->toArray(), $fields);
        }
        return response()->json($data);
    }

    /**
     * Get and show the full information about the car by its id
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $car = $this->carsRepository->getById($id);

        if ($car === null) {
            return response()->json([
                'message' => "The car with ID #$id not found",
            ], 404);
        }
        return response()->json($car);
    }
}
