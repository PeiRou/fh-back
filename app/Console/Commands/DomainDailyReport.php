<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class DomainDailyReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'DomainDailyReport:DailyReport {startTime?} {endTime?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '会员注册每日报表(域名区分)';

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
        $pattern = '/^\d{4}-\d{2}-\d{2}?$/';
        if(preg_match($pattern,$startTime)==0 || preg_match($pattern,$endTime)==0){
            $this->info('输入日期格式不为 YYYY-MM-DD');
            return false;
        }

        $fistSql = "SELECT * FROM (
	SELECT count(NAR.ip) AS ckNum,NAR.host,cast(NAR.created_at as date) AS ar_cr_date,NAR.domainId FROM 
	(
	  SELECT domain_info.id AS domainId,access_records.* FROM access_records LEFT JOIN domain_info ON access_records.host = domain_info.domain
	)AS NAR GROUP BY ar_cr_date,host
)AS AR WHERE 1=1 AND AR.ar_cr_date >= '".$startTime."' AND AR.ar_cr_date <= '".$endTime."' ";
        $seconSql = "SELECT IFNULL(NRURD.fuserNum,0) AS fuserNum,NURD.userNum,NURD.register_domainId,NURD.register_domain,NURD.ref_cr_date FROM (
                        SELECT count(user_id) AS userNum,register_domainId,register_domain,cast(created_at as date) AS ref_cr_date FROM users_registered_detail WHERE 1=1 AND created_at >= '".$startTime."' AND created_at <= '".$endTime." 23:59:59' GROUP BY register_domainId,ref_cr_date
                     ) AS NURD
                    LEFT JOIN(
                        SELECT count(user_id) AS fuserNum,register_domainId,rt_cr_date FROM (
                        SELECT URD.user_id,URD.register_domainId,cast(RT.created_at as date) AS rt_cr_date FROM users_registered_detail AS URD INNER JOIN recharges_times AS RT  ON URD.user_id = RT.userId AND RT.frequency=1
                        )AS NRT WHERE 1=1 AND rt_cr_date >= '".$startTime."' AND rt_cr_date <= '".$endTime." 23:59:59'  GROUP BY register_domainId,rt_cr_date
                    ) AS NRURD ON NURD.register_domainId = NRURD.register_domainId AND NURD.ref_cr_date = NRURD.rt_cr_date ";

        $aSql = "SELECT IFNULL(X.domainId,Y.register_domainId) AS domainId,IFNULL(X.host,Y.register_domain) AS register_domain,IFNULL(X.ckNum,0) AS ckNum,
			             IFNULL(Y.userNum,0) AS userNum,IFNULL(Y.fuserNum,0) AS fuserNum,IFNULL(X.ar_cr_date,Y.ref_cr_date) AS cr_date 
			     FROM (".$fistSql.")AS X
                 LEFT JOIN (".$seconSql.")AS Y
                 ON X.host = Y.register_domain AND X.ar_cr_date = Y.ref_cr_date
                 UNION
                 SELECT IFNULL(X.domainId,Y.register_domainId) AS domainId,IFNULL(X.host,Y.register_domain) AS register_domain,IFNULL(X.ckNum,0) AS ckNum,
			             IFNULL(Y.userNum,0) AS userNum,IFNULL(Y.fuserNum,0) AS fuserNum,IFNULL(X.ar_cr_date,Y.ref_cr_date) AS cr_date 
			     FROM (".$fistSql.")AS X
                 RIGHT JOIN (".$seconSql.")AS Y
                 ON X.host = Y.register_domain  AND X.ar_cr_date = Y.ref_cr_date";
        $res = DB::select($aSql);
        $resCount = count($res);
        $deleteCount = count(DB::table('domain_daily')->where('date', '>=', $startTime)->where('date', '<=', $endTime)->get());

        $incomedayData=[];
        foreach ($res as $k=>$v){
            $incomedayData[$k]= array(
                'date'=>$v->cr_date,
                'dateTime'=>strtotime($v->cr_date),
                'adomain_infoId'=>$v->domainId,
                'adomain'=>$v->register_domain,
                'click_num'=>$v->ckNum,
                'register_num'=>$v->userNum,
                'firstcharge_num'=>$v->fuserNum,
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s'),
            );
        }

        DB::beginTransaction();
        try {
            DB::table('domain_daily')->where('date', '>=', $startTime)->where('date', '<=', $endTime)->delete();
            DB::table('domain_daily')->insert($incomedayData);
            DB::commit();
            $this->info('会员注册每日报表(域名区分) 执行成功! ('.$startTime.' 至 '.$endTime.' 删除 '.$deleteCount.' 笔 & 新增 '.$resCount.' 笔)');
        }catch (\Exception $exception){
            writeLog('error',__CLASS__ . '->' . __FUNCTION__ . ' Line:' . $exception->getLine() . ' ' . $exception->getMessage());
            DB::rollback();
            $this->info('会员注册每日报表(域名区分) 执行失败! (请查看 error 的 log)');
        }
    }
}