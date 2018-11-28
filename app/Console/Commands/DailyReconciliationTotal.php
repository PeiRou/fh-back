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
        $daytstrot = strtotime(date($date));


        /*在线支付*/
        $onlinePaymentsql = 'SELECT rechName AS \'rechname\',SUM(amount) AS \'amount\',SUM(rebate_or_fee) AS \'giftamount\'
FROM(SELECT B.id AS \'id\',B.rechName AS \'rechName\',A.amount AS \'amount\',A.rebate_or_fee AS \'rebate_or_fee\',A.updated_at AS \'updated_at\',A.status AS \'status\'
FROM(select username,pay_online_id,payType,amount,rebate_or_fee,updated_at,status from recharges where username = (select username from users where testFlag = \'0\' and recharges.username = users.username) and payType = \'onlinePayment\' and status =\'2\' and updated_at BETWEEN ? AND ? ) AS A
INNER JOIN (select id ,rechName from pay_online_new where rechType =\'onlinePayment\') AS B ON A.pay_online_id = B.id) AS C
GROUP BY rechName';
        $onlinePayment = DB::select($onlinePaymentsql,[$date.' 00:00:00',$date.' 23:59:59']);

        /*银行汇款*/
        $bankTransfersql = 'SELECT rechName AS \'rechname\',SUM(amount) AS \'amount\',SUM(rebate_or_fee) AS \'giftamount\'
FROM(SELECT B.id AS \'id\',B.payeeName AS \'rechName\',A.amount AS \'amount\',A.rebate_or_fee AS \'rebate_or_fee\',A.updated_at AS \'updated_at\',A.status AS \'status\'
FROM(select username,pay_online_id,payType,amount,rebate_or_fee,updated_at,status from recharges where username = (select username from users where testFlag = \'0\' and recharges.username = users.username) and payType = \'bankTransfer\' and status =\'2\' AND updated_at BETWEEN ? AND ? ) AS A
INNER JOIN (select id ,payeeName from pay_online_new where rechType =\'bankTransfer\') AS B ON A.pay_online_id = B.id) AS C
GROUP BY rechName';
        $bankTransfer = DB::select($bankTransfersql,[$date.' 00:00:00',$date.' 23:59:59']);

        /*支付宝支付*/
        $alipaysql = 'SELECT rechName AS \'rechname\',SUM(amount) AS \'amount\',SUM(rebate_or_fee) AS \'giftamount\'
FROM(SELECT B.id AS \'id\',B.payeeName AS \'rechName\',A.amount AS \'amount\',A.rebate_or_fee AS \'rebate_or_fee\',A.updated_at AS \'updated_at\',A.status AS \'status\'
FROM(select username,pay_online_id,payType,amount,rebate_or_fee,updated_at,status from recharges where username = (select username from users where testFlag = \'0\' and recharges.username = users.username) and payType = \'alipay\' and status =\'2\' AND updated_at BETWEEN ? AND ? ) AS A
INNER JOIN (select id ,payeeName from pay_online_new where rechType =\'alipay\') AS B ON A.pay_online_id = B.id) AS C
GROUP BY rechName';
        $alipay = DB::select($alipaysql,[$date.' 00:00:00',$date.' 23:59:59']);

        /*微信支付*/
        $weixinsql = 'SELECT rechName AS \'rechname\',SUM(amount) AS \'amount\',SUM(rebate_or_fee) AS \'giftamount\'
FROM(SELECT B.id AS \'id\',B.payeeName AS \'rechName\',A.amount AS \'amount\',A.rebate_or_fee AS \'rebate_or_fee\',A.updated_at AS \'updated_at\',A.status AS \'status\'
FROM(select username,pay_online_id,payType,amount,rebate_or_fee,updated_at,status from recharges where username = (select username from users where testFlag = \'0\' and recharges.username = users.username) and payType = \'weixin\' and status =\'2\' AND updated_at BETWEEN ? AND ? ) AS A
INNER JOIN (select id ,payeeName from pay_online_new where rechType =\'weixin\') AS B ON A.pay_online_id = B.id) AS C
GROUP BY rechName';
        $weixin = DB::select($weixinsql,[$date.' 00:00:00',$date.' 23:59:59']);

        /*财付通*///'2018-10-29
        $cftsql = 'SELECT rechName AS \'rechname\',SUM(amount) AS \'amount\',SUM(rebate_or_fee) AS \'giftamount\'
FROM(SELECT B.id AS \'id\',B.payeeName AS \'rechName\',A.amount AS \'amount\',A.rebate_or_fee AS \'rebate_or_fee\',A.updated_at AS \'updated_at\',A.status AS \'status\'
FROM(select username,pay_online_id,payType,amount,rebate_or_fee,updated_at,status from recharges where username = (select username from users where testFlag = \'0\' and recharges.username = users.username) and payType = \'cft\' and status =\'2\' AND updated_at BETWEEN ? AND ? ) AS A
INNER JOIN (select id ,payeeName from pay_online_new where rechType =\'cft\') AS B ON A.pay_online_id = B.id) AS C
GROUP BY rechName';
        $cft = DB::select($cftsql,[$date.' 00:00:00',$date.' 23:59:59']);

        /*后台加钱*/
        $adminAddMoneysql = 'SELECT rechName AS \'rechname\',SUM(amount) AS \'amount\',SUM(rebate_or_fee) AS \'giftamount\'
FROM(SELECT B.rechName AS \'rechName\',A.amount AS \'amount\',A.rebate_or_fee AS \'rebate_or_fee\',A.updated_at AS \'updated_at\',A.status AS \'status\'
FROM(select username,admin_add_money,payType,amount,rebate_or_fee,updated_at,status from recharges where username = (select username from users where testFlag = \'0\' and recharges.username = users.username) and payType = \'adminAddMoney\' and status =\'2\' AND updated_at BETWEEN ? AND ? ) AS A
INNER JOIN (select admin_add_money,case recharges.admin_add_money when \'1\' then \'加彩金\' when \'2\' then \'掉单补发\' when \'3\' then \'其他\' end as \'rechName\' from recharges where payType = \'adminAddMoney\' GROUP BY admin_add_money) AS B ON A.admin_add_money = B.admin_add_money) AS C
GROUP BY rechName';
        $adminAddMoney = DB::select($adminAddMoneysql,[$date.' 00:00:00',$date.' 23:59:59']);

        /*提款*/
        $drawsql = 'SELECT rechName AS \'rechname\',SUM(amount) AS \'amount\'
FROM(SELECT B.rechName AS \'rechName\',A.amount AS \'amount\',A.updated_at AS \'updated_at\',A.status AS \'status\'
FROM(select user_id,amount,draw_type,status,updated_at from drawing where user_id = (select id from users where testFlag = \'0\' and drawing.user_id = users.id)and status = \'2\' and updated_at BETWEEN ? AND ? ) AS A
INNER JOIN (select draw_type , case drawing.draw_type when \'0\' then \'自动出款\' when \'1\' then \'手动出款\' when \'2\' then \'后台扣钱\' end as \'rechName\' from drawing where status = \'2\' GROUP BY draw_type)AS B ON A.draw_type = B.draw_type) AS C
GROUP BY rechName';
        $draw = DB::select($drawsql,[$date.' 00:00:00',$date.' 23:59:59']);

        /*资金明细*/
        //to1
        $echargessql = 'SELECT \'充值\' AS \'rechname\',SUM(A.amount) AS amount
FROM (select username,amount,updated_at,status from recharges where username = (select username from users where testFlag = \'0\' and recharges.username = users.username) and status = \'2\' and updated_at BETWEEN ? AND ?  ) AS A';
        $echarges = DB::select($echargessql,[$date.' 00:00:00',$date.' 23:59:59']);
        //t02~t27
        $capitalsql = 'SELECT rechName AS \'rechname\',SUM(amount) AS \'amount\'
FROM(SELECT B.rechName AS \'rechName\',A.money AS \'amount\',A.updated_at AS \'updated_at\'
FROM(select to_user,type,money,updated_at from capital where to_user = (select id from users where testFlag = \'0\' and capital.to_user = users.id) and updated_at BETWEEN ? AND ? ) AS A
INNER JOIN (select type, case capital.type when \'t04\' then \'返利/手续费\' when \'t05\' then \'下注\' when \'t06\' then \'重新开奖[中奖金额]\' when \'t07\' then \'重新开奖[退水金额]\' when \'t08\' then \'活动\' when \'t09\' then \'奖金\' when \'t10\' then \'代理结算佣金\' when \'t11\' then \'代理佣金提现\' when \'t12\' then \'代理佣金提现失败退回\' when \'t13\' then \'抢到红包\' when \'t14\' then \'退水\' when \'t15\' then \'提现\' when \'t16\' then \'撤单\' when \'t17\' then \'提现失败\' when \'t18\' then \'后台加钱\' when \'t19\' then \'后台扣钱\' when \'t23\' then \'棋牌上分\' when \'t24\' then \'棋牌下分\' when \'t25\' then \'冻结提现金额\' when \'t26\' then \'解冻金额\' when \'t27\' then \'冻结金额\' end as \'rechName\' from capital GROUP BY type)AS B ON A.type = B.type) AS C
GROUP BY rechName';
        $capital = DB::select($capitalsql,[$date.' 00:00:00',$date.' 23:59:59']);
        $capital = array_merge($echarges,$capital);

        $data[$date] = [
            'onlinePayment' => $this->arrayunset($onlinePayment),
            'bankTransfer' => $this->arrayunset($bankTransfer),
            'alipay'=> $this->arrayunset($alipay),
            'weixin' => $this->arrayunset($weixin),
            'cft' => $this->arrayunset($cft),
            'adminAddMoney' => $this->arrayunset($adminAddMoney),
            'draw' => $this->arrayunset($draw),
            'capital' => $this->arrayunset($capital)
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
                \Log::info(date('Y-m-d H:i:s').' 系统  执行「会员对帐」功能 （daytstrot：'.$daytstrot.'）');
            }else{
                /*会员馀额*/
                $useramountsql = 'SELECT SUM(A.money) AS \'amount\' FROM (select id,money from users where testFlag = \'0\') AS A';
                $useramount =  DB::select($useramountsql);
                foreach ($useramount as $k=>$v){
                    $memberquota=$v->amount;
                }
                $datatotalreport['daytstrot']=$daytstrot;
                $datatotalreport['daytime']=$date;
                $datatotalreport['memberquota']=$memberquota;
                $datatotalreport['created_at']=date('Y-m-d H:i:s');
                try{
                    DB::table('totalreport')->insert([$datatotalreport]);
                } catch (\Exception $exception){
                    \Log::info(__CLASS__ . '->' . __FUNCTION__ . ' Line:' . $exception->getLine() . ' ' . $exception->getMessage());
                    $this->error('insert to totalreport error');
                }
                $this->info('insert to totalreport successfully');
                \Log::info(date('Y-m-d H:i:s').' 系统  执行「会员对帐」功能 （daytstrot：'.$daytstrot.'）');
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
            \Log::info(date('Y-m-d H:i:s').' 操作人：'.$this->argument('user').'  执行「会员对帐」功能 （daytstrot：'.$daytstrot.'）');
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
