<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Whitelist extends Model
{
    protected $table = 'whitelist';

    public static $role = [
        'ip' => 'required|string|max:20',
        'content' => 'required|string|max:100',
    ];

    public static function getWhiteIpList(){
        $data = self::select('ip')->get();
        $ip = [];
        foreach ($data as $value){
            $ip[] = $value->ip;
        }
        return $ip;
    }
}
