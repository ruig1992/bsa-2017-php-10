<?php
namespace App\Transformers;

use App\Entity\Car;
use League\Fractal\TransformerAbstract;

/**
 * Class CarTransformer
 * @package App\Transformers
 */
class CarTransformer extends TransformerAbstract
{
    /**
     * @inheritdoc
     */
    protected $availableIncludes = ['user'];

    /**
     * [transform description].
     * @param  Car $car
     * @return array
     */
    public function transform(Car $car): array
    {
        return [
            'id' => $car->id,
            'model' => $car->model,
            'registration_number' => $car->registration_number,
            'year' => $car->year,
            'color' => $car->color,
            'mileage' => $car->mileage,
            'price' => $car->price,
        ];
    }

    /**
     * [includeUser description].
     * @param  Car $car
     * @return \League\Fractal\Resource\Item
     */
    public function includeUser(Car $car)
    {
        return $this->item($car->user, new UserTransformer);
    }
}
