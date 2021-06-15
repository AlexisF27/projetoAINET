@extends('layout')
@section('content')


<div class="row">
    <form method="GET" action="{{route('admin.users')}}" class="form-group">
        <div class="input-group">
            <select class="custom-select" name="tipo" id="inputTipo" aria-label="Tipo">
                <option value="" {{ '' == old('tipo', $selectedTipo) ? 'selected' : ''}}>Tipos</option>
                @foreach ($lista_tipos as $id)
                    <option value={{$id}} {{$id == old('tipo', $selectedTipo) ? 'selected' : '' }} > {{$id}} </option>
                @endforeach
            </select>
            <div class="input-group">
                <input type="text" name="name" class="form-control" value="{{old('name', $selectedNomeUser)}}" id="inputNomeUser" aria-label="User" placeholder="Nome User">
            </div>
            <div class="input-group">
                <input type="text" name="email" class="form-control" value="{{old('email', $selectedEmail)}}" id="inputEmail" aria-label="Email" placeholder="Email User">
            </div>
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="submit">Filtrar</button>
            </div>
        </div>
  </form>
</div>

<div class="row">
<table class="table table-striped table-bordered">
    <thead class="thead-dark">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Tipo</th>
            <th>Bloquedo</th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($todosUsers as $user)
            <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->tipo}}</td>
                <td>{{$user->bloqueado}}</td>
                <td>
                    <form action="{{route('users.updateBloqueado', ['user' => $user])}}" method="POST">
                        @csrf
                        @method('put')
                        <input type="hidden" name="quantidade" value="-1">
                        <input class="btn btn-primary btn-sm" role="button" type="submit" value="Bloquear - Não Bloquear">
                    </form>
                </td>
                <td>
                    <a href="{{route('users.edit', ['user' => $user])}}"
                       class="btn btn-primary btn-sm" role="button" aria-pressed="true">Alterar</a>
                </td>
                <td>
                    <form action="{{route('users.destroy', ['user' => $user])}}" method="POST">
                        @csrf
                        @method("DELETE")
                        <input type="submit" class="btn btn-danger btn-sm" value="Apagar">
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
</div>
    {{ $todosUsers->links() }}

@endsection
