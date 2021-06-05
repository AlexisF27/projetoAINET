<div class="form-group">
    <label for="inputCor_codigo">Cor</label>
    <select class="form-control" name="cor_codigo" id="inputCor_codigo">
        @foreach ($lista_cores as $cor)
          <option value="{{$cor->id}}" {{ old('cor', $newTshirt->cor_codigo) == $cor->codigo ? 'selected' : ''}}>{{$cor->nome}}</option>
        @endforeach
    </select>
      @error('cor')
          <div class="small text-danger">{{$message}}</div>
      @enderror
</div>

<div class="form-group">
    <label for="inputCor_codigo">Cor</label>
    <input type="text" class="form-control" name="cor_codigo" id="inputCor_codigo" value="{{old('cor_codigo', $newTshirt->coresRef->nome)}}" />
      @error('nome')
          <div class="small text-danger">{{$message}}</div>
      @enderror
</div>

<div class="form-group">
    <label for="inputNome">Descrição</label>
    <textarea rows="5" type="text" class="form-control" name="descricao" id="textAreaDescricao" value="{{old('nome', $newEstampa->descricao)}}">
    </textarea>
      @error('descricao')
          <div class="small text-danger">{{$message}}</div>
      @enderror
</div>


