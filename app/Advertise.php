<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Advertise extends Model
{
    protected $table = 'advertise';

    public $advertiseType = [
        '1' => '键-值',
        '2' => '键-数组',
        '3' => '键-对象',
    ];

    public $advertiseStatus = [
        '1' => '开启',
        '2' => '关闭',
    ];

    public static $role = [
        'title' => 'required|max:50',
        'js_key' => 'required|max:20',
        'type' => 'required|integer',
    ];
}
