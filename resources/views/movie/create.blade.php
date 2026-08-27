@extends('layouts.app')

@section('content')
<section class="movies-create">
    <h1>Aggiungi un Film</h1>
    <a class="btn-secondary" href="{{ route('movies.index') }}">Torna indietro</a>

    <div class="movies-create-form">
        @if ($errors->any())
            <div class="errors">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{route('movies.store')}}" method="POST" id="create_film">
            @csrf
            @method('POST')
            <div class="form-row">
                <div class="input-group">
                    <label for="title">
                        Titolo<span class="req">*</span>
                    </label>
                    <input type="text" name="title" id="title" placeholder="Inserisci il titolo del film" value="{{ old('title') }}" />
                </div>
            </div>

            <div class="form-row">
                <div class="input-group">
                    <label for="year">
                        Anno<span class="req">*</span>
                    </label>
                    <input type="number" min="1900" name="year" id="year" placeholder="Inserisci l'anno del film" value="{{ old('year') }}" />
                </div>
                 <div class="input-group">
                    <label for="director">
                        Regista<span class="req">*</span>
                    </label>
                    <input type="text" name="director" id="director" placeholder="Inserisci il regista del film" value="{{ old('director') }}" />
                </div>
            </div>

            <div class="form-row">
                <div class="input-group">
                    <label for="genre">
                        Genere<span class="req">*</span>
                    </label>
                    <input type="text" name="genre" id="genre" placeholder="Inserisci il genere del film" value="{{ old('genre') }}" />
                </div>
            </div>

            <div class="form-row">
                <div class="input-group">
                    <label for="description">
                        Trama
                    </label>
                    <textarea name="description" id="description" cols="30" rows="10" placeholder="Inserisci la trama del film">{{ old('description') }}</textarea>
                </div>
            </div>

            <div class="form-row">
                <div class="input-group cast-section">
                    <label for="cast_rows">
                        Cast
                    </label>

                    <div class="cast-rows" id="cast_rows">
                        @php
                            $oldCast = old('cast', ['']); // almeno una riga vuota se non c'è old input
                        @endphp

                        @foreach ($oldCast as $actorName)
                            <div class="cast-row">
                                <input type="text" name="cast[]" placeholder="Nome e cognome dell'attore" value="{{ $actorName }}" />
                                <button type="button" class="btn-remove-cast" aria-label="Rimuovi attore">&times;</button>
                            </div>
                        @endforeach
                    </div>

                    <button type="button" class="btn-add-cast" id="add_cast">+ Aggiungi attore</button>

                    <template id="cast_row_template">
                        <div class="cast-row">
                            <input type="text" name="cast[]" placeholder="Nome e cognome dell'attore" />
                            <button type="button" class="btn-remove-cast" aria-label="Rimuovi attore">&times;</button>
                        </div>
                    </template>
                </div>
            </div>

            <input type="submit" value="Inserisci" class="btn-submit">


        </form>
    </div>
</section>
@endsection
