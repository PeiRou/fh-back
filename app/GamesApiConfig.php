<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GamesApiConfig extends Model
{
    protected $table = 'games_api_config';
    protected $primaryKey = 'c_id';

    public static function getConfig($g_id){
        $res = self::select('key', 'value')->where('g_id', $g_id)->get()->toArray();
        $data = [];
        foreach ($res as $k=>$v){
            $data[$v['key']] = $v['value'];
        }
        return $data;
    }
}
