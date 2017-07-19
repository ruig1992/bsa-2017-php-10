<?php
namespace App\Http\Controllers\Api\Admin;

use App\Entity\Car;
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
     * Store a newly created car in the repository
     *
     * @param  Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $storeData = $request->only([
            'model',
            'year',
            'mileage',
            'registration_number',
            'color',
            'price',
            'user_id',
        ]);
        $car = new Car($storeData);
        $newData = $this->carsRepository->store($car);

        return response()->json($newData);
    }

    /**
     * Update the specified car in the repository
     *
     * @param  Request $request
     * @return JsonResponse
     */
    public function update(Request $request, int $id): JsonResponse
    {
        $storeData = $request->only([
            'model',
            'year',
            'mileage',
            'registration_number',
            'color',
            'price',
        ]);

        $car = $this->carsRepository->getById($id);
        if ($car === null) {
            return response()->json([
                'message' => "The car with ID #$id not found",
            ], 404);
        }

        $car->fromArray($storeData);
        $data = $this->carsRepository->update($car);

        return response()->json($data);
    }

    /**
     * Remove the specified car from the repository
     *
     * @param  int $id
     * @return Response
     */
    public function destroy(int $id): Response
    {
        $car = $this->carsRepository->getById($id);
        if ($car === null) {
            return response()->json([
                'message' => "The car with ID #$id doesn't exist",
            ], 404);
        }

        $this->carsRepository->delete($id);

        return response('Ok', 200);
    }
}
