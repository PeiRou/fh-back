<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class DailyReconciliationTotal extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Member:DailyReconTotal {dayTime?} {user?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $date = empty($this->argument('dayTime'))?date('Y-m-d',strtotime('-1 day')):date('Y-m-d',strtotime(date($this->argument('dayTime'))));
        $daytstrot = strtotime($date);

        /*在线支付*/
        $onlinePaymentsql = "SELECT rechName AS 'rechname',SUM(amount) AS 'amount',SUM(rebate_or_fee) AS 'giftamount'
FROM(SELECT B.id AS 'id',B.rechName AS 'rechName',A.amount AS 'amount',A.rebate_or_fee AS 'rebate_or_fee',A.updated_at AS 'updated_at',A.status AS 'status'
FROM(select username,pay_online_id,payType,amount,rebate_or_fee,updated_at,status from recharges where username = (select username from users where testFlag = '0' and recharges.username = users.username) and payType = 'onlinePayment' and status ='2' and updated_at BETWEEN ? AND ? ) AS A
INNER JOIN (select id ,rechName from pay_online_new where rechType ='onlinePayment') AS B ON A.pay_online_id = B.id) AS C
GROUP BY rechName";
        $onlinePayment = DB::select($onlinePaymentsql,[$date.' 00:00:00',$date.' 23:59:59']);

        /*银行汇款*/
        $bankTransfersql = "SELECT rechName AS 'rechname',SUM(amount) AS 'amount',SUM(rebate_or_fee) AS 'giftamount'
FROM(SELECT B.id AS 'id',B.payeeName AS 'rechName',A.amount AS 'amount',A.rebate_or_fee AS 'rebate_or_fee',A.updated_at AS 'updated_at',A.status AS 'status'
FROM(select username,pay_online_id,payType,amount,rebate_or_fee,updated_at,status from recharges where username = (select username from users where testFlag = '0' and recharges.username = users.username) and payType = 'bankTransfer' and status ='2' AND updated_at BETWEEN ? AND ? ) AS A
INNER JOIN (select id ,payeeName from pay_online_new where rechType ='bankTransfer') AS B ON A.pay_online_id = B.id) AS C
GROUP BY rechName";
        $bankTransfer = DB::select($bankTransfersql,[$date.' 00:00:00',$date.' 23:59:59']);

        /*支付宝支付*/
        $alipaysql = "SELECT rechName AS 'rechname',SUM(amount) AS 'amount',SUM(rebate_or_fee) AS 'giftamount'
FROM(SELECT B.id AS 'id',B.payeeName AS 'rechName',A.amount AS 'amount',A.rebate_or_fee AS 'rebate_or_fee',A.updated_at AS 'updated_at',A.status AS 'status'
FROM(select username,pay_online_id,payType,amount,rebate_or_fee,updated_at,status from recharges where username = (select username from users where testFlag = '0' and recharges.username = users.username) and payType = 'alipay' and status ='2' AND updated_at BETWEEN ? AND ? ) AS A
INNER JOIN (select id ,payeeName from pay_online_new where rechType ='alipay') AS B ON A.pay_online_id = B.id) AS C
GROUP BY rechName";
        $alipay = DB::select($alipaysql,[$date.' 00:00:00',$date.' 23:59:59']);

        /*微信支付*/
        $weixinsql = "SELECT rechName AS 'rechname',SUM(amount) AS 'amount',SUM(rebate_or_fee) AS 'giftamount'
FROM(SELECT B.id AS 'id',B.payeeName AS 'rechName',A.amount AS 'amount',A.rebate_or_fee AS 'rebate_or_fee',A.updated_at AS 'updated_at',A.status AS 'status'
FROM(select username,pay_online_id,payType,amount,rebate_or_fee,updated_at,status from recharges where username = (select username from users where testFlag = '0' and recharges.username = users.username) and payType = 'weixin' and status ='2' AND updated_at BETWEEN ? AND ? ) AS A
INNER JOIN (select id ,payeeName from pay_online_new where rechType ='weixin') AS B ON A.pay_online_id = B.id) AS C
GROUP BY rechName";
        $weixin = DB::select($weixinsql,[$date.' 00:00:00',$date.' 23:59:59']);

        /*财付通*/
        $cftsql = "SELECT rechName AS 'rechname',SUM(amount) AS 'amount',SUM(rebate_or_fee) AS 'giftamount'
FROM(SELECT B.id AS 'id',B.payeeName AS 'rechName',A.amount AS 'amount',A.rebate_or_fee AS 'rebate_or_fee',A.updated_at AS 'updated_at',A.status AS 'status'
FROM(select username,pay_online_id,payType,amount,rebate_or_fee,updated_at,status from recharges where username = (select username from users where testFlag = '0' and recharges.username = users.username) and payType = 'cft' and status ='2' AND updated_at BETWEEN ? AND ? ) AS A
INNER JOIN (select id ,payeeName from pay_online_new where rechType ='cft') AS B ON A.pay_online_id = B.id) AS C
GROUP BY rechName";
        $cft = DB::select($cftsql,[$date.' 00:00:00',$date.' 23:59:59']);

        /*充值(无须语法，直接前五项加总)*/

        /*后台加钱-掉单补发*/
        $adminAddMoney_reissuesql ="SELECT rechname,amount FROM(
select username,admin_add_money,payType,msg as 'rechname',SUM(amount) as 'amount',updated_at,status from recharges where username = (select username from users where testFlag = '0' and recharges.username = users.username) and payType = 'adminAddMoney' and status ='2'and admin_add_money = 2 AND updated_at BETWEEN ? AND ? 
GROUP BY admin_add_money,msg) AS A";
        $adminAddMoney_reissue= DB::select($adminAddMoney_reissuesql,[$date.' 00:00:00',$date.' 23:59:59']);

        /*后台加钱-加彩金*/
        $adminAddMoney_pluscolorsql="SELECT rechname,amount FROM(
select username,admin_add_money,payType,msg as 'rechname',SUM(amount) as 'amount',updated_at,status from recharges where username = (select username from users where testFlag = '0' and recharges.username = users.username) and payType = 'adminAddMoney' and status ='2'and admin_add_money = 1 AND updated_at BETWEEN ? AND ? 
GROUP BY admin_add_money,msg) AS A";
        $adminAddMoney_pluscolor= DB::select($adminAddMoney_pluscolorsql,[$date.' 00:00:00',$date.' 23:59:59']);

        /*后台加钱-其他*/
        $adminAddMoney_othersql="SELECT rechname,amount FROM(
select username,admin_add_money,payType,msg as 'rechname',SUM(amount) as 'amount',updated_at,status from recharges where username = (select username from users where testFlag = '0' and recharges.username = users.username) and payType = 'adminAddMoney' and status ='2'and admin_add_money = 3 AND updated_at BETWEEN ? AND ? 
GROUP BY admin_add_money,msg) AS A";
        $adminAddMoney_other= DB::select($adminAddMoney_othersql,[$date.' 00:00:00',$date.' 23:59:59']);

        /*后台加钱*/
        $adminAddMoneysql = "SELECT rechName AS 'rechname',SUM(amount) AS 'amount'
FROM(SELECT B.rechName AS 'rechName',A.amount AS 'amount',A.rebate_or_fee AS 'rebate_or_fee',A.updated_at AS 'updated_at',A.status AS 'status'
FROM(select username,admin_add_money,payType,amount,rebate_or_fee,updated_at,status from recharges where username = (select username from users where testFlag = '0' and recharges.username = users.username) and payType = 'adminAddMoney' and status ='2' AND updated_at BETWEEN ? AND ? ) AS A
INNER JOIN (select admin_add_money,case recharges.admin_add_money when '1' then '加彩金' when '2' then '掉单补发' when '3' then '其他' end as 'rechName' from recharges where payType = 'adminAddMoney' GROUP BY admin_add_money) AS B ON A.admin_add_money = B.admin_add_money) AS C
GROUP BY rechName";
        $adminAddMoney = DB::select($adminAddMoneysql,[$date.' 00:00:00',$date.' 23:59:59']);

        /*提款*/
        $drawsql = "SELECT rechName AS 'rechname',SUM(amount) AS 'amount'
FROM(SELECT B.rechName AS 'rechName',A.amount AS 'amount',A.updated_at AS 'updated_at',A.status AS 'status'
FROM(select user_id,amount,draw_type,status,updated_at from drawing where user_id = (select id from users where testFlag = '0' and drawing.user_id = users.id)and status = '2' and updated_at BETWEEN ? AND ? ) AS A
INNER JOIN (select draw_type , case drawing.draw_type when '0' then '自动出款' when '1' then '手动出款' when '2' then '后台扣钱' end as 'rechName' from drawing where status = '2' GROUP BY draw_type)AS B ON A.draw_type = B.draw_type) AS C
GROUP BY rechName";
        $draw = DB::select($drawsql,[$date.' 00:00:00',$date.' 23:59:59']);

        /*资金明细*/
        /*//to1（充值）
        $echargessql = "SELECT '充值' AS 'rechname',SUM(A.amount) AS amount
FROM (select username,amount,updated_at,status from recharges where username = (select username from users where testFlag = '0' and recharges.username = users.username) and status = '2' and updated_at BETWEEN ? AND ?  ) AS A";
        $echarges = DB::select($echargessql,[$date.' 00:00:00',$date.' 23:59:59']);*/
        //t02~t27
        $capitalsql = "SELECT rechName AS 'rechname',SUM(amount) AS 'amount'
FROM(SELECT B.rechName AS 'rechName',A.money AS 'amount',A.updated_at AS 'updated_at'
FROM(select to_user,type,money,updated_at from capital where to_user = (select id from users where testFlag = '0' and capital.to_user = users.id) and updated_at BETWEEN ? AND ? ) AS A
INNER JOIN (select type, case capital.type when 't04' then '返利/手续费' when 't05' then '下注' when 't06' then '重新开奖[中奖金额]' when 't07' then '重新开奖[退水金额]' when 't08' then '活动' when 't09' then '奖金' when 't10' then '代理结算佣金' when 't11' then '代理佣金提现' when 't12' then '代理佣金提现失败退回' when 't13' then '抢到红包' when 't14' then '退水' when 't15' then '提现' when 't16' then '撤单' when 't17' then '提现失败' when 't18' then '后台加钱' when 't19' then '后台扣钱' when 't23' then '棋牌上分' when 't24' then '棋牌下分' when 't25' then '冻结提现金额' when 't26' then '解冻金额' when 't27' then '冻结金额' when 't28' then '推广人佣金' when 't29' then '冻结[退水金额]' end as 'rechName' from capital WHERE type in ('t04','t05','t06','t07','t08','t13','t15','t16','17','t19','t23','t24','t28')  GROUP BY type)AS B ON A.type = B.type) AS C
GROUP BY rechName";
        $capital = DB::select($capitalsql,[$date.' 00:00:00',$date.' 23:59:59']);
//        $capital = array_merge($echarges,$capital);

        /*注单当日实际总输赢
        $bunkosql = "SELECT LEFT(updated_at,10) AS date,SUM(CASE WHEN game_id IN(90,91) THEN nn_view_money
ELSE(CASE WHEN bunko > 0 THEN (bunko - bet_money) ELSE bunko END) 
END) AS amount
FROM bet WHERE 1 AND testFlag ='0' AND 	updated_at BETWEEN ? AND ? ";
        $bunko = DB::select($bunkosql,[$date.' 00:00:00',$date.' 23:59:59']);*/
        /*今日实际输赢--扣除 活动金额 和 红包金额 和 入款优惠 得出的会员总输赢
        foreach ($capital as $k=>$v){
            if($v ->rechname == '活动') {
                $bunko[0]->amount += $v ->amount;
            }
            if($v ->rechname == '抢到红包') {
                $bunko[0]->amount += $v ->amount;
            }
            if($v ->rechname == '返利/手续费') {
                $bunko[0]->amount += $v ->amount;
            }
        }*/

        /*今日盈亏*/
        //to1（充值）--已包含后台加钱
        $echargessql = "SELECT '充值' AS 'rechname',SUM(A.amount) AS amount
FROM (select username,amount,updated_at,status from recharges where username = (select username from users where testFlag = '0' and recharges.username = users.username) and status = '2' and updated_at BETWEEN ? AND ?  ) AS A";
        $echarges = DB::select($echargessql,[$date.' 00:00:00',$date.' 23:59:59']);
        //t04(返利/手续费),t08(活动),t13(抢到红包),t14(退水),t23(棋牌上分),t24(棋牌下分)
        $capitallittlesql = "SELECT rechName AS 'rechname',SUM(amount) AS 'amount'
FROM(SELECT B.rechName AS 'rechName',A.money AS 'amount',A.updated_at AS 'updated_at'
FROM(select to_user,type,money,updated_at from capital where to_user = (select id from users where testFlag = '0' and capital.to_user = users.id) and updated_at BETWEEN ? AND ? ) AS A
INNER JOIN (select type, case capital.type when 't04' then '返利/手续费' when 't05' then '下注' when 't06' then '重新开奖[中奖金额]' when 't07' then '重新开奖[退水金额]' when 't08' then '活动' when 't09' then '奖金' when 't10' then '代理结算佣金' when 't11' then '代理佣金提现' when 't12' then '代理佣金提现失败退回' when 't13' then '抢到红包' when 't14' then '退水' when 't15' then '提现' when 't16' then '撤单' when 't17' then '提现失败' when 't18' then '后台加钱' when 't19' then '后台扣钱' when 't23' then '棋牌上分' when 't24' then '棋牌下分' when 't25' then '冻结提现金额' when 't26' then '解冻金额' when 't27' then '冻结金额' when 't28' then '推广人佣金' when 't29' then '冻结[退水金额]' end as 'rechName' from capital WHERE type in ('t04','t08','t13','t14','t23','t24')  GROUP BY type)AS B ON A.type = B.type) AS C
GROUP BY rechName";
        $capitallittle = DB::select($capitallittlesql,[$date.' 00:00:00',$date.' 23:59:59']);
        //会员输赢（含退水）
        $bunkofactsql = "SELECT '会员输赢（含退水）' AS 'rechname',SUM(A.amount-A.back_money) AS amount FROM(
SELECT SUM(CASE WHEN game_id IN(90,91) THEN nn_view_money
ELSE(CASE WHEN bunko > 0 THEN (bunko - bet_money) ELSE bunko END) 
END) AS amount ,SUM(bet.bet_money * bet.play_rebate) AS back_money
FROM bet WHERE 1 AND testFlag ='0' AND updated_at BETWEEN ? AND ? ) AS A";
        $bunkofact = DB::select($bunkofactsql,[$date.' 00:00:00',$date.' 23:59:59']);
        //未结算
        $nowtime = date('Y-m-d H',strtotime('-1 day')); //搭配定时任务的执行时间为 00时
        $executtime = date('Y-m-d H',strtotime($date));
        if($nowtime == $executtime){  //定时任务时间与输入执行日期一致
            \Log::info('「会员对帐」功能定时任务执行了。');
            $unsettlementsql= "SELECT '未结算' AS 'rechname',SUM(CASE WHEN game_id IN(90,91) THEN freeze_money ELSE bet_money END) AS amount
FROM bet WHERE 1 AND testFlag ='0' AND bunko= '0' AND updated_at BETWEEN ? AND ?";
            $unsettlement = DB::select($unsettlementsql,[$date.' 00:00:00',$date.' 23:59:59']);

            $unsettlementlogsql = "SELECT * FROM bet WHERE 1 AND testFlag ='0' AND bunko= '0' AND updated_at BETWEEN ? AND ?";
            $unsettlementlog = DB::select($unsettlementlogsql,[$date.' 00:00:00',$date.' 23:59:59']);
            \Log::info('未结算执行加总的语法: '."SELECT '未结算' AS 'rechname',SUM(CASE WHEN game_id IN(90,91) THEN freeze_money ELSE bet_money END) AS amount FROM bet WHERE 1 AND testFlag ='0' AND bunko= '0' AND updated_at BETWEEN ".$date." 00:00:00 AND ".$date." 23:59:59");
            \Log::info('未结算执行捞数据的语法: '."SELECT * FROM bet WHERE 1 AND testFlag ='0' AND bunko= '0' AND updated_at BETWEEN ".$date." 00:00:00 AND ".$date." 23:59:59");
            \Log::info(json_encode($unsettlementlog));
        }else{
           /*//试算，有点问题
           $datetom = date('Y-m-d',strtotime($date."+1 days"));
           $unsettlementsql= "SELECT '未结算' AS 'rechname',SUM(A.amount+A.bunko) AS amount
FROM( SELECT SUM(CASE WHEN game_id IN(90,91) THEN `freeze_money` ELSE `bet_money` END) AS amount,
SUM(CASE WHEN game_id IN(90,91) THEN nn_view_money ELSE(CASE WHEN bunko > 0 THEN (bunko - bet_money) ELSE bunko END) END) AS bunko
FROM bet WHERE 1 AND testFlag ='0' AND `created_at` BETWEEN ? AND ? AND updated_at BETWEEN ? AND ?) AS A";
            $unsettlement = DB::select($unsettlementsql,[$date.' 00:00:00',$date.' 23:59:59',$datetom.' 00:00:00',$datetom.' 23:59:59']);*/
            \Log::info('「会员对帐」功能重新执行按钮执行了。');
            $val = 0.00;
            $unsettlementsql = "SELECT data FROM totalreport WHERE daytstrot = ".strtotime($date);
            $unsettlement = DB::select($unsettlementsql);
            \Log::info('执行的语法: '.$unsettlementsql);
            $dataunsettlement = unserialize($unsettlement[0]->data)[$date];
            if(isset($dataunsettlement['todayprofitlossitem'])){
                \Log::info('捞到今日盈亏的数据: '.json_encode($dataunsettlement['todayprofitlossitem']));
                foreach ($dataunsettlement['todayprofitlossitem'] as $k=>$v){
                    if($v->rechname == "未结算"){
                        $val =  $v->amount;
                    }
                }
            }
            $unsettlement =[
                (object)[
                    "rechname" => "未结算",
                    "amount" => $val
                ]
            ];
            \Log::info('最后处理好的值 '.json_encode($unsettlement));
        }

        $merge1 = array_merge($echarges,$capitallittle);
        $merge2 = array_merge($merge1,$bunkofact);
        $merge3 = array_merge($merge2,$unsettlement);
        $todayprofitlossitem = array_merge($merge3,$draw);
        $profitlosstal = 0;
        foreach ($todayprofitlossitem as $k=>$v){
            if($v ->rechname == '充值') {
                $profitlosstal += $v ->amount;
            }
            if($v ->rechname == '返利/手续费') {
                $profitlosstal += $v ->amount;
            }
            if($v ->rechname == '活动') {
                $profitlosstal += $v ->amount;
            }
            if($v ->rechname == '抢到红包') {
                $profitlosstal += $v ->amount;
            }
            if($v ->rechname == '退水') {
                $profitlosstal += $v ->amount;
            }
            if($v ->rechname == '棋牌上分') {
                $profitlosstal -= $v ->amount;
            }
            if($v ->rechname == '棋牌下分') {
                $profitlosstal += $v ->amount;
            }
            if($v ->rechname == '会员输赢（含退水）') {
                $profitlosstal += $v ->amount;
            }
            if($v ->rechname == '未结算') {
                $profitlosstal -= $v ->amount;
            }
            //提款
            if($v ->rechname == '自动出款') {
                $profitlosstal -= $v ->amount;
            }
            if($v ->rechname == '手动出款') {
                $profitlosstal -= $v ->amount;
            }
            if($v ->rechname == '后台扣钱') {
                $profitlosstal -= $v ->amount;
            }
        }
        $todayprofitloss=[
            (object)[
                "rechname" => "今日盈亏",
                "amount" => $profitlosstal,
            ]
        ];

        $data[$date] = [
            'onlinePayment' => $this->arrayunset($onlinePayment),
            'bankTransfer' => $this->arrayunset($bankTransfer),
            'alipay'=> $this->arrayunset($alipay),
            'weixin' => $this->arrayunset($weixin),
            'cft' => $this->arrayunset($cft),
            'adminAddMoney_reissue' => $this->arrayunset($adminAddMoney_reissue),
            'adminAddMoney_pluscolor' => $this->arrayunset($adminAddMoney_pluscolor),
            'adminAddMoney_other' => $this->arrayunset($adminAddMoney_other),
            'adminAddMoney' => $this->arrayunset($adminAddMoney),
            'draw' => $this->arrayunset($draw),
            'capital' => $this->arrayunset($capital),
            'bunko' => $bunkofact,
            'todayprofitloss' => $todayprofitloss,
            'todayprofitlossitem' => $todayprofitlossitem,
        ];
        $serdata =  serialize($data);

        if(empty($this->argument('dayTime'))){
            $ispresencesql = 'SELECT * FROM totalreport WHERE daytstrot = \''.$daytstrot.'\'';
            $ispresence = DB::select($ispresencesql);

            $datatotalreport['data']=$serdata;
            $datatotalreport['updated_at']=date('Y-m-d H:i:s');

            if (!empty($ispresence)){
                $datatotalreport['operation_account']='系统';
                try{
                    DB::table('totalreport')
                        ->where('daytstrot', $daytstrot)
                        ->update($datatotalreport);
                } catch (\Exception $exception){
                    \Log::info(__CLASS__ . '->' . __FUNCTION__ . ' Line:' . $exception->getLine() . ' ' . $exception->getMessage());
                    $this->error('update to totalreport error');
                }
                $this->info('update to totalreport successfully');
                \Log::info('系统  执行「会员对帐」功能 （daytstrot：'.$daytstrot.'）');
            }else{
                /*今日会员馀额*/
                $useramountsql = "SELECT SUM(A.money) AS 'amount' FROM (select id,money from users where testFlag = '0') AS A";
                $useramount =  DB::select($useramountsql);
                foreach ($useramount as $k=>$v){
                    $memberquota=$v->amount;
                }
                /*昨日会员馀额*/
                $memberquotaydaysql = "SELECT memberquota FROM totalreport WHERE daytstrot = ".strtotime("-1day",$daytstrot);
                $memberquotayday = DB::select($memberquotaydaysql);

                $datatotalreport['daytstrot']=$daytstrot;
                $datatotalreport['daytime']=$date;
                $datatotalreport['memberquota']=$memberquota;
                $datatotalreport['memberquotayday']=empty($memberquotayday[0]->memberquota)?0:$memberquotayday[0]->memberquota;
                $datatotalreport['created_at']=date('Y-m-d H:i:s');
                try{
                    DB::table('totalreport')->insert([$datatotalreport]);
                } catch (\Exception $exception){
                    \Log::info(__CLASS__ . '->' . __FUNCTION__ . ' Line:' . $exception->getLine() . ' ' . $exception->getMessage());
                    $this->error('insert to totalreport error');
                }
                $this->info('insert to totalreport successfully');
                \Log::info('系统  执行「会员对帐」功能 （daytstrot：'.$daytstrot.'）');
            }
        }else{
            $datatotalreport['data']=$serdata;
            $datatotalreport['operation_account']=$this->argument('user');
            $datatotalreport['updated_at']=date('Y-m-d H:i:s');

            try{
                DB::table('totalreport')
                    ->where('daytstrot', $daytstrot)
                    ->update($datatotalreport);
            } catch (\Exception $exception){
                \Log::info(__CLASS__ . '->' . __FUNCTION__ . ' Line:' . $exception->getLine() . ' ' . $exception->getMessage());
                $this->error('update to totalreport error');
            }
            \Log::info('操作人：'.$this->argument('user').'  执行「会员对帐」功能 （daytstrot：'.$daytstrot.'）');
            $this->info('update to totalreport successfully');
        }
    }

    private function arrayunset($array){
        foreach ($array as $k=>$v){
            if($v->amount <= 0)
                unset($array[$k]);
        }
        return $array;
    }
}
