<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EstampaPolicy
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

    public function viewAny(User $user){
        return ($user->tipo == 'C' || $user->tipo == 'F' || $user->tipo == 'A');
    }

    public function view(User $user, Cliente $cliente){
        return($user->tipo == 'A' || $user->id == $cliente->id);
    }

    public function create(User $user){
        return false;
    }
    public function delete(User $user, Cliente $cliente){
        return false;
    }

    public function update(User $user, Cliente $cliente) {
        return $user->id == $cliente->id;
    }
    public function restore(User $user, Cliente $cliente) {

        //
    }
    public function forceDelete(User $user, Cliente $cliente) {
        //
    }



}
