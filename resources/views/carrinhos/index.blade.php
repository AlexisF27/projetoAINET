@extends('layout')
@section('content')


<div>
  <p>
        <form action="{{ route('carrinho.destroy') }}" method="POST">
            @csrf
            @method("DELETE")
            <input type="submit" value="Apagar carrinho">
        </form>
  </p>
  <p>
        <form action="{{ route('carrinho.store') }}" method="POST">
            @csrf
            <input type="submit" value="Confirmar carrinho">
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
            <th></th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
    @foreach ($carrinho as $row)
    <tr>
        <td>{{ $row['quantidade'] }} </td>
        <td>{{ $row['estampa'] }} </td>
        <td>{{ $row['cor'] }} </td>
        <td>{{ $row['tamanho'] }} </td>
        <td>{{ $row['preco_un'] }} </td>
        <td>{{ $row['subtotal'] }} </td>
        <td>
            <form action="{{route('carrinho.update_t_shirt', $row['id'])}}" method="POST">
                @csrf
                @method('put')
                <input type="hidden" name="quantidade" value="1">
                <input type="submit" value="Incrementar">
            </form>
        </td>
        <td>
            <form action="{{route('carrinho.update_t_shirt', $row['id'])}}" method="POST">
                @csrf
                @method('put')
                <input type="hidden" name="quantidade" value="-1">
                <input type="submit" value="Decrementar">
            </form>
        </td>
        <td>
            <form action="{{route('carrinho.destroy_t_shirt', $row['id'])}}" method="POST">
                @csrf
                @method('delete')
                <input type="submit" value="Remover">
            </form>

        </td>
    </tr>
    @endforeach
    </tbody>
</table>

@endsection
