<?php

namespace App\Http\Controllers;

use App\Http\Requests\EstampaPost;
use App\Models\Estampa;
use App\Models\Categoria;
use App\Models\Tshirt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Cliente;

class EstampaController extends Controller
{
    //
    public function index(Request $request){
        $selectedCategoria = $request->categoria ?? '';
        $selectedNomeEstampa = $request->nome ?? '';
        $user = Auth::user();
        $qry = Estampa::query();
        if ($selectedCategoria) {
            $qry->where('categoria_id', $selectedCategoria);
        }
        if($selectedNomeEstampa){
            $qry->where('nome', $selectedNomeEstampa);
        }
        $todasEstampas = $qry->paginate(10);
        $lista_Categorias = Categoria::pluck('nome','id');
        $newTshirt = new Tshirt();
        return view('estampas.index',
        compact('todasEstampas',
                'selectedCategoria',
                'lista_Categorias',
                'selectedNomeEstampa',
                'user',
                'newTshirt'));
    }

    public function index_clientes(Request $request,$id){
        $selectedCategoria = $request->categoria ?? '';
        $selectedNomeEstampa = $request->nome ?? '';
        $user = Auth::user();
        $qry = Estampa::query();
        if ($selectedCategoria) {
            $qry->where('categoria_id', $selectedCategoria);
        }
        if($selectedNomeEstampa){
            $qry->where('nome', $selectedNomeEstampa);
        }
        $todasEstampas = $qry->where('cliente_id', $id)->paginate(10);
        $lista_Categorias = Categoria::pluck('nome','id');
        return view('estampas.index_clientes',
        compact('selectedCategoria',
                'selectedNomeEstampa',
                'todasEstampas',
                'lista_Categorias',
                'user'));
    }

    public function create(){
        $newEstampa = new Estampa();
        $lista_categorias = Categoria::all();
        return view('estampas.create',compact('newEstampa','lista_categorias'));

    }

    public function store(EstampaPost $request){
        $dados = $request->validated();
        $dados['cliente_id'] = Auth::user()->id;
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
            // $th ?? a exce????o lan??ada pelo sistema - por norma, erro ocorre no servidor BD MySQL
            // Descomentar a pr??xima linha para verificar qual a informa????o que a exce????o tem
            //dd($th, $th->errorInfo);

            if ($th->errorInfo[1] == 1451) {   // 1451 - MySQL Error number for "Cannot delete or update a parent row: a foreign key constraint fails (%s)"
                return redirect()->route('estampas.index')
                    ->with('alert-msg', 'N??o foi poss??vel apagar a Estampa "' . $oldName . '", porque esta estampa j?? est?? em uso!')
                    ->with('alert-type', 'danger');
            } else {
                return redirect()->route('estampas.index')
                    ->with('alert-msg', 'N??o foi poss??vel apagar a Estampa "' . $oldName . '". Erro: ' . $th->errorInfo[2])
                    ->with('alert-type', 'danger');
            }
        }
    }


}
