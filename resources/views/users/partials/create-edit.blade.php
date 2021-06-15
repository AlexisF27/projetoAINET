<div class="form-group">
    <label for="inputUserNome">Nome Usuario</label>
    <input type="text" class="form-control" name="userNome" id="inputUserNome" value="{{old('userNome',$newUser->name)}}"/>
    @error('userNome')
        <div class="error">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="inputUserEmail">Usuario Email</label>
    <input type="text" class="form-control" name="userEmail" id="inputUserEmail" value="{{old('userEmail',$newUser->email)}}"/>
    @error('userEmail')
        <div class="error">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="inputUserPassword">Usuario Password</label>
    <input type="text" class="form-control" name="userPassword" id="inputUserPassword" value="{{old('userPassword',$newUser->password)}}"/>
    @error('userPassword')
        <div class="error">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="inputTipo">Tipo</label>
    <select class="form-control" name="tipo" id="inputTipo">
        <option {{old('tipo',$newUser->tipo) == 'C' ? 'selected' : ''}}>Cliente</option>
        <option {{old('tipo',$newUser->tipo) == 'F' ? 'selected' : ''}}>Funcionario</option>
        <option {{old('tipo',$newUser->tipo) == 'A' ? 'selected' : ''}}>Administrador</option>
    </select>
    @error('tipo')
        <div class="small text-danger">{{$message}}</div>
    @enderror
</div>

<div class="item-form m23-item">
    <input type="hidden" name="bloqueado" value="0">
    <label for="idBloqueado">Bloqueado:</label>
    <input type="checkbox" name="bloqueado" id="idBloqueado" value="1" {{old('bloqueado')=='1'?'checked':''}}>
    @error('bloqueado')
        <div class="error">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="inputFotoURL">Foto URL</label>
    <input type="text" class="form-control" name="foto_url" id="inputFotoURL" value="{{old('foto_url',$newUser->foto_url)}}"/>
    @error('foto_url')
        <div class="error">{{ $message }}</div>
    @enderror
</div>

