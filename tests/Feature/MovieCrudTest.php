<?php

use Illuminate\Foundation\Http\Middleware\ValidateCsrfToken;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Movie;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->withoutMiddleware(ValidateCsrfToken::class);
});

it('displays the movies index with existing movies', function () {
    $movie = Movie::create([
        'title' => 'Inception',
        'year' => 2010,
        'director' => 'Christopher Nolan',
        'genre' => 'Fantascienza',
    ]);

    $response = $this->get(route('movies.index'));

    $response->assertStatus(200);
    $response->assertSee($movie->title);
    $response->assertSee($movie->year);
});

it('creates a movie and its cast members', function () {
    $response = $this->post(route('movies.store'), [
        'title' => 'Inception',
        'year' => 2010,
        'director' => 'Christopher Nolan',
        'genre' => 'Fantascienza',
        'description' => 'Un film sui sogni.',
        'cast' => ['Leonardo DiCaprio', 'Joseph Gordon-Levitt'],
    ]);

    $response->assertRedirect(route('movies.index'));
    $response->assertSessionHas('success');

    $this->assertDatabaseHas('movies', [
        'title' => 'Inception',
        'year' => 2010,
    ]);

    $this->assertDatabaseHas('casts', [
        'actor_name' => 'Leonardo DiCaprio',
    ]);

    $this->assertDatabaseHas('casts', [
        'actor_name' => 'Joseph Gordon-Levitt',
    ]);
});

it('fails to create a movie with missing required fields', function () {
    $response = $this->post(route('movies.store'), []);

    $response->assertSessionHasErrors(['title', 'year', 'director', 'genre', 'cast']);
});

it('updates a movie and replaces the cast members', function () {
    $movie = Movie::create([
        'title' => 'Inception',
        'year' => 2010,
        'director' => 'Christopher Nolan',
        'genre' => 'Fantascienza',
    ]);

    $movie->castMembers()->create(['actor_name' => 'Old Actor']);

    $this->assertDatabaseHas('casts', ['actor_name' => 'Old Actor']);

    $response = $this->patch(route('movies.update', $movie), [
        'title' => 'Interstellar',
        'year' => 2014,
        'director' => 'Christopher Nolan',
        'genre' => 'Fantascienza',
        'description' => 'Un viaggio nello spazio.',
        'cast' => ['Matthew McConaughey', 'Anne Hathaway'],
    ]);

    $response->assertRedirect(route('movies.index'));

    $this->assertDatabaseHas('movies', [
        'id' => $movie->id,
        'title' => 'Interstellar',
        'year' => 2014,
    ]);

    $this->assertDatabaseMissing('casts', ['actor_name' => 'Old Actor']);
    $this->assertDatabaseHas('casts', ['actor_name' => 'Matthew McConaughey']);
    $this->assertDatabaseHas('casts', ['actor_name' => 'Anne Hathaway']);
});

it('deletes a movie and its cast members', function () {
    $movie = Movie::create([
        'title' => 'Inception',
        'year' => 2010,
        'director' => 'Christopher Nolan',
        'genre' => 'Fantascienza',
    ]);

    $movie->castMembers()->create(['actor_name' => 'Leonardo DiCaprio']);

    $response = $this->delete(route('movies.destroy', $movie));

    $response->assertRedirect(route('movies.index'));

    $this->assertDatabaseMissing('movies', ['id' => $movie->id]);
    $this->assertDatabaseMissing('casts', ['actor_name' => 'Leonardo DiCaprio']);
});
