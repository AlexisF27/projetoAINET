<?php

namespace App\Http\Controllers;

use App\Http\Requests\EstampaPost;
use App\Models\Estampa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

    public function store(EstampaPost $request){
        $dados = $request->validated();
        dd($dados);
        if($request->file('imagem_url')->isValid()){
            $dados['imagem_url'] = Storage::putFile('public/estampas', $request->file('imagem_url'));
            $dados['imagem_url'] = str_replace('public/estampas/', '', $dados['imagem_url']);
        }
        $newEstampa = Estampa::create($dados);
        return redirect()->route('estampas.index')
            ->with('alert-msg', 'Estampa "' . $newEstampa->nome . '" foi criada com sucesso!')
            ->with('alert-type', 'success');
    }

    public function edit(Estampa $estampa){
        $lista_categorias = Categoria::all();
        return view('estampas.edit',compact('lista_categorias'))->withNewEstampa($estampa);
    }

    public function update(EstampaPost $request, Estampa $estampa)
    {
        $dados = $request->validated();
        if($request->file('imagem_url')->isValid()){
            $dados['imagem_url'] = Storage::putFile('public/estampas', $request->file('imagem_url'));
            $dados['imagem_url'] = str_replace('public/estampas/', '' , $dados['imagem_url']);
        }
        $estampa->fill($dados);
        $estampa->save();
        return redirect()->route('estampas.index')
            ->with('alert-msg', 'Estampa "' . $estampa->nome . '" foi alterada com sucesso!')
            ->with('alert-type', 'success');
    }


    public function destroy(Estampa $estampa)
    {
        $oldName = $estampa->nome;
        try {
            $estampa->delete();
            Storage::delete(['imagem_url']);
            return redirect()->route('estampas.index')
                ->with('alert-msg', 'Estampa "' . $estampa->nome . '" foi apagada com sucesso!')
                ->with('alert-type', 'success');
        } catch (\Throwable $th) {
            // $th é a exceção lançada pelo sistema - por norma, erro ocorre no servidor BD MySQL
            // Descomentar a próxima linha para verificar qual a informação que a exceção tem
            //dd($th, $th->errorInfo);

            if ($th->errorInfo[1] == 1451) {   // 1451 - MySQL Error number for "Cannot delete or update a parent row: a foreign key constraint fails (%s)"
                return redirect()->route('estampas.index')
                    ->with('alert-msg', 'Não foi possível apagar a Estampa "' . $oldName . '", porque esta estampa já está em uso!')
                    ->with('alert-type', 'danger');
            } else {
                return redirect()->route('estampas.index')
                    ->with('alert-msg', 'Não foi possível apagar a Estampa "' . $oldName . '". Erro: ' . $th->errorInfo[2])
                    ->with('alert-type', 'danger');
            }
        }
    }


}
