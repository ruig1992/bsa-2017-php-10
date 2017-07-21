<?php
namespace App\Http\Controllers\Api\Admin;

use App\Entity\Car;

use App\Http\Requests\StoreCar;
use App\Http\Requests\UpdateCarFields;

use App\Manager\Contracts\{
    CarManager as CarManagerContract,
    UserManager as UserManagerContract
};

use App\Http\Controllers\Controller;
use Illuminate\Http\{Request, JsonResponse};
use Symfony\Component\HttpFoundation\Response;

/**
 * Class AdminCarController
 * @package App\Http\Controllers\Api\Admin
 */
class AdminCarController extends Controller
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

        $this->middleware('auth:api');
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

    /**
     * Store a newly created car.
     *
     * @param \App\Http\Requests\StoreCar $request
     *    Contains the rules for validating the car data from request
     *
     * @return void
     */
    public function store(StoreCar $request): void //JsonResponse
    {
        $data = $request->only([
            'model',
            'registration_number',
            'year',
            'color',
            'mileage',
            'price',
            'user_id',
        ]);

        $car = new Car($data);
        $car->save();
        //$this->carsRepository->store($car);
        //$cars = $this->carManager->findAll();

        //return response()->json($cars);
    }

    /**
     * Updates the specified car by its id.
     *
     * @param  \App\Entity\Car $car
     * @return JsonResponse
     */
    public function update(UpdateCarFields $request, Car $car): JsonResponse
    {
        $data = $request->only([
            'model',
            'registration_number',
            'year',
            'color',
            'mileage',
            'price',
            'user_id',
        ]);

        foreach ($data as $field => $value) {
            if ($value !== null) {
                $car->$field = $value;
            }
        }
        $car->save();

        //$car = $this->carsRepository->update($car);

        return response()->json($car);
    }

    /**
     * Deletes the specified car by its id.
     *
     * @param  \App\Entity\Car $car
     * @return void
     */
    public function destroy(Car $car): void
    {
        $car->delete();
    }
}
