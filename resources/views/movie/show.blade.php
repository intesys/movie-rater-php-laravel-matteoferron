@extends('layouts.app')

@section('content')
<section class="movies-single">
    <h1>{{ $movie->title }}</h1>

    <a class="btn-secondary" href="{{ route('movies.index') }}">Torna indietro</a>


    <div class="movies-single-details">
        <div class="movies-single-details-item">
            <span class="label">Anno:</span>
            <span class="value">{{ $movie->year }}</span>
        </div>

        <div class="movies-single-details-item">
            <span class="label">Regista:</span>
            <span class="value">{{ $movie->director }}</span>
        </div>

        <div class="movies-single-details-item">
            <span class="label">Genere:</span>
            <span class="value">{{ $movie->genre }}</span>
        </div>

        <div class="movies-single-details-text">
            <span class="label">Cast:</span>
            @if ($movie->castMembers->isNotEmpty())
                <ul>
                    @foreach ($movie->castMembers as $cast)
                        <li>{{ $cast->actor_name }}</li>
                    @endforeach
                </ul>
            @else
                <span class="empty-cast">Per questo film non è previsto un cast</span>
            @endif

            <span class="value">{{ $movie->description }}</span>
        </div>


        <div class="movies-single-details-text">
            <span class="label">Descrizione:</span>
            <span class="value">{{ $movie->description }}</span>
        </div>
    </div>
</section>

@endsection
