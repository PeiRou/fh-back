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

    //获取游戏数据
    public static function getGameAllData(){
        return self::select('game_id','game_name','mode','code','status')->get();
    }

    //各个彩种is_open状态
    public static $gameIsOpen = [
        '0' => '未开奖',
        '1' => '已开奖',
        '5' => '已冻结',
        '6' => '已撤单',
        '7' => '重新开奖中',
        '8' => '冻结中',
        '9' => '冻结失败',
        '10' => '重新开奖失败',
        '11' => '撤单中',
        '12' => '撤单失败',
    ];

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
        'msnn' => 'mssc',       //秒速牛牛
        'ahk3' => 'ahk3',       //安徽快3
        'gxk3' => 'gxk3',       //广西快3
        'hbk3' => 'hbk3',       //湖北快3
        'msjsk3' => 'msjsk3',   //秒速快3
        'hebeik3' => 'hebeik3',   //河北快3
        'gzk3' => 'gzk3',       //贵州快3
        'gsk3' => 'gsk3',       //甘肃快3
        'qqffc' => 'qqffc',       //QQ分分彩
        'msqxc' => 'msqxc',       //秒速七星彩
        'ksssc' => 'ksssc',       //快速时时彩
        'ksft' => 'ksft',       //快速飞艇
        'kssc' => 'kssc',       //快速赛车
        'twxyft' => 'twxyft',       //台湾幸运飞艇
        'sfsc' => 'sfsc',       //三分赛车
        'sfssc' => 'sfssc',       //三分时时彩
        'jslhc' => 'jslhc',       //急速六合彩
        'sflhc' => 'sflhc',       //三分六合彩
    ];

    public static $aCodeBindingGame = [
        'pk10' => 'pk10nn',
        'bjkl8' => 'pcdd',
        'jspk10' => 'msnn',
    ];

    public static $aCodeCategory = [
        //快3类
        'k3' => ['jsk3','ahk3','gxk3','hbk3','msjsk3','hebeik3','gzk3','gsk3'],
        //时时彩
        'ssc' => ['jsssc','cqssc','tjssc','xjssc','qqffc','ksssc','sfssc'],
        //赛车
        'sc' => ['jspk10','pk10','jsft','xyft','paoma','jspk10','kssc','ksft','twxyft','sfsc'],
        //幸运农场 快乐十分
        'xync' => ['gdkl10','xync'],
        //广东11选5
        'gd11x5' => ['gd11x5'],
        //北京快乐8
        'bjkl8' => ['bjkl8'],
        //香港六合彩
        'lhc' => ['lhc','xylhc','jslhc','sflhc'],
    ];

    public static $aTableByGameId = [
        80 => 'mssc',
        50 => 'bjpk10',
        82 => 'msft',
        81 => 'msssc',
        1 => 'cqssc',
        84 => '',
        70 => 'lhc',
        61 => 'cqxync',
        85 => 'xylhc',
        83 => '',
        66 => 'pcdd',
        21 => 'gd11x5',
        10 => 'jsk3',
        65 => 'bjkl8',
        60 => 'gdklsf',
        30 => 'fc3d',
        5 => '',
        4 => 'xjssc',
        55 => '',
        99 => 'paoma',
        90 => 'pknn',
        91 => 'mssc',
        11 => 'ahk3',
        12 => 'gxk3',
        13 => 'hbk3',
        86 => 'msjsk3',
        111 => '',
        15 => 'hebeik3',
        16 => 'gsk3',
        18 => 'gzk3',
        112 => 'txffc',
        113 => 'qqffc',
        114 => 'msqxc',
        801 => 'kssc',
        802 => 'ksft',
        803 => 'ksssc',
        804 => 'twxyft',
        901 => 'sfsc',
        902 => 'sfssc',
        903 => 'jslhc',
        904 => 'sflhc',
    ];
}
