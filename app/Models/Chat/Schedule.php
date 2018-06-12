<?php

namespace App\Models\Chat;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $table = 'schedule';
    protected $fillable = [
        'type', 'content'
    ];
}
