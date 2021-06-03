@extends('layout')
@section('title','Alterar Estampa' )
@section('content')

    <form method="POST" action="{{route('estampas.update', ['estampa' => $newEstampa]) }}" class="form-group" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('estampas.partials.create-edit')
        <div class="form-group text-right">
                <button type="submit" class="btn btn-success" name="ok">Save</button>
                <a href="{{route('estampas.index') }}"
                     class="btn btn-secondary">Cancel</a>
        </div>
    </form>
@endsection
