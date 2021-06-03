@extends('layout')
@section('content')


<div class="row">

    <div class="col-3">
        <a href="{{route('estampas.create')}}" class="btn btn-success" role="button" aria-pressed="true">Nova Disciplina</a>
    </div>

    <form method="GET" action="{{route('estampas.index')}}" class="form-group">
        <div class="input-group">
            <select class="custom-select" name="categoria" id="inputCategoria" aria-label="Categoria">
                <option value="" {{ '' == old('categoria_id', $selectedCategoria) ? 'selected' : ''}}>Todas as Categorias</option>

                @foreach ($lista_Categorias as $id => $nome)
                    <option value={{$id}} {{$id == old('categoria_id', $selectedCategoria) ? 'selected' : '' }} > {{$nome}} </option>
                @endforeach
            </select>
            <div class="input-group">
                <input type="text" name="nome" class="form-control" value="{{old('nome', $selectedNomeEstampa)}}" id="inputNomeEstampa" aria-label="Estampa" placeholder="Nome Estampa">
            </div>
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="submit">Filtrar</button>
            </div>
        </div>
  </form>
</div>



<div class="row">
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
                <td>{{$estampa->categoriaRef->nome ?? ''}}</td>
                <td>
                    <a href="{{route('estampas.edit', ['estampa' => $estampa])}}"
                        class="btn btn-primary btn-sm" role="button" aria-pressed="true">Alterar</a>
                </td>
                <td>
                    <form action="{{route('estampas.destroy', ['estampa' => $estampa])}}" method="POST">
                        @csrf
                        @method("DELETE")
                        <input type="submit" class="btn btn-danger btn-sm" value="Apagar">
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
</div>

<div class="row">
    <div class="col">
        {{$todasEstampas->withQueryString()->links()}}
    </div>
</div>

@endsection
