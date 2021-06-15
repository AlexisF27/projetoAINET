<?php

namespace App\Http\Controllers;

use App\Http\Requests\TshirtPost;
use App\Models\Cores;
use App\Models\Encomenda;
use App\Models\Estampa;
use App\Models\Tshirt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Validation\ValidatesRequests;


class CarrinhoController extends Controller
{
    //
    public function index(Request $request)
    {
        return view('carrinhos.index')
            ->with('pageTitle', 'Carrinho de compras')
            ->with('carrinho', session('carrinho') ?? []);
    }

    public function store_t_shirt(Request $request, Estampa $estampa)
    {
        $carrinho = $request->session()->get('carrinho', []);
        $user = Auth::user();
        $encomenda = new Encomenda();
        $encomenda->id = Encomenda::all()->last()['id'] +1;
        $encomenda->cliente_id = $user->id;
        $encomenda->data = date("Y-m-d");
        $encomenda->preco_total = 10.0;
        $encomenda->notas = "";
        $encomenda->nif = $user->nif;
        $encomenda->tipo_pagamento = $user->tipo_pagamento;
        $encomenda->ref_pagamento = $user->tipo_pagamento;
        $tshirt = new Tshirt();
        $tshirt->id = Tshirt::all()->last()['id'] + 1;
        $tshirt->encomenda_id = $encomenda->id;
        $tshirt->estampa_id = $estampa->id;
        $tshirt->cor_codigo = '00a2f2';
        $tshirt->tamanho = 'M';
        $tshirt->quantidade = 1;
        $tshirt->preco_un = 10.0;
        $tshirt->subtotal = 10.0;
        $quantidade = ($carrinho[$estampa->id]['quantidade'] ?? 0) + 1;
         $carrinho[$estampa->id] = [
             'id' => $tshirt->id,
             'quantidade' => $quantidade,
             'estampa_id' => $estampa->id,
             'estampa' => $estampa->imagem_url,
             'cor' => $tshirt->coresRef->nome ?? '',
             'tamanho' => $tshirt->tamanho,
             'tshirt_all' => $tshirt,
             'estampa_all' => $estampa,
             'encomenda' => $encomenda,
             'preco_un' => $tshirt->preco_un,
             'subtotal' => $tshirt->subtotal * $quantidade,
         ];

         $request->session()->put('carrinho', $carrinho);
         return back()
             ->with('alert-msg', 'Foi adicionada uma t-shirt  com a estampa "' . $estampa->nome . '" ao carrinho! Quantidade de t-shirts = ' .  $quantidade)
             ->with('alert-type', 'success');
    }
//--Prueba
    public function editar_t_shirt(Request $request, Estampa $estampa, Tshirt $tshirt){
        $carrinho = $request->session()->get('carrinho', []);
        $tshirt = $carrinho[$estampa->id]['tshirt_all'];
        $tamanhos = array( 'XS', 'S', 'M', 'L', 'XL');
        $lista_cores= Cores::all();
        return view('tshirts.edit',compact('lista_cores','tamanhos'))->withTshirt($tshirt)->withEstampa($estampa);
    }

    public function update(TshirtPost $request, Estampa $estampa, Tshirt $tshirt){
        $carrinho = $request->session()->get('carrinho', []);
        $tshirt = $carrinho[$estampa->id]['tshirt_all'];
        $tshirt->fill($request->validated());
        return redirect()->route('carrinhos.index')
        ->with('alert-msg', 'Tshirt "' . $tshirt->id . '" foi alterada com sucesso!')
        ->with('alert-type', 'success');
    }
 //--Prueba

    public function update_t_shirt(Request $request, Estampa $estampa, Tshirt $tshirt)
    {
        $carrinho = $request->session()->get('carrinho', []);
        $quantidade = $carrinho[$estampa->id]['quantidade'] ?? 0;
        $quantidade += $request->quantidade;
        if ($request->quantidade < 0) {
            $msg = 'Foram removidas ' . -$request->quantidade . ' tshirts com a estampa "' . $estampa->nome . '"! Quantidade de tshirts atuais = ' .  $quantidade;
        } elseif ($request->quantidade > 0) {
            $msg = 'Foram adicionadas ' . $request->quantidade . ' tshirts com a estampa "' . $estampa->nome . '"! Quantidade de tshirts atuais = ' .  $quantidade;
        }
        if ($quantidade <= 0) {
            unset($carrinho[$estampa->id]);
            $msg = 'Foram removidas todas as thirts com a estampa "' . $estampa->nome . '"';
        } else {
            $carrinho[$estampa->id] = [
                'id' => $tshirt->id,
                'quantidade' => $quantidade,
                'estampa_id' => $estampa->id,
                'estampa' => $estampa->imagem_url,
                'cor' => $carrinho[$estampa->id]['cor'],
                'tshirt_all' => $carrinho[$estampa->id]['tshirt_all'],
                'estampa_all' => $carrinho[$estampa->id]['estampa_all'],
                'tamanho' => $carrinho[$estampa->id]['tamanho'],
                'preco_un' => $carrinho[$estampa->id]['preco_un'],
                'subtotal' => $carrinho[$estampa->id]['preco_un'] * $quantidade,
            ];
        }
        $request->session()->put('carrinho', $carrinho);
        return back()
            ->with('alert-msg', $msg)
            ->with('alert-type', 'success');
    }

    public function destroy_t_shirt(Request $request, Estampa $estampa)
    {
        $carrinho = $request->session()->get('carrinho', []);
        if (array_key_exists($estampa->id, $carrinho)) {
            unset($carrinho[$estampa->id]);
            $request->session()->put('carrinho', $carrinho);
            return back()
                ->with('alert-msg', 'Foram removidas todas as thirts com a estampa "' . $estampa->nome . '"')
                ->with('alert-type', 'success');
        }
        return back()
            ->with('alert-msg', 'A tshirt com a estampa "' . $estampa->nome . '" já não tem tshirts no carrinho!')
            ->with('alert-type', 'warning');
    }

    public function destroy(Request $request)
    {
        $request->session()->forget('carrinho');
        return back()
            ->with('alert-msg', 'Carrinho foi limpo!')
            ->with('alert-type', 'danger');
    }

}
