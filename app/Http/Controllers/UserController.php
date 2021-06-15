<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserPost;

class UserController extends Controller
{
    //
    public function admin_index(Request $request){
        $selectedTipo= $request->tipo ?? '';
        $selectedNomeUser= $request->name ?? '';
        $selectedEmail = $request->email ?? '';
        $user = Auth::user();
        $qry = User::query();
        if ($selectedTipo) {
            $qry->where('tipo', $selectedTipo);
        }
        if($selectedNomeUser){
            $qry->where('name', $selectedNomeUser);
        }
        if($selectedEmail){
            $qry->where('email', $selectedEmail);
        }
        $lista_tipos = array( 'C', 'F', 'A');
        $todosUsers = $qry->paginate(10);
        return view('users.admin',
            compact('todosUsers',
                    'user',
                    'lista_tipos',
                    'selectedNomeUser',
                    'selectedTipo',
                    'selectedEmail'));
    }

    public function create(){
        $newUser = new User();
        $lista_tipo = array( 'C', 'F', 'A');
        return view('users.admin',
            compact('newUser',
                    'lista_tipo'));
    }

    public function store(UserPost $request){
        $newUser = User::create($request->validated());
        return redirect()->route('users.admin')
            ->with('alert-msg', 'Usuario "' . $newUser->name . '" foi criada com sucesso!')
            ->with('alert-type', 'success');
    }

    public function edit(User $user){
        $lista_tipo = array( 'C', 'F', 'A');
        return view('users.edit',compact('lista_tipo'))->withNewUser($user);
    }

    public function updateBloqueado(Request $request, $id){
        $user = User::findOrFail($id);
        if($user->tipo == 0){
            $msg = 'O usuario' . $user->name . ' foi bloqueado';
            $user->tipo = 1;
        }
        if($user->tipo == 1){
            $msg = 'O usuario' . $user->name . ' deixou de estar bloqueado';
            $user->tipo = 0;
        }
        $user->save();
        return back()
        ->with('alert-msg', 'O usuario "' . $user->name . '" mudou de estado !')
        ->with('alert-type', 'warning');
    }

    public function update(UserPost $request, User $user)
    {
        $user->fill($request->validated());
        $user->save();
        return redirect()->route('users.admin')
            ->with('alert-msg', 'Usuario "' . $user->name . '" foi alterada com sucesso!')
            ->with('alert-type', 'success');
    }

    public function destroy(User $user)
    {
        $oldName = $user->name;
        try {
            $user->delete();
            Storage::delete(['foto_url']);
            return redirect()->route('users.admin')
                ->with('alert-msg', 'Usuario "' . $user->name . '" foi apagada com sucesso!')
                ->with('alert-type', 'success');
        } catch (\Throwable $th) {
            // $th é a exceção lançada pelo sistema - por norma, erro ocorre no servidor BD MySQL
            // Descomentar a próxima linha para verificar qual a informação que a exceção tem
            //dd($th, $th->errorInfo);

            if ($th->errorInfo[1] == 1451) {   // 1451 - MySQL Error number for "Cannot delete or update a parent row: a foreign key constraint fails (%s)"
                return redirect()->route('users.admin')
                    ->with('alert-msg', 'Não foi possível apagar o Usuario "' . $oldName . '", porque esta estampa já está em uso!')
                    ->with('alert-type', 'danger');
            } else {
                return redirect()->route('estampas.index')
                    ->with('alert-msg', 'Não foi possível apagar o Usuario "' . $oldName . '". Erro: ' . $th->errorInfo[2])
                    ->with('alert-type', 'danger');
            }
        }
    }


}
