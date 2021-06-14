<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Estampa;
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

    }

    public function before(User $user, $ability)
    {
        if ($user->tipo == 'A') {
            return true;
        }
    }

    public function viewAny(User $user){
        return ($user->tipo == 'C' || $user->tipo == 'F' || $user->tipo == 'A');
    }

    public function view(User $user, Estampa $estampa){
        return($user->id == $estampa->cliente_id );
    }

    public function create(User $user){
        return true;
    }
    public function delete(User $user, Estampa $estampa){
        return false;
    }

    public function update(User $user, Estampa $estampa) {
        return $user->id == $estampa->cliente_id;
    }
    public function restore(User $user, Estampa $estampa) {

        //
    }
    public function forceDelete(User $user, Estampa $estampa) {
        //
    }



}
