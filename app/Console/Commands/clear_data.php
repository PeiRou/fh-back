<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Artisan;
use SameClass\Config\LotteryGames\Games;

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
        ini_set('memory_limit','2048M');
        $num = 0;
        $redis = Redis::connection();
        $redis->select(5);
//        $keyEx = 'clearing';
        if($redis->exists('clearing')){
            return "";
        }
//        $redis->setex('clearing',300,'on');
        $this->stoptime = date('Y-m-d H:i:s',strtotime(date('Y-m-d 23:59:59'))+7200);                                 //卡redis时间，改成两点之后才开始移数据
//        $this->stoptime = date('Y-m-d H:i:s',strtotime(date('Y-m-d 23:59:59'))+3600);                                 //卡redis时间，改成一点之后才开始移数据
        $this->time = strtotime($this->stoptime) - time();                                                      //卡redis时间，剩馀时间
        if($this->time<=0)                                 //剩馀时间若是非有效秒数，则返回不继续往下做
            return "";
        $clearDate1 = date('Y-m-d 23:59:59',strtotime("-1 days"));        //1天
        $clearDate2 = date('Y-m-d 23:59:59',strtotime("-2 days"));        //2天
        $clearDate7 = date('Y-m-d 23:59:59',strtotime("-7 days"));        //2天
        $clearDate31 = date('Y-m-d 23:59:59',strtotime("-31 days")-300);        //31天
        $clearDate62 = date('Y-m-d 23:59:59',strtotime("-62 days")-300);        //62天
        $clearDate93 = date('Y-m-d 23:59:59',strtotime("-93 days")-300);        //93天
        $clearDate120 = date('Y-m-d 23:59:59',strtotime("-120 days")-300);        //100
        echo "clear 卡redis时间:".$this->stoptime.PHP_EOL;
        echo "clear 卡redis剩馀时间:".$this->time.PHP_EOL;
        echo "clear Date1:".$clearDate1.PHP_EOL;
        echo "clear Date2:".$clearDate2.PHP_EOL;
        echo "clear Date31:".$clearDate31.PHP_EOL;
        echo "clear Date62:".$clearDate62.PHP_EOL;
        echo "clear Date93:".$clearDate93.PHP_EOL;
        echo "clear Date120:".$clearDate120.PHP_EOL;
        //清-游客
        $sql = "delete from users where testFlag = 1 and loginTime <='".$clearDate1."' LIMIT 1000";
        $res = DB::statement($sql);
        echo "clear testFlag...".PHP_EOL;
        writeLog('clear','1 clear users testFlag:'.json_encode($res));
        $sql = "delete from chat_users where chat_role = 1 and created_at <='".$clearDate1."' LIMIT 1000";
        $res = DB::statement($sql);
        echo "clear chat testFlag...".PHP_EOL;
        writeLog('clear','2 clear chat_user role is yk:'.json_encode($res));
        if(!$redis->exists('clear-bet')){
            $redis->setex('clear-bet',5,'on');
            echo "clear clear-bet 3 clear bet ing...".PHP_EOL;
            writeLog('clear','3 clear bet ing...');
            $res = DB::connection('mysql_report')->table('bet')->select('bet_id')->where('status','>=',1)->where('updated_at','<=',$clearDate1)->first();       //查一下有没有数据
            writeLog('clear','4 clear bet :'.json_encode($res));
            if(empty($res)){
                $redis->setex('clear-bet',$this->time,$this->stoptime);
            }else{
                //当文件有数据的时候，则到文件里把文件放到bet_his里
                echo "clear clear-bet file into...".PHP_EOL;

                //如果已经有做过一次，则不再读一次浪费内存
                $rdKeybet = 'clear-bet-file';
                if($redis->exists($rdKeybet)){
                    $files = json_decode($redis->get($rdKeybet),true);
                }else{
                    $files = Storage::disk('betTemp')->files();
                }
                $arrayTmp = [];
                $ii = 0;
                $needNew = false;
                if(count($files)>0){
                    echo "clear clear-bet file into start...".PHP_EOL;
                    $arrayFileData = [];
                    $arrayFileDataDel = [];         //蒐集要删掉的key
                    foreach ($files as $ik => $hisKey){
                        if($ii>=1000)
                            break;
                        $arrayTmp[] = $hisKey;                      //将序号放成数组，容易使用sql查询
                        if(!Storage::disk('betTemp')->exists($hisKey)){
                            $needNew = true;
                            continue;
                        }
                        $betinfoData = json_decode(Storage::disk('betTemp')->get($hisKey),true);     //把值从文件里面拿出来
                        if(strtotime($betinfoData['updated_at'])>strtotime($clearDate1))
                            continue;
                        $arrayFileData[] = $betinfoData;
                        $arrayFileDataDel[] = $ik;
                        $ii++;
                    }
                    DB::table('bet_his')->whereIn('bet_id', $arrayTmp)->where('updated_at','<=',$clearDate1)->delete();
                    DB::table('bet_his')->insert($arrayFileData);
                    DB::table('bet')->whereIn('bet_id', $arrayTmp)->where('updated_at','<=',$clearDate1)->delete();
                    Storage::disk('betTemp')->delete($arrayTmp);              //删除用户在文件的历史数据
                    foreach ($arrayFileDataDel as $ik => $delKey){
                        unset($files[$delKey]);
                    }
                    if($needNew)
                        $redis->del($rdKeybet);
                    else
                        $redis->setex($rdKeybet,30,json_encode($files));
                    $num++;
                    $redis->del('clear-bet');
                }else{
                    echo "clear clear-bet db into...".PHP_EOL;
                    //如果还有遗漏的数据，则像原先一样到bet里读出来，再放到bet_his里
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
                            if($res){
                                $res = DB::table('bet')->whereIn('bet_id', $arrIds)->delete();
                                writeLog('clear','table delete bet :'.$res);
                            }
                            DB::commit();
                        }catch (\Exception $e){
                            DB::rollback();
                            writeLog('clear', __CLASS__ . '->' . __FUNCTION__ . ' Line:' . $e->getLine() . ' ' . $e->getMessage());
                            writeLog('clear','table insert into bet_his :fail');
                        }
                        $num++;
                        $redis->del('clear-bet');
                    }
                }
            }
        }
        writeLog('clear','clear ing ....');
        writeLog('clear',"clear Date1:".$clearDate1."clear Date31:".$clearDate31."clear Date62:".$clearDate62."clear Date93:".$clearDate93);
        //清-投注历史数据
        if(!$redis->exists('clear-bet-his')){
            echo 'table bet_his ing ...' . PHP_EOL;
            $sql = "DELETE FROM bet_his WHERE updated_at<='{$clearDate93}' LIMIT 2000";
            $res = DB::statement($sql);
            echo 'table bet_his :' . $res . PHP_EOL;
            $res = DB::connection('mysql_report')->table('bet_his')->select('bet_id')->where('updated_at','<=',$clearDate93)->first();
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
            $sql = "DELETE FROM capital WHERE created_at <= '{$clearDate120}' LIMIT 1000";
            $res = DB::statement($sql);
            echo 'table capital :' . $res . PHP_EOL;
            //清-充值
            $sql = "DELETE FROM recharges WHERE created_at<='{$clearDate120}' LIMIT 1000";
            $res = DB::statement($sql);
            echo 'table recharges :' . $res . PHP_EOL;
            //清-提款
            $sql = "DELETE FROM drawing WHERE created_at<='{$clearDate120}' LIMIT 1000";
            $res = DB::statement($sql);
            echo 'table drawing :' . $res . PHP_EOL;
            //清-活动
            $sql = "DELETE FROM activity_send WHERE created_at<='{$clearDate120}' LIMIT 1000";
            $res = DB::statement($sql);
            echo 'table activity_send :' . $res . PHP_EOL;
            //清-活动
            $sql = "DELETE FROM activity_sign_qiandao WHERE created_at<='{$clearDate120}' LIMIT 1000";
            $res = DB::statement($sql);
            echo 'table activity_sign_qiandao :' . $res . PHP_EOL;
            //清-错误日志
            $sql = "DELETE FROM log_abnormal WHERE create_at<='{$clearDate62}' LIMIT 1000";
            $res = DB::statement($sql);
            echo 'table log_abnormal :' . $res . PHP_EOL;
            //清-操作日志
            $sql = "DELETE FROM log_handle WHERE created_at<='{$clearDate62}' LIMIT 1000";
            $res = DB::statement($sql);
            echo 'table log_handle :' . $res . PHP_EOL;
            //清-会员登陆日志
            $sql = "DELETE FROM log_login WHERE login_time<='{$clearDate62}' LIMIT 1000";
            $res = DB::statement($sql);
            echo 'table log_login :' . $res . PHP_EOL;
            //清-会员登陆异常日志
            $sql = "DELETE FROM log_login_error WHERE login_time<='{$clearDate62}' LIMIT 1000";
            $res = DB::statement($sql);
            echo 'table log_login_error :' . $res . PHP_EOL;
            //清-游客投注数据
            $sql = "DELETE FROM bet_his WHERE testFlag = 1 LIMIT 1000";
            $res = DB::statement($sql);
            echo 'table log_login :' . $res . PHP_EOL;
            $Games = new Games();
            $res = $Games->games;
            foreach ($res as $key => $val){
                $newClearDate = $clearDate62;
                if($val['table'] == 'game_lhc'){
                    $newClearDate = date('Y-m-d 23:59:59',strtotime("-1 Year")-300);
                }
                $num_else = $this->clrGameTables($val['table'], $newClearDate, $num_else);
            }
            //特定休市彩种-删奖期
            $res = ['game_bjpk10','game_pcdd','game_bjkl8','game_pknn'];
            foreach ($res as $key => $table){
                $num_else = $this->delGameTables($table, '2020-01-22 00:00:00', '2020-06-30 23:59:59', $num_else);
            }
            //特定休市彩种-封盘
            $resGameIds = [50,66,65,90];
            DB::table('game')->whereIn('game_id',$resGameIds)->update(['holiday_start'=>'2020-01-22 00:00:00','holiday_end'=>'2020-06-30 23:59:59']);
            //清-计画试算
            $num_else = $this->clrGameTables('plan_record', $clearDate2, $num_else,'updated_at');
            //清-推送消息
            $num_else = $this->clrGameTables('message_push', $clearDate62, $num_else,'updated_at');
            $num_else = $this->clrGameTables('user_messages', $clearDate7, $num_else,'created_at');

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
            //当文件有数据的时候，则到文件里把文件放到bet_his里
            echo "clear clear-bet jq file into...".PHP_EOL;
            $res = DB::connection('mysql_report')->table('jq_bet')->select('id')->where('flag',1)->where('updated_at','<=',$clearDate1)->first();       //查一下有没有数据
            writeLog('clear','clear bet jq :'.json_encode($res));
            if(empty($res)){
                $redis->setex('clear-jq-bet',$this->time,$this->stoptime);
            }else {
                //如果已经有做过一次，则不再读一次浪费内存
                $rdKeybet = 'clear-jq-bet-file';
                if ($redis->exists($rdKeybet)) {
                    $files = json_decode($redis->get($rdKeybet), true);
                } else {
                    $files = Storage::disk('betJqTemp')->files();
                }
                $arrayTmp = [];
                $ii = 0;
                $needNew = false;
                if (count($files) > 0) {
                    echo "clear clear-jq-bet file into start..." . PHP_EOL;
                    $arrayFileData = [];
                    $arrayFileDataDel = [];         //蒐集要删掉的key
                    foreach ($files as $ik => $hisKey) {
                        if ($ii >= 1000)
                            break;
                        $arrayTmp[] = $hisKey;                      //将序号放成数组，容易使用sql查询
                        if (!Storage::disk('betJqTemp')->exists($hisKey)) {
                            $needNew = true;
                            continue;
                        }
                        $betinfoData = json_decode(Storage::disk('betJqTemp')->get($hisKey), true);     //把值从文件里面拿出来
                        if (strtotime($betinfoData['updated_at']) > strtotime($clearDate1))
                            continue;
                        $arrayFileData[] = $betinfoData;
                        $arrayFileDataDel[] = $ik;
                        $ii++;
                    }
                    DB::table('jq_bet_his')->whereIn('id', $arrayTmp)->where('updated_at', '<=', $clearDate1)->delete();
                    DB::table('jq_bet_his')->insert($arrayFileData);
                    DB::table('jq_bet')->whereIn('id', $arrayTmp)->where('updated_at', '<=', $clearDate1)->delete();
                    Storage::disk('betJqTemp')->delete($arrayTmp);              //删除用户在文件的历史数据
                    foreach ($arrayFileDataDel as $ik => $delKey) {
                        unset($files[$delKey]);
                    }
                    if ($needNew)
                        $redis->del($rdKeybet);
                    else
                        $redis->setex($rdKeybet, 30, json_encode($files));
                    $num++;
                    $redis->del('clear-jq-bet');
                } else {
                    echo "clear clear-bet db into..." . PHP_EOL;
                    $sql = "SELECT id FROM jq_bet WHERE `flag` = 1 AND updated_at <= '{$clearDate1}' LIMIT 1000";
                    $tmp = DB::connection('mysql_report')->select($sql);
                    $arrIds = array();
                    foreach ($tmp as &$value)
                        $arrIds[] = $value->id;

                    DB::table('jq_bet_his')->whereIn('id', $arrIds)->delete();
                    writeLog('clear', 'clear jq bet :' . json_encode($arrIds));
                    if (count($arrIds) == 0) {
                        $redis->setex('clear-jq-bet', $this->time, $this->stoptime);
                    } else {
                        try {
                            $strIds = implode(',', $arrIds);
                            $sql = "INSERT INTO jq_bet_his SELECT * FROM jq_bet WHERE `id` in (" . $strIds . ")";
                            $res = DB::statement($sql);
                            writeLog('clear', 'table insert into jq_bet_his :' . $res);
                            $sql = "DELETE FROM jq_bet WHERE `id` in (" . $strIds . ")";
                            $res = DB::statement($sql);
                            writeLog('clear', 'table delete jq_bet :' . $res);
                        } catch (\Exception $e) {
                            writeLog('clear', 'error :' . $e->getMessage());
                            writeLog('clear', 'table insert into jq_bet_his :fail');
                        }
                        $num++;
                        $redis->setex('clear-jq-bet', 1, 'on');
                    }
                }
            }
        }
        //清-棋牌历史数据
        if(!$redis->exists('clear-jq-bet-his')){
            $sql = "DELETE FROM jq_bet_his WHERE updated_at<='{$clearDate93}' LIMIT 5000";
            $res = DB::statement($sql);
            echo 'table jq_bet_his :' . $res . PHP_EOL;
            $res = DB::connection('mysql_report')->table('jq_bet_his')->select('id')->where('updated_at','<=',$clearDate93)->first();
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
            $res = DB::statement($sql);
            echo 'table jq_recharges :' . $res . PHP_EOL;
            $res = DB::connection('mysql_report')->table('jq_recharges')->select('id')->where('updated_at','<=',$clearDate31)->first();
            if(empty($res)){
                $redis->setex('clear-jq-recharges',$this->time,$this->stoptime);
            }else{
                $num++;
                $redis->setex('clear-jq-recharges',1,'on');
            }
        }
        //清棋牌jq_game_issue数据
        if(!$redis->exists('clear-jq-game-issue')){
            try{
                $sql = "DELETE FROM `jq_game_issue` WHERE issue<='".date('Ymd000000', time() - (60 * 60 * 24 * 31))."' LIMIT 5000";
                $res = DB::statement($sql);
                echo 'table jq_game_issue :' . $res . PHP_EOL;
                $res = DB::connection('mysql_report')->table('jq_game_issue')->select('issue')->where('issue','<=',date('Ymd000000', time() - (60 * 60 * 24 * 31)))->first();
                if(empty($res)){
                    $redis->setex('clear-jq-game-issue',$this->time,$this->stoptime);
                }else{
                    $num++;
                    $redis->setex('clear-jq-game-issue',1,'on');
                }
            }catch (\Throwable $e){
                writeLog('error', $e->getMessage());
            }
        }

        //检查馀额宝有没有要删数据
        if(!$redis->exists('clearing_balance_income')){     //锁定暂存
            //同步执行删馀额宝数据
            Artisan::call('clear_balance_income');
            $num++;
        }

        if($num==0){
            $redis->setex('clearing',$this->time,$this->stoptime);
            echo 'finished'.PHP_EOL;
            writeLog('clear',$this->stoptime.'finished');
        }else{
            $redis->setex('clearing',1,'on');
            echo 'continue...'.PHP_EOL;
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
    private function clrGameTables($table='',$clearDate62='',$num_else,$fielddname='opentime'){
        if(empty($table) || empty($clearDate62))
            return 0;
        $redis = Redis::connection();
        $redis->select(5);
        if(!$redis->exists('clear-'.$table)){
            $res = DB::connection('mysql_report')->table($table)->select('id')->where($fielddname,'<=',$clearDate62)->first();
            if(empty($res)){
                $this->time = strtotime($this->stoptime) - time();
                $redis->setex('clear-'.$table,$this->time,$this->stoptime);
                writeLog('clear',$table.'=>0');
            }else{
                $sql = "DELETE FROM {$table} WHERE {$fielddname}<='{$clearDate62}' LIMIT 1000";
                $res = DB::statement($sql);
                writeLog('clear',$table.'=>'.$res);
                $num_else ++;
            }
        }
        return $num_else;
    }

    /**
     * 删游戏数据表-特定休市时间
     * @param string $table
     * @param string $clearDate62
     * @return int
     */
    private function delGameTables($table='',$delStart='',$delEnd='',$num_else,$fielddname='opentime'){
        if(empty($table) || empty($delStart) || empty($delEnd))
            return 0;
        $redis = Redis::connection();
        $redis->select(5);
        $redisKey = 'clear-del-'.$table.'-'.$delStart.'-'.$delEnd;
        if(!$redis->exists($redisKey)){
            $res = DB::connection('mysql_report')->table($table)->select('id')->whereBetween($fielddname, [$delStart, $delEnd])->first();
            if(empty($res)){
                $this->time = strtotime($this->stoptime) - time();
                $redis->setex($redisKey,$this->time,$this->stoptime);
                echo $redisKey.'=>0'.PHP_EOL;
                writeLog('clear',$redisKey.'=>0');
            }else{
                $sql = "DELETE FROM {$table} WHERE {$fielddname} between '{$delStart}' and '{$delEnd}'";
                $res = DB::statement($sql);
                echo $redisKey.'=>'.$res.PHP_EOL;
                writeLog('clear',$redisKey.'=>'.$res);
                $num_else ++;
            }
        }
        return $num_else;
    }
}
