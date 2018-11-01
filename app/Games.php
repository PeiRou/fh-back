<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Games extends Model
{
    protected $table = 'game';
    protected $primaryKey = 'g_id';

    //获取游戏选项
    public static function getGameOption(){
        return self::select('game_id','game_name')->where('status','=',1)->get();
    }

    public static $aCodeGameName = [
        'jspk10' => 'mssc',     //秒速赛车
        'pk10' => 'bjpk10',     //北京赛车
        'jsft' => 'msft',       //秒速飞艇
        'jsssc' => 'msssc',     //秒速时时彩
        'cqssc' => 'cqssc',     //秒速时时彩
        'xydd' => '',           //幸运蛋蛋
        'lhc' => 'lhc',         //香港六合彩
        'xync' => 'cqxync',     //重庆幸运农场
        'xylhc' => 'xylhc',     //幸运六合彩
        'xykl8' => '',          //幸运快乐8
        'pcdd' => 'pcdd',       //PC蛋蛋
        'gd11x5' => 'gd11x5',   //广东11选5
        'jsk3' => 'jsk3',       //江苏快3
        'bjkl8' => 'bjkl8',     //北京快乐8
        'gdkl10' => 'gdklsf',   //广东快乐十分
        'fc3d' => 'fc3d',       //福彩3D
        'tjssc' => '',          //天津时时彩
        'xjssc' => 'xjssc',     //新疆时时彩
        'xyft' => '',           //幸运飞艇
        'paoma' => 'paoma',     //香港跑马
        'pk10nn' => 'pknn',     //PK10牛牛
        'msnn' => '',           //秒速牛牛
        'ahk3' => 'ahk3',       //安徽快3
        'gxk3' => 'gxk3',       //广西快3
        'hbk3' => 'hbk3',       //湖北快3
        'msjsk3' => 'msjsk3',   //秒速快3
        'hebeik3' => 'hebeik3',   //河北快3
        'gzk3' => 'gzk3',       //贵州快3
        'gsk3' => 'gsk3',       //甘肃快3
    ];

    public static $aCodeCategory = [
        //快3类
        'k3' => ['jsk3','ahk3','gxk3','hbk3','msjsk3','hebeik3','gzk3','gsk3'],
        //时时彩
        'ssc' => ['jsssc','cqssc','tjssc','xjssc'],
        //赛车
        'sc' => ['jspk10','pk10','jsft','xyft','paoma','jspk10'],
        //幸运农场 快乐十分
        'xync' => ['gdkl10','xync'],
        //广东11选5
        'gd11x5' => ['gd11x5'],
        //北京快乐8
        'bjkl8' => ['bjkl8'],
    ];
}
