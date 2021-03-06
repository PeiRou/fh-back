<?php
/* BBIN */
namespace App\Http\Controllers\GamesApi\Card;

use Illuminate\Support\Facades\Redis;

class BBIN extends Base{

    public $kind = null;
    //获取棋牌投注详情
    public function getBet($param = []){
        try{
            $redis = Redis::connection();
            $redis->select(5);
            $key = 'GameApiGetBet:'.$this->repo->gameInfo->g_id;
            if($redis->exists($key)){
                sleep(5);
            }
            $redis->setex($key, 20, 'on');
        }catch (\Throwable $e){
            $this->repo->WriteLog($e->getMessage().$e->getFile().'('.$e->getLine().')'.$e->getTraceAsString());
        }
        if(($jq_error_bet_id = @app('obj')->jq_error_bet_id) > 0){
            $this->repo->param = $param;
            $this->sgssdfjk();
        }else {
            $gamekind = isset($this->repo::gamekind[@$param['gamekind']]) ? [$param['gamekind'] => $this->repo::gamekind[@$param['gamekind']]] : $this->repo::gamekind;
            $starttime = strtotime($this->repo->OffsetTime(['time' => $param['toTime'] ?? time()])) - (60 * 60 * 12) - (60 * 8);
            $starttime = $this->bt($starttime);
            $this->repo->param['starttime'] = $this->repo->param['starttime'] ?? date('H:i:s', $starttime);
            $this->repo->param['endtime'] = date('H:i:s', strtotime($this->repo->param['starttime']) + 299);
            $this->repo->param['rounddate'] = $this->repo->param['rounddate'] ?? date('Y-m-d', $starttime);//防止前一天最后5分钟没拉
            $kind = null;
            foreach ($gamekind as $k => $v) {
                foreach ($v['subgamekinds'] ?? [0] as $kk => $vv) {
                    $this->repo->param['page'] = 0;
                    $this->repo->param['gamekind'] = $k;
                    $this->repo->param['subgamekind'] = $vv;
                    $this->repo->param['pagelimit'] = 500;
                    $this->sgssdfjk();
                }
            }
        }
    }

    public function bt($time)
    {
        $i = date('i', $time);
        $d = date('YmdH', $time).sprintf("%'02d", (((int)($i / 5)) * 5)).'00';
        return strtotime($d);
    }
    public function sgssdfjk()
    {
        if (in_array($this->repo->param['gamekind'], [3, 5])) {
            $method = 'BetRecord';
//            $this->BetRecord();
        } else {
            $method = 'WagersRecordBy' . $this->repo->param['gamekind'];
//            $this->WagersRecordBy($method);
        }
        $this->f($method);
    }

    private function f($method)
    {
        if($this->kind == $this->repo->param['gamekind']){
            sleep(1 + rand(0, 4));
        }
        $this->kind = $this->repo->param['gamekind'];

        $r = $method == 'BetRecord' ? 'BetRecord' : 'WagersRecordBy';
        if(!empty($res = $this->repo->{$r}($method))){
//            writeLog($method, json_encode($res, 3));
            if($res['result'] == 1){
                $this->repo->createData($res['data']);
                if(count($res['data']) >= $this->repo->param['pagelimit'] ){
                    $this->repo->param['page'] ++;
                    $this->f($method);
                }
            }
        }
        if(($res['result'] ?? 0) != 1){
            $code = $res['data']['Code'] ?? 500;
            $codeMsg = $res['data']['Message'] ?? '超时！';
        }
        $this->repo->insertError($code ?? $res['data']['Code'] ?? 0, $codeMsg ?? 'ok');
    }

    //除了体育
//    private function BetRecord()
//    {
//        if(!empty($res = $this->repo->{__FUNCTION__}())){
////            writeLog('BetRecord', json_encode($res, 3));
//            if($res['result'] == 1){
//                $this->repo->createData($res['data']);
//                if(count($res['data']) >= $this->repo->param['pagelimit'] ){
//                    $this->repo->param['page'] ++;
//                    $this->{__FUNCTION__}();
//                }
//            }
//        }
//        if(($res['result'] ?? 0) != 1){
//            $code = $res['data']['Code'] ?? 500;
//            $codeMsg = $res['data']['Message'] ?? '超时！';
//        }
//
//        $this->repo->insertError($code ?? $res['data']['Code'] ?? 0, $codeMsg ?? 'ok');
//    }

}
