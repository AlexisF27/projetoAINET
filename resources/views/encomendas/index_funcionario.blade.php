@extends('layout')
@section('content')


<div class="form-group">
    <label for="inputEstado">Estado</label>
    <input type="text" class="form-control" name="estado" id="inputEstado" value="{{$encomenda->estado}}" readonly />
</div>

<div class="form-group">
    <label for="inputClienteNome">Cliente Nome</label>
    <input type="text" class="form-control" name="clienteNome" id="inputClienteNome" value="{{$encomenda->clienteRef->user->name}}" readonly />
</div>

<div class="form-group">
    <label for="inputClienteEmail">Cliente Email</label>
    <input type="text" class="form-control" name="clienteEmail" id="inputClienteEmail" value="{{$encomenda->clienteRef->user->email}}" readonly />
</div>

<div class="form-group">
    <label for="inputData">Encomenda Data</label>
    <input type="text" class="form-control" name="Data" id="inputData" value="{{$encomenda->data}}" readonly />
</div>

<div class="form-group">
    <label for="inputPrecoTotal">Encomenda Preco Total</label>
    <input type="text" class="form-control" name="preco_total" id="inputPrecoTotal" value="{{$encomenda->preco_total}}" readonly />
</div>

<div class="form-group">
    <label for="inputNotas">Notas da Encomenda</label>
    <input type="text" class="form-control" name="notas" id="inputNotas" value="{{$encomenda->notas}}" readonly />
</div>

<div class="form-group">
    <label for="inputNif"> Cliente Nif</label>
    <input type="text" class="form-control" name="nif" id="inputNif" value="{{$encomenda->nif}}" readonly />
</div>

<div class="form-group">
    <label for="inputTipoPagamento"> Encomenda Tipo Pagamento</label>
    <input type="text" class="form-control" name="tipo_pagamento" id="inputTipoPagamento" value="{{$encomenda->tipo_pagamento}}" readonly />
</div>

<div class="form-group">
    <label for="inputRefPagamento"> Encomenda Referencia Pagamento</label>
    <input type="text" class="form-control" name="ref_pagamento" id="inputRefPagamento" value="{{$encomenda->ref_pagamento}}" readonly />
</div>

<div class="form-group text-right">
    <a href="{{route('encomendas.index')}}" class="btn btn-secondary">Voltar</a>
</div>






@endsection
