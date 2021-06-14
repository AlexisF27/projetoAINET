@extends('layout')
@section('title','Alterar Encomenda' )
@section('content')

    <form method="POST" action="{{route('encomendas.update', ['encomenda' => $newEncomenda]) }}" class="form-group" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('encomendas.partials.create-edit')
        <div class="form-group text-right">
                <button type="submit" class="btn btn-success" name="ok">Save</button>
                <a href="{{route('encomendas.index') }}"
                     class="btn btn-secondary">Cancel</a>
        </div>
    </form>
@endsection
