<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
    protected $connection = 'sakila';
    const CREATED_AT = 'last_update';
    const UPDATED_AT = 'last_update';

    protected $table = 'actor';
    protected $primaryKey = 'actor_id';
    public $timestamps = false;

    public function films()
    {
        return $this->belongsToMany(Film::class, 'film_actor', 'actor_id', 'film_id');
    }
}
