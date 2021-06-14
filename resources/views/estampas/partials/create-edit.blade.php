<div class="form-group">
    <label for="inputNome">Nome</label>
    <input type="text" class="form-control" name="nome" id="inputNome" value="{{old('nome', $newEstampa->nome)}}" />
      @error('nome')
          <div class="small text-danger">{{$message}}</div>
      @enderror
</div>

<div class="form-group">
    <label for="inputNome">Descrição</label>
    <textarea rows="5" type="text" class="form-control" name="descricao" id="textAreaDescricao" value="{{old('descricao', $newEstampa->descricao)}}">
    </textarea>
      @error('descricao')
          <div class="small text-danger">{{$message}}</div>
      @enderror
</div>

<div class="form-group">
    <label for="inputCategoria">Categoria</label>
    <select class="form-control" name="categoria_id" id="inputCategoria">
        @foreach ($lista_categorias as $categoria)
          <option value="{{$categoria->id}}" {{ old('categoria', $newEstampa->categoria_id) == $categoria->id ? 'selected' : ''}}>{{$categoria->nome}}</option>
        @endforeach
    </select>
      @error('categoria')
          <div class="small text-danger">{{$message}}</div>
      @enderror
</div>

<div>
        <input type="file" name="imagem_url">
</div>
