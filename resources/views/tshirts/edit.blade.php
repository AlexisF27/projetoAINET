@extends('layout')
@section('title','Alterar Tshirt' )
@section('content')

    <form method="POST" action="{{route('carrinho.update', ['tshirt' => $tshirt], ['estampa' => $estampa]) }}" class="form-group" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('tshirts.partials.create-edit')
        <div class="form-group text-right">
                <button type="submit" class="btn btn-success" name="ok">Save</button>
                <a href="{{route('carrinhos.index') }}"
                     class="btn btn-secondary">Cancel</a>
        </div>
    </form>
@endsection
