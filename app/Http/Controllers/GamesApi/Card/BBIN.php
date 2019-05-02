<?php
/* BBIN */
namespace App\Http\Controllers\GamesApi\Card;

class BBIN extends Base{

    //获取棋牌投注详情
    public function getBet($param = []){
        $gamekind = isset($this->repo::gamekind[@$param['gamekind']]) ? [$param['gamekind'] => $this->repo::gamekind[@$param['gamekind']]] : $this->repo::gamekind;

        foreach ($gamekind as $k => $v){
            foreach ($v['subgamekinds'] ?? [0] as $kk => $vv){
                $this->repo->param['rounddate'] = $this->repo->param['rounddate'] ?? date('Y-m-d', $param['toTime'] ?? ($this->repo->getTime() - 60 * 10));//防止前一天最后5分钟没拉
                $this->repo->param['gamekind'] = $k;
                $this->repo->param['subgamekind'] = $vv;
                $this->repo->param['page'] = 0;
                $this->repo->param['pagelimit'] = 100;
                isset($param['toTime']) && $this->repo->param['endtime'] = date('H:i:s', ($param['toTime']));
                $this->repo->param['endtime'] = $this->repo->param['endtime'] ?? date('H:i:s', $param['toTime'] ?? ($this->repo->getTime() - 60 * 5));
                $this->repo->param['starttime'] = date('H:i:s', strtotime($this->repo->param['endtime']) - 60 * 5);

                if(in_array($this->repo->param['gamekind'], [3, 5])){
                    $this->BetRecord();
                }else{
                    $method = 'WagersRecordBy'.$this->repo->param['gamekind'];
                    $this->WagersRecordBy($method);
                }
            }
        }
    }

    private function WagersRecordBy($method)
    {
        if(!empty($res = $this->repo->WagersRecordBy($method))){
            writeLog($method, json_encode($res, 3));
            if($res['result'] == 1){
                $this->repo->createData($res['data']);
                if(count($res['data']) >= $this->repo->param['pagelimit'] ){
                    $this->repo->param['page'] ++;
                    $this->WagersRecordBy($method);
                }
            }
        }

        $code = $res['data']['Code'] ?? 500;
        $codeMsg = $res['data']['Message'] ?? '超时！';
        (($res['result'] ?? 0) != 1) && $this->repo->insertError($code, $codeMsg);
    }

    //除了体育
    private function BetRecord()
    {
        if(!empty($res = $this->repo->{__FUNCTION__}())){
            writeLog('BetRecord', json_encode($res, 3));
            if($res['result'] == 1){
                $this->repo->createData($res['data']);
                if(count($res['data']) >= $this->repo->param['pagelimit'] ){
                    $this->repo->param['page'] ++;
                    $this->{__FUNCTION__}();
                }
            }
        }
        $code = $res['data']['Code'] ?? 500;
        $codeMsg = $res['data']['Message'] ?? '超时！';
        (($res['result'] ?? 0) != 1) && $this->repo->insertError($code, $codeMsg);
    }

}
