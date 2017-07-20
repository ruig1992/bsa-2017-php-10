<?php
namespace App\Http\Controllers;

use App\Entity\Car;
use Illuminate\Http\Request;
use App\Http\Requests\ValidatedCar;

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
    }

    /**
     * Gets and displays the list of all cars.
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
     * Stores a newly created car.
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
            'mileage',
            'price',
            'user_id',
        ]);

        $car = new Car($data);
        $car->save();
        //$this->carsRepository->store($car);
        $cars = $this->carManager->findAll();

        return redirect()->route('cars.index');
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
     * Updates the specified car by its id.
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
            'mileage',
            'price',
            'user_id',
        ]);

        foreach ($data as $field => $value) {
            $car->$field = $value;
        }
        $car->save();

        //$car = $this->carsRepository->update($car);

        return redirect()->route('cars.show', ['id' => $car->id]);
    }

    /**
     * Deletes the specified car by its id.
     *
     * @param  \App\Entity\Car $car
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    /*public function destroy(Car $car)
    {
        dd($car);

        //$car = $this->carsRepository->update($car);

        return redirect()->route('cars.show', ['id' => $car->id]);
    }*/
}
