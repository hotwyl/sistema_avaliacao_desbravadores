@extends('adminlte::page')

@section('title', 'Ranking Clubes')

@section('content_header')
    <h1>Ranking Avaliações Clubes</h1>
@stop

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Ranking Clube</li>
        </ol>
    </nav>

    <form action="{{ route('ranking_clubes.index') }}" method="GET">
        <div class="row">

            <div class="col-md-3">
                <select name="avaliacao" class="form-control form-control-sm">
                    <option value="">Selecione a Avaliação</option>
                    @foreach ($rankingClubes as $rankingClube)
                        <option value="{{ $rankingClube->avaliacao->id_avaliacao }}" {{ request()->avaliacao === $rankingClube->avaliacao->id_avaliacao ? 'selected' : '' }}>{{ $rankingClube->avaliacao->nome }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3">
                <select name="avaliador" class="form-control form-control-sm">
                    <option value="">Selecione o Avaliador</option>
                    @foreach ($rankingClubes as $rankingClube)
                        <option value="{{ $rankingClube->avaliador->id_avaliador }}" {{ request()->avaliador === $rankingClube->avaliador->id_avaliador ? 'selected' : '' }}>{{ $rankingClube->avaliador->nome }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3">
                <select name="clube" class="form-control form-control-sm">
                    <option value="">Selecione o Clube</option>
                    @foreach ($rankingClubes as $rankingClube)
                        <option value="{{ $rankingClube->clube->id_clube }}" {{ request()->clube === $rankingClube->clube->id_clube ? 'selected' : '' }}>{{ $rankingClube->clube->nome }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3 d-flex justify-content-around">
                <button type="submit" class="btn btn-secondary btn-sm">Filtrar</button>
                <a href="{{ route('ranking_clubes.index') }}" class="btn btn-warning btn-sm">Limpar</a>
                <a href="{{ route('ranking_clubes.create') }}" class="btn btn-success btn-sm">Nova Avaliação</a>
            </div>
        </div>
    </form>

    <x-mensagem />

    <table class="table table-bordered table-striped table-hover mt-3">
        <thead>
            <tr>
                <th>Avaliação</th>
                <th>Avaliador</th>
                <th>Clube</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
        @forelse ($rankingClubes as $rankingClube)
            <tr>
                <td>{{ $rankingClube->avaliacao->nome }}</td>
                <td>{{ $rankingClube->avaliador->nome }}</td>
                <td>{{ $rankingClube->clube->nome }}</td>
                <td class="d-flex justify-content-around">
                    <a href="{{ route('ranking_clubes.show', $rankingClube->id_ranking_clube) }}" class="btn btn-info btn-sm">Mostrar</a>
                    <a href="{{ route('ranking_clubes.edit', $rankingClube->id_ranking_clube) }}" class="btn btn-primary btn-sm">Editar</a>
                    <form action="{{ route('ranking_clubes.destroy', $rankingClube->id_ranking_clube) }}" method="POST" style="display:inline;" onsubmit="return confirm('Tem certeza que deseja excluir o intem Ranking {{$rankingClube->avaliacao->nome }} ?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Deletar</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6">Nenhum registro encontrado.</td>
            </tr>
        @endforelse
        </tbody>
    </table>

    @if($rankingClubes->total() > $rankingClubes->perPage())
        <div class="mt-1 py-2">
            {{ $rankingClubes->appends(request()->query())->links('pagination::bootstrap-5') }}
        </div>
    @endif
@endsection
