<?php

namespace Database\Seeders;

use App\Models\Movie;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Movie::create([
            'title' => 'Inception',
            'year' => 2010,
            'director' => 'Christopher Nolan',
            'genre' => 'Fantascienza',
            'description' => 'Trama di Inception'
        ]);

        Movie::create([
            'title' => 'Il Signore degli Anelli - La Compagnia dell\'Anello',
            'year' => 2001,
            'director' => 'Peter Jackson',
            'genre' => 'Fantasy',
            'description' => 'Trama del Signore degli Anelli - La Compagnia dell\'Anello'
        ]);

        Movie::create([
            'title' => 'Star Wars III - La vendetta dei Sith',
            'year' => 2005,
            'director' => 'George Lucas',
            'genre' => 'Fantascienza',
            'description' => 'Trama di Star Wars III - La vendetta dei Sith'
        ]);

        Movie::create([
            'title' => 'Il Signore degli Anelli - Le due Torri',
            'year' => 2001,
            'director' => 'Peter Jackson',
            'genre' => 'Fantasy',
            'description' => 'Trama del Signore degli Anelli - Le due Torri'
        ]);

        Movie::create([
            'title' => 'Interstellar',
            'year' => 2014,
            'director' => 'Christopher Nolan',
            'genre' => 'Fantasy',
            'description' => 'Trama di Interstellar'
        ]);

        Movie::create([
            'title' => 'Bad Boys',
            'year' => 1995,
            'director' => 'Michael Bay',
            'genre' => 'Azione',
            'description' => 'Trama di Bsd Boys'
        ]);
    }
}
