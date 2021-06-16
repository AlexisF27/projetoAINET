<?php

namespace App\Policies;

use App\Models\Encomenda;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class EncomendaPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        //
    }

    public function before(User $user, $ability)
    {
        if ($user->tipo == 'A') {
            return true;
        }
    }

    public function view(User $user, Encomenda $encomenda){
        return($user->id == $encomenda->cliente_id );
    }
    public function viewFuncionario(User $user){
        return($user->tipo == 'F');
    }

    public function updateEstado(User $user) {
        return ($user->tipo == 'F');
    }


    public function create(User $user){
        return true;
    }
    public function delete(User $user, Encomenda $encomenda){
        return false;
    }

    public function update(User $user, Encomenda $encomenda) {
        return $user->id == $encomenda->cliente_id;
    }
}
