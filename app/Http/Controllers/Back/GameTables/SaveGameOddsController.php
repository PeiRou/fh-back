<?php

namespace App\Http\Controllers\Back\GameTables;

use App\AgentOddsSetting;
use App\Games;
use App\Play;
use App\PlayCates;
use App\SystemSetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
class SaveGameOddsController extends Controller
{
    public function bjpk10(Request $request)
    {
        $data = $request->all();
        return $this->updateBatch($data,50);
    }

    public function cqssc(Request $request)
    {
        $data = $request->all();
        return $this->updateBatch($data,1);
    }

    public function xjssc(Request $request)
    {
        $data = $request->all();
        return $this->updateBatch($data,4);
    }

    public function tjssc(Request $request)
    {
        $data = $request->all();
        return $this->updateBatch($data,5);
    }

    public function gdklsf(Request $request)
    {
        $data = $request->all();
        return $this->updateBatch($data,60);
    }

    public function jsk3(Request $request)
    {
        $data = $request->all();
        return $this->updateBatch($data,10);
    }

    public function ahk3(Request $request)
    {
        $data = $request->all();
        return $this->updateBatch($data,11);
    }

    public function gxk3(Request $request)
    {
        $data = $request->all();
        return $this->updateBatch($data,12);
    }

    public function hbk3(Request $request)
    {
        $data = $request->all();
        return $this->updateBatch($data,13);
    }

    public function cqxync(Request $request)
    {
        $data = $request->all();
        return $this->updateBatch($data,61);
    }

    public function bjkl8(Request $request)
    {
        $data = $request->all();
        return $this->updateBatch($data,65);
    }

    public function gd11x5(Request $request)
    {
        $data = $request->all();
        return $this->updateBatch($data,21);
    }

    public function fc3d(Request $request)
    {
        $data = $request->all();
        return $this->updateBatch($data,30);
    }

    public function pcdd(Request $request)
    {
        $data = $request->all();
        return $this->updateBatch($data,66);
    }

    public function lhc(Request $request)
    {
        $data = $request->all();
        return $this->updateBatch($data,70);
    }

    public function xylhc(Request $request)
    {
        $data = $request->all();
        return $this->updateBatch($data,85);
    }

    public function mssc(Request $request)
    {
        $data = $request->all();
        return $this->updateBatch($data,80);
    }

    public function msft(Request $request)
    {
        $data = $request->all();
        return $this->updateBatch($data,82);
    }

    public function msssc(Request $request)
    {
        $data = $request->all();
        return $this->updateBatch($data,81);
    }

    public function paoma(Request $request)
    {
        $data = $request->all();
        return $this->updateBatch($data,99);
    }

    public function hebeik3(Request $request)
    {
        $data = $request->all();
        return $this->updateBatch($data,15);
    }

    public function gsk3(Request $request)
    {
        $data = $request->all();
        return $this->updateBatch($data,16);
    }

    public function gzk3(Request $request)
    {
        $data = $request->all();
        return $this->updateBatch($data,18);
    }

    public function txffc(Request $request)
    {
        $data = $request->all();
        return $this->updateBatch($data,112);
    }

    public function msqxc(Request $request)
    {
        $data = $request->all();
        return $this->updateBatch($data,114);
    }

    public function qqffc(Request $request)
    {
        $data = $request->all();
        return $this->updateBatch($data,113);
    }

    public function msjsk3(Request $request)
    {
        $this->view_name = 'jsk3';
        $data = $request->all();
        return $this->updateBatch($data,86);
    }

    function updateBatch($data,$id)
    {
        $sqlOdds = "UPDATE play SET odds = CASE ";
        $sqlRebate = "";
        $error = "no";
        foreach ($data as $key => $value) {
            if ($value == "") {
                $error = "yes";
                break;
            }
            $sqlOdds .= "WHEN `odds_tag` = '$key' THEN $value ";
            $sqlRebate .= "WHEN `rebate_tag` = '$key' THEN $value ";
        }
        if ($error == "yes") {
            return response()->json([
                'status' => false
            ]);
        } else {
            $sqlOdds .= "END, rebate = CASE ";
            $sqlRebate .= "END WHERE `gameId` = $id";
            $run = DB::statement($sqlOdds . $sqlRebate);
            if ($run == 1) {
                $write = Storage::disk('static')->put('gamedatas.js', '');
                $write1 = Storage::disk('static')->put('gamedatas.json', '');
                $game = Games::select('game_id as id', 'game_name as name')->orderBy('order', 'ASC')->get();
                $playCate = PlayCates::all();
                $plays = Play::select('odds_tag','rebate_tag','name', 'id', 'gameId', 'playCateId', 'alias', 'code', 'odds', 'rebate', 'minMoney', 'maxMoney', 'maxTurnMoney')->get();
                $views = $this->updateBatch1();
                $arr = [];
                foreach ($plays as $item) {
                    //pc端生成table数据
                    foreach ($views as $k => $v){
                        if($item->gameId == $k){
                            $arr[$k]['view'] = $v['view'];
                            if($k == 90 || $k == 91){ //pk10牛牛 秒速牛牛另外处理
                                $arr[$k]['fromDBOdds'][$item->name] = [
                                    'key' => $item->odds,
                                    'minMoney' => $item->minMoney,
                                    'maxMoney' => $item->maxMoney,
                                    'maxTurnMoney' => $item->maxTurnMoney,
                                ];
                                $arr[$k]['fromDBRebate'][$item->name]['key'] = $item->rebate * 100;
                            }else{
                                foreach($v['name'] as $vv){
                                    if($item->odds_tag == $vv){
                                        $arr[$k]['fromDBOdds'][$item->odds_tag] = [
                                            'key' => $item->odds,
                                            'minMoney' => $item->minMoney,
                                            'maxMoney' => $item->maxMoney,
                                            'maxTurnMoney' => $item->maxTurnMoney,
                                        ];
                                        $arr[$k]['fromDBRebate'][$item->rebate_tag]['key'] = $item->rebate * 100;
                                    }
                                }
                            }
                        }
                    }
                    $collect = collect($item);
                    $newID = $item->gameId . $item->playCateId . $item->id;
                    $newCollect[] = $collect->put('id', (int)$newID);
                }
                if(count($arr)){
                    foreach ($arr as $k => $v){
                        $str = view('table.'.$v['view'])
                            ->with('odds',$v['fromDBOdds'])
                            ->with('rebate',$v['fromDBRebate']);
                        Storage::disk('static')->put('tables/'.$k.'.json', $str);
                    }
                }
                $gameMap_txt = "var gameMap = " . $game->keyBy('id') . ";";
                $next_row = "\n";
                $playCate_txt = "var playCates = " . $playCate->keyBy('id') . ";";
                $plays_txt = "var plays = " . collect($newCollect)->keyBy('id') . ";";
                $animalsYear = "var animalsYear = ".json_encode(Config::get('website.animalsYear')).";";
                $write = Storage::disk('static')->put('gamedatas.js', $gameMap_txt . $next_row . $playCate_txt . $next_row . $plays_txt );

                $gameMap_txt = '"gameMap" : ' . $game->keyBy('id') . ",";
                $playCate_txt = ' "playCates" : ' . $playCate->keyBy('id') . ",";
                $plays_txt = ' "plays" : ' . collect($newCollect)->keyBy('id') . "}";
                $write1 = Storage::disk('static')->put('gamedatas.json', $gameMap_txt . $next_row . $playCate_txt . $next_row . $plays_txt );
                //生成ios的json格式
                $plays_txt = collect($newCollect)->keyBy('id');
                $writeIos = Storage::disk('static')->put('iosOdds.json', $plays_txt);
                if ($write == 1 && $write1 == 1 && $writeIos == 1) {
//                    $this->agentOddsAllFile($newCollect,$gameMap_txt,$gameMap_txt,$playCate_txt,$animalsYear,$next_row);
                    return response()->json([
                        'status' => true
                    ]);
                }
            }
        }
    }
    //pc端生成table
    private function updateBatch1($id = ''){
        $filter = [
            '1' => [
                'name' => ['1_5_odds','1_5_rebate','2face_odds','2face_rebate','longhu_odds','longhu_rebate','he_odds','he_rebate','q3z3h3_baozi_odds','q3z3h3_baozi_rebate','q3z3h3_shunzi_odds','q3z3h3_shunzi_rebate','q3z3h3_duizi_odds','q3z3h3_duizi_rebate','q3z3h3_banshun_odds','q3z3h3_banshun_rebate','q3z3h3_zaliu_odds','q3z3h3_zaliu_rebate'],
                'view' => 'cqssc'
            ] ,
            '4' => [
                'name' => ['1_5_odds','1_5_rebate','2face_odds','2face_rebate','longhu_odds','longhu_rebate','he_odds','he_rebate','q3z3h3_baozi_odds','q3z3h3_baozi_rebate','q3z3h3_shunzi_odds','q3z3h3_shunzi_rebate','q3z3h3_duizi_odds','q3z3h3_duizi_rebate','q3z3h3_banshun_odds','q3z3h3_banshun_rebate','q3z3h3_zaliu_odds','q3z3h3_zaliu_rebate'],
                'view' => 'cqssc'
            ],
            '5' => [
                'name' => ['1_5_odds','1_5_rebate','2face_odds','2face_rebate','longhu_odds','longhu_rebate','he_odds','he_rebate','q3z3h3_baozi_odds','q3z3h3_baozi_rebate','q3z3h3_shunzi_odds','q3z3h3_shunzi_rebate','q3z3h3_duizi_odds','q3z3h3_duizi_rebate','q3z3h3_banshun_odds','q3z3h3_banshun_rebate','q3z3h3_zaliu_odds','q3z3h3_zaliu_rebate'],
                'view' => 'cqssc'
            ],
            '113' => [
                'name' => ['1_5_odds','1_5_rebate','2face_odds','2face_rebate','longhu_odds','longhu_rebate','he_odds','he_rebate','q3z3h3_baozi_odds','q3z3h3_baozi_rebate','q3z3h3_shunzi_odds','q3z3h3_shunzi_rebate','q3z3h3_duizi_odds','q3z3h3_duizi_rebate','q3z3h3_banshun_odds','q3z3h3_banshun_rebate','q3z3h3_zaliu_odds','q3z3h3_zaliu_rebate'],
                'view' => 'cqssc'
            ],
            '81' => [
                'name' => ['1_5_odds','1_5_rebate','2face_odds','2face_rebate','longhu_odds','longhu_rebate','he_odds','he_rebate','q3z3h3_baozi_odds','q3z3h3_baozi_rebate','q3z3h3_shunzi_odds','q3z3h3_shunzi_rebate','q3z3h3_duizi_odds','q3z3h3_duizi_rebate','q3z3h3_banshun_odds','q3z3h3_banshun_rebate','q3z3h3_zaliu_odds','q3z3h3_zaliu_rebate'],
                'view' => 'cqssc'
            ],
            '21' => [
                'name' => ['1_5_odds','1_5_rebate','YZY_odds','YZY_rebate','2face_odds','2face_rebate','ZHDS_dan_odds','ZHDS_dan_rebate','ZHDS_shuang_odds','ZHDS_shuang_rebate','ZHWS_da_odds','ZHWS_da_rebate','ZHWS_xiao_odds','ZHWS_xiao_rebate','rx2_odds','rx2_rebate','rx3_odds','rx3_rebate','rx4_odds','rx4_rebate','rx5_odds','rx5_rebate','rx6_odds','rx6_rebate','rx7_odds','rx7_rebate','rx8_odds','rx8_rebate','q2zx_odds','q2zx_rebate','q3zx_odds','q3zx_rebate','q2zhix_odds','q2zhix_rebate','q3zhix_odds','q3zhix_rebate'],
                'view' => 'gd11x5'
            ],
            '60' => [
                'name' => ['1_8_odds','1_8_rebate','2face_odds','2face_rebate','1_8_FW_odds','1_8_FW_rebate','1_8_FW_odds','1_8_FW_rebate','zhongfa_odds','zhongfa_rebate','bai_odds','bai_rebate','ZM_odds','ZM_rebate','zongdan_odds','zongdan_rebate','zongshuang_odds','zongshuang_rebate','zongweida_odds','zongweida_rebate','zongweixiao_odds','zongweixiao_rebate','rx2_odds','rx2_rebate','x2lz_odds','x2lz_rebate','rx3_odds','rx3_rebate','x3qz_odds','x3qz_rebate','rx4_odds','rx4_rebate','rx5_odds','rx5_rebate'],
                'view' => 'gdklsf'
            ],
            '61' => [
                'name' => ['1_8_odds','1_8_rebate','2face_odds','2face_rebate','1_8_FW_odds','1_8_FW_rebate','1_8_FW_odds','1_8_FW_rebate','zhongfa_odds','zhongfa_rebate','bai_odds','bai_rebate','ZM_odds','ZM_rebate','zongdan_odds','zongdan_rebate','zongshuang_odds','zongshuang_rebate','zongweida_odds','zongweida_rebate','zongweixiao_odds','zongweixiao_rebate','rx2_odds','rx2_rebate','x2lz_odds','x2lz_rebate','rx3_odds','rx3_rebate','x3qz_odds','x3qz_rebate','rx4_odds','rx4_rebate','rx5_odds','rx5_rebate'],
                'view' => 'gdklsf'
            ],
            '10' => [
                'name' => ['HZ_DXDS_rebate','HZ_DXDS_odds','HZ_318_rebate','HZ_318_odds','HZ_417_odds','HZ_417_rebate','HZ_516_rebate','HZ_516_odds','HZ_615_rebate','HZ_615_odds','HZ_714_odds','HZ_714_rebate','HZ_813_rebate','HZ_813_odds','HZ_1011_rebate','HZ_1011_odds','HZ_912_odds','HZ_912_rebate','SLH_SLTX_odds','SLH_SLTX_rebate','SLH_odds','SLH_rebate','STH_odds','STH_rebate','STH_STTX_odds','STH_STTX_rebate','ETH_odds','ETH_rebate','KD_0_odds','KD_0_rebate','KD_15_odds','KD_15_rebate','KD_24_odds','KD_24_rebate','KD_3_odds','KD_3_rebate','KD_DA_odds','KD_DA_rebate','KD_XIAO_odds','KD_XIAO_rebate','KD_DAN_odds','KD_DAN_rebate','KD_SHUANG_odds','KD_SHUANG_rebate','PD_110_odds','PD_29_odds','PD_3_odds','PD_47_odds','PD_56_odds','PD_8_odds','PD_DXDS_odds','PD_DXDS_rebate','PD_110_rebate','PD_29_rebate','PD_8_rebate','PD_47_rebate','PD_56_rebate','PD_3_rebate','BICHU_odds','BICHU_rebate','BUCHU_odds','BUCHU_rebate'],
                'view' => 'jsk3'
            ],
            '11' => [
                'name' => ['HZ_DXDS_rebate','HZ_DXDS_odds','HZ_318_rebate','HZ_318_odds','HZ_417_odds','HZ_417_rebate','HZ_516_rebate','HZ_516_odds','HZ_615_rebate','HZ_615_odds','HZ_714_odds','HZ_714_rebate','HZ_813_rebate','HZ_813_odds','HZ_1011_rebate','HZ_1011_odds','HZ_912_odds','HZ_912_rebate','SLH_SLTX_odds','SLH_SLTX_rebate','SLH_odds','SLH_rebate','STH_odds','STH_rebate','STH_STTX_odds','STH_STTX_rebate','ETH_odds','ETH_rebate','KD_0_odds','KD_0_rebate','KD_15_odds','KD_15_rebate','KD_24_odds','KD_24_rebate','KD_3_odds','KD_3_rebate','KD_DA_odds','KD_DA_rebate','KD_XIAO_odds','KD_XIAO_rebate','KD_DAN_odds','KD_DAN_rebate','KD_SHUANG_odds','KD_SHUANG_rebate','PD_110_odds','PD_29_odds','PD_3_odds','PD_47_odds','PD_56_odds','PD_8_odds','PD_DXDS_odds','PD_DXDS_rebate','PD_110_rebate','PD_29_rebate','PD_8_rebate','PD_47_rebate','PD_56_rebate','PD_3_rebate','BICHU_odds','BICHU_rebate','BUCHU_odds','BUCHU_rebate'],
                'view' => 'jsk3'
            ],
            '86' => [
                'name' => ['HZ_DXDS_rebate','HZ_DXDS_odds','HZ_318_rebate','HZ_318_odds','HZ_417_odds','HZ_417_rebate','HZ_516_rebate','HZ_516_odds','HZ_615_rebate','HZ_615_odds','HZ_714_odds','HZ_714_rebate','HZ_813_rebate','HZ_813_odds','HZ_1011_rebate','HZ_1011_odds','HZ_912_odds','HZ_912_rebate','SLH_SLTX_odds','SLH_SLTX_rebate','SLH_odds','SLH_rebate','STH_odds','STH_rebate','STH_STTX_odds','STH_STTX_rebate','ETH_odds','ETH_rebate','KD_0_odds','KD_0_rebate','KD_15_odds','KD_15_rebate','KD_24_odds','KD_24_rebate','KD_3_odds','KD_3_rebate','KD_DA_odds','KD_DA_rebate','KD_XIAO_odds','KD_XIAO_rebate','KD_DAN_odds','KD_DAN_rebate','KD_SHUANG_odds','KD_SHUANG_rebate','PD_110_odds','PD_29_odds','PD_3_odds','PD_47_odds','PD_56_odds','PD_8_odds','PD_DXDS_odds','PD_DXDS_rebate','PD_110_rebate','PD_29_rebate','PD_8_rebate','PD_47_rebate','PD_56_rebate','PD_3_rebate','BICHU_odds','BICHU_rebate','BUCHU_odds','BUCHU_rebate'],
                'view' => 'jsk3'
            ],
            '12' => [
                'name' => ['HZ_DXDS_rebate','HZ_DXDS_odds','HZ_318_rebate','HZ_318_odds','HZ_417_odds','HZ_417_rebate','HZ_516_rebate','HZ_516_odds','HZ_615_rebate','HZ_615_odds','HZ_714_odds','HZ_714_rebate','HZ_813_rebate','HZ_813_odds','HZ_1011_rebate','HZ_1011_odds','HZ_912_odds','HZ_912_rebate','SLH_SLTX_odds','SLH_SLTX_rebate','SLH_odds','SLH_rebate','STH_odds','STH_rebate','STH_STTX_odds','STH_STTX_rebate','ETH_odds','ETH_rebate','KD_0_odds','KD_0_rebate','KD_15_odds','KD_15_rebate','KD_24_odds','KD_24_rebate','KD_3_odds','KD_3_rebate','KD_DA_odds','KD_DA_rebate','KD_XIAO_odds','KD_XIAO_rebate','KD_DAN_odds','KD_DAN_rebate','KD_SHUANG_odds','KD_SHUANG_rebate','PD_110_odds','PD_29_odds','PD_3_odds','PD_47_odds','PD_56_odds','PD_8_odds','PD_DXDS_odds','PD_DXDS_rebate','PD_110_rebate','PD_29_rebate','PD_8_rebate','PD_47_rebate','PD_56_rebate','PD_3_rebate','BICHU_odds','BICHU_rebate','BUCHU_odds','BUCHU_rebate'],
                'view' => 'jsk3'
            ],
            '13' => [
                'name' => ['HZ_DXDS_rebate','HZ_DXDS_odds','HZ_318_rebate','HZ_318_odds','HZ_417_odds','HZ_417_rebate','HZ_516_rebate','HZ_516_odds','HZ_615_rebate','HZ_615_odds','HZ_714_odds','HZ_714_rebate','HZ_813_rebate','HZ_813_odds','HZ_1011_rebate','HZ_1011_odds','HZ_912_odds','HZ_912_rebate','SLH_SLTX_odds','SLH_SLTX_rebate','SLH_odds','SLH_rebate','STH_odds','STH_rebate','STH_STTX_odds','STH_STTX_rebate','ETH_odds','ETH_rebate','KD_0_odds','KD_0_rebate','KD_15_odds','KD_15_rebate','KD_24_odds','KD_24_rebate','KD_3_odds','KD_3_rebate','KD_DA_odds','KD_DA_rebate','KD_XIAO_odds','KD_XIAO_rebate','KD_DAN_odds','KD_DAN_rebate','KD_SHUANG_odds','KD_SHUANG_rebate','PD_110_odds','PD_29_odds','PD_3_odds','PD_47_odds','PD_56_odds','PD_8_odds','PD_DXDS_odds','PD_DXDS_rebate','PD_110_rebate','PD_29_rebate','PD_8_rebate','PD_47_rebate','PD_56_rebate','PD_3_rebate','BICHU_odds','BICHU_rebate','BUCHU_odds','BUCHU_rebate'],
                'view' => 'jsk3'
            ],
            '15' => [
                'name' => ['HZ_DXDS_rebate','HZ_DXDS_odds','HZ_318_rebate','HZ_318_odds','HZ_417_odds','HZ_417_rebate','HZ_516_rebate','HZ_516_odds','HZ_615_rebate','HZ_615_odds','HZ_714_odds','HZ_714_rebate','HZ_813_rebate','HZ_813_odds','HZ_1011_rebate','HZ_1011_odds','HZ_912_odds','HZ_912_rebate','SLH_SLTX_odds','SLH_SLTX_rebate','SLH_odds','SLH_rebate','STH_odds','STH_rebate','STH_STTX_odds','STH_STTX_rebate','ETH_odds','ETH_rebate','KD_0_odds','KD_0_rebate','KD_15_odds','KD_15_rebate','KD_24_odds','KD_24_rebate','KD_3_odds','KD_3_rebate','KD_DA_odds','KD_DA_rebate','KD_XIAO_odds','KD_XIAO_rebate','KD_DAN_odds','KD_DAN_rebate','KD_SHUANG_odds','KD_SHUANG_rebate','PD_110_odds','PD_29_odds','PD_3_odds','PD_47_odds','PD_56_odds','PD_8_odds','PD_DXDS_odds','PD_DXDS_rebate','PD_110_rebate','PD_29_rebate','PD_8_rebate','PD_47_rebate','PD_56_rebate','PD_3_rebate','BICHU_odds','BICHU_rebate','BUCHU_odds','BUCHU_rebate'],
                'view' => 'jsk3'
            ],
            '16' => [
                'name' => ['HZ_DXDS_rebate','HZ_DXDS_odds','HZ_318_rebate','HZ_318_odds','HZ_417_odds','HZ_417_rebate','HZ_516_rebate','HZ_516_odds','HZ_615_rebate','HZ_615_odds','HZ_714_odds','HZ_714_rebate','HZ_813_rebate','HZ_813_odds','HZ_1011_rebate','HZ_1011_odds','HZ_912_odds','HZ_912_rebate','SLH_SLTX_odds','SLH_SLTX_rebate','SLH_odds','SLH_rebate','STH_odds','STH_rebate','STH_STTX_odds','STH_STTX_rebate','ETH_odds','ETH_rebate','KD_0_odds','KD_0_rebate','KD_15_odds','KD_15_rebate','KD_24_odds','KD_24_rebate','KD_3_odds','KD_3_rebate','KD_DA_odds','KD_DA_rebate','KD_XIAO_odds','KD_XIAO_rebate','KD_DAN_odds','KD_DAN_rebate','KD_SHUANG_odds','KD_SHUANG_rebate','PD_110_odds','PD_29_odds','PD_3_odds','PD_47_odds','PD_56_odds','PD_8_odds','PD_DXDS_odds','PD_DXDS_rebate','PD_110_rebate','PD_29_rebate','PD_8_rebate','PD_47_rebate','PD_56_rebate','PD_3_rebate','BICHU_odds','BICHU_rebate','BUCHU_odds','BUCHU_rebate'],
                'view' => 'jsk3'
            ],
            '18' => [
                'name' => ['HZ_DXDS_rebate','HZ_DXDS_odds','HZ_318_rebate','HZ_318_odds','HZ_417_odds','HZ_417_rebate','HZ_516_rebate','HZ_516_odds','HZ_615_rebate','HZ_615_odds','HZ_714_odds','HZ_714_rebate','HZ_813_rebate','HZ_813_odds','HZ_1011_rebate','HZ_1011_odds','HZ_912_odds','HZ_912_rebate','SLH_SLTX_odds','SLH_SLTX_rebate','SLH_odds','SLH_rebate','STH_odds','STH_rebate','STH_STTX_odds','STH_STTX_rebate','ETH_odds','ETH_rebate','KD_0_odds','KD_0_rebate','KD_15_odds','KD_15_rebate','KD_24_odds','KD_24_rebate','KD_3_odds','KD_3_rebate','KD_DA_odds','KD_DA_rebate','KD_XIAO_odds','KD_XIAO_rebate','KD_DAN_odds','KD_DAN_rebate','KD_SHUANG_odds','KD_SHUANG_rebate','PD_110_odds','PD_29_odds','PD_3_odds','PD_47_odds','PD_56_odds','PD_8_odds','PD_DXDS_odds','PD_DXDS_rebate','PD_110_rebate','PD_29_rebate','PD_8_rebate','PD_47_rebate','PD_56_rebate','PD_3_rebate','BICHU_odds','BICHU_rebate','BUCHU_odds','BUCHU_rebate'],
                'view' => 'jsk3'
            ],
            '66' => [
                'name' => ['HH_dxds_odds','HH_dxds_rebate','HH_dd_ds_xd_xs_odds','HH_dd_ds_xd_xs_rebate','HH_jd_jx_odds','HH_jd_jx_rebate','HH_baozi_odds','HH_baozi_rebate','BS_odds','BS_rebate','TM_0_odds','TM_0_rebate','TM_0126_odds','TM_0126_rebate','TM_0225_odds','TM_0225_rebate','TM_3_odds','TM_3_rebate','TM_0423_odds','TM_0423_rebate','TM_0522_odds','TM_0522_rebate','TM_0621_odds','TM_0621_rebate','TM_0720_odds','TM_0720_rebate','TM_0819_odds','TM_0819_rebate','TM_0918_odds','TM_0918_rebate','TM_1017_odds','TM_1017_rebate','TM_1116_odds','TM_1116_rebate','TM_1215_odds','TM_1215_rebate','TM_1314_odds','TM_1314_rebate','TM_24_odds','TM_24_rebate','TM_27_odds','TM_27_rebate'],
                'view' => 'pcdd'
            ],
            '65' => [
                'name' => ['ZM_odds','ZM_rebate','jin_tu_odds','jin_tu_rebate','mu_huo_odds','mu_huo_rebate','shui_odds','shui_rebate','2face_odds','2face_rebate','heju_odds','heju_rebate','guoguan_odds','guoguan_rebate','qianhou_odds','qianhou_rebate','qianhouhe_odds','qianhouhe_rebate','danshuang_odds','danshuang_rebate','danshuanghe_odds','danshuanghe_rebate'],
                'view' => 'bjkl8'
            ],
            '50' => [
                'name' => ['GYD_odds','GYD_rebate','GYX_odds','GYX_rebate','GYDan_odds','GYDan_rebate','GYS_odds','GYS_rebate','1_10_odds','1_10_rebate','2face_odds','2face_rebate','341819_odds','341819_rebate','561617_odds','561617_rebate','781415_odds','781415_rebate','9101213_odds','9101213_rebate','11_odds','11_rebate'],
                'view' => 'bjpk10'
            ],
            '80' => [
                'name' => ['GYD_odds','GYD_rebate','GYX_odds','GYX_rebate','GYDan_odds','GYDan_rebate','GYS_odds','GYS_rebate','341819_odds','341819_rebate','561617_odds','561617_rebate','781415_odds','781415_rebate','9101213_odds','9101213_rebate','11_odds','11_rebate','1_10_odds','1_10_rebate','2face_odds','2face_rebate'],
                'view' => 'bjpk10'
            ],
            '82' => [
                'name' => ['GYD_odds','GYD_rebate','GYX_odds','GYX_rebate','GYDan_odds','GYDan_rebate','GYS_odds','GYS_rebate','341819_odds','341819_rebate','561617_odds','561617_rebate','781415_odds','781415_rebate','9101213_odds','9101213_rebate','11_odds','11_rebate','1_10_odds','1_10_rebate','2face_odds','2face_rebate'],
                'view' => 'bjpk10'
            ],
            '99' => [
                'name' => ['GYD_odds','GYD_rebate','GYX_odds','GYX_rebate','GYDan_odds','GYDan_rebate','GYS_odds','GYS_rebate','341819_odds','341819_rebate','561617_odds','561617_rebate','781415_odds','781415_rebate','9101213_odds','9101213_rebate','11_odds','11_rebate','1_10_odds','1_10_rebate','2face_odds','2face_rebate'],
                'view' => 'bjpk10'
            ],
            '70' => [
                'name' => ['TMA_01_odds','TMA_01_rebate','TMA_02_odds','TMA_02_rebate','TMA_03_odds','TMA_03_rebate','TMA_04_odds','TMA_04_rebate','TMA_05_odds','TMA_05_rebate','TMA_06_odds','TMA_06_rebate','TMA_07_odds','TMA_07_rebate','TMA_08_odds','TMA_08_rebate','TMA_09_odds','TMA_09_rebate','TMA_10_odds','TMA_10_rebate','TMA_11_odds','TMA_11_rebate','TMA_12_odds','TMA_12_rebate','TMA_13_odds','TMA_13_rebate','TMA_14_odds','TMA_14_rebate','TMA_15_odds','TMA_15_rebate','TMA_16_odds','TMA_16_rebate','TMA_17_odds','TMA_17_rebate','TMA_18_odds','TMA_18_rebate','TMA_19_odds','TMA_19_rebate','TMA_20_odds','TMA_20_rebate','TMA_21_odds','TMA_21_rebate','TMA_22_odds','TMA_22_rebate','TMA_23_odds','TMA_23_rebate','TMA_24_odds','TMA_24_rebate','TMA_25_odds','TMA_25_rebate','TMA_26_odds','TMA_26_rebate','TMA_27_odds','TMA_27_rebate','TMA_28_odds','TMA_28_rebate','TMA_29_odds','TMA_29_rebate','TMA_30_odds','TMA_30_rebate','TMA_31_odds','TMA_31_rebate','TMA_32_odds','TMA_32_rebate','TMA_33_odds','TMA_33_rebate','TMA_34_odds','TMA_34_rebate','TMA_35_odds','TMA_35_rebate','TMA_36_odds','TMA_36_rebate','TMA_37_odds','TMA_37_rebate','TMA_38_odds','TMA_38_rebate','TMA_39_odds','TMA_39_rebate','TMA_40_odds','TMA_40_rebate','TMA_41_odds','TMA_41_rebate','TMA_42_odds','TMA_42_rebate','TMA_43_odds','TMA_43_rebate','TMA_44_odds','TMA_44_rebate','TMA_45_odds','TMA_45_rebate','TMA_46_odds','TMA_46_rebate','TMA_47_odds','TMA_47_rebate','TMA_48_odds','TMA_48_rebate','TMA_49_odds','TMA_49_rebate','TMB_01_odds','TMB_01_rebate','TMB_02_odds','TMB_02_rebate','TMB_03_odds','TMB_03_rebate','TMB_04_odds','TMB_04_rebate','TMB_05_odds','TMB_05_rebate','TMB_06_odds','TMB_06_rebate','TMB_07_odds','TMB_07_rebate','TMB_08_odds','TMB_08_rebate','TMB_09_odds','TMB_09_rebate','TMB_10_odds','TMB_10_rebate','TMB_11_odds','TMB_11_rebate','TMB_12_odds','TMB_12_rebate','TMB_13_odds','TMB_13_rebate','TMB_14_odds','TMB_14_rebate','TMB_15_odds','TMB_15_rebate','TMB_16_odds','TMB_16_rebate','TMB_17_odds','TMB_17_rebate','TMB_18_odds','TMB_18_rebate','TMB_19_odds','TMB_19_rebate','TMB_20_odds','TMB_20_rebate','TMB_21_odds','TMB_21_rebate','TMB_22_odds','TMB_22_rebate','TMB_23_odds','TMB_23_rebate','TMB_24_odds','TMB_24_rebate','TMB_25_odds','TMB_25_rebate','TMB_26_odds','TMB_26_rebate','TMB_27_odds','TMB_27_rebate','TMB_28_odds','TMB_28_rebate','TMB_29_odds','TMB_29_rebate','TMB_30_odds','TMB_30_rebate','TMB_31_odds','TMB_31_rebate','TMB_32_odds','TMB_32_rebate','TMB_33_odds','TMB_33_rebate','TMB_34_odds','TMB_34_rebate','TMB_35_odds','TMB_35_rebate','TMB_36_odds','TMB_36_rebate','TMB_37_odds','TMB_37_rebate','TMB_38_odds','TMB_38_rebate','TMB_39_odds','TMB_39_rebate','TMB_40_odds','TMB_40_rebate','TMB_41_odds','TMB_41_rebate','TMB_42_odds','TMB_42_rebate','TMB_43_odds','TMB_43_rebate','TMB_44_odds','TMB_44_rebate','TMB_45_odds','TMB_45_rebate','TMB_46_odds','TMB_46_rebate','TMB_47_odds','TMB_47_rebate','TMB_48_odds','TMB_48_rebate','TMB_49_odds','TMB_49_rebate','LM_rebate','LM_odds','LM_TMDXDS_rebate','LM_TMDXDS_odds','HB_odds','HB_rebate','LB_LB_odds','LB_LB_rebate','HD_LX_LX_odds','HD_LX_LX_rebate','SB_HX_odds','SB_HX_rebate','SB_LVD_odds','SB_LVD_rebate','SB_LD_odds','SB_LD_rebate','HD_LD_LS_LD_odds','HD_LD_LS_LD_rebate','SB_HSHUANG_odds','SB_HSHUANG_rebate','SB_LVSHUANG_odds','SB_LVSHUANG_rebate','SB_HDD_LXD_LXS_odds','SB_HDD_LXD_LXS_rebate','SB_HXD_HXS_LDD_odds','SB_HXD_HXS_LDD_rebate','HDS_LXS_LDS_LDD_LXD_LDS_odds','HDS_LXS_LDS_LDD_LXD_LDS_rebate','TX_SHU_odds','TX_SHU_rebate','TX_NIU_odds','TX_NIU_rebate','TX_HU_odds','TX_HU_rebate','TX_TU_odds','TX_TU_rebate','TX_LONG_odds','TX_LONG_rebate','TX_SHE_odds','TX_SHE_rebate','TX_MA_odds','TX_MA_rebate','TX_YANG_odds','TX_YANG_rebate','TX_HOU_odds','TX_HOU_rebate','TX_JI_odds','TX_JI_rebate','TX_GOU_odds','TX_GOU_rebate','TX_ZHU_odds','TX_ZHU_rebate','HX_2X_odds','HX_2X_rebate','HX_3X_odds','HX_3X_rebate','HX_4X_odds','HX_4X_rebate','HX_5X_odds','HX_5X_rebate','HX_6X_odds','HX_6X_rebate','HX_7X_odds','HX_7X_rebate','HX_8X_odds','HX_8X_rebate','HX_9X_odds','HX_9X_rebate','HX_10X_odds','HX_10X_rebate','HX_11X_odds','HX_11X_rebate','TWS_0T_odds','TWS_0T_rebate','TWS_T_rebate','TWS_T_odds','TWS_0W_odds','TWS_0W_rebate','TWS_W_rebate','TWS_W_odds','ZM_odds','ZM_rebate','WX_JIN_odds','WX_JIN_rebate','WX_MU_odds','WX_MU_rebate','WX_SHUI_odds','WX_SHUI_rebate','WX_HUO_odds','WX_HUO_rebate','WX_TU_odds','WX_TU_rebate','PTYX_SHU_odds','PTYX_SHU_rebate','PTYX_NIU_odds','PTYX_NIU_rebate','PTYX_HU_odds','PTYX_HU_rebate','PTYX_TU_odds','PTYX_TU_rebate','PTYX_LONG_odds','PTYX_LONG_rebate','PTYX_SHE_odds','PTYX_SHE_rebate','PTYX_MA_odds','PTYX_MA_rebate','PTYX_YANG_odds','PTYX_YANG_rebate','PTYX_HOU_odds','PTYX_HOU_rebate','PTYX_JI_odds','PTYX_JI_rebate','PTYX_GOU_odds','PTYX_GOU_rebate','PTYX_ZHU_odds','PTYX_ZHU_rebate','ZTM_rebate','ZTM_odds','ZTM_HBO_odds','ZTM_HBO_rebate','ZTM_H_L_L_odds','ZTM_H_L_L_rebate','PTYX_0W_odds','PTYX_0W_rebate','PTYX_1W_odds','PTYX_1W_rebate','PTYX_2W_odds','PTYX_2W_rebate','PTYX_3W_odds','PTYX_3W_rebate','PTYX_4W_odds','PTYX_4W_rebate','PTYX_5W_odds','PTYX_5W_rebate','PTYX_6W_odds','PTYX_6W_rebate','PTYX_7W_odds','PTYX_7W_rebate','PTYX_8W_odds','PTYX_8W_rebate','PTYX_9W_odds','PTYX_9W_rebate','7SB_HJ_odds','7SB_HJ_rebate','7SB_LB_LB_odds','7SB_LB_LB_rebate','7SB_HONG_odds','7SB_HONG_rebate','ZONGXIAO_2X_odds','ZONGXIAO_2X_rebate','ZONGXIAO_3X_odds','ZONGXIAO_3X_rebate','ZONGXIAO_4X_odds','ZONGXIAO_4X_rebate','ZONGXIAO_5X_odds','ZONGXIAO_5X_rebate','ZONGXIAO_6X_odds','ZONGXIAO_6X_rebate','ZONGXIAO_7X_odds','ZONGXIAO_7X_rebate','ZONGXIAO_DAN_odds','ZONGXIAO_DAN_rebate','ZONGXIAO_S_odds','ZONGXIAO_S_rebate','3Z2_Z2_odds','3Z2_Z2_rebate','3Z2_Z3_odds','3Z2_Z3_rebate','3QZ_odds','3QZ_rebate','2QZ_odds','2QZ_rebate','2ZT_ZT_odds','2ZT_ZT_rebate','2ZT_Z2_odds','2ZT_Z2_rebate','TC_ZT_odds','TC_ZT_rebate','4QZ_odds','4QZ_rebate','ZXIAO_SHU_odds','ZXIAO_SHU_rebate','ZXIAO_NIU_odds','ZXIAO_NIU_rebate','ZXIAO_HU_odds','ZXIAO_HU_rebate','ZXIAO_TU_odds','ZXIAO_TU_rebate','ZXIAO_LONG_odds','ZXIAO_LONG_rebate','ZXIAO_SHE_odds','ZXIAO_SHE_rebate','ZXIAO_MA_odds','ZXIAO_MA_rebate','ZXIAO_YANG_odds','ZXIAO_YANG_rebate','ZXIAO_HOU_odds','ZXIAO_HOU_rebate','ZXIAO_JI_odds','ZXIAO_JI_rebate','ZXIAO_GOU_odds','ZXIAO_GOU_rebate','ZXIAO_ZHU_odds','ZXIAO_ZHU_rebate','ELX_SHU_odds','ELX_SHU_rebate','ELX_NIU_odds','ELX_NIU_rebate','ELX_HU_odds','ELX_HU_rebate','ELX_TU_odds','ELX_TU_rebate','ELX_LONG_odds','ELX_LONG_rebate','ELX_SHE_odds','ELX_SHE_rebate','ELX_MA_odds','ELX_MA_rebate','ELX_YANG_odds','ELX_YANG_rebate','ELX_HOU_odds','ELX_HOU_rebate','ELX_JI_odds','ELX_JI_rebate','ELX_GOU_odds','ELX_GOU_rebate','ELX_ZHU_odds','ELX_ZHU_rebate','SLX_SHU_odds','SLX_SHU_rebate','SLX_NIU_odds','SLX_NIU_rebate','SLX_HU_odds','SLX_HU_rebate','SLX_TU_odds','SLX_TU_rebate','SLX_LONG_odds','SLX_LONG_rebate','SLX_SHE_odds','SLX_SHE_rebate','SLX_MA_odds','SLX_MA_rebate','SLX_YANG_odds','SLX_YANG_rebate','SLX_HOU_odds','SLX_HOU_rebate','SLX_JI_odds','SLX_JI_rebate','SLX_GOU_odds','SLX_GOU_rebate','SLX_ZHU_odds','SLX_ZHU_rebate','SILX_SHU_odds','SILX_SHU_rebate','SILX_NIU_odds','SILX_NIU_rebate','SILX_HU_odds','SILX_HU_rebate','SILX_TU_odds','SILX_TU_rebate','SILX_LONG_odds','SILX_LONG_rebate','SILX_SHE_odds','SILX_SHE_rebate','SILX_MA_odds','SILX_MA_rebate','SILX_YANG_odds','SILX_YANG_rebate','SILX_HOU_odds','SILX_HOU_rebate','SILX_JI_odds','SILX_JI_rebate','SILX_GOU_odds','SILX_GOU_rebate','SILX_ZHU_odds','SILX_ZHU_rebate','WLX_SHU_odds','WLX_SHU_rebate','WLX_NIU_odds','WLX_NIU_rebate','WLX_HU_odds','WLX_HU_rebate','WLX_TU_odds','WLX_TU_rebate','WLX_LONG_odds','WLX_LONG_rebate','WLX_SHE_odds','WLX_SHE_rebate','WLX_MA_odds','WLX_MA_rebate','WLX_YANG_odds','WLX_YANG_rebate','WLX_HOU_odds','WLX_HOU_rebate','WLX_JI_odds','WLX_JI_rebate','WLX_GOU_odds','WLX_GOU_rebate','WLX_ZHU_odds','WLX_ZHU_rebate','EELW_0W_odds','EELW_0W_rebate','EELW_W_odds','EELW_W_rebate','SSLW_0W_odds','SSLW_0W_rebate','SSLW_W_odds','SSLW_W_rebate','SILW_0W_odds','SILW_0W_rebate','SILW_W_odds','SILW_W_rebate','WULW_0W_odds','WULW_0W_rebate','WULW_W_odds','WULW_W_rebate','ZXBZ_12BZ_odds','ZXBZ_12BZ_rebate','ZXBZ_11BZ_odds','ZXBZ_11BZ_rebate','ZXBZ_10BZ_odds','ZXBZ_10BZ_rebate','ZXBZ_9BZ_odds','ZXBZ_9BZ_rebate','ZXBZ_8BZ_odds','ZXBZ_8BZ_rebate','ZXBZ_7BZ_odds','ZXBZ_7BZ_rebate','ZXBZ_6BZ_odds','ZXBZ_6BZ_rebate','ZXBZ_5BZ_odds','ZXBZ_5BZ_rebate','ZMLM_odds','ZMLM_rebate'],
                'view' => 'xglhc'
            ],
            '85' => [
                'name' => ['TMA_01_odds','TMA_01_rebate','TMA_02_odds','TMA_02_rebate','TMA_03_odds','TMA_03_rebate','TMA_04_odds','TMA_04_rebate','TMA_05_odds','TMA_05_rebate','TMA_06_odds','TMA_06_rebate','TMA_07_odds','TMA_07_rebate','TMA_08_odds','TMA_08_rebate','TMA_09_odds','TMA_09_rebate','TMA_10_odds','TMA_10_rebate','TMA_11_odds','TMA_11_rebate','TMA_12_odds','TMA_12_rebate','TMA_13_odds','TMA_13_rebate','TMA_14_odds','TMA_14_rebate','TMA_15_odds','TMA_15_rebate','TMA_16_odds','TMA_16_rebate','TMA_17_odds','TMA_17_rebate','TMA_18_odds','TMA_18_rebate','TMA_19_odds','TMA_19_rebate','TMA_20_odds','TMA_20_rebate','TMA_21_odds','TMA_21_rebate','TMA_22_odds','TMA_22_rebate','TMA_23_odds','TMA_23_rebate','TMA_24_odds','TMA_24_rebate','TMA_25_odds','TMA_25_rebate','TMA_26_odds','TMA_26_rebate','TMA_27_odds','TMA_27_rebate','TMA_28_odds','TMA_28_rebate','TMA_29_odds','TMA_29_rebate','TMA_30_odds','TMA_30_rebate','TMA_31_odds','TMA_31_rebate','TMA_32_odds','TMA_32_rebate','TMA_33_odds','TMA_33_rebate','TMA_34_odds','TMA_34_rebate','TMA_35_odds','TMA_35_rebate','TMA_36_odds','TMA_36_rebate','TMA_37_odds','TMA_37_rebate','TMA_38_odds','TMA_38_rebate','TMA_39_odds','TMA_39_rebate','TMA_40_odds','TMA_40_rebate','TMA_41_odds','TMA_41_rebate','TMA_42_odds','TMA_42_rebate','TMA_43_odds','TMA_43_rebate','TMA_44_odds','TMA_44_rebate','TMA_45_odds','TMA_45_rebate','TMA_46_odds','TMA_46_rebate','TMA_47_odds','TMA_47_rebate','TMA_48_odds','TMA_48_rebate','TMA_49_odds','TMA_49_rebate','TMB_01_odds','TMB_01_rebate','TMB_02_odds','TMB_02_rebate','TMB_03_odds','TMB_03_rebate','TMB_04_odds','TMB_04_rebate','TMB_05_odds','TMB_05_rebate','TMB_06_odds','TMB_06_rebate','TMB_07_odds','TMB_07_rebate','TMB_08_odds','TMB_08_rebate','TMB_09_odds','TMB_09_rebate','TMB_10_odds','TMB_10_rebate','TMB_11_odds','TMB_11_rebate','TMB_12_odds','TMB_12_rebate','TMB_13_odds','TMB_13_rebate','TMB_14_odds','TMB_14_rebate','TMB_15_odds','TMB_15_rebate','TMB_16_odds','TMB_16_rebate','TMB_17_odds','TMB_17_rebate','TMB_18_odds','TMB_18_rebate','TMB_19_odds','TMB_19_rebate','TMB_20_odds','TMB_20_rebate','TMB_21_odds','TMB_21_rebate','TMB_22_odds','TMB_22_rebate','TMB_23_odds','TMB_23_rebate','TMB_24_odds','TMB_24_rebate','TMB_25_odds','TMB_25_rebate','TMB_26_odds','TMB_26_rebate','TMB_27_odds','TMB_27_rebate','TMB_28_odds','TMB_28_rebate','TMB_29_odds','TMB_29_rebate','TMB_30_odds','TMB_30_rebate','TMB_31_odds','TMB_31_rebate','TMB_32_odds','TMB_32_rebate','TMB_33_odds','TMB_33_rebate','TMB_34_odds','TMB_34_rebate','TMB_35_odds','TMB_35_rebate','TMB_36_odds','TMB_36_rebate','TMB_37_odds','TMB_37_rebate','TMB_38_odds','TMB_38_rebate','TMB_39_odds','TMB_39_rebate','TMB_40_odds','TMB_40_rebate','TMB_41_odds','TMB_41_rebate','TMB_42_odds','TMB_42_rebate','TMB_43_odds','TMB_43_rebate','TMB_44_odds','TMB_44_rebate','TMB_45_odds','TMB_45_rebate','TMB_46_odds','TMB_46_rebate','TMB_47_odds','TMB_47_rebate','TMB_48_odds','TMB_48_rebate','TMB_49_odds','TMB_49_rebate','LM_rebate','LM_odds','LM_TMDXDS_rebate','LM_TMDXDS_odds','HB_odds','HB_rebate','LB_LB_odds','LB_LB_rebate','HD_LX_LX_odds','HD_LX_LX_rebate','SB_HX_odds','SB_HX_rebate','SB_LVD_odds','SB_LVD_rebate','SB_LD_odds','SB_LD_rebate','HD_LD_LS_LD_odds','HD_LD_LS_LD_rebate','SB_HSHUANG_odds','SB_HSHUANG_rebate','SB_LVSHUANG_odds','SB_LVSHUANG_rebate','SB_HDD_LXD_LXS_odds','SB_HDD_LXD_LXS_rebate','SB_HXD_HXS_LDD_odds','SB_HXD_HXS_LDD_rebate','HDS_LXS_LDS_LDD_LXD_LDS_odds','HDS_LXS_LDS_LDD_LXD_LDS_rebate','TX_SHU_odds','TX_SHU_rebate','TX_NIU_odds','TX_NIU_rebate','TX_HU_odds','TX_HU_rebate','TX_TU_odds','TX_TU_rebate','TX_LONG_odds','TX_LONG_rebate','TX_SHE_odds','TX_SHE_rebate','TX_MA_odds','TX_MA_rebate','TX_YANG_odds','TX_YANG_rebate','TX_HOU_odds','TX_HOU_rebate','TX_JI_odds','TX_JI_rebate','TX_GOU_odds','TX_GOU_rebate','TX_ZHU_odds','TX_ZHU_rebate','HX_2X_odds','HX_2X_rebate','HX_3X_odds','HX_3X_rebate','HX_4X_odds','HX_4X_rebate','HX_5X_odds','HX_5X_rebate','HX_6X_odds','HX_6X_rebate','HX_7X_odds','HX_7X_rebate','HX_8X_odds','HX_8X_rebate','HX_9X_odds','HX_9X_rebate','HX_10X_odds','HX_10X_rebate','HX_11X_odds','HX_11X_rebate','TWS_0T_odds','TWS_0T_rebate','TWS_T_rebate','TWS_T_odds','TWS_0W_odds','TWS_0W_rebate','TWS_W_rebate','TWS_W_odds','ZM_odds','ZM_rebate','WX_JIN_odds','WX_JIN_rebate','WX_MU_odds','WX_MU_rebate','WX_SHUI_odds','WX_SHUI_rebate','WX_HUO_odds','WX_HUO_rebate','WX_TU_odds','WX_TU_rebate','PTYX_SHU_odds','PTYX_SHU_rebate','PTYX_NIU_odds','PTYX_NIU_rebate','PTYX_HU_odds','PTYX_HU_rebate','PTYX_TU_odds','PTYX_TU_rebate','PTYX_LONG_odds','PTYX_LONG_rebate','PTYX_SHE_odds','PTYX_SHE_rebate','PTYX_MA_odds','PTYX_MA_rebate','PTYX_YANG_odds','PTYX_YANG_rebate','PTYX_HOU_odds','PTYX_HOU_rebate','PTYX_JI_odds','PTYX_JI_rebate','PTYX_GOU_odds','PTYX_GOU_rebate','PTYX_ZHU_odds','PTYX_ZHU_rebate','ZTM_rebate','ZTM_odds','ZTM_HBO_odds','ZTM_HBO_rebate','ZTM_H_L_L_odds','ZTM_H_L_L_rebate','PTYX_0W_odds','PTYX_0W_rebate','PTYX_1W_odds','PTYX_1W_rebate','PTYX_2W_odds','PTYX_2W_rebate','PTYX_3W_odds','PTYX_3W_rebate','PTYX_4W_odds','PTYX_4W_rebate','PTYX_5W_odds','PTYX_5W_rebate','PTYX_6W_odds','PTYX_6W_rebate','PTYX_7W_odds','PTYX_7W_rebate','PTYX_8W_odds','PTYX_8W_rebate','PTYX_9W_odds','PTYX_9W_rebate','7SB_HJ_odds','7SB_HJ_rebate','7SB_LB_LB_odds','7SB_LB_LB_rebate','7SB_HONG_odds','7SB_HONG_rebate','ZONGXIAO_2X_odds','ZONGXIAO_2X_rebate','ZONGXIAO_3X_odds','ZONGXIAO_3X_rebate','ZONGXIAO_4X_odds','ZONGXIAO_4X_rebate','ZONGXIAO_5X_odds','ZONGXIAO_5X_rebate','ZONGXIAO_6X_odds','ZONGXIAO_6X_rebate','ZONGXIAO_7X_odds','ZONGXIAO_7X_rebate','ZONGXIAO_DAN_odds','ZONGXIAO_DAN_rebate','ZONGXIAO_S_odds','ZONGXIAO_S_rebate','3Z2_Z2_odds','3Z2_Z2_rebate','3Z2_Z3_odds','3Z2_Z3_rebate','3QZ_odds','3QZ_rebate','2QZ_odds','2QZ_rebate','2ZT_ZT_odds','2ZT_ZT_rebate','2ZT_Z2_odds','2ZT_Z2_rebate','TC_ZT_odds','TC_ZT_rebate','4QZ_odds','4QZ_rebate','ZXIAO_SHU_odds','ZXIAO_SHU_rebate','ZXIAO_NIU_odds','ZXIAO_NIU_rebate','ZXIAO_HU_odds','ZXIAO_HU_rebate','ZXIAO_TU_odds','ZXIAO_TU_rebate','ZXIAO_LONG_odds','ZXIAO_LONG_rebate','ZXIAO_SHE_odds','ZXIAO_SHE_rebate','ZXIAO_MA_odds','ZXIAO_MA_rebate','ZXIAO_YANG_odds','ZXIAO_YANG_rebate','ZXIAO_HOU_odds','ZXIAO_HOU_rebate','ZXIAO_JI_odds','ZXIAO_JI_rebate','ZXIAO_GOU_odds','ZXIAO_GOU_rebate','ZXIAO_ZHU_odds','ZXIAO_ZHU_rebate','ELX_SHU_odds','ELX_SHU_rebate','ELX_NIU_odds','ELX_NIU_rebate','ELX_HU_odds','ELX_HU_rebate','ELX_TU_odds','ELX_TU_rebate','ELX_LONG_odds','ELX_LONG_rebate','ELX_SHE_odds','ELX_SHE_rebate','ELX_MA_odds','ELX_MA_rebate','ELX_YANG_odds','ELX_YANG_rebate','ELX_HOU_odds','ELX_HOU_rebate','ELX_JI_odds','ELX_JI_rebate','ELX_GOU_odds','ELX_GOU_rebate','ELX_ZHU_odds','ELX_ZHU_rebate','SLX_SHU_odds','SLX_SHU_rebate','SLX_NIU_odds','SLX_NIU_rebate','SLX_HU_odds','SLX_HU_rebate','SLX_TU_odds','SLX_TU_rebate','SLX_LONG_odds','SLX_LONG_rebate','SLX_SHE_odds','SLX_SHE_rebate','SLX_MA_odds','SLX_MA_rebate','SLX_YANG_odds','SLX_YANG_rebate','SLX_HOU_odds','SLX_HOU_rebate','SLX_JI_odds','SLX_JI_rebate','SLX_GOU_odds','SLX_GOU_rebate','SLX_ZHU_odds','SLX_ZHU_rebate','SILX_SHU_odds','SILX_SHU_rebate','SILX_NIU_odds','SILX_NIU_rebate','SILX_HU_odds','SILX_HU_rebate','SILX_TU_odds','SILX_TU_rebate','SILX_LONG_odds','SILX_LONG_rebate','SILX_SHE_odds','SILX_SHE_rebate','SILX_MA_odds','SILX_MA_rebate','SILX_YANG_odds','SILX_YANG_rebate','SILX_HOU_odds','SILX_HOU_rebate','SILX_JI_odds','SILX_JI_rebate','SILX_GOU_odds','SILX_GOU_rebate','SILX_ZHU_odds','SILX_ZHU_rebate','WLX_SHU_odds','WLX_SHU_rebate','WLX_NIU_odds','WLX_NIU_rebate','WLX_HU_odds','WLX_HU_rebate','WLX_TU_odds','WLX_TU_rebate','WLX_LONG_odds','WLX_LONG_rebate','WLX_SHE_odds','WLX_SHE_rebate','WLX_MA_odds','WLX_MA_rebate','WLX_YANG_odds','WLX_YANG_rebate','WLX_HOU_odds','WLX_HOU_rebate','WLX_JI_odds','WLX_JI_rebate','WLX_GOU_odds','WLX_GOU_rebate','WLX_ZHU_odds','WLX_ZHU_rebate','EELW_0W_odds','EELW_0W_rebate','EELW_W_odds','EELW_W_rebate','SSLW_0W_odds','SSLW_0W_rebate','SSLW_W_odds','SSLW_W_rebate','SILW_0W_odds','SILW_0W_rebate','SILW_W_odds','SILW_W_rebate','WULW_0W_odds','WULW_0W_rebate','WULW_W_odds','WULW_W_rebate','ZXBZ_12BZ_odds','ZXBZ_12BZ_rebate','ZXBZ_11BZ_odds','ZXBZ_11BZ_rebate','ZXBZ_10BZ_odds','ZXBZ_10BZ_rebate','ZXBZ_9BZ_odds','ZXBZ_9BZ_rebate','ZXBZ_8BZ_odds','ZXBZ_8BZ_rebate','ZXBZ_7BZ_odds','ZXBZ_7BZ_rebate','ZXBZ_6BZ_odds','ZXBZ_6BZ_rebate','ZXBZ_5BZ_odds','ZXBZ_5BZ_rebate','ZMLM_odds','ZMLM_rebate'],
                'view' => 'xglhc'
            ],
            '90' => [
                'name' => [] ,
                'view' => 'pk10nn',
            ],
            '91' => [
                'name' => [] ,
                'view' => 'pk10nn',
            ],
        ];
        if(empty($id)) return $filter;
        return isset($filter[$id]) ? $filter[$id] : false;
    }

    //生成全部层级代理赔率文件
    public function agentOddsAllFile($newCollect,$game_txt,$gameMap_txt,$playCate_txt,$animalsYear,$next_row){
        $aAgentOdds = AgentOddsSetting::select('level','odds')->orderBy('level','asc')->get();
        $this->agentOddsAloneFile($aAgentOdds,$newCollect,$game_txt,$gameMap_txt,$playCate_txt,$animalsYear,$next_row);
    }

    //生成单个层级代理赔率文件
    public function agentOddsAloneFile($aAgentOdds,$newCollect,$game_txt,$gameMap_txt,$playCate_txt,$animalsYear,$next_row,$i = 0,$preOdds = 0){
        if(!empty($aAgentOdds[$i]->odds) && !empty($aAgentOdds[$i]->level)){
            $aArray = [];
            if(empty($preOdds)){
                $iAgentOddsBasis = SystemSetting::getValueByRemark1('agent_odds_basis');
                foreach ($newCollect as $kNewCollect => $iNewCollect) {
                    $aArray[$kNewCollect] = $iNewCollect;
                    $aArray[$kNewCollect]['odds'] = $this->getAgentOdds($iAgentOddsBasis, $aAgentOdds[$i]->odds, $iNewCollect['odds']);
                }
                $preOdds = $aAgentOdds[$i]->odds;
            }else{
                foreach ($newCollect as $kNewCollect => $iNewCollect){
                    $aArray[$kNewCollect] = $iNewCollect;
                    $aArray[$kNewCollect]['odds'] = $this->getAgentOdds($preOdds, $aAgentOdds[$i]->odds, $iNewCollect['odds']);
                }
                $preOdds = $aAgentOdds[$i]->odds;
            }

            $plays_txt = "var plays = ".collect($aArray)->keyBy('id').";";
            Storage::disk('static')->put('gamedatas'.$aAgentOdds[$i]->level.'.js',$game_txt.$next_row.$gameMap_txt.$next_row.$playCate_txt.$next_row.$plays_txt);

            $plays_ios_txt = collect($aArray)->keyBy('id');
            Storage::disk('static')->put('iosOdds'.$aAgentOdds[$i]->level.'.json',$plays_ios_txt);

            $i++;
            $this->agentOddsAloneFile($aAgentOdds,$aArray,$game_txt,$gameMap_txt,$playCate_txt,$animalsYear,$next_row,$i,$preOdds);
        }
    }

    //获取集体赔率
    public function getAgentOdds($preOdds,$setOdds,$justOdds){
        //获取小数后位数
        $length = $this->getDecimalNumber($justOdds);
        $odds = (string)round((1 - ($preOdds -$setOdds)/$preOdds)*$justOdds,$length);
        $oddsLength = $this->getDecimalNumber($odds);
        if($oddsLength < $length){
            return $odds.'0';
        }
        return $odds;
    }

    //获取小数后位数
    public function getDecimalNumber($preOdds){
        $aNum = explode('.',$preOdds);
        if(empty($aNum[1]))
            return 0;
        else
            return strlen($aNum[1]);
    }
}
