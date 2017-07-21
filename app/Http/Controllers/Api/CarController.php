<?php
namespace App\Http\Controllers\Api;

use App\Entity\Car;
use App\Manager\Contracts\{
    CarManager as CarManagerContract,
    UserManager as UserManagerContract
};
use App\Http\Controllers\Controller;
use Illuminate\Http\{Request, JsonResponse};

use App\Transformers\CarTransformer;

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

        $this->middleware('auth:api');
    }

    /**
     * Gets and displays the list of all cars with certain data fields.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $fields = ['id', 'model', 'year', 'color', 'price',];
        $data = [];

        foreach ($this->carManager->findAll() as $car) {
            $data[] = array_only($car->toArray(), $fields);
        }

        return response()->json($data);
    }

    /**
     * Gets and displays the full information about the car by its id.
     *
     * @param  \App\Entity\Car $car
     * @return JsonResponse
     */
    public function show(Car $car): JsonResponse
    {
        $data = fractal()
            ->item($car)
            ->parseIncludes(['user'])
            ->transformWith(new CarTransformer())
            ->toArray();

        return response()->json($data);
    }
}
