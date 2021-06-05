@extends('layout')
@section('title','Adicionar Tshirt ao carrinho')
@section('content')

    <form method="POST" action="{{route('carrinho.store_t_shirt', $estampa)}}" class="form-group" enctype="multipart/form-data">
        @csrf
        @include('tshirts.partials.create-edit')
        <div class="form-group text-right">
                <button type="submit" class="btn btn-success" name="ok">Save</button>
                <a href="{{route('estampas.index')}}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
@endsection
