<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Play extends Model
{
    protected $table = 'play';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
