@extends('layout')
@section('content')

<table class="table table-striped table-bordered">
    <thead class="thead-dark">
        <tr>
            <th>Imagem</th>
            <th>Nome</th>
            <th>Descricao</th>
            <th>Categoria</th>
            <th></th>
            <th></th>


        </tr>
    </thead>
    <tbody>
    <div class="docentes-area">
        @foreach ($todasEstampas as $estampa)
            <tr>
                <td>
                    <div class="estampa-imagem">
                        <img src="{{$estampa->imagem_url ?
                                    asset('storage/estampas/' . $estampa->imagem_url) :
                                    asset('storage/fotos/default.png') }}" alt="Imagem da Estampa" width="42" style="horizontal-align:middle">
                    </div>
                </td>
                <td>{{$estampa->nome}}</td>
                <td>{{$estampa->descricao}}</td>
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
        </div>
    </tbody>
</table>

@endsection
