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
        if(!empty($this->argument('dayTime')) && $this->argument('dayTime') == "insert"){  //定时任务搭配执行--只取会员余额和未结算的金额
            $date = date('Y-m-d',strtotime('-1 day'));
            $daytstrot = strtotime($date);

            /*今日会员馀额*/
            $useramountsql = "SELECT SUM(A.money) AS 'amount' FROM (select id,money from users where testFlag = '0') AS A";
            $useramount =  DB::select($useramountsql);
            /*昨日会员馀额*/
            $memberquotaydaysql = "SELECT memberquota FROM totalreport WHERE daytstrot = ".strtotime("-1day",$daytstrot);
            $memberquotayday = DB::select($memberquotaydaysql);

            $data[$date] = [
                'onlinePayment' => [],
                'bankTransfer' => [],
                'alipay'=> [],
                'alipaySm'=> [],
                'weixin' => [],
                'weixinSm'=> [],
                'cft' => [],
                'ysf' => [],
                'draw' => [],
                'activity' => [],
                'redEnvelope' => [],
                'capital' => [],
                'adminAddMoney_reissue' => [],
                'adminAddMoney_pluscolor' => [],
                'adminAddMoney_other' => [],
                'adminAddMoney' => [],
                'bunko' => [],
                'thirdbunkofact' => [],
                'todayprofitloss' => [],
                'todayprofitlossitem' => [],
            ];
            $serdata =  serialize($data);

            $datatotalreport['daytstrot']=$daytstrot;
            $datatotalreport['daytime']=$date;
            $datatotalreport['data']=$serdata;
            $datatotalreport['memberquota']=$useramount[0]->amount;
            $datatotalreport['created_at']=date('Y-m-d H:i:s');
            $datatotalreport['updated_at']=date('Y-m-d H:i:s');
            $datatotalreport['memberquotayday']=empty($memberquotayday[0]->memberquota)?0:$memberquotayday[0]->memberquota;
            $datatotalreport['unsetamount']=0.00;
            $datatotalreport['unsetamountnum']=NULL;
            try{
                DB::table('totalreport')->insert([$datatotalreport]);
            } catch (\Exception $exception){
                writeLog('error',__CLASS__ . '->' . __FUNCTION__ . ' Line:' . $exception->getLine() . ' ' . $exception->getMessage());
                $this->error('insert to totalreport error');
            }
            writeLog('DailyReconTotal','memberquota: '.$datatotalreport['memberquota']);
            writeLog('DailyReconTotal','memberquotayday: '.$datatotalreport['memberquotayday']);
            $this->info('insert to totalreport successfully');
            writeLog('DailyReconTotal','系统  执行「会员对帐」功能 （daytstrot：'.$daytstrot.'）');

            die;
        }

        $date = empty($this->argument('dayTime'))?date('Y-m-d',strtotime('-1 day')):date('Y-m-d',strtotime(date($this->argument('dayTime'))));
        $daytstrot = strtotime($date);

        /*在线支付*/
        /* $onlinePaymentsql = "SELECT rechName AS 'rechname',SUM(amount) AS 'amount',SUM(rebate_or_fee) AS 'giftamount'
 FROM(SELECT B.id AS 'id',B.rechName AS 'rechName',A.amount AS 'amount',A.rebate_or_fee AS 'rebate_or_fee',A.updated_at AS 'updated_at',A.status AS 'status'
 FROM(select username,pay_online_id,payType,amount,rebate_or_fee,updated_at,status from recharges where username = (select username from users where testFlag = '0' and recharges.username = users.username) and payType = 'onlinePayment' and status ='2' and updated_at BETWEEN ? AND ? ) AS A
 INNER JOIN (select id ,rechName from pay_online_new where rechType ='onlinePayment') AS B ON A.pay_online_id = B.id) AS C
 GROUP BY rechName";*/
        $onlinePaymentsql = "SELECT  id,shou_info AS 'rechname',SUM(amount) AS 'amount',SUM(rebate_or_fee) AS 'giftamount' FROM(
select username,pay_online_id AS 'id',shou_info,payType,amount,rebate_or_fee,updated_at,status from recharges 
 where username = (select username from users where testFlag = '0' and recharges.username = users.username) and payType = 'onlinePayment' and status ='2' and updated_at  BETWEEN ? AND ? )AS A GROUP BY id";
        $onlinePayment = DB::select($onlinePaymentsql,[$date.' 00:00:00',$date.' 23:59:59']);
        foreach ($onlinePayment as $k=>$v){
            unset($v->id);
            $snum = strrpos($v->rechname,">")+1;
            $restr = substr($v->rechname,$snum);
            $v->rechname = $restr;
        }

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

        /*支付宝扫码*/
        $alipaySmsql = "SELECT rechName AS 'rechname',SUM(amount) AS 'amount',SUM(rebate_or_fee) AS 'giftamount'
FROM(SELECT B.id AS 'id',B.payeeName AS 'rechName',A.amount AS 'amount',A.rebate_or_fee AS 'rebate_or_fee',A.updated_at AS 'updated_at',A.status AS 'status'
FROM(select username,pay_online_id,payType,amount,rebate_or_fee,updated_at,status from recharges where username = (select username from users where testFlag = '0' and recharges.username = users.username) and payType = 'alipaySm' and status ='2' AND updated_at BETWEEN ? AND ? ) AS A
INNER JOIN (select id ,payeeName from pay_online_new where rechType ='alipaySm') AS B ON A.pay_online_id = B.id) AS C
GROUP BY rechName";
        $alipaySm = DB::select($alipaySmsql,[$date.' 00:00:00',$date.' 23:59:59']);

        /*微信支付*/
        $weixinsql = "SELECT rechName AS 'rechname',SUM(amount) AS 'amount',SUM(rebate_or_fee) AS 'giftamount'
FROM(SELECT B.id AS 'id',B.payeeName AS 'rechName',A.amount AS 'amount',A.rebate_or_fee AS 'rebate_or_fee',A.updated_at AS 'updated_at',A.status AS 'status'
FROM(select username,pay_online_id,payType,amount,rebate_or_fee,updated_at,status from recharges where username = (select username from users where testFlag = '0' and recharges.username = users.username) and payType = 'weixin' and status ='2' AND updated_at BETWEEN ? AND ? ) AS A
INNER JOIN (select id ,payeeName from pay_online_new where rechType ='weixin') AS B ON A.pay_online_id = B.id) AS C
GROUP BY rechName";
        $weixin = DB::select($weixinsql,[$date.' 00:00:00',$date.' 23:59:59']);

        /*微信支付扫码*/
        $weixinSmsql = "SELECT rechName AS 'rechname',SUM(amount) AS 'amount',SUM(rebate_or_fee) AS 'giftamount'
FROM(SELECT B.id AS 'id',B.payeeName AS 'rechName',A.amount AS 'amount',A.rebate_or_fee AS 'rebate_or_fee',A.updated_at AS 'updated_at',A.status AS 'status'
FROM(select username,pay_online_id,payType,amount,rebate_or_fee,updated_at,status from recharges where username = (select username from users where testFlag = '0' and recharges.username = users.username) and payType = 'weixinSm' and status ='2' AND updated_at BETWEEN ? AND ? ) AS A
INNER JOIN (select id ,payeeName from pay_online_new where rechType ='weixinSm') AS B ON A.pay_online_id = B.id) AS C
GROUP BY rechName";
        $weixinSm = DB::select($weixinSmsql,[$date.' 00:00:00',$date.' 23:59:59']);

        /*财付通*/
        $cftsql = "SELECT rechName AS 'rechname',SUM(amount) AS 'amount',SUM(rebate_or_fee) AS 'giftamount'
FROM(SELECT B.id AS 'id',B.payeeName AS 'rechName',A.amount AS 'amount',A.rebate_or_fee AS 'rebate_or_fee',A.updated_at AS 'updated_at',A.status AS 'status'
FROM(select username,pay_online_id,payType,amount,rebate_or_fee,updated_at,status from recharges where username = (select username from users where testFlag = '0' and recharges.username = users.username) and payType = 'cft' and status ='2' AND updated_at BETWEEN ? AND ? ) AS A
INNER JOIN (select id ,payeeName from pay_online_new where rechType ='cft') AS B ON A.pay_online_id = B.id) AS C
GROUP BY rechName";
        $cft = DB::select($cftsql,[$date.' 00:00:00',$date.' 23:59:59']);

        /*云闪付*/
        $ysfsql = "SELECT rechName AS 'rechname',SUM(amount) AS 'amount',SUM(rebate_or_fee) AS 'giftamount'
FROM(SELECT B.id AS 'id',B.payeeName AS 'rechName',A.amount AS 'amount',A.rebate_or_fee AS 'rebate_or_fee',A.updated_at AS 'updated_at',A.status AS 'status'
FROM(select username,pay_online_id,payType,amount,rebate_or_fee,updated_at,status from recharges where username = (select username from users where testFlag = '0' and recharges.username = users.username) and payType = 'ysf' and status ='2' AND updated_at BETWEEN ? AND ? ) AS A
INNER JOIN (select id ,payeeName from pay_online_new where rechType ='ysf') AS B ON A.pay_online_id = B.id) AS C
GROUP BY rechName";
        $ysf = DB::select($ysfsql,[$date.' 00:00:00',$date.' 23:59:59']);

        /*充值(无须语法，直接前七项加总)*/

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
INNER JOIN (select type, case capital.type when 't04' then '返利/手续费' when 't05' then '下注' when 't06' then '重新开奖[中奖金额]' when 't07' then '重新开奖[退水金额]' when 't08' then '活动' when 't09' then '奖金' when 't10' then '代理结算佣金' when 't11' then '代理佣金提现' when 't12' then '代理佣金提现失败退回' when 't13' then '聊天室红包' when 't14' then '退水' when 't15' then '提现' when 't16' then '撤单' when 't17' then '提现失败' when 't18' then '后台加钱' when 't19' then '后台扣钱' when 't23' then '第三方游戏上分' when 't24' then '第三方游戏下分' when 't25' then '冻结提现金额' when 't26' then '解冻金额' when 't27' then '冻结金额' when 't28' then '推广人佣金' when 't29' then '冻结[退水金额]' when 't30' then '第三方游戏上分失败退回' end as 'rechName' from capital WHERE type in ('t04','t05','t06','t07','t08','t13','t15','t16','17','t19','t23','t24','t28','t30')  GROUP BY type)AS B ON A.type = B.type) AS C
GROUP BY rechName";
        $capital = DB::select($capitalsql,[$date.' 00:00:00',$date.' 23:59:59']);
//        $capital = array_merge($echarges,$capital);
        writeLog('DailyReconTotal','$capital: '.json_encode($capital));

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

        /*今日盈亏*/
        //to1（充值）--已包含后台加钱
        $echargessql = "SELECT '充值' AS 'rechname',SUM(A.amount) AS amount
FROM (select username,amount,updated_at,status from recharges where username = (select username from users where testFlag = '0' and recharges.username = users.username) and status = '2' and updated_at BETWEEN ? AND ?  ) AS A";
        $echarges = DB::select($echargessql,[$date.' 00:00:00',$date.' 23:59:59']);
        //t04(返利/手续费),t08(活动),t13(聊天室红包),t14(退水),t23(第三方游戏上分),t24(第三方游戏下分),t30(第三方游戏上分失败退回)
        $capitallittlesql = "SELECT rechName AS 'rechname',SUM(amount) AS 'amount'
FROM(SELECT B.rechName AS 'rechName',A.money AS 'amount',A.updated_at AS 'updated_at'
FROM(select to_user,type,money,updated_at from capital where to_user = (select id from users where testFlag = '0' and capital.to_user = users.id) and updated_at BETWEEN ? AND ? ) AS A
INNER JOIN (select type, case capital.type when 't04' then '返利/手续费' when 't05' then '下注' when 't06' then '重新开奖[中奖金额]' when 't07' then '重新开奖[退水金额]' when 't08' then '活动' when 't09' then '奖金' when 't10' then '代理结算佣金' when 't11' then '代理佣金提现' when 't12' then '代理佣金提现失败退回' when 't13' then '聊天室红包' when 't14' then '退水' when 't15' then '提现' when 't16' then '撤单' when 't17' then '提现失败' when 't18' then '后台加钱' when 't19' then '后台扣钱' when 't23' then '第三方游戏上分' when 't24' then '第三方游戏下分' when 't25' then '冻结提现金额' when 't26' then '解冻金额' when 't27' then '冻结金额' when 't28' then '推广人佣金' when 't29' then '冻结[退水金额]' when 't30' then '第三方游戏上分失败退回' end as 'rechName' from capital WHERE type in ('t04','t08','t13','t14','t23','t24','t30')  GROUP BY type)AS B ON A.type = B.type) AS C
GROUP BY rechName";
        $capitallittle = DB::select($capitallittlesql,[$date.' 00:00:00',$date.' 23:59:59']);
        /*彩票会员输赢（含退水）& 第三方今日输赢*/
        $bunkoday='2019-07-12'; //彩票会员输赢时间分界点
        $bunkodaytstrot=strtotime($bunkoday);
        if($bunkodaytstrot > $daytstrot){
            $bunkofactdata = $this->bunkofactdata($date);
            $bunkofactsql = $bunkofactdata[0];
            $thirdbunkofactsql = $bunkofactdata[1];
        }else{
            $bunkofactsql = "SELECT (CASE game_name WHEN '彩票' THEN '彩票会员输赢（含退水）' ELSE game_name END) AS 'rechname',SUM(bet_bunko) AS 'amount' FROM `zh_report_general_bunko` WHERE game_id=0 AND dateTime = ? GROUP BY game_id";
            $thirdbunkofactsql = "SELECT (CASE game_name WHEN '彩票' THEN '彩票会员输赢（含退水）' ELSE game_name END) AS 'rechname',SUM(bet_bunko) AS 'amount' FROM `zh_report_general_bunko` WHERE game_id<>0 AND dateTime = ? GROUP BY game_id";
        }
        $bunkofact = DB::select($bunkofactsql,[$daytstrot]);
        $thirdbunkofact = DB::select($thirdbunkofactsql,[$daytstrot]);

        /*//未结算试算，有点问题
           $datetom = date('Y-m-d',strtotime($date."+1 days"));
           $unsettlementsql= "SELECT '未结算' AS 'rechname',SUM(A.amount+A.bunko) AS amount
FROM( SELECT SUM(CASE WHEN game_id IN(90,91) THEN `freeze_money` ELSE `bet_money` END) AS amount,
SUM(CASE WHEN game_id IN(90,91) THEN nn_view_money ELSE(CASE WHEN bunko > 0 THEN (bunko - bet_money) ELSE bunko END) END) AS bunko
FROM bet WHERE 1 AND testFlag ='0' AND `created_at` BETWEEN ? AND ? AND updated_at BETWEEN ? AND ?) AS A";
            $unsettlement = DB::select($unsettlementsql,[$date.' 00:00:00',$date.' 23:59:59',$datetom.' 00:00:00',$datetom.' 23:59:59']);*/
        /*未结算*/
        $val = 0.00;
        if(empty($this->argument('dayTime'))){            //系统执行
            /*未结算金额*/
            $unsettlementsql= "SELECT SUM(CASE WHEN game_id IN(90,91) THEN freeze_money+bet_money ELSE bet_money END) AS amount FROM bet WHERE 1 AND testFlag ='0' AND status='0' AND updated_at BETWEEN ? AND ?";
            $unsettlement = DB::select($unsettlementsql,[$date.' 00:00:00',$date.' 23:59:59']);

            $unsetamountsql = "SELECT unsetamount FROM totalreport WHERE daytstrot = ".$daytstrot;
            $unsetamount = DB::select($unsetamountsql);
            if(empty($unsetamount)){
                $this->info('不该进来这段的！表示定时任务没有设定 php artisan Member:DailyReconTotal insert');
            }
            $val = empty($unsettlement[0]->amount)?$val:$unsettlement[0]->amount;

            /*未结算bet_id*/
            $unsettlementidsql= "SELECT bet_id FROM bet WHERE 1 AND testFlag ='0' AND status='0' AND updated_at BETWEEN ? AND ?";
            $unsettlementid = DB::select($unsettlementidsql,[$date.' 00:00:00',$date.' 23:59:59']);
            if(empty($unsettlementid)){
                $unsettlementidstr=NULL;
            }else{
                $unsettlementidstr='';
                foreach ($unsettlementid as $k=>$v){
                    $unsettlementidstr .=$v->bet_id.',';
                }
                $unsettlementidstr=substr($unsettlementidstr,0,-1);
            }

        }else{                                            //「重新执行」按钮执行
            $unsetamountsql = "SELECT unsetamount FROM totalreport WHERE daytstrot = ".$daytstrot;
            $unsetamount = DB::select($unsetamountsql);
            if(empty($unsetamount)){
                $this->info('没有'.$date.'的这笔资料可以重新执行');
            }else if(!empty($unsetamount) && $unsetamount[0]->unsetamount != "0.00"){
                $val = $unsetamount[0]->unsetamount;
            }else{
                $unsettlementsql = "SELECT data FROM totalreport WHERE daytstrot = ".$daytstrot;
                $unsettlement = DB::select($unsettlementsql);
                writeLog('DailyReconTotal','执行的语法: '.$unsettlementsql);
                $dataunsettlement = unserialize($unsettlement[0]->data)[$date];
                if(isset($dataunsettlement['todayprofitlossitem'])){
                    writeLog('DailyReconTotal','捞到今日盈亏的数据: '.json_encode($dataunsettlement['todayprofitlossitem']));
                    foreach ($dataunsettlement['todayprofitlossitem'] as $k=>$v){
                        if($v->rechname == "未结算"){
                            $val = empty($v->amount)?$val:$v->amount;
                        }
                    }
                }
                $updateunsetamount['unsetamount'] = $val;
                try{
                    DB::table('totalreport')
                        ->where('daytstrot', $daytstrot)
                        ->update($updateunsetamount);
                } catch (\Exception $exception){
                    writeLog('error',__CLASS__ . '->' . __FUNCTION__ . ' Line:' . $exception->getLine() . ' ' . $exception->getMessage());
                    $this->error('update to totalreport error');
                }
                $this->info('「重新执行」按钮执行并自动更新 新栏位`unsetamount` 的值为 '.$val);
            }
        }
        $unsettlement =[
            (object)[
                "rechname" => "未结算",
                "amount" => $val
            ]
        ];
        writeLog('DailyReconTotal','未结算 最后处理好的值 '.json_encode($unsettlement));

        $merge1 = array_merge($echarges,$capitallittle);
        $merge2 = array_merge($merge1,$bunkofact);
        $merge3 = array_merge($merge2,$unsettlement);
        $merge4 = array_merge($merge3,$draw);
        $activity = 0;
        $redEnvelope = 0;
        $profitlosstal = 0;                         //彩票今日盈亏(根据业务逻辑的金额)
        $actuallywinlose = empty($bunkofact)?0:$bunkofact[0]->amount;   //彩票今日实际输赢（含退水）= 彩票会员输赢（含退水）+ 红包金额 + 返利/手续费 + 活动金额
        foreach ($merge4 as $k=>$v){
            if($v ->rechname == '充值') {
                $profitlosstal += $v ->amount;
            }
            if($v ->rechname == '返利/手续费') {
                $profitlosstal += $v ->amount;
                $actuallywinlose += $v ->amount;
            }
            if($v ->rechname == '活动') {
                $profitlosstal += $v ->amount;
                $actuallywinlose += $v ->amount;
                $activity += $v ->amount;
            }
            if($v ->rechname == '聊天室红包') {
                $profitlosstal += $v ->amount;
                $actuallywinlose += $v ->amount;
                $redEnvelope += $v ->amount;
            }
            /*if($v ->rechname == '退水') {
            }*/
            if($v ->rechname == '第三方游戏上分') {
                $profitlosstal -= $v ->amount;
            }
            if($v ->rechname == '第三方游戏下分') {
                $profitlosstal += $v ->amount;
            }
            if($v ->rechname == '第三方游戏上分失败退回') {
                $profitlosstal += $v ->amount;
            }
            if($v ->rechname == '彩票会员输赢（含退水）') {
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
        $activityarray = [
            (object)[
                "rechname" => "活动",
                "amount" => $activity
            ]
        ];
        $redEnvelopearray = [
            (object)[
                "rechname" => "聊天室红包",
                "amount" => $redEnvelope
            ]
        ];
        $actuallywinlosearay =[
            (object)[
                "rechname" => "彩票今日实际输赢（含退水）",
                "amount" => $actuallywinlose
            ]
        ];

        /*处理坏帐*/
        $ispresencesql = 'SELECT * FROM totalreport WHERE daytstrot = \''.$daytstrot.'\'';
        $ispresence = DB::select($ispresencesql);
        $todayprofitloss=[
            (object)[
                "rechname" => "彩票今日盈亏",
                "amount" => $ispresence[0]->memberquota -  $ispresence[0]->memberquotayday,  //今日会员余额 - 昨日会员余额
            ]
        ];
        $badDebt = [
            (object)[
                "rechname" => "坏帐",
                "amount" => $ispresence[0]->memberquota -  $ispresence[0]->memberquotayday - $profitlosstal //今日会员余额 - 昨日会员余额 - 彩票今日盈亏(根据业务逻辑的金额)
            ]
        ];
        $todayprofitlossitem = array_merge($merge4,$badDebt);

        $data[$date] = [
            'onlinePayment' => $this->arrayunset($onlinePayment),   //在线支付
            'bankTransfer' => $this->arrayunset($bankTransfer),     //银行汇款
            'alipay'=> $this->arrayunset($alipay),                  //支付宝支付
            'alipaySm'=> $this->arrayunset($alipaySm),              //支付宝扫码
            'weixin' => $this->arrayunset($weixin),                 //微信支付
            'weixinSm' => $this->arrayunset($weixinSm),             //微信扫码
            'cft' => $this->arrayunset($cft),                       //财付通
            'ysf' => $this->arrayunset($ysf),                       //云闪付
            'draw' => $this->arrayunset($draw),                     //提款
            'activity' => $activityarray,                           //活动
            'redEnvelope' => $redEnvelopearray,                     //聊天室红包
            'capital' => $this->arrayunset($capital),               //资金明细
            'adminAddMoney_reissue' => $this->arrayunset($adminAddMoney_reissue),       //后台加钱-掉单补发
            'adminAddMoney_pluscolor' => $this->arrayunset($adminAddMoney_pluscolor),   //后台加钱-加彩金
            'adminAddMoney_other' => $this->arrayunset($adminAddMoney_other),           //后台加钱-其他
            'adminAddMoney' => $this->arrayunset($adminAddMoney),                       //后台加钱
            'bunko' => $actuallywinlosearay,                        //彩票今日实际输赢（含退水）
            'thirdbunkofact' => $thirdbunkofact,                    //第三方今日输赢
            'todayprofitloss' => $todayprofitloss,                  //彩票今日盈亏(今日会员余额 - 昨日会员余额)
            'todayprofitlossitem' => $todayprofitlossitem,          //彩票今日盈亏(明细)
        ];
        $serdata =  serialize($data);

        if(empty($this->argument('dayTime'))){
            $datatotalreport['data']=$serdata;
            $datatotalreport['updated_at']=date('Y-m-d H:i:s');

            if (!empty($ispresence)){
                $datatotalreport['operation_account']='系统';
                $datatotalreport['unsetamount']=$val;
                $datatotalreport['unsetamountnum']=$unsettlementidstr;

                try{
                    DB::table('totalreport')
                        ->where('daytstrot', $daytstrot)
                        ->update($datatotalreport);
                } catch (\Exception $exception){
                    writeLog('DailyReconTotal',__CLASS__ . '->' . __FUNCTION__ . ' Line:' . $exception->getLine() . ' ' . $exception->getMessage());
                    $this->error('update to totalreport error');
                }
                $this->info('system update to totalreport successfully');
                writeLog('DailyReconTotal','系统  执行「会员对帐」功能 （daytstrot：'.$daytstrot.'）');
            }else{
                /*今日会员馀额*/
                $useramountsql = "SELECT SUM(A.money) AS 'amount' FROM (select id,money from users where testFlag = '0') AS A";
                $useramount =  DB::select($useramountsql);
                $useramountstr = $useramount[0]->amount;
                /*昨日会员馀额*/
                $memberquotaydaysql = "SELECT memberquota FROM totalreport WHERE daytstrot = ".strtotime("-1day",$daytstrot);
                $memberquotayday = DB::select($memberquotaydaysql);
                $memberquotaydaystr = empty($memberquotayday[0]->memberquota)?0:$memberquotayday[0]->memberquota;
                /*未结算金额*/
                $unsettlementsql= "SELECT SUM(CASE WHEN game_id IN(90,91) THEN freeze_money+bet_money ELSE bet_money END) AS amount FROM bet WHERE 1 AND testFlag ='0' AND status='0' AND updated_at BETWEEN ? AND ?";
                $unsettlement = DB::select($unsettlementsql,[$date.' 00:00:00',$date.' 23:59:59']);
                $unsettlementstr =$unsettlement[0]->amount;
                /*未结算bet_id*/
                $unsettlementidsql= "SELECT bet_id FROM bet WHERE 1 AND testFlag ='0' AND status='0' AND updated_at BETWEEN ? AND ?";
                $unsettlementid = DB::select($unsettlementidsql,[$date.' 00:00:00',$date.' 23:59:59']);
                $unsettlementidstr='';
                foreach ($unsettlementid as $k=>$v){
                    $unsettlementidstr .=$v->bet_id.',';
                }
                $unsettlementidstr=substr($unsettlementidstr,0,-1);
/*
                $datatotalreport['daytstrot']=$daytstrot;
                $datatotalreport['daytime']=$date;
                $datatotalreport['memberquota']=$useramountstr;
                $datatotalreport['memberquotayday']=$memberquotaydaystr;
                $datatotalreport['created_at']=date('Y-m-d H:i:s');
                try{
                    DB::table('totalreport')->insert([$datatotalreport]);
                } catch (\Exception $exception){
                    writeLog('error',__CLASS__ . '->' . __FUNCTION__ . ' Line:' . $exception->getLine() . ' ' . $exception->getMessage());
                    $this->error('insert to totalreport error');
                }
                writeLog('DailyReconTotal','data: '.$datatotalreport['data']);
                writeLog('DailyReconTotal','memberquota: '.$datatotalreport['memberquota']);
                writeLog('DailyReconTotal','memberquotayday: '.$datatotalreport['memberquotayday']);
                writeLog('DailyReconTotal','系统  执行「会员对帐」功能 （daytstrot：'.$daytstrot.'）');
*/
                $this->info('不该进来这段的！表示定时任务没有设定 php artisan Member:DailyReconTotal insert');
                $this->info('**********************************************************************************');
                $this->info("INSERT INTO totalreport (`daytstrot`,`daytime`,`data`,`memberquota`,`operation_account`,`created_at`,`updated_at`,`memberquotayday`,`unsetamount`,`unsetamountnum`) 
                              VALUES ('".$daytstrot."','".$date."','".$serdata."','".$useramountstr."','系统','".date('Y-m-d H:i:s')."','".date('Y-m-d H:i:s')."','".$memberquotaydaystr."'),'".$unsettlementstr."','".$unsettlementidstr."'");
                $this->info('**********************************************************************************');
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
                writeLog('error',__CLASS__ . '->' . __FUNCTION__ . ' Line:' . $exception->getLine() . ' ' . $exception->getMessage());
                $this->error('update to totalreport error');
            }
            writeLog('DailyReconTotal','操作人：'.$this->argument('user').'  执行「会员对帐」功能 （daytstrot：'.$daytstrot.'）');
            $this->info($this->argument('user').' update to totalreport successfully');
        }
    }

    private function arrayunset($array){
        foreach ($array as $k=>$v){
            if($v->amount == 0){
                unset($array[$k]);
            }
            if($v->amount < 0){
                $v->amount=-($v->amount);
            }
        }
        return $array;
    }

    //彩票会员输赢（含退水）--重新执行，综合报表没有数据才进来这里
    private function bunkofactdata($date){
        //---amount彩票会员输赢（不含退水）/ back_money(退水)
        $today = date('Y-m-d');
//        $yesterday = date('Y-m-d',strtotime('-1 day'));
        if($date == $today){  // || $date == $yesterday  (bet表 每晚12点过后都要搬到bet_his表里，条件是:非未结算的状态都搬到bet_his)
            $bunkofactsql = "SELECT '彩票会员输赢（含退水）' AS 'rechname',SUM(A.amount+A.back_money) AS amount FROM(
SELECT SUM(CASE WHEN game_id IN(90,91) THEN nn_view_money
ELSE(CASE WHEN bunko > 0 THEN (bunko - bet_money) ELSE bunko END) 
END) AS amount ,SUM(bet.bet_money * bet.play_rebate) AS back_money
FROM bet WHERE 1 AND testFlag =0 AND status = 1 AND updated_at BETWEEN ? AND ? ) AS A";
            $thirdbunkofactsql="SELECT `rechname`,`amount` FROM(
SELECT JB.g_id AS `id`,GA.name AS `rechname`,JB.bunko AS `amount` FROM jq_bet AS JB LEFT JOIN games_api AS GA on JB.g_id = GA.g_id WHERE JB.flag=1 and JB.updated_at BETWEEN ? AND ?
) AS A GROUP BY A.id";
        }else{
            $bunkofactsql = "SELECT '彩票会员输赢（含退水）' AS 'rechname',SUM(A.amount+A.back_money) AS amount FROM(
SELECT SUM(CASE WHEN game_id IN(90,91) THEN nn_view_money
ELSE(CASE WHEN bunko > 0 THEN (bunko - bet_money) ELSE bunko END) 
END) AS amount ,SUM(bet_his.bet_money * bet_his.play_rebate) AS back_money
FROM bet_his WHERE 1 AND testFlag =0 AND updated_at BETWEEN ? AND ? ) AS A";
            $thirdbunkofactsql="SELECT `rechname`,`amount` FROM(
SELECT JB.g_id AS `id`,GA.name AS `rechname`,JB.bunko AS `amount` FROM jq_bet_his AS JB LEFT JOIN games_api AS GA on JB.g_id = GA.g_id WHERE JB.flag=1 and JB.updated_at BETWEEN ? AND ?
) AS A GROUP BY A.id";
        }
        return [$bunkofactsql,$thirdbunkofactsql];
    }
}
