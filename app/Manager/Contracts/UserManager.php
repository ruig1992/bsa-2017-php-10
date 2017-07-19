<?php
namespace App\Manager\Contracts;

use App\Entity\User;
use Illuminate\Support\Collection;
use App\Request\Contracts\SaveUserRequest;

/**
 * Interface UserManager
 * @package App\Manager\Contracts
 */
interface UserManager
{
    /**
     * Find All Users
     *
     * @return Collection
     */
    public function findAll(): Collection;

    /**
     * Get User model by ID
     *
     * @param int $id
     * @return User|null
     */
    public function findById(int $id): ?User;

    /**
     * Find Users that has is_active flag true
     *
     * @return Collection
     */
    public function findActive(): Collection;

    /**
     * Create or Update User
     *
     * @param SaveUserRequest $request
     * @return User|null
     */
    public function saveUser(SaveUserRequest $request): ?User;

    /**
     * Delete User By ID
     *
     * @param int $userId
     * @return void
     */
    public function deleteUser(int $userId): void;
}
