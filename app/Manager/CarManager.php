<?php
namespace App\Manager;

use App\Entity\Car;
use Illuminate\Support\Collection;
use App\Request\Contracts\SaveCarRequest;
use App\Manager\Contracts\CarManager as CarManagerContract;

/**
 * Class CarManager
 * @package App\Manager
 */
class CarManager implements CarManagerContract
{
    /**
     * @inheritdoc
     */
    public function findAll(): Collection
    {
        return Car::all();
    }

    /**
     * @inheritdoc
     */
    public function findById(int $id): ?Car
    {
        return Car::find($id);
    }

    /**
     * @inheritdoc
     */
    public function findCarsFromActiveUsers(): Collection
    {
        return Car::whereHas('user', function ($query) {
            $query->where('is_active', true);
        })->get();
    }

    /**
     * @inheritdoc
     */
    public function saveCar(SaveCarRequest $request): ?Car
    {
        $car = $request->getCar();

        $car->model = $request->getModel() ?? $car->model;
        $car->registration_number = $request->getRegistrationNumber() ??
            $car->registration_number;
        $car->color = $request->getColor() ?? $car->color;
        $car->year = $request->getYear() ?? $car->year;
        $car->mileage = $request->getMileage() ?? $car->mileage;
        $car->price = $request->getPrice() ?? $car->price;
        $car->user_id = $request->getUser()->id ?? $car->user_id;

        return $car->save() ? $car : null;
    }

    /**
     * @inheritdoc
     */
    public function deleteCar(int $carId): void
    {
        $car = $this->findById($carId);
        if ($car === null) {
            return;
        }
        $car->delete();
    }
}
