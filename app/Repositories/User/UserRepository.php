<?php
namespace App\Repositories\User;

use App\Repositories\BaseRepository;
use App\Repositories\User\UserRepositoryInterface;
use App\Models\Person;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function getModel()
    {
        return Person::class;
    }

    public function updateRole($id)
    {
        $user = $this->model->find($id);

        if ($user->role == config('user.customer')) {
            $user->update(['role' => config('user.admin')]);

            return true;
        } else {
            $user->update(['role' => config('user.customer')]);

            return true;
        }

        return false;
    }
}
