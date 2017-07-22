<?php
namespace App\Http\Controllers;

use App\Entity\Car;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCar;

use App\Managers\Contracts\{
    CarManager,
    UserManager
};
use App\Managers\Eloquent\Criteria\{
    Latest,
    EagerLoad, ByUser, IsActive
};

/**
 * Class CarController
 * @package App\Http\Controllers
 */
class CarController extends Controller
{
    /**
     * @var \App\Managers\Contracts\CarManager
     */
    protected $cars;
    /**
     * @var \App\Managers\Contracts\UserManager
     */
    protected $users;

    /**
     * @param \App\Managers\Contracts\CarManager $cars
     * @param \App\Managers\Contracts\UserManager $users
     */
    public function __construct(CarManager $cars, UserManager $users)
    {
        $this->cars = $cars;
        $this->users = $users;

        $this->middleware('auth');

        $this->middleware('can:cars.create')->only(['create', 'store']);
        $this->middleware('can:cars.update,car')->only(['edit', 'update']);
        $this->middleware('can:cars.delete,car')->only(['destroy']);
    }

    /**
     * Gets and displays the list of all cars.
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        $cars = $this->cars
            ->withCriteria(new Latest('id'))
            ->paginate(9, ['id', 'model', 'color', 'price']);

        return view('cars.index', ['cars' => $cars]);
    }

    /**
     * Gets and displays the full information about the car by its id.
     *
     * @param  int $id
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function show(int $id)
    {
        $car = $this->cars
            //->withCriteria(new EagerLoad(['user']))
            ->find($id);

        //dd($car->toArray());

        return view('cars.show', ['car' => $car->toArray()]);
    }

    /**
     * Shows the form for creating a new car.
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function create()
    {
        $users = $this->users->findAllForForm();

        return view('cars.create', ['users' => $users]);
    }

    /**
     * Stores a newly created car.
     *
     * @param \App\Http\Requests\StoreCar $request
     *    Contains the rules for validating the car data from form request
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function store(StoreCar $request)
    {
        $this->cars->create($request->only([
            'model',
            'registration_number',
            'year',
            'color',
            'mileage',
            'price',
            'user_id',
        ]));

        return redirect()->route('cars.index');
    }

    /**
     * Shows the form for editing the specified car by its id.
     *
     * @param  int $id
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function edit(int $id)
    {
        $car = $this->cars->find($id);
        $users = $this->users->findAllForForm();

        return view('cars.edit', [
            'car' => $car->toArray(),
            'users' => $users,
        ]);
    }

    /**
     * Updates the specified car by its id.
     *
     * @param  \App\Http\Requests\StoreCar $request
     *    Contains the rules for validating the car data from form request
     * @param  int $id
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function update(StoreCar $request, int $id)
    {
        $this->cars->update($id, $request->only([
            'model',
            'registration_number',
            'year',
            'color',
            'mileage',
            'price',
            'user_id',
        ]));

        return redirect()->route('cars.show', ['id' => $id]);
    }

    /**
     * Deletes the specified car by its id.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function destroy(int $id)
    {
        $this->cars->delete($id);

        return redirect()->route('cars.index');
    }
}
