@extends('layout')
@section('title','Alterar Estampa' )
@section('content')

    <form method="POST" action="{{route('estampas.update', ['estampa' => $estampa]) }}" class="form-group">
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
