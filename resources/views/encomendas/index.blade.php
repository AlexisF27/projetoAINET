
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
            <th>NIF</th>
            <th>Endereço</th>
            <th>Tipo Pagamento</th>
            <th>Referencia Pagamento</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
    @foreach ($todasEncomendas as $encomenda)
    <tr>
        <td>{{ $encomenda->id }} </td>
        <td>{{ $encomenda->estado }} </td>
        <td>{{ $encomenda->data }} </td>
        <td>{{ $encomenda->preco_total }} </td>
        <td>{{ $encomenda->nif }} </td>
        <td>{{ $encomenda->endereco }} </td>
        <td>{{ $encomenda->tipo_pagamento }} </td>
        <td>{{ $encomenda->ref_pagamento }} </td>
        <td>

        </td>
        <td>

        </td>
        <td>

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

