<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Onderdeel extends Model {

    protected $table = 'onderdeel';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'naam',
    ];

}
