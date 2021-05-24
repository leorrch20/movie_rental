<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Movie extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code', 'title', 'category', 'description', 'year', 'qty'
    ];

    /**
     * @var array
     */
    protected $dates = [
        'deleted_at'
    ];
}
