<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserFreezeMoney extends Model
{
    protected $table = 'user_freeze_money';

    public $userFreezeMoneyStatus = [
        '0' => '已冻结',
        '1' => '已解冻',
    ];

    //用户冻结记录-表格数据
    public static function freezeRecord($aParam){
        $aModel = self::where(function ($aSql) use($aParam){
            if(isset($aParam['username']) && array_key_exists('username',$aParam)) {
                $aSql->where('users.username',$aParam['username']);
            }
            if(isset($aParam['startTime']) && array_key_exists('startTime',$aParam)){
                $aSql->where('user_freeze_money.created_at','>=',$aParam['startTime']);
            }
            if(isset($aParam['endTime']) && array_key_exists('endTime',$aParam)){
                $aSql->where('user_freeze_money.created_at','<=',$aParam['startTime'] . ' 23:59:59');
            }
        })->join('users','users.id','=','user_freeze_money.user_id')->join('game','game.game_id','=','user_freeze_money.game_id');
        return [
            'iCount' => $aModel->count(),
            'aData' => $aModel->select('users.username','users.fullName','game.game_name','user_freeze_money.issue','user_freeze_money.status','user_freeze_money.money','user_freeze_money.id','user_freeze_money.created_at')
                ->skip($aParam['start'])->take($aParam['length'])->get(),
        ];
    }

}
