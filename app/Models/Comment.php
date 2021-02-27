<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'content',
        'movie_id',
        'user_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'movie_id' => 'integer',
        'user_id' => 'integer',
    ];


    public function movie()
    {
        return $this->belongsTo(\App\Models\Movie::class);
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}
