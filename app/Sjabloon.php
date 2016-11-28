<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sjabloon extends Model {

    protected $table = 'sjabloon';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'naam',
    ];

}
