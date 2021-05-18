@extends('layout')
@section('content')

<table class="table table-striped table-bordered">
    <thead class="thead-dark">
        <tr>
            <th>ID</th>
            <th>NIF</th>
            <th>Endereco</th>
            <th>Tipo Pagamento</th>
            <th>Ref Pagamento</th>
            <th></th>
            <th></th>


        </tr>
    </thead>
    <tbody>
        @foreach ($todosClientes as $clientes)
            <tr>
                <td>{{$clientes->user->id}}</td>
                <td>{{$clientes->nif}}</td>
                <td>{{$clientes->endereco}}</td>
                <td>{{$clientes->tipo_pagamento}}</td>
                <td>{{$clientes->ref_pagamento}}</td>
                <td>
                    <a href=""
                       class="btn btn-primary btn-sm" role="button" aria-pressed="true">Alterar</a>
                </td>
                <td>
                    <form action="#" method="POST">
                        @csrf
                        @method("DELETE")
                        <input type="submit" class="btn btn-danger btn-sm" value="Apagar">
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection
