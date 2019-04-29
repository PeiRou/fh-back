<?php

/**
 *  第三方游戏列表
 */

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class GamesList extends Base
{
    protected $table = 'games_list';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public static function getArr($param = [])
    {
        $arr = self::select('id', 'pid', 'name')->get();
        return self::getTree($arr->toArray());
    }
    public static function getTreeList($param = [])
    {
        $arr = self::getList($param)->toArray();
        $arr = GamesList::getTreeGroup($arr);
        $arr = array_values($arr);
        foreach ($arr as $k=>&$v){
            if(count($v['child']) == 0) unset($arr[$k]);
            $v['child'] = array_values($v['child']);
        }
        return $arr;
    }

    /**
     * 获取所有的不重复的游戏
     * @param array $param 附加参数
     * @return mixed
     */
    public static function getChildList($param = [])
    {
        $res = self::select(DB::raw('games_list.game_id, games_list.name, games_list.pid '))->where(function($sql){
            isset($param['type']) &&
            $sql->where('games_api.type', 1);
            $sql->where('pid', '>', 0);
        })->leftJoin('games_api', 'games_api.g_id', 'games_list.g_id')
            ->where(function($sql) use($param){
                (isset($param['status']) || isset($param['open'])) &&
                $sql->whereRaw('CASE WHEN pid > 0 THEN
                                games_api.status = 1 AND
                                games_list.open = 1
                            ELSE 1 END ');
            })
            ->orderBy('games_list.sort', 'asc')->groupBy('games_list.name')->orderBy('games_list.game_id', 'asc')->get();
        return $res;
    }

    public static function getAll($param = [])
    {
        return self::where(function($sql)use($param){

        })->orderBy('sort','asc')->get();
    }

    public static function getGamesList($param = [])
    {
        $arr = self::getAll()->toArray();
        $arr = GamesList::getTreeGroup($arr);
        $arr = array_values($arr);
        foreach ($arr as $k=>&$v){
            if(count($v['child']) == 0) unset($arr[$k]);
            $v['child'] = array_values($v['child']);
        }
        return $arr;
    }

//    public static function getTreeGroup($array, &$list = [], $pid =0, $level = 0){
//        $list = [];
//        foreach ($array as $key => $value){
//            if ($value['pid'] == $pid){
//                $list[$value['game_id']] = $value;
//                unset($array[$key]);
//                static::getTreeGroup($array, $list[$value['game_id']]['child'], $value['game_id'], $level);
//            }
//        }
//        return $list;
//    }
    //获取的游戏
    public static function getList($param = [])
    {
        return GamesList::select('games_list.id','games_list.sort','games_list.game_id','pid','games_list.name','games_list.g_id',DB::raw('(CASE WHEN games_api.status = 1 AND games_list.open = 1 THEN 1 ELSE 0 END) AS status '))->where(function($sql)use($param){
            (isset($param['status']) || isset($param['open'])) &&
            $sql->whereRaw('CASE WHEN pid > 0 THEN
                                games_api.status = 1 AND
                                games_list.open = 1
                            ELSE 1 END ');

            isset($param['pid']) &&
            $sql->where('games_list.pid', '>', 0);
        })->leftJoin('games_api', 'games_api.g_id', 'games_list.g_id')
            ->get();
    }

    public static $productType = [
        4 => 'AG',
        17 => 'Ameba(AE)',
        25 => 'Lotus',
        30 => 'IBC(沙巴)',
        47 => 'BTI',
        43 => 'MG',
        3 => 'PT',
    ];

    /**
     * 天成游戏下productType对应的东西
     * name 名称
     * games 下面包含的游戏
     * ratio 默认抽点 单位（%） --总后台会设置，如果没取到就拿这里的
     */

    public static $productTypeList = [
        4 => [
            'name' => 'AG',  //名称
            'games' => ['FISH','RNG','LIVE'],
            'ratio' => 10
        ],
        17 => [
            'name' => 'Ameba(AE)',
            'games' => ['RNG'],
            'ratio' => 8
        ],
        25 => [
            'name' => 'Lotus',
            'games' => ['RNG','LIVE'],
            'ratio' => 8
        ],
        30 => [
            'name' => 'IBC(沙巴)',
            'games' => ['SPORTS'],
            'ratio' => 17
        ],
        47 => [
            'name' => 'BTI',
            'games' => ['SPORTS'],
            'ratio' => 15
        ],
        43 => [
            'name' => 'MG',
            'games' => ['RNG'],
            'ratio' => 12
        ],
        3 => [
            'name' => 'PT',
            'games' => ['FISH','RNG','LIVE'],
            'ratio' => 15
        ],
    ];

    public static $gameCategory = [
        'PVP' => '棋牌',
        'RNG' => '电子',
        'LIVE' => '真人',
        'FISH' => '捕鱼',
        'SPORTS' => '体育',
    ];


}
