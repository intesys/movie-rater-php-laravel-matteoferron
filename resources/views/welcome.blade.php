@extends('layouts.app')

@section('content')
    <h1>{{ config('app.name', 'Laravel') }}</h1>
    <p>Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})</p>

    <a class="btn" href="{{ route('movies.index') }}" title="Visualizza i film">Films</a>
@endsection
