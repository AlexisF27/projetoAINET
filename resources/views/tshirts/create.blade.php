@extends('layout')
@section('title','Adicionar Tshirt ao carrinho')
@section('content')

    <form class="form-group">
    {{-- <form action="" class="form-group"> --}}
        @csrf
        @include('tshirts.partials.create-edit')
        <div class="form-group text-right">
            <form action="{{route('carrinho.store_t_shirt',$estampa)}}" method="POST">
                @csrf
                <input type="submit" value="Add">
            </form>
            <button type="button" class="btn btn-success" name="ok">Adicionar</button>
            {{-- <a href="{{route('carrinho.index')}}" class="btn btn-secondary">Save</a> --}}
            <a href="{{route('estampas.index')}}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
@endsection
