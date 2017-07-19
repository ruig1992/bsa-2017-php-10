<?php
namespace App\Request\Contracts;

use App\Entity\User;

/**
 * Interface SaveUserRequest
 * @package App\Request\Contracts
 */
interface SaveUserRequest
{
    /**
     * @return string|null
     */
    public function getFirstName();

    /**
     * @return string|null
     */
    public function getLastName();

    /**
     * @return bool
     */
    public function getIsActive(): bool;

    /**
     * @return User
     */
    public function getUser(): User;
}
