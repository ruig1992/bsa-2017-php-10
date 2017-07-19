<?php
namespace App\Manager;

use App\Entity\User;
use Illuminate\Support\Collection;
use App\Request\Contracts\SaveUserRequest;
use App\Manager\Contracts\UserManager as UserManagerContract;

/**
 * Class UserManager
 * @package App\Manager
 */
class UserManager implements UserManagerContract
{
    /**
     * @inheritdoc
     */
    public function findAll(): Collection
    {
        return User::all();
    }

    /**
     * @inheritdoc
     */
    public function findById(int $id): ?User
    {
        return User::find($id);
    }

    /**
     * @inheritdoc
     */
    public function findActive(): Collection
    {
        return User::where('is_active', 1)->get();
    }

    /**
     * @inheritdoc
     */
    public function saveUser(SaveUserRequest $request): ?User
    {
        $user = $request->getUser();

        $user->first_name = $request->getFirstName() ?? $user->first_name;
        $user->last_name = $request->getLastName() ?? $user->last_name;
        $user->is_active = $request->getIsActive() ?? $user->is_active;

        return $user->save() ? $user : null;
    }

    /**
     * @inheritdoc
     */
    public function deleteUser(int $userId): void
    {
        $user = $this->findById($userId);
        if ($user === null) {
            return;
        }
        $user->delete();
    }
}
