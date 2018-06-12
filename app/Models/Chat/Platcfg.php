<?php

namespace App\Models\Chat;

use Illuminate\Database\Eloquent\Model;

class Platcfg extends Model
{
    protected $fillable = [
        'is_open', 'schedule_type','schedule_games', 'schedule_msg', 'start_time', 'end_time', 'is_auto', 'min_money', 'ip_black',
    ];


}
