<?php
/* BBIN */
namespace App\Http\Controllers\GamesApi\Card;

class BBIN extends Base{

    //获取棋牌投注详情
    public function getBet($param = []){

        if(($jq_error_bet_id = @app('obj')->jq_error_bet_id) > 0){
            $this->repo->param = $param;
            $this->sgssdfjk();
        }else {
            $gamekind = isset($this->repo::gamekind[@$param['gamekind']]) ? [$param['gamekind'] => $this->repo::gamekind[@$param['gamekind']]] : $this->repo::gamekind;
            isset($param['toTime']) && $param['toTime'] = $param['toTime'] - 60 * 5;
            foreach ($gamekind as $k => $v) {
                foreach ($v['subgamekinds'] ?? [0] as $kk => $vv) {
                    $this->repo->param['rounddate'] = $this->repo->param['rounddate'] ?? date('Y-m-d', ($param['toTime']) ?? ($this->repo->getTime() - 60 * 10));//防止前一天最后5分钟没拉
                    $this->repo->param['gamekind'] = $k;
                    $this->repo->param['subgamekind'] = $vv;
                    $this->repo->param['page'] = 0;
                    $this->repo->param['pagelimit'] = 800;
                    isset($param['toTime']) && $this->repo->param['endtime'] = date('H:i:s', ($param['toTime']));
                    $this->repo->param['endtime'] = $this->repo->param['endtime'] ?? date('H:i:s', $param['toTime'] ?? ($this->repo->getTime() - 60 * 10));
                    $this->repo->param['starttime'] = date('H:i:s', strtotime($this->repo->param['endtime']) - 60 * 5);
                    $this->sgssdfjk();
                }
            }
        }
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
