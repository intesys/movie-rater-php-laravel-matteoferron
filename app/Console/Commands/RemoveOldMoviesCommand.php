<?php

namespace App\Console\Commands;

use App\Models\Movie;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class RemoveOldMoviesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:remove-old-movies';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Commando deletes films older than 5 years';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            $current_year = (int) Carbon::now()->format('Y');
            $old_movies = Movie::where('year', '<', $current_year - 5)->get();
            $count_movies = $old_movies->count();

            if ($count_movies > 0) {
                foreach ($old_movies as $movie) {
                    Log::info("Movie deleted: " . $movie->title .' - ' . $movie->year);
                    $movie->delete();
                }
            } else {
                echo("No 5-year-old movies found\n");
            }

            print("Deleted movies: " . $count_movies);

        } catch (\Throwable $th) {
            Log::error("Error on the command 'app:remove-old-movies' - " . $th);
        }
    }
}
