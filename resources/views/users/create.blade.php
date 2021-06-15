@extends('layout')
@section('title','Novo Usuario')
@section('content')

    <form method="POST" action="{{route('users.store')}}" class="form-group">
        @csrf
        @include('users.partials.create-edit')
        <div class="form-group text-right">
                <button type="submit" class="btn btn-success" name="ok">Save</button>
                <a href="{{route('admin.users')}}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
@endsection
