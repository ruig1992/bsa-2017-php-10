<?php
namespace App\Http\Controllers;

use App\Entity\Car;
use App\Http\Requests\ValidatedCar;
use App\Repositories\Contracts\CarRepositoryInterface;

use App\Manager\Contracts\{
    CarManager as CarManagerContract,
    UserManager as UserManagerContract
};

/**
 * Class CarController
 * @package App\Http\Controllers
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

        /**
         * Assign the middleware for the controller's actions
         * to check the existence of the car in the repository
         */
        $this->middleware('car.exists')->only(['show', 'edit', 'update']);
    }

    /**
     * Get and show the list of all cars
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        $cars = $this->carManager->findAll();

        return view('cars.index', ['cars' => $cars->toArray()]);
    }

    /**
     * Shows the form for creating a new car.
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function create()
    {
        $users = $this->userManager->findAll();

        return view('cars.create', ['users' => $users]);
    }

    /**
     * Stores a newly created car in the repository.
     *
     * @param \App\Http\Requests\ValidatedCar $request
     *    Contains the rules for validating the car data from request
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function store(ValidatedCar $request)
    {
        $data = $request->only([
            'model',
            'registration_number',
            'year',
            'color',
            'price',
        ]);

        $car = new Car($data);
        $this->carsRepository->store($car);
        $updatedCars = $this->carsRepository->getAll();

        return view('cars.index', ['cars' => $updatedCars->toArray()]);
    }

    /**
     * Gets and displays the full information about the car by its id.
     *
     * @param  \App\Entity\Car $car
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function show(Car $car)
    {
        return view('cars.show', ['car' => $car->toArray()]);
    }

    /**
     * Shows the form for editing the specified car by its id.
     *
     * @param  \App\Entity\Car $car
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function edit(Car $car)
    {
        $users = $this->userManager->findAll();

        return view('cars.edit', [
            'car' => $car->toArray(),
            'users' => $users,
        ]);
    }

    /**
     * Updates the specified car by its id in the repository.
     *
     * @param  \App\Http\Requests\ValidatedCar $request
     *    Contains the rules for validating the car data from request
     * @param  \App\Entity\Car $car
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function update(ValidatedCar $request, Car $car)
    {
        $data = $request->only([
            'model',
            'registration_number',
            'year',
            'color',
            'price',
        ]);

        $car->fromArray($data);
        $car = $this->carsRepository->update($car);

        return view('cars.show', ['car' => $car->toArray()]);
    }
}
