@extends('layout')
@section('title','Nova Estampa')
@section('content')

    <form method="POST" action="{{route('estampas.store')}}" class="form-group" enctype="multipart/form-data">
        @csrf
        @include('estampas.partials.create-edit')
        <div class="form-group text-right">
                <button type="submit" class="btn btn-success" name="ok">Save</button>
                <a href="{{route('estampas.index')}}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
@endsection
