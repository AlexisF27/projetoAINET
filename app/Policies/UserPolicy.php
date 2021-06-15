<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    public function before(User $user, $ability)
    {
        if ($user->tipo == 'A') {
            return true;
        }
    }

    public function view(User $user){
        return($user->tipo == 'A');
    }

    public function create(User $user){
        return true;
    }
    public function delete(User $user){
        return false;
    }

    public function update(User $user) {
        return($user->tipo == 'A');
    }

    public function restore(User $user, Estampa $estampa) {

        //
    }
    public function forceDelete(User $user, Estampa $estampa) {
        //
    }
}
