@extends('layout')
@section('content')


<div>
  <p>
        <form action="{{ route('carrinho.destroy') }}" method="POST">
            @csrf
            @method("DELETE")
            <input class="btn btn-primary btn-sm" type="submit" value="Apagar carrinho">
        </form>
  </p>
  <p>
        <form action="{{ route('carrinho.store') }}" method="POST">
            @csrf
            <input class="btn btn-primary btn-sm" type="submit" value="Confirmar carrinho">
        </form>
  </p>
</div>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Quantidade</th>
            <th>Estampa</th>
            <th>Cor</th>
            <th>Tamanho</th>
            <th>Preço Singular</th>
            <th>Sub Total</th>
            <th>Editar Tshirt</th>
            <th>Incrementar</th>
            <th>Decrementar</th>
            <th>Remover</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($carrinho as $row)
    <tr>
        {{-- form updateLinhaCarrinho
        input id Session --}}
        <td> {{ $row['quantidade'] }} </td>
        <td>
            <div class="estampa-imagem">
                <img src="{{ $row['estampa']  ?
                            asset('storage/estampas/' . $row['estampa'] ) :
                            asset('storage/fotos/default.png') }}" alt="Imagem da Estampa" width="42" style="horizontal-align:middle">
            </div>
        </td>
        {{-- select  --}}
        <td>{{ $row['cor'] }} </td>
        <td>{{ $row['tamanho'] }} </td>
        <td>{{ $row['preco_un'] }} </td>
        <td>{{ $row['subtotal'] }} </td>
        <td>
            {{-- button submit --}}
            {{-- <a href="{{route('carrinho.editar_t_shirt',$row['estampa_all'], $row['tshirt_all'] )}}"
                class="btn btn-primary btn-sm" role="button" aria-pressed="true">Alterar</a> --}}
        </td>
        <td>
            <form action="{{route('carrinho.update_t_shirt', $row['estampa_all'], $row['tshirt_all'])}}" method="POST">
                @csrf
                @method('put')
                <input type="hidden" name="quantidade" value="1">
                <input class="btn btn-primary btn-sm" role="button" type="submit" value="Incrementar">
            </form>
        </td>
        <td>
            <form action="{{route('carrinho.update_t_shirt', $row['estampa_all'], $row['tshirt_all'])}}" method="POST">
                @csrf
                @method('put')
                <input type="hidden" name="quantidade" value="-1">
                <input class="btn btn-primary btn-sm" role="button" type="submit" value="Decrementar">
            </form>
        </td>
        <td>
            <form action="{{route('carrinho.destroy_t_shirt', $row['estampa_all'])}}" method="POST">
                @csrf
                @method('delete')
                <input type="submit" class="btn btn-danger btn-sm" type="submit" value="Remover">
            </form>

        </td>
    </tr>
    @endforeach
    </tbody>
</table>

@endsection
