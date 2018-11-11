<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GamesApi extends Model
{
    protected $table = 'games_api';
    public $statusArr = [
        111 => '棋牌游戏'
    ];
    
}
