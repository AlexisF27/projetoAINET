<?php

namespace App\Http\Controllers;

use App\Models\Estampa;
use App\Models\Categoria;
use Illuminate\Http\Request;

class EstampaController extends Controller
{
    //
    public function index(Request $request){
        $selectedCategoria = $request->categoria ?? '';
        $selectedNomeEstampa = $request->nome ?? '';
        $qry = Estampa::query();
        if ($selectedCategoria) {
            $qry->where('categoria_id', $selectedCategoria);
        }
        if($selectedNomeEstampa){
            $qry->where('nome', $selectedNomeEstampa);
        }
        $todasEstampas = $qry->paginate(10);
        $lista_Categorias = Categoria::pluck('nome','id');
        return view('estampas.index', compact('todasEstampas','selectedCategoria','lista_Categorias','selectedNomeEstampa'));
    }

    public function create(){
        $newEstampa = new Estampa();
        $lista_categorias = Categoria::all();
        return view('estampas.create',compact('newEstampa','lista_categorias'));

    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'nome' => 'required|max:255',
            'descricao' => 'required|max:255',
            'imagem_url' => 'required'
        ],[
            'nome.required' => 'É obrigatorio colocar nome',
            'imagem_url.required' => 'É obrigatorio colocar uma imagem'
        ]);
        $newEstampa = Estampa::create($validatedData);
        return redirect()->route('estampas.index')
            ->with('alert-msg', 'Estampa "' . $newEstampa->nome . '" foi criada com sucesso!')
            ->with('alert-type', 'success');
    }

    public function update(Request $request, Estampa $estampa)
    {
        $estampa->fill($request->validated());
        $estampa->save();
        return redirect()->route('estampas.index')
            ->with('alert-msg', 'Estampa "' . $estampa->nome . '" foi alterada com sucesso!')
            ->with('alert-type', 'success');
    }

    public function edit(Estampa $estampa){
        $lista_categorias = Categoria::all();
        return view('estampas.edit', compact('estampa','lista_categorias'));
    }

    public function destroy(Estampa $estampa)
    {
        $oldName = $estampa->nome;
        try {
            $estampa->delete();
            return redirect()->route('estampas.index')
                ->with('alert-msg', 'Estampa "' . $estampa->nome . '" foi apagada com sucesso!')
                ->with('alert-type', 'success');
        } catch (\Throwable $th) {
            // $th é a exceção lançada pelo sistema - por norma, erro ocorre no servidor BD MySQL
            // Descomentar a próxima linha para verificar qual a informação que a exceção tem
            //dd($th, $th->errorInfo);

            if ($th->errorInfo[1] == 1451) {   // 1451 - MySQL Error number for "Cannot delete or update a parent row: a foreign key constraint fails (%s)"
                return redirect()->route('estampas.index')
                    ->with('alert-msg', 'Não foi possível apagar a Estampa "' . $oldName . '", porque esta disciplina já está em uso!')
                    ->with('alert-type', 'danger');
            } else {
                return redirect()->route('estampas.index')
                    ->with('alert-msg', 'Não foi possível apagar a Estampa "' . $oldName . '". Erro: ' . $th->errorInfo[2])
                    ->with('alert-type', 'danger');
            }
        }
    }


}
