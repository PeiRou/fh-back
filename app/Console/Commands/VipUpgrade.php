<?php

namespace App\Console\Commands;

use App\Capital;
use App\Repository\VipUpgradeRepository;
use App\SystemSetup;
use App\UserVip;
use App\Vip;
use App\ZhReportMember;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class VipUpgrade extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'VipUpgrade:VipUpgrade';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'vip每日升级定时任务';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //判断vip功能是否开启
        $iVipSwitch = SystemSetup::getValueByCode('vip_switch');
        if($iVipSwitch != 1){
            $this->info('VIP暂未开启');
            return ;
        }
        //获取用户打码量和投注金额
        $iOpenTime = SystemSetup::getValueByCode('vip_open_time');
        if($iOpenTime == 0){
            $this->info('VIP时间未设置');
            return ;
        }
        $aUser = ZhReportMember::getVipUser($iOpenTime);
        //设置vip信息
        $aVip = Vip::getVipData();
        $aUserVip = [];
        $iVipUpgrade = new VipUpgradeRepository($aVip);
        foreach ($aUser as $iUser){
            $iVipUpgrade->doAction($iUser);
            $aUserVip[] = [
                'user_id' => $iUser->user_id,
                'money' => $iUser->recharges_money,
                'bet_money' => $iUser->bet_money,
            ];
        }
        $aData = $iVipUpgrade->returnData();
        $iTime = date('Y-m-d H:i:s');
        //添加新用户
        if(count($aData['aNullUser']) > 0){
            $aNewUser = [];
            foreach ($aData['aNullUser'] as $iNullUser){
                $aNewUser[] = [
                    'user_id' => $iNullUser,
                    'vip_id' => 0,
                    'money' => 0,
                    'bet_money' => 0,
                    'created_at' => $iTime,
                    'updated_at' => $iTime,
                ];
            }
            UserVip::insert($aNewUser);
        }
        //修改vip用户充值和投注金额
        $aUserVip = array_chunk($aUserVip,1000);
        foreach ($aUserVip as $iUserVip){
            DB::update($this->editVipMoneyBet('user_vip',$iUserVip,['money','bet_money'],'user_id'));
        }
        //有用户需要升级时
        if(count($aData['aUpgradeId']) > 0){
            //添加资金明细
            Capital::insert($aData['aCapital']);
            //添加晋级礼金派奖记录
            DB::table('user_vip_record')->insert($aData['aRecord']);
            //添加晋级礼金金额
            DB::update($this->editUserMoney($aData['aUserGift']));
            //修改vip用户等级
            DB::update($this->editUserUpgrade($aData['aUpgradeId']));

        }
        $this->info('执行结束');
    }

    //拼接vip充值和投注金额
    private function editVipMoneyBet($table,$data,$fields,$primary){
        $aSql = 'UPDATE ' . $table . ' SET ';
        foreach ($fields as $field){
            $str1 = '`' . $field . '` = CASE ' . $primary . ' ';
            foreach ($data as $key => $value){
                $str1 .= 'WHEN \'' . $value[$primary] . '\' THEN \'' . $value[$field] . '\' ';
            }
            $str1 .= 'END , ';
            $aSql .= $str1;
        }
        $aSql = substr($aSql,0,strlen($aSql)-2);
        $endStr = 'WHERE ' . $primary . ' IN (';
        foreach ($data as $key => $value){
            $endStr .= '\''.$value[$primary] . '\',';
        }
        $endStr = substr($endStr,0,strlen($endStr)-1);
        $endStr .= ')';
        $aSql .= $endStr;
        return $aSql;
    }

    //拼接vip升级sql
    private function editUserUpgrade($aUpgradeId){
        $aSql = 'UPDATE `user_vip` SET ';
        $str1 = '`vip_id` = CASE `user_id` ';
        foreach ($aUpgradeId as $key => $value){
            $str1 .= 'WHEN \'' . $key . '\' THEN \'' . $value . '\' ';
        }
        $str1 .= 'END , ';
        $aSql .= $str1;
        $aSql = substr($aSql,0,strlen($aSql)-2);
        $endStr = 'WHERE `user_id` IN (';
        foreach ($aUpgradeId as $key => $value){
            $endStr .= '\''. $key . '\',';
        }
        $endStr = substr($endStr,0,strlen($endStr)-1);
        $endStr .= ')';
        $aSql .= $endStr;
        return $aSql;
    }

    //拼接vip晋级彩金sql
    public function editUserMoney($aUserGift){
        $aSql = 'UPDATE `users` SET ';
        $str1 = '`money` = `money` + CASE `id` ';
        foreach ($aUserGift as $key => $value){
            $str1 .= 'WHEN \'' . $key . '\' THEN \'' . $value . '\' ';
        }
        $str1 .= 'END , ';
        $aSql .= $str1;
        $aSql = substr($aSql,0,strlen($aSql)-2);
        $endStr = 'WHERE `id` IN (';
        foreach ($aUserGift as $key => $value){
            $endStr .= '\''. $key . '\',';
        }
        $endStr = substr($endStr,0,strlen($endStr)-1);
        $endStr .= ')';
        $aSql .= $endStr;
        return $aSql;
    }
}
