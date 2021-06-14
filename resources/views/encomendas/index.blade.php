
@extends('layout')
@section('content')
<div class="row">


    <div class="col-3">
        @can('create', new App\Models\Encomenda)
        <a href="{{route('encomendas.create')}}" class="btn btn-success" role="button" aria-pressed="true">Nova Encomenda</a>
        @endcan
    </div>

    <form method="GET" action="{{route('encomendas.index')}}" class="form-group">
        <div class="input-group">
            <select class="custom-select" name="estado" id="inputEstado" aria-label="Estado">
                <option value="" {{ '' == old('estado', $selectedEstado) ? 'selected' : ''}}>Estados</option>

                @foreach ($lista_estados as $id)
                    <option value={{$id}} {{$id == old('estado', $selectedEstado) ? 'selected' : '' }} > {{$id}} </option>
                @endforeach
            </select>
            {{-- <div class="input-group">
                <input type="date" name="data"  value="{{old('data', $selectedData)}}" id="inputDAta" aria-label="Encomenda" >
            </div> --}}

            <div class="input-group">
                <select class="custom-select" name="cliente_id" id="inputCliente" aria-label="Cliente">
                    <option value="" {{ '' == old('cliente_id', $selectedCliente) ? 'selected' : ''}}>Cliente</option>

                    @foreach ($lista_Clientes as $id => $nome)
                        <option value={{$id}} {{$id == old('cliente_id', $selectedCliente) ? 'selected' : '' }} > {{$nome}} </option>
                    @endforeach
                </select>
            </div>
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="submit">Filtrar</button>
            </div>
        </div>
  </form>


</div>

<div class="row">
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Id da encomenda</th>
            <th>Estado</th>
            <th>Data</th>
            <th>Preço Total</th>
            @can('viewFuncionario', new App\Models\Encomenda)
            <th>Mudar Estado</th>
            @endcan
            <th>Detalhes</th>
            @can('view', new App\Models\Encomenda)
            <th></th>
            @endcan
            @can('delete', new App\Models\Encomenda)
            <th></th>
            @endcan
        </tr>
    </thead>
    <tbody>
    @foreach ($todasEncomendas as $encomenda)
    <tr>
        <td>{{ $encomenda->id }} </td>
        <td>{{ $encomenda->estado }} </td>
        <td>{{ $encomenda->data }} </td>
        <td>{{ $encomenda->preco_total }} </td>
            @can('viewFuncionario', $encomenda)
        <td>
            <form action="{{route('encomendas.update', ['encomenda' => $encomenda->id])}}" method="POST">
                @csrf
                @method('put')
                <input type="hidden" name="estado" >
                <input class="btn btn-warning" type="submit" value="Mudar">
            </form>
      </td>
      @endcan
        <td>
            <a href="{{route('encomendas.index_funcionario', ['encomenda' => $encomenda->id])}}"
                class="btn btn-primary btn-sm" role="button" aria-pressed="true">Ver Detalhes</a>
        </td>
        @can('viewFuncionario', $encomenda)
        <td>
            <a href="{{route('encomendas.edit', ['encomenda' => $encomenda])}}"
                class="btn btn-primary btn-sm" role="button" aria-pressed="true">Alterar</a>
        </td>
        @endcan
        @can('delete', $encomenda)
        <td>
            <form action="{{route('encomendas.destroy', ['encomenda' => $encomenda])}}" method="POST">
                @csrf
                @method("DELETE")
                <input type="submit" class="btn btn-danger btn-sm" value="Apagar">
            </form>
        </td>
        @endcan

    </tr>
    @endforeach
    </tbody>
</table>
</div>

<div class="row">
    <div class="col">
        {{$todasEncomendas->withQueryString()->links()}}
    </div>
</div>


@endsection

