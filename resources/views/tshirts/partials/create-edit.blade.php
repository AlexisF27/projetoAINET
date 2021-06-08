
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
    <label for="inputCor_tamanho">Tamanho</label>
    <select class="form-control" name="tamanho" id="inputTamanho">
        @foreach ($tamanhos as $tamanho)
          <option value="{{$tamanho}}" {{ old('tamanho', $newTshirt->tamanho) ? 'selected' : ''}}>{{$tamanho}}</option>
        @endforeach
    </select>
      @error('cor')
          <div class="small text-danger">{{$message}}</div>
      @enderror
</div>

<div class="item-form">
    <label for="quantidades">Quantidade</label>
    <input type="text" name="quantidade" id="quantidade" class="form-control" value="{{old('quantidade')}}">
    @error('quantidade')
        <div class="error">{{ $message }}</div>
    @enderror
</div>


