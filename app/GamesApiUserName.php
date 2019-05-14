<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class GamesApiUserName extends Model
{
    protected $table = 'games_api_user_name';

    const CacheKay = 'GamesApiUserName_';

    /**
     * 读取g_id对应下的所有会员
     * 有缓存就取缓存 没有就读库
     * @param array $param[name, g_id, user_id, user]
     * @return string
     */
    public static function getGidOtherName($param = [])
    {
        static $collects;
        $key = $param['username'].($param['key'] ?? '').($param['value'] ?? '');
        if(isset($collects[$param['g_id']]) && ($val = @$collects[$param['g_id']]->get($key)))
            return $val;
        $Cache = GamesApi::getCaCheInstance('NameCache');
        $CacheKay = self::CacheKay.$param['g_id'];
        if((!$collects[$param['g_id']] = $Cache->get($CacheKay)) || !($val = $collects[$param['g_id']]->get($key))){
            $res = self::getGidAll($param);
            $collects[$param['g_id']] = collect([]);
            foreach ($res as $k=>$v){
                $collects[$param['g_id']]->put($v->othername.$v->key.$v->value, $v);
            }
            $Cache->put($CacheKay, $collects[$param['g_id']], 3600 * 2); //缓存两天
        }

        return $collects[$param['g_id']]->get($key) ?? $param['username'];
    }

    public static function getGidAll($param = [])
    {
        $res = self::select('users.id','users.agent','users.username','games_api_user_name.name as othername','games_api_user_name.key','games_api_user_name.value')
            ->where(function($sql) use($param){
                isset($param['g_id']) && $sql->where('g_id', $param['g_id']);
            })
            ->leftJoin('users', 'users.id', 'games_api_user_name.user_id')
            ->get();
        return $res;
    }
}
