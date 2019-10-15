<?php

namespace App\Console\Commands;

use App\Agent;
use App\AgentReport;
use App\AgentReportBase;
use App\AgentReportReview;
use App\Bets;
use App\Http\Proxy\GetDate;
use App\ZhReportMemberBunko;
use Illuminate\Console\Command;

class AgentSettle extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'AgentSettle:Settlement';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'billing agent last month report';

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
        //获取上月时间段
        $currentMonth = $date->lastMonthDate();
        //$currentMonth = ['start'=>'2018-05-01','end'=>'2018-06-30'];
        $yearMonth = date('Y-m',strtotime($currentMonth['start']));
        $yearMonthDay = date('Y-m-d H:i:s',strtotime($currentMonth['start']));
        //获取平台配置
        $aAgentBaseInfo = AgentReportBase::getAgentBaseInfo();
        //获取上月的前两月时间段
        $beforeMonth = $date->beforeTwoMonthDate();
        //获取上月的前两月统计数据
        $aMemberBeforeDatas = AgentReport::getAccordingDateData($beforeMonth);
        //获取需要统计的会员
//        $aMemberDatas = Bets::preliminaryManualSettlement($currentMonth);
        $aMemberDatas = ZhReportMemberBunko::getDataMemberBunko($currentMonth,$aAgentBaseInfo->statistics_game);
        //获取所有代理商
        $aAgentAlls = Agent::getAgentAllBunko($aAgentBaseInfo->noNeed_agent);
        //代理结算信息整合
        $aAgentInfos = [];
        foreach ($aAgentAlls as $aAgentKey => $aAgentAll){
            //初始化有效会员个数
            $effectiveMember = 0;
            $real_bunko = 0;
            //获取代理商的实际输赢
            foreach ($aMemberDatas as $aMemberKey => $aMemberData){
                if($aMemberData->agent_id == $aAgentAll->a_id) {
                    $real_bunko += $aMemberData->sumBunko;
                    //获取有效会员数
                    if ($aMemberData->betCount >= $aAgentBaseInfo->effective_bet && $aMemberData->sumBetMoney >= $aAgentBaseInfo->effective_money) {
                        $effectiveMember++;
                    }
                }
            }
            $aAgentInfos[] = [
                'a_id' => $aAgentAll->a_id,
                'account' => $aAgentAll->account,
                'name' => $aAgentAll->name,
                'created_at' => $yearMonthDay,
                'year_month' => $yearMonth,
                'real_bunko' => $real_bunko,
                'valid_member' => $effectiveMember,
                'fenhong_rate' => json_decode($aAgentAll->fenhong_rate),
            ];
        }
        //代理结算初步计算
        foreach ($aAgentInfos as $key => $aAgentInfo){
            //平台费用比
            $aAgentInfos[$key]['base_fee_prop'] = $aAgentBaseInfo->feesProp;
            //根据实际输赢判断平台费用
            if($aAgentInfo['real_bunko'] >= 0){
                $aAgentInfos[$key]['base_fee'] = $aAgentInfo['real_bunko'] * $aAgentBaseInfo->feesProp;
            }else{
                $aAgentInfos[$key]['base_fee'] = -$aAgentInfo['real_bunko'] * $aAgentBaseInfo->feesProp;
            }
            //本月纯赢利
            $aAgentInfos[$key]['fee_bunko'] = $aAgentInfo['real_bunko'] + $aAgentInfos[$key]['base_fee'];
            //代理分红比
            if(empty($aAgentInfo['fenhong_rate'])){
                $aAgentInfos[$key]['fenhong_prop'] = $this->getAgentProp($aAgentBaseInfo->fenhong_rate,-$aAgentInfos[$key]['fee_bunko']);
            }else{
                $aAgentInfos[$key]['fenhong_prop'] = $this->getAgentProp($aAgentInfo['fenhong_rate'],-$aAgentInfos[$key]['fee_bunko']);
            }

            //代理本月佣金(本月纯赢利*代理分红比)
            $aAgentInfos[$key]['commission'] = -$aAgentInfos[$key]['fee_bunko'] * $aAgentInfos[$key]['fenhong_prop'];
            //最近三个月的累计赢利和佣金以及达标会员
            $aAgentInfos[$key]['month3_fee_bunko'] = $aAgentInfos[$key]['fee_bunko'];
            $aAgentInfos[$key]['month3_commission'] = $aAgentInfos[$key]['commission'];
            $aAgentInfos[$key]['ach_member'] = $aAgentBaseInfo->incre_member;
            foreach ($aMemberBeforeDatas as $aMemberBeforeData){
                if($aAgentInfo['a_id'] == $aMemberBeforeData->a_id){
                    $aAgentInfos[$key]['month3_fee_bunko'] += $aMemberBeforeData->fee_bunko;
                    $aAgentInfos[$key]['month3_commission'] += $aMemberBeforeData->commission;
                    $aAgentInfos[$key]['ach_member'] = $aAgentBaseInfo->incre_member + $aMemberBeforeData->ach_member;
                }
            }
        }
        AgentReport::where('year_month','=',$yearMonth)->delete();
        AgentReportReview::where('year_month','=',$yearMonth)->delete();
        AgentReport::where('created_at','<',$yearMonthDay)->where('status','=',0)->update(['status'=>4]);
        AgentReport::insert($aAgentInfos);
        $this->info('Console settlement successfully.');
    }

    public function getAgentProp($aList,$profit){
        $proportion = 0;
        foreach ($aList->fenhong_rate as $fenhong_rate){
            if($profit > $fenhong_rate['profit']){
                $proportion = $fenhong_rate['proportion'];
            }else{
                break;
            }
        }
        return $proportion;
    }
}
