@extends('layout')
@section('content')

<div class="cursos-area">
        @foreach ($todasTshirts as $tshirts)
            <div class="curso">
                <div class="curso-imagem">
                    <img src="img/cursos/{{$curso->abreviatura}}.png" alt="Imagem do curso">
                </div>
                <div class="curso-info-area">
                    <div class="curso-info">
                        <span class="curso-label">Abreviatura</span>
                        <span class="curso-info-desc">{{$curso->nome}}</span>
                    </div>
                    <div class="curso-info">
                        <span class="curso-label">Nome</span>
                        <span class="curso-info-desc">{{$curso->nome}}</span>
                    </div>
                    <div class="curso-info">
                        <span class="curso-label">Tipo</span>
                        <span class="curso-info-desc">{{$curso->tipo}}</span>
                    </div>
                    <div class="curso-info">
                        <span class="curso-label">Semestres</span>
                        <span class="curso-info-desc">{{$curso->semestres}}</span>
                    </div>
                    <div class="curso-info">
                        <span class="curso-label">ECTS</span>
                        <span class="curso-info-desc">{{$curso->ECTS}}</span>
                    </div>
                    <div class="curso-info">
                        <span class="curso-label">Vagas</span>
                        <span class="curso-info-desc">{{$curso->vagas}}</span>
                    </div>
                    <div class="curso-info">
                        <span class="curso-label">Contacto</span>
                        <span class="curso-info-desc">{{$curso->contato}}</span>
                    </div>
                    <div class="curso-info">
                        <span class="curso-label">Objetivos</span>
                        <span class="curso-info-desc">{{$curso->objetivos}}</span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

  

@endsection
