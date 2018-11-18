<?php

namespace App\Console\Commands;

use App\Http\Proxy\GetDate;
use App\Models\Chat\Users;
use App\PromotionConfig;
use App\PromotionReport;
use Illuminate\Console\Command;

class PromotionSettle extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'PromotionSettle:Settlement';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'billing promotion last month report';

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
        ini_set('memory_limit','1024M');
        $date = new GetDate();
        //获取昨天时间段
        $yesterday = $date->yesterdayDate();
        //$yesterday = ['start'=>'2018-05-01','end'=>'2018-07-30'];
        //投注时间
        $current = date('Y-m-d',strtotime($yesterday['start']));
        //获取推广结算数据
        $aPromotion = PromotionReport::promotionBillingData($yesterday);
        //获取推广结算信息
        $aConfig = PromotionConfig::getPromotionConfigList();
        //获取推广用户信息
        $aUser = Users::getUsersInfoList();
        //推广结算信息整合
        $aPromotionData = [];
        foreach ($aPromotion as $promotionKey => $iPromotion){
            //推荐人id
            $proportion = $iPromotion->promotion_id;
            for ($i=1;$i<=count($aConfig);$i++){
                if($aConfig[$i]['money'] <= $iPromotion->betMoneySum) {
                    $aPromotionData[] = [
                        'date' => $current,
                        'promotion_id' => $aUser[$proportion]['id'],
                        'promotion_name' => $aUser[$proportion]['name'],
                        'promotion_account' => $aUser[$proportion]['username'],
                        'agent_id' => $iPromotion->agent_id,
                        'agent_account' => $iPromotion->account,
                        'agent_name' => $iPromotion->name,
                        'bet_money' => $iPromotion->betMoneySum,
                        'bet_count' => $iPromotion->betCount,
                        'level' => $i,
                        'fenhong_prop' => $aConfig[$i]['proportion']/100,
                        'commission' => $iPromotion->betMoneySum * $aConfig[$i]['proportion']/100
                    ];
                    $proportion = $aUser[$proportion]['promoter'];
                }
            }
        }
        //推广结算信息合并
        $aReportData = [];
        foreach ($aPromotionData as $promotionKey => $iPromotionData){
            if(isset($aReportData[$iPromotionData['promotion_id'].$iPromotionData['level']]) && array_key_exists($iPromotionData['promotion_id'].$iPromotionData['level'],$aReportData)){
                $aReportData[$iPromotionData['promotion_id'].$iPromotionData['level']]['bet_money'] += $aReportData[$iPromotionData['promotion_id']]['bet_money'];
                $aReportData[$iPromotionData['promotion_id'].$iPromotionData['level']]['commission'] += $aReportData[$iPromotionData['promotion_id']]['commission'];
            }else{
                $aReportData[$iPromotionData['promotion_id'].$iPromotionData['level']] = $iPromotionData;
            }
        }
        PromotionReport::where('date','=',$current)->delete();
        PromotionReport::where('date','<=',$current)->where('status','=',0)->update(['status'=>4]);
        PromotionReport::insert($aReportData);
        $this->info('Console settlement successfully.');
    }
}
