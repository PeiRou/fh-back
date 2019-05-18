<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class clear_data extends Command
{

    protected $signature = 'clear_data';
    protected $description = '清除缓存';
    protected $stoptime = '';
    protected $time = '';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $num = 0;
        $redis = Redis::connection();
        $redis->select(5);
//        $keyEx = 'clearing';
        if($redis->exists('clearing')){
            echo "ing...";
            return "";
        }
        $redis->setex('clearing',300,'on');
        $this->stoptime = date('Y-m-d 23:59:59');                                 //卡redis时间
        $this->time = strtotime($this->stoptime) - time();                                     //卡redis时间
        $clearDate1 = date('Y-m-d 23:59:59',strtotime("-1 days"));        //1天
        $clearDate31 = date('Y-m-d 23:59:59',strtotime("-31 days")-300);        //31天
        $clearDate62 = date('Y-m-d 23:59:59',strtotime("-62 days")-300);        //62天
        $clearDate93 = date('Y-m-d 23:59:59',strtotime("-93 days")-300);        //93天
        echo "clear Date1:".$clearDate1.PHP_EOL;
        echo "clear Date31:".$clearDate31.PHP_EOL;
        echo "clear Date62:".$clearDate62.PHP_EOL;
        //清-游客
        $sql = "delete from users where testFlag = 1 and loginTime <='".$clearDate1."' LIMIT 1000";
        $res = DB::connection('mysql::write')->statement($sql);
        writeLog('clear','clear users testFlag:'.json_encode($res));
        $sql = "delete from chat_user where chat_role = 1 and loginTime <='".$clearDate1."' LIMIT 1000";
        $res = DB::connection('mysql::write')->statement($sql);
        writeLog('clear','clear chat_user role is yk:'.json_encode($res));
        if(!$redis->exists('clear-bet')){
            $res = DB::connection('mysql::write')->table('bet')->select('bet_id')->where('status','>=',1)->where('updated_at','<=',$clearDate1)->first();
            writeLog('clear','clear bet :'.json_encode($res));
            if(empty($res)){
                $redis->setex('clear-bet',$this->time,$this->stoptime);
            }else{
                $sql = "SELECT bet_id FROM bet WHERE status >=1 AND updated_at <= '{$clearDate1}' LIMIT 1000";
                $tmp = DB::select($sql);
                $arrIds = array();
                foreach ($tmp as&$value)
                    $arrIds[] = $value->bet_id;
                if(count($arrIds)==0){
                    $redis->setex('clear-bet',$this->time,$this->stoptime);
                }else{
                    DB::beginTransaction();
                    try {
                        DB::table('bet_his')->whereIn('bet_id', $arrIds)->delete();
                        $strIds = implode(',',$arrIds);
                        $sql = "INSERT INTO bet_his SELECT * FROM bet WHERE bet_id in (".$strIds.")";
                        $res = DB::statement($sql);
                        writeLog('clear','table insert into bet_his :'.$res);
                        $res = DB::table('bet')->whereIn('bet_id', $arrIds)->delete();
                        writeLog('clear','table delete bet :'.$res);
                        DB::commit();
                    }catch (\Exception $e){
                        DB::rollback();
                        writeLog('clear', __CLASS__ . '->' . __FUNCTION__ . ' Line:' . $e->getLine() . ' ' . $e->getMessage());
                        writeLog('clear','table insert into bet_his :fail');
                    }
                    $num++;
                    $redis->setex('clear-bet',1,'on');
                }
            }
        }
        writeLog('clear','clear ing ....');
        writeLog('clear',"clear Date1:".$clearDate1."clear Date31:".$clearDate31."clear Date62:".$clearDate62."clear Date93:".$clearDate93);
        //清-投注历史数据
        if(!$redis->exists('clear-bet-his')){
            $sql = "DELETE FROM bet_his WHERE updated_at<='{$clearDate93}' LIMIT 5000";
            $res = DB::statement($sql);
            echo 'table bet_his :' . $res . PHP_EOL;
            $res = DB::connection('mysql::write')->table('bet_his')->select('bet_id')->where('updated_at','<=',$clearDate93)->first();
            if(empty($res)){
                $redis->setex('clear-bet-his',$this->time,$this->stoptime);
            }else{
                $num++;
                $redis->setex('clear-bet-his',1,'on');
            }
        }
        //清-资金明细
        if(!$redis->exists('clear-else')) {
            $num_else = 0;
            $sql = "DELETE FROM capital WHERE created_at <= '{$clearDate93}' LIMIT 1000";
            $res = DB::connection('mysql::write')->statement($sql);
            echo 'table capital :' . $res . PHP_EOL;
            //清-充值
//        $sql = "DELETE FROM recharges WHERE created_at<='{$clearDate}' LIMIT 1000";
//        $res = DB::connection('mysql::write')->statement($sql);
            echo 'table recharges :' . $res . PHP_EOL;
            //清-提款
//        $sql = "DELETE FROM drawing WHERE created_at<='{$clearDate}' LIMIT 1000";
//        $res = DB::connection('mysql::write')->statement($sql);
            echo 'table drawing :' . $res . PHP_EOL;
            //清-活动
            $sql = "DELETE FROM activity_send WHERE created_at<='{$clearDate62}' LIMIT 1000";
            $res = DB::connection('mysql::write')->statement($sql);
            echo 'table activity_send :' . $res . PHP_EOL;
            //清-活动
            $sql = "DELETE FROM activity_sign_qiandao WHERE created_at<='{$clearDate62}' LIMIT 1000";
            $res = DB::connection('mysql::write')->statement($sql);
            echo 'table activity_sign_qiandao :' . $res . PHP_EOL;
            //清-错误日志
            $sql = "DELETE FROM log_abnormal WHERE create_at<='{$clearDate62}' LIMIT 1000";
            $res = DB::connection('mysql::write')->statement($sql);
            echo 'table log_abnormal :' . $res . PHP_EOL;
            //清-操作日志
            $sql = "DELETE FROM log_handle WHERE create_at<='{$clearDate62}' LIMIT 1000";
            $res = DB::connection('mysql::write')->statement($sql);
            echo 'table log_handle :' . $res . PHP_EOL;
            //清-会员登陆日志
            $sql = "DELETE FROM log_login WHERE login_time<='{$clearDate62}' LIMIT 1000";
            $res = DB::connection('mysql::write')->statement($sql);
            echo 'table log_login :' . $res . PHP_EOL;
            $num_else = $this->clrGameTables('game_ahk3', $clearDate62, $num_else);
            $num_else = $this->clrGameTables('game_bjkl8', $clearDate62, $num_else);
            $num_else = $this->clrGameTables('game_bjpk10', $clearDate62, $num_else);
            $num_else = $this->clrGameTables('game_cqssc', $clearDate62, $num_else);
            $num_else = $this->clrGameTables('game_cqxync', $clearDate62, $num_else);
            $num_else = $this->clrGameTables('game_gd11x5', $clearDate62, $num_else);
            $num_else = $this->clrGameTables('game_gdklsf', $clearDate62, $num_else);
            $num_else = $this->clrGameTables('game_gsk3', $clearDate62, $num_else);
            $num_else = $this->clrGameTables('game_gxk3', $clearDate62, $num_else);
            $num_else = $this->clrGameTables('game_gzk3', $clearDate62, $num_else);
            $num_else = $this->clrGameTables('game_hbk3', $clearDate62, $num_else);
            $num_else = $this->clrGameTables('game_hebeik3', $clearDate62, $num_else);
            $num_else = $this->clrGameTables('game_jsk3', $clearDate62, $num_else);
            $num_else = $this->clrGameTables('game_ksft', $clearDate62, $num_else);
            $num_else = $this->clrGameTables('game_kssc', $clearDate62, $num_else);
            $num_else = $this->clrGameTables('game_ksssc', $clearDate62, $num_else);
            $num_else = $this->clrGameTables('game_lhc', $clearDate62, $num_else);
            $num_else = $this->clrGameTables('game_msft', $clearDate62, $num_else);
            $num_else = $this->clrGameTables('game_msjsk3', $clearDate62, $num_else);
            $num_else = $this->clrGameTables('game_msqxc', $clearDate62, $num_else);
            $num_else = $this->clrGameTables('game_mssc', $clearDate62, $num_else);
            $num_else = $this->clrGameTables('game_msssc', $clearDate62, $num_else);
            $num_else = $this->clrGameTables('game_paoma', $clearDate62, $num_else);
            $num_else = $this->clrGameTables('game_pcdd', $clearDate62, $num_else);
            $num_else = $this->clrGameTables('game_pknn', $clearDate62, $num_else);
            $num_else = $this->clrGameTables('game_qqffc', $clearDate62, $num_else);
            $num_else = $this->clrGameTables('game_twxyft', $clearDate62, $num_else);
            $num_else = $this->clrGameTables('game_xjssc', $clearDate62, $num_else);
            $num_else = $this->clrGameTables('game_xylhc', $clearDate62, $num_else);
            $num_else = $this->clrGameTables('game_sfsc', $clearDate62, $num_else);
            $num_else = $this->clrGameTables('game_sfssc', $clearDate62, $num_else);
            $num_else = $this->clrGameTables('game_sflhc', $clearDate62, $num_else);
            $num_else = $this->clrGameTables('game_jslhc', $clearDate62, $num_else);
            $num_else = $this->clrGameTables('game_xyft', $clearDate62, $num_else);
            if($num_else==0){
                $this->time = strtotime($this->stoptime) - time();
                $redis->setex('clear-else',$this->time,$this->stoptime);
            }else{
                $redis->setex('clear-else',1,'on');
                $num++;
            }
        }
        //清-棋牌昨日数据
        if(!$redis->exists('clear-jq-bet')){
            $res = DB::connection('mysql::write')->table('jq_bet')->select('id')->where('updated_at','<=',$clearDate1)->first();
            writeLog('clear','clear jq bet :'.json_encode($res));
            if(empty($res)){
                $redis->setex('clear-jq-bet',$this->time,$this->stoptime);
            }else{
                try {
                    $sql = "INSERT INTO jq_bet_his SELECT * FROM jq_bet WHERE  updated_at <= '{$clearDate1}' LIMIT 1000";
                    $res = DB::connection('mysql::write')->statement($sql);
                    writeLog('clear','table insert into jq_bet_his :'.$res);
                    $sql = "DELETE FROM jq_bet WHERE  updated_at <= '{$clearDate1}' LIMIT 1000";
                    $res = DB::connection('mysql::write')->statement($sql);
                    writeLog('clear','table delete jq_bet :'.$res);
                }catch (\Exception $e){
                    writeLog('clear','error :'.$e->getMessage());
                    writeLog('clear','table insert into jq_bet_his :fail');
                }
                $num++;
                $redis->setex('clear-jq-bet',1,'on');
            }
        }
        //清-棋牌历史数据
        if(!$redis->exists('clear-jq-bet-his')){
            $sql = "DELETE FROM jq_bet_his WHERE updated_at<='{$clearDate93}' LIMIT 5000";
            $res = DB::connection('mysql::write')->statement($sql);
            echo 'table jq_bet_his :' . $res . PHP_EOL;
            $res = DB::connection('mysql::write')->table('jq_bet_his')->select('id')->where('updated_at','<=',$clearDate93)->first();
            if(empty($res)){
                $redis->setex('clear-jq-bet-his',$this->time,$this->stoptime);
            }else{
                $num++;
                $redis->setex('clear-jq-bet-his',1,'on');
            }
        }
        //清-棋牌上下分失败数据
        if(!$redis->exists('clear-jq-recharges')){
            $sql = "DELETE FROM jq_recharges WHERE updated_at<='{$clearDate31}' LIMIT 5000";
            $res = DB::connection('mysql::write')->statement($sql);
            echo 'table jq_recharges :' . $res . PHP_EOL;
            $res = DB::connection('mysql::write')->table('jq_recharges')->select('id')->where('updated_at','<=',$clearDate31)->first();
            if(empty($res)){
                $redis->setex('clear-jq-recharges',$this->time,$this->stoptime);
            }else{
                $num++;
                $redis->setex('clear-jq-recharges',1,'on');
            }
        }
        if($num==0){
            $redis->setex('clearing',$this->time,$this->stoptime);
            writeLog('clear',$this->stoptime.'finished');
        }else{
            $redis->setex('clearing',1,'on');
            writeLog('clear','have program num :'.$num.','.$this->stoptime.'continue...');
        }
        writeLog('clear','Ok');
        echo 'Ok';
    }

    /**
     * 清游戏数据表只保留两个月
     * @param string $table
     * @param string $clearDate62
     * @return int
     */
    private function clrGameTables($table='',$clearDate62='',$num_else){
        if(empty($table) || empty($clearDate62))
            return 0;
        $redis = Redis::connection();
        $redis->select(5);
        if(!$redis->exists('clear-'.$table)){
            $res = DB::connection('mysql::write')->table($table)->select('id')->where('opentime','<=',$clearDate62)->first();
            if(empty($res)){
                $this->time = strtotime($this->stoptime) - time();
                $redis->setex('clear-'.$table,$this->time,$this->stoptime);
                writeLog('clear',$table.'=>0');
            }else{
                $sql = "DELETE FROM {$table} WHERE opentime<='{$clearDate62}' LIMIT 1000";
                $res = DB::connection('mysql::write')->statement($sql);
                writeLog('clear',$table.'=>'.$res);
                $num_else ++;
            }
        }
        return $num_else;
    }
}
