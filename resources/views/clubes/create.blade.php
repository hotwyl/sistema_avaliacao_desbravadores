@extends('adminlte::page')

@section('title', 'Adicionar Clube')

@section('content_header')
    <h1>Adicionar Clube</h1>
@stop

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('clubes.index') }}">Clubes</a></li>
            <li class="breadcrumb-item active" aria-current="page">Adicionar</li>
        </ol>
    </nav>

    <form action="{{ route('clubes.store') }}" method="POST" autocomplete="off">
        @csrf

        @include('clubes.form_fields')

        <div class="d-flex justify-content-center">
            <a href="{{ route('clubes.index') }}" class="btn btn-danger btn-sm mr-5">Cancelar</a>
            <button type="submit" class="btn btn-success btn-sm ml-5">Adicionar</button>
        </div>
    </form>
@endsection