<?php

namespace App\Models\Chat;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        'name', 'type','is_disable','recharge','chip','online',
    ];
}
