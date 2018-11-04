<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdvertiseKey extends Model
{
    protected $table = 'advertise_key';

    public $advertiseType = [
        '1' => '文字',
        '2' => '图片',
        '3' => '富文本',
    ];

    public $advertiseStatus = [
        '1' => '开启',
        '2' => '关闭',
    ];
}
