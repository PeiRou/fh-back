<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blacklist extends Model
{
    protected $table = 'blacklist';
    protected $primaryKey = 'id';

    public static $role = [
        'value' => 'required|string|max:255',
        'content' => 'required|string|max:100',
    ];

    public static $types = [
        1 => '银行卡黑名单',
    ];
}
