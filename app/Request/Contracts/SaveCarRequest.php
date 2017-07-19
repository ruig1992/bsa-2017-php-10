<?php
namespace App\Request\Contracts;

use App\Entity\Car;
use App\Entity\User;

/**
 * Interface SaveCarRequest
 * @package App\Request\Contracts
 */
interface SaveCarRequest
{
    /**
     * @return Car
     */
    public function getCar(): Car;

    /**
     * @return string|null
     */
    public function getColor();

    /**
     * @return string|null
     */
    public function getModel();

    /**
     * @return string|null
     */
    public function getRegistrationNumber();

    /**
     * @return int|null
     */
    public function getYear();

    /**
     * @return float|null
     */
    public function getMileage();

    /**
     * @return float|null
     */
    public function getPrice();

    /**
     * @return User
     */
    public function getUser(): User;
}
