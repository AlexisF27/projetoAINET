@extends('layout')
@section('content')


<div class="row">

    <div class="col-3">
        @can('create', new App\Models\Estampa)
        <a href="{{route('estampas.create')}}" class="btn btn-success" role="button" aria-pressed="true">Nova Estampa</a>
        @endcan
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

  <div class="col-3">
        <a href="{{route('estampas.index_clientes')}}" class="btn btn-success" role="button" aria-pressed="true">Mis Estampas</a>
</div>
</div>



<div class="row">
<table class="table table-striped table-bordered">
    <thead class="thead-dark">
        <tr>
            <th>Imagem</th>
            <th>Nome</th>
            <th>Descricao</th>
            <th>Categoria</th>
            <th>Adicinoar</th>
            @can('view', new App\Models\Estampa)
            <th></th>
            @endcan
            @can('delete', new App\Models\Estampa)
            <th></th>
            @endcan


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
                <td>{{$estampa->categoriaRef->nome ?? ''}}</td>
                <td>
                <form action="{{route('carrinho.store_t_shirt',$estampa)}}" method="POST">
                    @csrf
                    <input class="btn btn-success" type="submit" value="Adicionar">
                </form>
                </td>
                @can('view', $estampa)
                <td>
                    <a href="{{route('estampas.edit', ['estampa' => $estampa])}}"
                        class="btn btn-primary btn-sm" role="button" aria-pressed="true">Alterar</a>
                </td>
                @endcan
                @can('delete', $estampa)
                <td>
                    <form action="{{route('estampas.destroy', ['estampa' => $estampa])}}" method="POST">
                        @csrf
                        @method("DELETE")
                        <input type="submit" class="btn btn-danger btn-sm" value="Apagar">
                    </form>
                </td>
                @endcan
            </tr>
        @endforeach
        </div>
    </tbody>
</table>
</div>

<div class="row">
    <div class="col">
        {{$todasEstampas->withQueryString()->links()}}
    </div>
</div>

@endsection
