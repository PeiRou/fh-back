<?php

namespace App\Models\Chat;

use Illuminate\Database\Eloquent\Model;

class Bullet extends Model
{
    protected $fillable = [
        'content', 'type','created_hand', 'updated_hand',
    ];
}
