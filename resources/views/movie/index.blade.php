@extends('layouts.app')

@section('content')
<section class="movies">
    <h1>Elenco Film</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a class="btn" href="{{ route('movies.create') }}">Aggiungi un nuovo film</a>

    @if ($movies->count() > 0)
        <table class="movies-table">
            <thead>
                <tr>
                    <th>Titolo</th>
                    <th>Anno</th>
                    <th>Regista</th>
                    <th>Genere</th>
                    <th>Azioni</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($movies as $movie)
                <tr>
                    <td>{{$movie->title}}</td>
                    <td>{{$movie->year}}</td>
                    <td>{{$movie->director}}</td>
                    <td>{{$movie->genre}}</td>
                    <td class="movies-table-actions">
                        <a class="btn-view" href="{{ route('movies.show', $movie) }}" title="Visualizza il film: {{$movie->title}}">
                            Visualizza
                        </a>
                        <a class="btn-edit" href="{{ route('movies.edit', $movie) }}" title="Modifica il film: {{$movie->title}}">
                            Modifica
                        </a>
                        <form action="{{ route('movies.destroy', $movie) }}" method="POST" style="display: inline;" onsubmit="return confirm('Sei sicuro di voler eliminare {{ $movie->title }}?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-destroy" title="Elimina il film: {{ $movie->title }}">
                                Elimina
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <div class="not-found">
            <span>Nessun film trovato</span>
        </div>
    @endif
</section>

@endsection
