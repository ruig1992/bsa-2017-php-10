<?php
namespace App\Http\Controllers\Api\Admin;

use App\Entity\Car;

use App\Http\Requests\StoreCar;
use App\Http\Requests\UpdateCarFields;

use App\Http\Controllers\Api\CarController;
use Illuminate\Http\{Request, JsonResponse};
use Symfony\Component\HttpFoundation\Response;

/**
 * Class AdminCarController
 * @package App\Http\Controllers\Api\Admin
 */
class AdminCarController extends CarController
{
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
