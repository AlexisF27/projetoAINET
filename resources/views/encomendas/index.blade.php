
@extends('layout')
@section('content')
<div class="row">
    <form method="GET" action="{{route('encomendas.index')}}" class="form-group">
        <div class="input-group">
            <select class="custom-select" name="estado" id="inputEstado" aria-label="Estado">
                <option value="" {{ '' == old('estado', $selectedEstado) ? 'selected' : ''}}>Estados</option>

                @foreach ($lista_estados as $id)
                    <option value={{$id}} {{$id == old('estado', $selectedEstado) ? 'selected' : '' }} > {{$id}} </option>
                @endforeach
            </select>
            {{-- <div class="input-group">
                <input type="text" name="nome" class="form-control" value="{{old('nome', $selectedNomeEstampa)}}" id="inputNomeEstampa" aria-label="Estampa" placeholder="Nome Estampa">
            </div> --}}
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
            <th>Mudar Estado</th>
            <th>Detalhes</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($todasEncomendas as $encomenda)
    <tr>
        <td>{{ $encomenda->id }} </td>
        <td>{{ $encomenda->estado }} </td>
        <td>{{ $encomenda->data }} </td>
        <td>{{ $encomenda->preco_total }} </td>

        <td>
            <form action="{{route('encomendas.update', ['encomenda' => $encomenda->id])}}" method="POST">
                @csrf
                @method('put')
                <input type="hidden" name="estado" >
                <input class="btn btn-warning" type="submit" value="Mudar">
            </form>
      </td>
        <td>
            <a href="{{route('encomendas.index_funcionario', ['encomenda' => $encomenda->id])}}"
                class="btn btn-primary btn-sm" role="button" aria-pressed="true">Ver Detalhes</a>
        </td>
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

