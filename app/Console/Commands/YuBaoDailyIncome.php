<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class YuBaoDailyIncome extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'YuBaoDailyIncome:DailyReport {startTime?} {endTime?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '余额宝收益日报表';

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
        $startTime = empty($this->argument('startTime'))?date('Y-m-d',strtotime('-1 day')):$this->argument('startTime');
        $endTime = empty($this->argument('endTime'))?date('Y-m-d',strtotime('-1 day')):$this->argument('endTime');

        $aArray = [];
        $aArray['startTimeIG'] = $startTime.' 00:00:00';
        $aArray['endTimeIG'] = $endTime.' 23:59:59';
        $aArray['startTimeIT'] = $startTime.' 00:00:00';
        $aArray['endTimeIT'] = $endTime.' 23:59:59';

        $aSql = "SELECT IT.money,IG.* FROM(
                    SELECT * FROM (
                      SELECT id,vip_id,user_id,user_account,user_name,claim_money,proportion,balance,test_flag,created_at,updated_at,cast(updated_at as date) AS up_date FROM balance_income where updated_at >= :startTimeIG and updated_at <= :endTimeIG  ORDER BY id DESC
                    ) A GROUP BY user_id,up_date ORDER BY up_date
                 ) IG
                 LEFT JOIN (
                    SELECT user_id,cast(updated_at as date) AS up_date,sum(money) AS money FROM balance_income WHERE updated_at >= :startTimeIT and updated_at <= :endTimeIT GROUP BY user_id,up_date
                  ) IT ON IG.user_id = IT.user_id AND IG.up_date = IT.up_date";
        $res = DB::select($aSql,$aArray);
        $resCount = count($res);
        $deleteCount = count(DB::table('balance_income_day')->where('date', '>=', $startTime)->where('date', '<=', $endTime)->get());

        $incomedayData=[];
        foreach ($res as $k=>$v){
            $incomedayData[$k]= array(
                'vip_id'=>$v->vip_id,
                'user_id'=>$v->user_id,
                'user_account'=>$v->user_account,
                'user_name'=>$v->user_name,
                'claim_money'=>$v->claim_money,
                'proportion'=>$v->proportion,
                'money'=>$v->money,
                'balance'=>$v->balance,
                'test_flag'=>$v->test_flag,
                'date' =>date('Y-m-d',strtotime($v->updated_at)),
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s'),
            );
        }

        DB::beginTransaction();
        try {
            DB::table('balance_income_day')->where('date', '>=', $startTime)->where('date', '<=', $endTime)->delete();
            DB::table('balance_income_day')->insert($incomedayData);
            DB::commit();
            $this->info('余额宝收益日报表 执行成功! ('.$startTime.' 至 '.$endTime.' 删除 '.$deleteCount.' 笔 & 新增 '.$resCount.' 笔)');
        }catch (\Exception $exception){
            writeLog('error',__CLASS__ . '->' . __FUNCTION__ . ' Line:' . $exception->getLine() . ' ' . $exception->getMessage());
            DB::rollback();
            $this->info('余额宝收益日报表 执行失败! (请查看 error 的 log)');
        }
    }
}