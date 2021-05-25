@extends('layout')
@section('content')

<table class="table table-striped table-bordered">
    <thead class="thead-dark">
        <tr>
            <th>ID Encomenda</th>
            <th>Estado</th>
            <th>Data</th>
            <th>Preço Total</th>
            <th>Notas</th>
            <th></th><th></th><th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($todasEncomendas as $encomenda)
        <tr>
            <td>{{$encomenda->id}}</td>
            <td>{{$encomenda->estado}}</td>
            <td>{{$encomenda->data}}</td>
            <td>{{$encomenda->preco_total}}</td>
            <td>{{$encomenda->notas}}</td>
            <td>
                <a href="" class="btn btn-success btn-sm" role="button" aria-pressed="true">Fechar</a>
            </td>
            
            <td>
                <a href="" class="btn btn-primary btn-sm" role="button" aria-pressed="true">Paga</a>
            </td>
            <td>
                <form action="#" method="POST">
                    @csrf
                    @method("DELETE")
                    <input type="submit" class="btn btn-danger btn-sm" value="Anular">
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{$todasEncomendas->links()}}
@endsection