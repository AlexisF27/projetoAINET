<?php

namespace App\Http\Controllers;

use App\Models\Estampa;
use App\Models\Tshirt;
use Illuminate\Http\Request;

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
        $quantidade = ($carrinho[$estampa->id]['quantidade'] ?? 0) + 1;
        $tshirt = Tshirt::create([
            'encomenda_id' => null,
            'estampa_id' => $estampa->id,
            'cor_codigo' => '',
            'tamanho' => '',
            'quantidade' => $carrinho[$estampa->id]['quantidade'],
            'preco_un' => 10.0,
            'sub_total' => 10.0
        ]);
        $carrinho[$estampa->id] = [
            'id' => $carrinho[$estampa->id],
            'id_tshirt' => $tshirt->id,
            'quantidade' => $quantidade,
            'estampa' => $estampa->imagem_url,
            'cor' => $tshirt->coresRef->nome ?? '',
            'tamanho' => $tshirt->tamanho,
            'preco_un' => $tshirt->preco_un,
            'subtotal' => $tshirt->subtotal,
        ];
        $request->session()->put('carrinho', $carrinho);
        return back()
            ->with('alert-msg', 'Foi adicionada uma t-shirt  com a estampa "' . $estampa->nome . '" ao carrinho! Quantidade de t-shirts = ' .  $quantidade)
            ->with('alert-type', 'success');
    }

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
                'estampa' => $tshirt->estampaRef->imagem_url,
                'cor' => $tshirt->coresRef->nome,
                'tamanho' => $tshirt->tamanho,
                'preco_un' => $tshirt->preco_un,
                'subtotal' => $tshirt->subtotal,
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
