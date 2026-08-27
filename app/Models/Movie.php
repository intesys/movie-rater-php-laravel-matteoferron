<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Movie extends Model
{
    protected $fillable = ['title', 'year', 'director', 'genre', 'description'];

    /**
     * Relation with casts table
     *
     * @return HasMany
     */
    public function castMembers(): HasMany
    {
        return $this->hasMany(Cast::class);
    }

    /**
     * Scope get all movies order by title
     *
     * @param $query
     * @return void
     */
    public function scopeMoviesAll($query)
    {
        return $query->orderBy('title')->get();
    }

    /**
     * Scope for extract all movies and cast
     *
     * @param $query
     * @return void
     */
    public function scopeListMovies($query)
    {
        return $query
            ->select('id', 'title', 'director', 'year', 'genre', 'description')
            ->with(['castMembers' => function ($query) {
                $query->select('id', 'movie_id', 'actor_name');
            }])
            ->orderBy('title')
            ->get();
    }
}
