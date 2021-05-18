@extends('layout')
@section('content')

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
                    <a href=""
                       class="btn btn-primary btn-sm" role="button" aria-pressed="true">Alterar</a>
                </td>
                <td>
                    <form action="#" method="POST">
                        @csrf
                        @method("DELETE")
                        <input type="submit" class="btn btn-danger btn-sm" value="Apagar">
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
    {{ $todosUsers->links() }}

@endsection
