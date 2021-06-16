<?php

namespace App\Http\Controllers;

use App\Http\Requests\EncomendaPost;
use App\Models\Encomenda;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\EncomendaShipped;

class EncomendaController extends Controller
{
    //
    public function index(Request $request){
        $selectedEstado = $request->estado ?? '';
        $selectedData = $request->data ?? '';
        $selectedCliente = $request->cliente_id ?? '';
        $user = Auth::user();
        $qry = Encomenda::query();
        if ($selectedEstado) {
            $qry->where('estado', $selectedEstado);
        }
        if($selectedData){
            $qry->whereDate('data', '=', date('Y-m-d'));
        }
        if($selectedCliente){
            $qry->where('cliente_id',$selectedCliente);
        }

        $lista_estados = array( 'pendente', 'paga', 'fechada', 'anulada');
        $todasEncomendas = $qry->where('cliente_id', $user->id)->paginate(10);
        $lista_Clientes = User::pluck('name','id');
        return view('encomendas.index',
        compact('selectedEstado',
                'user',
                'todasEncomendas',
                'lista_estados',
                'selectedData',
                'selectedCliente',
                'lista_Clientes'));
    }

    public function index_funcionario(Request $request, $id){
        $encomenda = Encomenda::findOrFail($id);
        return view('encomendas.index_funcionario',compact('encomenda'));
    }

    public function create(){
        $newEncomenda = new Encomenda();
        $lista_estados = array( 'pendente', 'paga', 'fechada', 'anulada');
        $lista_tipo_pagamento = array('VISA', 'MC', 'PAYPAL');
        $lista_users = User::all();
        return view('encomendas.create',compact('lista_users','newEncomenda','lista_estados', 'lista_tipo_pagamento'));
    }

    public function store(EncomendaPost $request){
        $newEncomenda = Encomenda::create($request->validated());
        return redirect()->route('encomendas.index')
            ->with('alert-msg', 'Estampa "' . $newEncomenda->id . '" foi criada com sucesso!')
            ->with('alert-type', 'success');
    }
    public function edit(Encomenda $encomenda){
        $lista_estados = array( 'pendente', 'paga', 'fechada', 'anulada');
        $lista_tipo_pagamento = array('VISA', 'MC', 'PAYPAL');
        $lista_users = User::all();
        return view('encomendas.edit',compact('lista_users','lista_estados','lista_tipo_pagamento'))->withNewEncomenda($encomenda);
    }


    public function updateEstado(Request $request, $id){
        $encomenda = Encomenda::findOrFail($id);
        if($encomenda->estado == 'paga'){
            $msg = 'O estado da encomenda ' . $request->id . ' foi mudado para fechada ';
            $encomenda->estado = 'fechada';
            $user = User::findOrFail($encomenda->cliente_id);
            $encomenda->save();
            Mail::to($user)
                ->send(new EncomendaShipped($encomenda));
            return redirect()->route('encomendas.index')
                ->with('alert-type', 'success')
                ->with('alert-msg', 'E-Mail sent with success (using Mailable)');
        }
        if($encomenda->estado == 'pendente'){
            $msg = 'O estado da encomenda ' . $request->id . ' foi mudado para pagada ';
            $encomenda->estado = 'paga';
        }
        $encomenda->save();
        return back()
        ->with('alert-msg', 'A encomenda "' . $encomenda->id . '" mudou de estado para "'. $encomenda->estado  .'"!')
        ->with('alert-type', 'warning');
    }

    public function update(EncomendaPost $request, Encomenda $encomenda)
    {
        $encomenda->fill($request->validated());
        $encomenda->save();
        return redirect()->route('encomendas.index')
            ->with('alert-msg', 'Encomenda "' . $encomenda->id . '" foi alterada com sucesso!')
            ->with('alert-type', 'success');
    }

    public function destroy(Encomenda $encomenda)
    {
        $oldName = $encomenda->nome;
        try {
            $encomenda->delete();
            Storage::delete(['imagem_url']);
            return redirect()->route('encomendas.index')
                ->with('alert-msg', 'Encomenda "' . $encomenda->id . '" foi apagada com sucesso!')
                ->with('alert-type', 'success');
        } catch (\Throwable $th) {
            // $th é a exceção lançada pelo sistema - por norma, erro ocorre no servidor BD MySQL
            // Descomentar a próxima linha para verificar qual a informação que a exceção tem
            //dd($th, $th->errorInfo);

            if ($th->errorInfo[1] == 1451) {   // 1451 - MySQL Error number for "Cannot delete or update a parent row: a foreign key constraint fails (%s)"
                return redirect()->route('encomendas.index')
                    ->with('alert-msg', 'Não foi possível apagar a Encomenda "' . $oldName . '", porque esta estampa já está em uso!')
                    ->with('alert-type', 'danger');
            } else {
                return redirect()->route('estampas.index')
                    ->with('alert-msg', 'Não foi possível apagar a Encomenda "' . $oldName . '". Erro: ' . $th->errorInfo[2])
                    ->with('alert-type', 'danger');
            }
        }
    }

}
