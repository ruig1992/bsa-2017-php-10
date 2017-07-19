<?php
namespace App\Http\Controllers;

use App\Entities\Car;
use App\Http\Requests\ValidatedCar;
use App\Repositories\Contracts\CarRepositoryInterface;

/**
 * Class CarController
 * @package App\Http\Controllers
 */
class CarController extends Controller
{
    /**
     * @var \App\Repositories\Contracts\CarRepositoryInterface
     */
    protected $carsRepository;

    /**
     * @param \App\Repositories\Contracts\CarRepositoryInterface $carsRepository
     */
    public function __construct(CarRepositoryInterface $carsRepository)
    {
        $this->carsRepository = $carsRepository;
        /**
         * Assign the middleware for the controller's actions
         * to check the existence of the car in the repository
         */
        $this->middleware('car.exists')->only(['show', 'edit', 'update']);
    }

    /**
     * Gets and displays the list of all cars from the repository.
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        $cars = $this->carsRepository->getAll();

        return view('cars.index', ['cars' => $cars->toArray()]);
    }

    /**
     * Shows the form for creating a new car.
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function create()
    {
        return view('cars.create');
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
     * @param  \App\Entities\Car $car
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function show(Car $car)
    {
        return view('cars.show', ['car' => $car->toArray()]);
    }

    /**
     * Shows the form for editing the specified car by its id.
     *
     * @param  \App\Entities\Car $car
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function edit(Car $car)
    {
        return view('cars.edit', ['car' => $car->toArray()]);
    }

    /**
     * Updates the specified car by its id in the repository.
     *
     * @param  \App\Http\Requests\ValidatedCar $request
     *    Contains the rules for validating the car data from request
     * @param  \App\Entities\Car $car
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
