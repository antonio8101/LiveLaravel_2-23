<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Film extends Model
{
    use SoftDeletes;

    protected $connection = 'sakila';
    const CREATED_AT = 'last_update';
    const UPDATED_AT = 'last_update';

    protected $table = 'film';
    protected $primaryKey = 'film_id';
    public $timestamps = false;

    public $attributes = [
        'language_id' => 1
    ];

    public function actors()
    {
        return $this->belongsToMany(Actor::class, 'film_actor', 'film_id', 'actor_id');
    }
}
