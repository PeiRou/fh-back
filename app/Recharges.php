<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recharges extends Model
{
    protected $table = 'recharges';

    public static $rechargesType = [
        '1' => '加彩金',
        '2' => '掉单补发',
        '3' => '其他'
    ];

}
