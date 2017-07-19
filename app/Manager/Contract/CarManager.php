<?php
namespace App\Manager\Contract;

use App\Entity\Car;
use Illuminate\Support\Collection;
use App\Request\Contract\SaveCarRequest;

/**
 * Interface CarManager
 * @package App\Manager\Contract
 */
interface CarManager
{
    /**
     * Find all Cars
     *
     * @return Collection
     */
    public function findAll(): Collection;

    /**
     * Find Car by ID
     *
     * @param int $id
     * @return Car|null
     */
    public function findById(int $id): ?Car;

    /**
     * Find Cars that belongs only to active users
     *
     * @return Collection
     */
    public function findCarsFromActiveUsers(): Collection;

    /**
     * Create or Update Car
     *
     * @param SaveCarRequest $request
     * @return Car|null
     */
    public function saveCar(SaveCarRequest $request): ?Car;

    /**
     * Delete Car by ID
     *
     * @param int $carId
     * @return void
     */
    public function deleteCar(int $carId): void;
}
