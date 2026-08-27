<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMovieRequest;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $movies = Movie::moviesAll();
        return view('movie.index', compact('movies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('movie.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMovieRequest $request)
    {
        $validated = $request->validated();

        $movie = DB::transaction(function() use ($validated) {
            $movie = Movie::create([
                'title' => $validated['title'],
                'year' => $validated['year'],
                'director' => $validated['director'],
                'genre' => $validated['genre'],
                'description' => $validated['description'] ?? null
            ]);

            $castRows = collect($validated['cast'])->map(function ($actorName) {
                return ['actor_name' => $actorName];
            });

            $movie->castMembers()->createMany($castRows);

            return $movie;
        });

        return redirect()
            ->route('movies.index')
            ->with('success', "Film aggiunto con successo");
    }

    /**
     * Display the specified resource.
     */
    public function show(Movie $movie)
    {
        return view('movie.show', compact('movie'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Movie $movie)
    {
        $movie->load('castMembers');

        return view('movie.edit', compact('movie'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreMovieRequest $request, Movie $movie)
    {
        $validated = $request->validated();

        DB::transaction(function() use ($validated, $movie) {
            $movie->update([
                'title' => $validated['title'],
                'year' => $validated['year'],
                'director' => $validated['director'],
                'genre' => $validated['genre'],
                'description' => $validated['description'] ?? null
            ]);

            // Clear cast members inserts before edit
            $movie->castMembers()->delete();

            $castRows = collect($validated['cast'])->map(function ($actorName) {
                return ['actor_name' => $actorName];
            });

            // Update cast with new rows
            $movie->castMembers()->createMany($castRows);
        });

        return redirect()
            ->route('movies.index')
            ->with('success', "Film modificato con successo");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Movie $movie)
    {
        Movie::where('id', $movie->id)->delete();
        return redirect()
            ->route('movies.index')
            ->with('success', "Film eliminato con successo");
    }

    public function all_movies_json()
    {
        return response()->json(Movie::listMovies());
    }
}
