<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rental extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customer_id', 'movie_id', 'start_date', 'end_date', 'description'
    ];

    /**
     * @var array
     */
    protected $dates = [
        'deleted_at'
    ];
}
