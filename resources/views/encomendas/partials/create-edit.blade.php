
<div class="form-group">
    <label for="inputEstado">Estado</label>
    <select class="form-control" name="estado" id="inputEstado">
        <option {{old('estado',$newEncomenda->estado) == 'pendente' ? 'selected' : ''}}>Pendente</option>
        <option {{old('estado',$newEncomenda->estado) == 'paga' ? 'selected' : ''}}>Paga</option>
        <option {{old('estado',$newEncomenda->estado) == 'fechada' ? 'selected' : ''}}>Fechada</option>
        <option {{old('estado',$newEncomenda->estado) == 'anulada' ? 'selected' : ''}}>Anulada</option>
    </select>
    @error('tipo')
        <div class="small text-danger">{{$message}}</div>
    @enderror
</div>

<div class="form-group">
    <label for="inputClienteNome">Cliente Nome</label>
    <input type="text" class="form-control" name="clienteNome" id="inputClienteNome" value="{{old('clienteNome',$newEncomenda->clienteRef->user->name)}}"/>
    @error('clienteNome')
        <div class="error">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="inputClienteEmail">Cliente Email</label>
    <input type="text" class="form-control" name="clienteEmail" id="inputClienteEmail" value="{{old('clienteEmail',$newEncomenda->clienteRef->user->email)}}"/>
    @error('clienteEmail')
        <div class="error">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="inputData">Encomenda Data</label>
    <input type="text" class="form-control" name="data" id="inputData" value="{{old('data',$newEncomenda->data)}}"/>
    @error('data')
        <div class="error">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="inputPrecoTotal">Encomenda Preco Total</label>
    <input type="text" class="form-control" name="preco_total" id="inputPrecoTotal" value="{{old('preco_total',$newEncomenda->preco_total)}}"/>
    @error('preco_total')
        <div class="error">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="inputNif"> Cliente Nif</label>
    <input type="text" class="form-control" name="nif" id="inputNif" value="{{old('nif',$newEncomenda->nif)}}"/>
    @error('nif')
        <div class="error">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="inputTipoPagamento"> Encomenda Tipo Pagamento</label>
    <select class="form-control" name="tipo_pagamento" id="inputTipoPagamento">
        <option {{old('tipo_pagamento',$newEncomenda->tipo_pagamento) == 'VISA' ? 'selected' : ''}}>VISA</option>
        <option {{old('tipo_pagamento',$newEncomenda->tipo_pagamento) == 'MC' ? 'selected' : ''}}>MC</option>
        <option {{old('tipo_pagamento',$newEncomenda->tipo_pagamento) == 'PAYPAL' ? 'selected' : ''}}>PAYPAL</option>
     </select>
    @error('tipo_pagamento')
        <div class="small text-danger">{{$message}}</div>
    @enderror
</div>


<div class="form-group">
    <label for="inputRefPagamento"> Encomenda Referencia Pagamento</label>
    <input type="text" class="form-control" name="ref_pagamento" id="inputRefPagamento" value="{{old('ref_pagamento',$newEncomenda->ref_pagamento)}}"/>
    @error('ref_pagamento')
        <div class="error">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="inputNotas">Notas da Encomenda</label>
    <textarea class="form-control" name="notas" id="inputNotas" rows=10>{{old('notas', $newEncomenda->notas)}}</textarea>
    @error('notas')
        <div class="error">{{ $message }}</div>
    @enderror
</div>

