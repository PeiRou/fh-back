<?php

namespace App\Http\Controllers\Back;

use App\Play;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GameTableController extends Controller
{
    public function gameTable50()
    {
        $data = Play::where('gameId',50)->get();
        $filter = ['GYD_odds','GYD_rebate','GYX_odds','GYX_rebate','GYDan_odds','GYDan_rebate','GYS_odds','GYS_rebate','1_10_odds','1_10_rebate','2face_odds','2face_rebate','341819_odds','341819_rebate','561617_odds','561617_rebate','781415_odds','781415_rebate','9101213_odds','9101213_rebate','11_odds','11_rebate'];
        $fromDBOdds = collect([]);
        $fromDBRebate = collect([]);
        foreach ($data as $item){
            foreach ($filter as $i){
                if($item->odds_tag == $i)
                {
                    $fromDBOdds->put($item->odds_tag,$item->odds);
                }
            }
            foreach ($filter as $s){
                if($item->rebate_tag == $s){
                    $fromDBRebate->put($item->rebate_tag,$item->rebate);
                }
            }
        }
        //return $fromDBRebate->all();
        return view('back.gameTables.50')->with('odds',$fromDBOdds->all())->with('rebate',$fromDBRebate->all());
    }

    public function gameTable1()
    {
        $data = Play::where('gameId',1)->get();
        $filter = ['1_5_odds','1_5_rebate','2face_odds','2face_rebate','longhu_odds','longhu_rebate','he_odds','he_rebate','q3z3h3_baozi_odds','q3z3h3_baozi_rebate','q3z3h3_shunzi_odds','q3z3h3_shunzi_rebate','q3z3h3_duizi_odds','q3z3h3_duizi_rebate','q3z3h3_banshun_odds','q3z3h3_banshun_rebate','q3z3h3_zaliu_odds','q3z3h3_zaliu_rebate'];
        $fromDBOdds = collect([]);
        $fromDBRebate = collect([]);
        foreach ($data as $item){
            foreach ($filter as $i){
                if($item->odds_tag == $i)
                {
                    $fromDBOdds->put($item->odds_tag,$item->odds);
                }
            }
            foreach ($filter as $s){
                if($item->rebate_tag == $s){
                    $fromDBRebate->put($item->rebate_tag,$item->rebate);
                }
            }
        }
        return view('back.gameTables.1')->with('odds',$fromDBOdds->all())->with('rebate',$fromDBRebate->all());
    }

    public function gameTable4()
    {
        $data = Play::where('gameId',4)->get();
        $filter = ['1_5_odds','1_5_rebate','2face_odds','2face_rebate','longhu_odds','longhu_rebate','he_odds','he_rebate','q3z3h3_baozi_odds','q3z3h3_baozi_rebate','q3z3h3_shunzi_odds','q3z3h3_shunzi_rebate','q3z3h3_duizi_odds','q3z3h3_duizi_rebate','q3z3h3_banshun_odds','q3z3h3_banshun_rebate','q3z3h3_zaliu_odds','q3z3h3_zaliu_rebate'];
        $fromDBOdds = collect([]);
        $fromDBRebate = collect([]);
        foreach ($data as $item){
            foreach ($filter as $i){
                if($item->odds_tag == $i)
                {
                    $fromDBOdds->put($item->odds_tag,$item->odds);
                }
            }
            foreach ($filter as $s){
                if($item->rebate_tag == $s){
                    $fromDBRebate->put($item->rebate_tag,$item->rebate);
                }
            }
        }
        return view('back.gameTables.4')->with('odds',$fromDBOdds->all())->with('rebate',$fromDBRebate->all());
    }

    public function gameTable5()
    {
        $data = Play::where('gameId',5)->get();
        $filter = ['1_5_odds','1_5_rebate','2face_odds','2face_rebate','longhu_odds','longhu_rebate','he_odds','he_rebate','q3z3h3_baozi_odds','q3z3h3_baozi_rebate','q3z3h3_shunzi_odds','q3z3h3_shunzi_rebate','q3z3h3_duizi_odds','q3z3h3_duizi_rebate','q3z3h3_banshun_odds','q3z3h3_banshun_rebate','q3z3h3_zaliu_odds','q3z3h3_zaliu_rebate'];
        $fromDBOdds = collect([]);
        $fromDBRebate = collect([]);
        foreach ($data as $item){
            foreach ($filter as $i){
                if($item->odds_tag == $i)
                {
                    $fromDBOdds->put($item->odds_tag,$item->odds);
                }
            }
            foreach ($filter as $s){
                if($item->rebate_tag == $s){
                    $fromDBRebate->put($item->rebate_tag,$item->rebate);
                }
            }
        }
        return view('back.gameTables.5')->with('odds',$fromDBOdds->all())->with('rebate',$fromDBRebate->all());
    }

    public function gameTable60()
    {
        $data = Play::where('gameId',60)->get();
        $filter = ['1_8_odds','1_8_rebate','2face_odds','2face_rebate','1_8_FW_odds','1_8_FW_rebate','1_8_FW_odds','1_8_FW_rebate','zhongfa_odds','zhongfa_rebate','bai_odds','bai_rebate','ZM_odds','ZM_rebate','zongdan_odds','zongdan_rebate','zongshuang_odds','zongshuang_rebate','zongweida_odds','zongweida_rebate','zongweixiao_odds','zongweixiao_rebate','rx2_odds','rx2_rebate','x2lz_odds','x2lz_rebate','rx3_odds','rx3_rebate','x3qz_odds','x3qz_rebate','rx4_odds','rx4_rebate','rx5_odds','rx5_rebate'];
        $fromDBOdds = collect([]);
        $fromDBRebate = collect([]);
        foreach ($data as $item){
            foreach ($filter as $i){
                if($item->odds_tag == $i)
                {
                    $fromDBOdds->put($item->odds_tag,$item->odds);
                }
            }
            foreach ($filter as $s){
                if($item->rebate_tag == $s){
                    $fromDBRebate->put($item->rebate_tag,$item->rebate);
                }
            }
        }
        return view('back.gameTables.60')->with('odds',$fromDBOdds->all())->with('rebate',$fromDBRebate->all());
    }

    public function gameTable10()
    {
        $data = Play::where('gameId',10)->get();
        $filter = ['HZ_DXDS_rebate','HZ_DXDS_odds','HZ_318_rebate','HZ_318_odds','HZ_417_odds','HZ_417_rebate','HZ_516_rebate','HZ_516_odds','HZ_615_rebate','HZ_615_odds','HZ_714_odds','HZ_714_rebate','HZ_813_rebate','HZ_813_odds','HZ_1011_rebate','HZ_1011_odds','HZ_912_odds','HZ_912_rebate','SLH_SLTX_odds','SLH_SLTX_rebate','SLH_odds','SLH_rebate','STH_odds','STH_rebate','STH_STTX_odds','STH_STTX_rebate','ETH_odds','ETH_rebate','KD_0_odds','KD_0_rebate','KD_15_odds','KD_15_rebate','KD_24_odds','KD_24_rebate','KD_3_odds','KD_3_rebate','KD_DA_odds','KD_DA_rebate','KD_XIAO_odds','KD_XIAO_rebate','KD_DAN_odds','KD_DAN_rebate','KD_SHUANG_odds','KD_SHUANG_rebate','PD_110_odds','PD_29_odds','PD_3_odds','PD_47_odds','PD_56_odds','PD_8_odds','PD_DXDS_odds','PD_DXDS_rebate','PD_110_rebate','PD_29_rebate','PD_8_rebate','PD_47_rebate','PD_56_rebate','PD_3_rebate','BICHU_odds','BICHU_rebate','BUCHU_odds','BUCHU_rebate'];
        $fromDBOdds = collect([]);
        $fromDBRebate = collect([]);
        foreach ($data as $item){
            foreach ($filter as $i){
                if($item->odds_tag == $i)
                {
                    $fromDBOdds->put($item->odds_tag,$item->odds);
                }
            }
            foreach ($filter as $s){
                if($item->rebate_tag == $s){
                    $fromDBRebate->put($item->rebate_tag,$item->rebate);
                }
            }
        }
        return view('back.gameTables.10')->with('odds',$fromDBOdds->all())->with('rebate',$fromDBRebate->all());
    }

    public function gameTable11(){
        $data = Play::where('gameId',11)->get();
        $filter = ['HZ_DXDS_rebate','HZ_DXDS_odds','HZ_318_rebate','HZ_318_odds','HZ_417_odds','HZ_417_rebate','HZ_516_rebate','HZ_516_odds','HZ_615_rebate','HZ_615_odds','HZ_714_odds','HZ_714_rebate','HZ_813_rebate','HZ_813_odds','HZ_1011_rebate','HZ_1011_odds','HZ_912_odds','HZ_912_rebate','SLH_SLTX_odds','SLH_SLTX_rebate','SLH_odds','SLH_rebate','STH_odds','STH_rebate','STH_STTX_odds','STH_STTX_rebate','ETH_odds','ETH_rebate','KD_0_odds','KD_0_rebate','KD_15_odds','KD_15_rebate','KD_24_odds','KD_24_rebate','KD_3_odds','KD_3_rebate','KD_DA_odds','KD_DA_rebate','KD_XIAO_odds','KD_XIAO_rebate','KD_DAN_odds','KD_DAN_rebate','KD_SHUANG_odds','KD_SHUANG_rebate','PD_110_odds','PD_29_odds','PD_3_odds','PD_47_odds','PD_56_odds','PD_8_odds','PD_DXDS_odds','PD_DXDS_rebate','PD_110_rebate','PD_29_rebate','PD_8_rebate','PD_47_rebate','PD_56_rebate','PD_3_rebate','BICHU_odds','BICHU_rebate','BUCHU_odds','BUCHU_rebate'];
        $fromDBOdds = collect([]);
        $fromDBRebate = collect([]);
        foreach ($data as $item){
            foreach ($filter as $i){
                if($item->odds_tag == $i)
                {
                    $fromDBOdds->put($item->odds_tag,$item->odds);
                }
            }
            foreach ($filter as $s){
                if($item->rebate_tag == $s){
                    $fromDBRebate->put($item->rebate_tag,$item->rebate);
                }
            }
        }
        return view('back.gameTables.11')->with('odds',$fromDBOdds->all())->with('rebate',$fromDBRebate->all());
    }

    public function gameTable12(){
        $data = Play::where('gameId',12)->get();
        $filter = ['HZ_DXDS_rebate','HZ_DXDS_odds','HZ_318_rebate','HZ_318_odds','HZ_417_odds','HZ_417_rebate','HZ_516_rebate','HZ_516_odds','HZ_615_rebate','HZ_615_odds','HZ_714_odds','HZ_714_rebate','HZ_813_rebate','HZ_813_odds','HZ_1011_rebate','HZ_1011_odds','HZ_912_odds','HZ_912_rebate','SLH_SLTX_odds','SLH_SLTX_rebate','SLH_odds','SLH_rebate','STH_odds','STH_rebate','STH_STTX_odds','STH_STTX_rebate','ETH_odds','ETH_rebate','KD_0_odds','KD_0_rebate','KD_15_odds','KD_15_rebate','KD_24_odds','KD_24_rebate','KD_3_odds','KD_3_rebate','KD_DA_odds','KD_DA_rebate','KD_XIAO_odds','KD_XIAO_rebate','KD_DAN_odds','KD_DAN_rebate','KD_SHUANG_odds','KD_SHUANG_rebate','PD_110_odds','PD_29_odds','PD_3_odds','PD_47_odds','PD_56_odds','PD_8_odds','PD_DXDS_odds','PD_DXDS_rebate','PD_110_rebate','PD_29_rebate','PD_8_rebate','PD_47_rebate','PD_56_rebate','PD_3_rebate','BICHU_odds','BICHU_rebate','BUCHU_odds','BUCHU_rebate'];
        $fromDBOdds = collect([]);
        $fromDBRebate = collect([]);
        foreach ($data as $item){
            foreach ($filter as $i){
                if($item->odds_tag == $i)
                {
                    $fromDBOdds->put($item->odds_tag,$item->odds);
                }
            }
            foreach ($filter as $s){
                if($item->rebate_tag == $s){
                    $fromDBRebate->put($item->rebate_tag,$item->rebate);
                }
            }
        }
        return view('back.gameTables.12')->with('odds',$fromDBOdds->all())->with('rebate',$fromDBRebate->all());
    }

    public function gameTable13(){
        $data = Play::where('gameId',13)->get();
        $filter = ['HZ_DXDS_rebate','HZ_DXDS_odds','HZ_318_rebate','HZ_318_odds','HZ_417_odds','HZ_417_rebate','HZ_516_rebate','HZ_516_odds','HZ_615_rebate','HZ_615_odds','HZ_714_odds','HZ_714_rebate','HZ_813_rebate','HZ_813_odds','HZ_1011_rebate','HZ_1011_odds','HZ_912_odds','HZ_912_rebate','SLH_SLTX_odds','SLH_SLTX_rebate','SLH_odds','SLH_rebate','STH_odds','STH_rebate','STH_STTX_odds','STH_STTX_rebate','ETH_odds','ETH_rebate','KD_0_odds','KD_0_rebate','KD_15_odds','KD_15_rebate','KD_24_odds','KD_24_rebate','KD_3_odds','KD_3_rebate','KD_DA_odds','KD_DA_rebate','KD_XIAO_odds','KD_XIAO_rebate','KD_DAN_odds','KD_DAN_rebate','KD_SHUANG_odds','KD_SHUANG_rebate','PD_110_odds','PD_29_odds','PD_3_odds','PD_47_odds','PD_56_odds','PD_8_odds','PD_DXDS_odds','PD_DXDS_rebate','PD_110_rebate','PD_29_rebate','PD_8_rebate','PD_47_rebate','PD_56_rebate','PD_3_rebate','BICHU_odds','BICHU_rebate','BUCHU_odds','BUCHU_rebate'];
        $fromDBOdds = collect([]);
        $fromDBRebate = collect([]);
        foreach ($data as $item){
            foreach ($filter as $i){
                if($item->odds_tag == $i)
                {
                    $fromDBOdds->put($item->odds_tag,$item->odds);
                }
            }
            foreach ($filter as $s){
                if($item->rebate_tag == $s){
                    $fromDBRebate->put($item->rebate_tag,$item->rebate);
                }
            }
        }
        return view('back.gameTables.13')->with('odds',$fromDBOdds->all())->with('rebate',$fromDBRebate->all());
    }

    public function gameTable61()
    {
        $data = Play::where('gameId',61)->get();
        $filter = ['1_8_odds','1_8_rebate','ZM_odds','ZM_rebate','2face_odds','2face_rebate','zongdan_odds','zongdan_rebate','zongshuang_odds','zongshuang_rebate','zongweida_odds','zongweida_rebate','zongweixiao_odds','zongweixiao_rebate','1_8_FW_odds','1_8_FW_rebate','zhongfa_odds','zhongfa_rebate','bai_odds','bai_rebate','rx2_odds','rx2_rebate','x2lz_odds','x2lz_rebate','rx3_odds','rx3_rebate','x3qz_odds','x3qz_rebate','rx4_odds','rx4_rebate','rx5_odds','rx5_rebate'];
        return $this->OddsAndRebate($data,$filter,61);
    }

    public function gameTable65()
    {
        $data = Play::where('gameId',65)->get();
        $filter = ['ZM_odds','ZM_rebate','jin_tu_odds','jin_tu_rebate','mu_huo_odds','mu_huo_rebate','shui_odds','shui_rebate','2face_odds','2face_rebate','heju_odds','heju_rebate','guoguan_odds','guoguan_rebate','qianhou_odds','qianhou_rebate','qianhouhe_odds','qianhouhe_rebate','danshuang_odds','danshuang_rebate','danshuanghe_odds','danshuanghe_rebate'];
        return $this->OddsAndRebate($data,$filter,65);
    }

    public function gameTable21()
    {
        $data = Play::where('gameId',21)->get();
        $filter = ['1_5_odds','1_5_rebate','YZY_odds','YZY_rebate','2face_odds','2face_rebate','ZHDS_dan_odds','ZHDS_dan_rebate','ZHDS_shuang_odds','ZHDS_shuang_rebate','ZHWS_da_odds','ZHWS_da_rebate','ZHWS_xiao_odds','ZHWS_xiao_rebate','rx2_odds','rx2_rebate','rx3_odds','rx3_rebate','rx4_odds','rx4_rebate','rx5_odds','rx5_rebate','rx6_odds','rx6_rebate','rx7_odds','rx7_rebate','rx8_odds','rx8_rebate','q2zx_odds','q2zx_rebate','q3zx_odds','q3zx_rebate','q2zhix_odds','q2zhix_rebate','q3zhix_odds','q3zhix_rebate'];
        return $this->OddsAndRebate($data,$filter,21);
    }

    public function gameTable66()
    {
        $data = Play::where('gameId',66)->get();
        $filter = ['HH_dxds_odds','HH_dxds_rebate','HH_dd_ds_xd_xs_odds','HH_dd_ds_xd_xs_rebate','HH_jd_jx_odds','HH_jd_jx_rebate','HH_baozi_odds','HH_baozi_rebate','BS_odds','BS_rebate','TM_0_odds','TM_0_rebate','TM_0126_odds','TM_0126_rebate','TM_0225_odds','TM_0225_rebate','TM_3_odds','TM_3_rebate','TM_0423_odds','TM_0423_rebate','TM_0522_odds','TM_0522_rebate','TM_0621_odds','TM_0621_rebate','TM_0720_odds','TM_0720_rebate','TM_0819_odds','TM_0819_rebate','TM_0918_odds','TM_0918_rebate','TM_1017_odds','TM_1017_rebate','TM_1116_odds','TM_1116_rebate','TM_1215_odds','TM_1215_rebate','TM_1314_odds','TM_1314_rebate','TM_24_odds','TM_24_rebate','TM_27_odds','TM_27_rebate'];
        return $this->OddsAndRebate($data,$filter,66);
    }

    public function gameTable80()
    {
        $data = Play::where('gameId',80)->get();
        $filter = ['GYD_odds','GYD_rebate','GYX_odds','GYX_rebate','GYDan_odds','GYDan_rebate','GYS_odds','GYS_rebate','341819_odds','341819_rebate','561617_odds','561617_rebate','781415_odds','781415_rebate','9101213_odds','9101213_rebate','11_odds','11_rebate','1_10_odds','1_10_rebate','2face_odds','2face_rebate'];
        return $this->OddsAndRebate($data,$filter,80);
    }

    public function gameTable82()
    {
        $data = Play::where('gameId',82)->get();
        $filter = ['GYD_odds','GYD_rebate','GYX_odds','GYX_rebate','GYDan_odds','GYDan_rebate','GYS_odds','GYS_rebate','341819_odds','341819_rebate','561617_odds','561617_rebate','781415_odds','781415_rebate','9101213_odds','9101213_rebate','11_odds','11_rebate','1_10_odds','1_10_rebate','2face_odds','2face_rebate'];
        return $this->OddsAndRebate($data,$filter,82);
    }

    public function gameTable81()
    {
        $data = Play::where('gameId',81)->get();
        $filter = ['1_5_odds','1_5_rebate','2face_odds','2face_rebate','longhu_odds','longhu_rebate','he_odds','he_rebate','q3z3h3_baozi_odds','q3z3h3_baozi_rebate','q3z3h3_shunzi_odds','q3z3h3_shunzi_rebate','q3z3h3_duizi_odds','q3z3h3_duizi_rebate','q3z3h3_banshun_odds','q3z3h3_banshun_rebate','q3z3h3_zaliu_odds','q3z3h3_zaliu_rebate'];
        return $this->OddsAndRebate($data,$filter,81);
    }

    public function gameTable99()
    {
        $data = Play::where('gameId',99)->get();
        $filter = ['GYD_odds','GYD_rebate','GYX_odds','GYX_rebate','GYDan_odds','GYDan_rebate','GYS_odds','GYS_rebate','341819_odds','341819_rebate','561617_odds','561617_rebate','781415_odds','781415_rebate','9101213_odds','9101213_rebate','11_odds','11_rebate','1_10_odds','1_10_rebate','2face_odds','2face_rebate'];
        return $this->OddsAndRebate($data,$filter,99);
    }

    public function gameTable30()
    {
        $data = Play::where('gameId',30)->get();
        $filter = ['YZZH_odds','YZZH_rebate','ZSP_odds','ZSP_rebate','EZZH_duizi_odds','EZZH_duizi_rebate','EZZH_qita_odds','EZZH_qita_rebate','SZZH_qita_odds','SZZH_qita_rebate','SZZH_baozi_odds','SZZH_baozi_rebate','SZZH_duizi_odds','SZZH_duizi_rebate','YZDW_odds','YZDW_rebate','EZDW_bs_odds','EZDW_bs_rebate','EZDW_bg_odds','EZDW_bg_rebate','EZDW_sg_odds','EZDW_sg_rebate','SZDW_odds','SZDW_rebate','EZHS_00041418_odds','EZHS_00041418_rebate','EZHS_0513_odds','EZHS_0513_rebate','EZHS_0612_odds','EZHS_0612_rebate','EZHS_0711_odds','EZHS_0711_rebate','EZHS_0810_odds','EZHS_0810_rebate','EZHS_09_odds','EZHS_09_rebate','EZHS_ws_odds','EZHS_ws_rebate','SZHS_00062127_odds','SZHS_00062127_rebate','SZHS_0720_odds','SZHS_0720_rebate','SZHS_0819_odds','SZHS_0819_rebate','SZHS_0918_odds','SZHS_0918_rebate','SZHS_1017_odds','SZHS_1017_rebate','SZHS_1116_odds','SZHS_1116_rebate','SZHS_1215_odds','SZHS_1215_rebate','SZHS_1314_odds','SZHS_1314_rebate','SZHS_ws_odds','SZHS_ws_rebate','ZX3_5_odds','ZX3_5_rebate','ZX3_6_odds','ZX3_6_rebate','ZX3_7_odds','ZX3_7_rebate','ZX3_8_odds','ZX3_8_rebate','ZX3_9_odds','ZX3_9_rebate','ZX3_10_odds','ZX3_10_rebate','ZX6_4_odds','ZX6_4_rebate','ZX6_5_odds','ZX6_5_rebate','ZX6_6_odds','ZX6_6_rebate','ZX6_7_odds','ZX6_7_rebate','ZX6_8_odds','ZX6_8_rebate','KD_0_odds','KD_0_rebate','KD_1_odds','KD_1_rebate','KD_2_odds','KD_2_rebate','KD_3_odds','KD_3_rebate','KD_4_odds','KD_4_rebate','KD_5_odds','KD_5_rebate','KD_6_odds','KD_6_rebate','KD_7_odds','KD_7_rebate','KD_8_odds','KD_8_rebate','KD_9_odds','KD_9_rebate'];
        return $this->OddsAndRebate($data,$filter,30);
    }

    public function gameTable70()
    {
        $data = Play::where('gameId',70)->get();
        $filter = ['TMA_01_odds','TMA_01_rebate','TMA_02_odds','TMA_02_rebate','TMA_03_odds','TMA_03_rebate','TMA_04_odds','TMA_04_rebate','TMA_05_odds','TMA_05_rebate','TMA_06_odds','TMA_06_rebate','TMA_07_odds','TMA_07_rebate','TMA_08_odds','TMA_08_rebate','TMA_09_odds','TMA_09_rebate','TMA_10_odds','TMA_10_rebate','TMA_11_odds','TMA_11_rebate','TMA_12_odds','TMA_12_rebate','TMA_13_odds','TMA_13_rebate','TMA_14_odds','TMA_14_rebate','TMA_15_odds','TMA_15_rebate','TMA_16_odds','TMA_16_rebate','TMA_17_odds','TMA_17_rebate','TMA_18_odds','TMA_18_rebate','TMA_19_odds','TMA_19_rebate','TMA_20_odds','TMA_20_rebate','TMA_21_odds','TMA_21_rebate','TMA_22_odds','TMA_22_rebate','TMA_23_odds','TMA_23_rebate','TMA_24_odds','TMA_24_rebate','TMA_25_odds','TMA_25_rebate','TMA_26_odds','TMA_26_rebate','TMA_27_odds','TMA_27_rebate','TMA_28_odds','TMA_28_rebate','TMA_29_odds','TMA_29_rebate','TMA_30_odds','TMA_30_rebate','TMA_31_odds','TMA_31_rebate','TMA_32_odds','TMA_32_rebate','TMA_33_odds','TMA_33_rebate','TMA_34_odds','TMA_34_rebate','TMA_35_odds','TMA_35_rebate','TMA_36_odds','TMA_36_rebate','TMA_37_odds','TMA_37_rebate','TMA_38_odds','TMA_38_rebate','TMA_39_odds','TMA_39_rebate','TMA_40_odds','TMA_40_rebate','TMA_41_odds','TMA_41_rebate','TMA_42_odds','TMA_42_rebate','TMA_43_odds','TMA_43_rebate','TMA_44_odds','TMA_44_rebate','TMA_45_odds','TMA_45_rebate','TMA_46_odds','TMA_46_rebate','TMA_47_odds','TMA_47_rebate','TMA_48_odds','TMA_48_rebate','TMA_49_odds','TMA_49_rebate','TMB_01_odds','TMB_01_rebate','TMB_02_odds','TMB_02_rebate','TMB_03_odds','TMB_03_rebate','TMB_04_odds','TMB_04_rebate','TMB_05_odds','TMB_05_rebate','TMB_06_odds','TMB_06_rebate','TMB_07_odds','TMB_07_rebate','TMB_08_odds','TMB_08_rebate','TMB_09_odds','TMB_09_rebate','TMB_10_odds','TMB_10_rebate','TMB_11_odds','TMB_11_rebate','TMB_12_odds','TMB_12_rebate','TMB_13_odds','TMB_13_rebate','TMB_14_odds','TMB_14_rebate','TMB_15_odds','TMB_15_rebate','TMB_16_odds','TMB_16_rebate','TMB_17_odds','TMB_17_rebate','TMB_18_odds','TMB_18_rebate','TMB_19_odds','TMB_19_rebate','TMB_20_odds','TMB_20_rebate','TMB_21_odds','TMB_21_rebate','TMB_22_odds','TMB_22_rebate','TMB_23_odds','TMB_23_rebate','TMB_24_odds','TMB_24_rebate','TMB_25_odds','TMB_25_rebate','TMB_26_odds','TMB_26_rebate','TMB_27_odds','TMB_27_rebate','TMB_28_odds','TMB_28_rebate','TMB_29_odds','TMB_29_rebate','TMB_30_odds','TMB_30_rebate','TMB_31_odds','TMB_31_rebate','TMB_32_odds','TMB_32_rebate','TMB_33_odds','TMB_33_rebate','TMB_34_odds','TMB_34_rebate','TMB_35_odds','TMB_35_rebate','TMB_36_odds','TMB_36_rebate','TMB_37_odds','TMB_37_rebate','TMB_38_odds','TMB_38_rebate','TMB_39_odds','TMB_39_rebate','TMB_40_odds','TMB_40_rebate','TMB_41_odds','TMB_41_rebate','TMB_42_odds','TMB_42_rebate','TMB_43_odds','TMB_43_rebate','TMB_44_odds','TMB_44_rebate','TMB_45_odds','TMB_45_rebate','TMB_46_odds','TMB_46_rebate','TMB_47_odds','TMB_47_rebate','TMB_48_odds','TMB_48_rebate','TMB_49_odds','TMB_49_rebate','LM_rebate','LM_odds','LM_TMDXDS_rebate','LM_TMDXDS_odds','HB_odds','HB_rebate','LB_LB_odds','LB_LB_rebate','HD_LX_LX_odds','HD_LX_LX_rebate','SB_HX_odds','SB_HX_rebate','SB_LVD_odds','SB_LVD_rebate','SB_LD_odds','SB_LD_rebate','HD_LD_LS_LD_odds','HD_LD_LS_LD_rebate','SB_HSHUANG_odds','SB_HSHUANG_rebate','SB_LVSHUANG_odds','SB_LVSHUANG_rebate','SB_HDD_LXD_LXS_odds','SB_HDD_LXD_LXS_rebate','SB_HXD_HXS_LDD_odds','SB_HXD_HXS_LDD_rebate','HDS_LXS_LDS_LDD_LXD_LDS_odds','HDS_LXS_LDS_LDD_LXD_LDS_rebate','TX_SHU_odds','TX_SHU_rebate','TX_NIU_odds','TX_NIU_rebate','TX_HU_odds','TX_HU_rebate','TX_TU_odds','TX_TU_rebate','TX_LONG_odds','TX_LONG_rebate','TX_SHE_odds','TX_SHE_rebate','TX_MA_odds','TX_MA_rebate','TX_YANG_odds','TX_YANG_rebate','TX_HOU_odds','TX_HOU_rebate','TX_JI_odds','TX_JI_rebate','TX_GOU_odds','TX_GOU_rebate','TX_ZHU_odds','TX_ZHU_rebate','HX_2X_odds','HX_2X_rebate','HX_3X_odds','HX_3X_rebate','HX_4X_odds','HX_4X_rebate','HX_5X_odds','HX_5X_rebate','HX_6X_odds','HX_6X_rebate','HX_7X_odds','HX_7X_rebate','HX_8X_odds','HX_8X_rebate','HX_9X_odds','HX_9X_rebate','HX_10X_odds','HX_10X_rebate','HX_11X_odds','HX_11X_rebate','TWS_0T_odds','TWS_0T_rebate','TWS_T_rebate','TWS_T_odds','TWS_0W_odds','TWS_0W_rebate','TWS_W_rebate','TWS_W_odds','ZM_odds','ZM_rebate','WX_JIN_odds','WX_JIN_rebate','WX_MU_odds','WX_MU_rebate','WX_SHUI_odds','WX_SHUI_rebate','WX_HUO_odds','WX_HUO_rebate','WX_TU_odds','WX_TU_rebate','PTYX_SHU_odds','PTYX_SHU_rebate','PTYX_NIU_odds','PTYX_NIU_rebate','PTYX_HU_odds','PTYX_HU_rebate','PTYX_TU_odds','PTYX_TU_rebate','PTYX_LONG_odds','PTYX_LONG_rebate','PTYX_SHE_odds','PTYX_SHE_rebate','PTYX_MA_odds','PTYX_MA_rebate','PTYX_YANG_odds','PTYX_YANG_rebate','PTYX_HOU_odds','PTYX_HOU_rebate','PTYX_JI_odds','PTYX_JI_rebate','PTYX_GOU_odds','PTYX_GOU_rebate','PTYX_ZHU_odds','PTYX_ZHU_rebate','ZTM_rebate','ZTM_odds','ZTM_HBO_odds','ZTM_HBO_rebate','ZTM_H_L_L_odds','ZTM_H_L_L_rebate','PTYX_0W_odds','PTYX_0W_rebate','PTYX_1W_odds','PTYX_1W_rebate','PTYX_2W_odds','PTYX_2W_rebate','PTYX_3W_odds','PTYX_3W_rebate','PTYX_4W_odds','PTYX_4W_rebate','PTYX_5W_odds','PTYX_5W_rebate','PTYX_6W_odds','PTYX_6W_rebate','PTYX_7W_odds','PTYX_7W_rebate','PTYX_8W_odds','PTYX_8W_rebate','PTYX_9W_odds','PTYX_9W_rebate','7SB_HJ_odds','7SB_HJ_rebate','7SB_LB_LB_odds','7SB_LB_LB_rebate','7SB_HONG_odds','7SB_HONG_rebate','ZONGXIAO_2X_odds','ZONGXIAO_2X_rebate','ZONGXIAO_3X_odds','ZONGXIAO_3X_rebate','ZONGXIAO_4X_odds','ZONGXIAO_4X_rebate','ZONGXIAO_5X_odds','ZONGXIAO_5X_rebate','ZONGXIAO_6X_odds','ZONGXIAO_6X_rebate','ZONGXIAO_7X_odds','ZONGXIAO_7X_rebate','ZONGXIAO_DAN_odds','ZONGXIAO_DAN_rebate','ZONGXIAO_S_odds','ZONGXIAO_S_rebate','3Z2_Z2_odds','3Z2_Z2_rebate','3Z2_Z3_odds','3Z2_Z3_rebate','3QZ_odds','3QZ_rebate','2QZ_odds','2QZ_rebate','2ZT_ZT_odds','2ZT_ZT_rebate','2ZT_Z2_odds','2ZT_Z2_rebate','TC_ZT_odds','TC_ZT_rebate','4QZ_odds','4QZ_rebate','ZXIAO_SHU_odds','ZXIAO_SHU_rebate','ZXIAO_NIU_odds','ZXIAO_NIU_rebate','ZXIAO_HU_odds','ZXIAO_HU_rebate','ZXIAO_TU_odds','ZXIAO_TU_rebate','ZXIAO_LONG_odds','ZXIAO_LONG_rebate','ZXIAO_SHE_odds','ZXIAO_SHE_rebate','ZXIAO_MA_odds','ZXIAO_MA_rebate','ZXIAO_YANG_odds','ZXIAO_YANG_rebate','ZXIAO_HOU_odds','ZXIAO_HOU_rebate','ZXIAO_JI_odds','ZXIAO_JI_rebate','ZXIAO_GOU_odds','ZXIAO_GOU_rebate','ZXIAO_ZHU_odds','ZXIAO_ZHU_rebate','ELX_SHU_odds','ELX_SHU_rebate','ELX_NIU_odds','ELX_NIU_rebate','ELX_HU_odds','ELX_HU_rebate','ELX_TU_odds','ELX_TU_rebate','ELX_LONG_odds','ELX_LONG_rebate','ELX_SHE_odds','ELX_SHE_rebate','ELX_MA_odds','ELX_MA_rebate','ELX_YANG_odds','ELX_YANG_rebate','ELX_HOU_odds','ELX_HOU_rebate','ELX_JI_odds','ELX_JI_rebate','ELX_GOU_odds','ELX_GOU_rebate','ELX_ZHU_odds','ELX_ZHU_rebate','SLX_SHU_odds','SLX_SHU_rebate','SLX_NIU_odds','SLX_NIU_rebate','SLX_HU_odds','SLX_HU_rebate','SLX_TU_odds','SLX_TU_rebate','SLX_LONG_odds','SLX_LONG_rebate','SLX_SHE_odds','SLX_SHE_rebate','SLX_MA_odds','SLX_MA_rebate','SLX_YANG_odds','SLX_YANG_rebate','SLX_HOU_odds','SLX_HOU_rebate','SLX_JI_odds','SLX_JI_rebate','SLX_GOU_odds','SLX_GOU_rebate','SLX_ZHU_odds','SLX_ZHU_rebate','SILX_SHU_odds','SILX_SHU_rebate','SILX_NIU_odds','SILX_NIU_rebate','SILX_HU_odds','SILX_HU_rebate','SILX_TU_odds','SILX_TU_rebate','SILX_LONG_odds','SILX_LONG_rebate','SILX_SHE_odds','SILX_SHE_rebate','SILX_MA_odds','SILX_MA_rebate','SILX_YANG_odds','SILX_YANG_rebate','SILX_HOU_odds','SILX_HOU_rebate','SILX_JI_odds','SILX_JI_rebate','SILX_GOU_odds','SILX_GOU_rebate','SILX_ZHU_odds','SILX_ZHU_rebate','WLX_SHU_odds','WLX_SHU_rebate','WLX_NIU_odds','WLX_NIU_rebate','WLX_HU_odds','WLX_HU_rebate','WLX_TU_odds','WLX_TU_rebate','WLX_LONG_odds','WLX_LONG_rebate','WLX_SHE_odds','WLX_SHE_rebate','WLX_MA_odds','WLX_MA_rebate','WLX_YANG_odds','WLX_YANG_rebate','WLX_HOU_odds','WLX_HOU_rebate','WLX_JI_odds','WLX_JI_rebate','WLX_GOU_odds','WLX_GOU_rebate','WLX_ZHU_odds','WLX_ZHU_rebate','EELW_0W_odds','EELW_0W_rebate','EELW_W_odds','EELW_W_rebate','SSLW_0W_odds','SSLW_0W_rebate','SSLW_W_odds','SSLW_W_rebate','SILW_0W_odds','SILW_0W_rebate','SILW_W_odds','SILW_W_rebate','WULW_0W_odds','WULW_0W_rebate','WULW_W_odds','WULW_W_rebate','ZXBZ_12BZ_odds','ZXBZ_12BZ_rebate','ZXBZ_11BZ_odds','ZXBZ_11BZ_rebate','ZXBZ_10BZ_odds','ZXBZ_10BZ_rebate','ZXBZ_9BZ_odds','ZXBZ_9BZ_rebate','ZXBZ_8BZ_odds','ZXBZ_8BZ_rebate','ZXBZ_7BZ_odds','ZXBZ_7BZ_rebate','ZXBZ_6BZ_odds','ZXBZ_6BZ_rebate','ZXBZ_5BZ_odds','ZXBZ_5BZ_rebate','ZMLM_odds','ZMLM_rebate'];
        return $this->OddsAndRebate($data,$filter,70);
    }

    public function gameTable85()
    {
        $data = Play::where('gameId',85)->get();
        $filter = ['TMA_01_odds','TMA_01_rebate','TMA_02_odds','TMA_02_rebate','TMA_03_odds','TMA_03_rebate','TMA_04_odds','TMA_04_rebate','TMA_05_odds','TMA_05_rebate','TMA_06_odds','TMA_06_rebate','TMA_07_odds','TMA_07_rebate','TMA_08_odds','TMA_08_rebate','TMA_09_odds','TMA_09_rebate','TMA_10_odds','TMA_10_rebate','TMA_11_odds','TMA_11_rebate','TMA_12_odds','TMA_12_rebate','TMA_13_odds','TMA_13_rebate','TMA_14_odds','TMA_14_rebate','TMA_15_odds','TMA_15_rebate','TMA_16_odds','TMA_16_rebate','TMA_17_odds','TMA_17_rebate','TMA_18_odds','TMA_18_rebate','TMA_19_odds','TMA_19_rebate','TMA_20_odds','TMA_20_rebate','TMA_21_odds','TMA_21_rebate','TMA_22_odds','TMA_22_rebate','TMA_23_odds','TMA_23_rebate','TMA_24_odds','TMA_24_rebate','TMA_25_odds','TMA_25_rebate','TMA_26_odds','TMA_26_rebate','TMA_27_odds','TMA_27_rebate','TMA_28_odds','TMA_28_rebate','TMA_29_odds','TMA_29_rebate','TMA_30_odds','TMA_30_rebate','TMA_31_odds','TMA_31_rebate','TMA_32_odds','TMA_32_rebate','TMA_33_odds','TMA_33_rebate','TMA_34_odds','TMA_34_rebate','TMA_35_odds','TMA_35_rebate','TMA_36_odds','TMA_36_rebate','TMA_37_odds','TMA_37_rebate','TMA_38_odds','TMA_38_rebate','TMA_39_odds','TMA_39_rebate','TMA_40_odds','TMA_40_rebate','TMA_41_odds','TMA_41_rebate','TMA_42_odds','TMA_42_rebate','TMA_43_odds','TMA_43_rebate','TMA_44_odds','TMA_44_rebate','TMA_45_odds','TMA_45_rebate','TMA_46_odds','TMA_46_rebate','TMA_47_odds','TMA_47_rebate','TMA_48_odds','TMA_48_rebate','TMA_49_odds','TMA_49_rebate','TMB_01_odds','TMB_01_rebate','TMB_02_odds','TMB_02_rebate','TMB_03_odds','TMB_03_rebate','TMB_04_odds','TMB_04_rebate','TMB_05_odds','TMB_05_rebate','TMB_06_odds','TMB_06_rebate','TMB_07_odds','TMB_07_rebate','TMB_08_odds','TMB_08_rebate','TMB_09_odds','TMB_09_rebate','TMB_10_odds','TMB_10_rebate','TMB_11_odds','TMB_11_rebate','TMB_12_odds','TMB_12_rebate','TMB_13_odds','TMB_13_rebate','TMB_14_odds','TMB_14_rebate','TMB_15_odds','TMB_15_rebate','TMB_16_odds','TMB_16_rebate','TMB_17_odds','TMB_17_rebate','TMB_18_odds','TMB_18_rebate','TMB_19_odds','TMB_19_rebate','TMB_20_odds','TMB_20_rebate','TMB_21_odds','TMB_21_rebate','TMB_22_odds','TMB_22_rebate','TMB_23_odds','TMB_23_rebate','TMB_24_odds','TMB_24_rebate','TMB_25_odds','TMB_25_rebate','TMB_26_odds','TMB_26_rebate','TMB_27_odds','TMB_27_rebate','TMB_28_odds','TMB_28_rebate','TMB_29_odds','TMB_29_rebate','TMB_30_odds','TMB_30_rebate','TMB_31_odds','TMB_31_rebate','TMB_32_odds','TMB_32_rebate','TMB_33_odds','TMB_33_rebate','TMB_34_odds','TMB_34_rebate','TMB_35_odds','TMB_35_rebate','TMB_36_odds','TMB_36_rebate','TMB_37_odds','TMB_37_rebate','TMB_38_odds','TMB_38_rebate','TMB_39_odds','TMB_39_rebate','TMB_40_odds','TMB_40_rebate','TMB_41_odds','TMB_41_rebate','TMB_42_odds','TMB_42_rebate','TMB_43_odds','TMB_43_rebate','TMB_44_odds','TMB_44_rebate','TMB_45_odds','TMB_45_rebate','TMB_46_odds','TMB_46_rebate','TMB_47_odds','TMB_47_rebate','TMB_48_odds','TMB_48_rebate','TMB_49_odds','TMB_49_rebate','LM_rebate','LM_odds','LM_TMDXDS_rebate','LM_TMDXDS_odds','HB_odds','HB_rebate','LB_LB_odds','LB_LB_rebate','HD_LX_LX_odds','HD_LX_LX_rebate','SB_HX_odds','SB_HX_rebate','SB_LVD_odds','SB_LVD_rebate','SB_LD_odds','SB_LD_rebate','HD_LD_LS_LD_odds','HD_LD_LS_LD_rebate','SB_HSHUANG_odds','SB_HSHUANG_rebate','SB_LVSHUANG_odds','SB_LVSHUANG_rebate','SB_HDD_LXD_LXS_odds','SB_HDD_LXD_LXS_rebate','SB_HXD_HXS_LDD_odds','SB_HXD_HXS_LDD_rebate','HDS_LXS_LDS_LDD_LXD_LDS_odds','HDS_LXS_LDS_LDD_LXD_LDS_rebate','TX_SHU_odds','TX_SHU_rebate','TX_NIU_odds','TX_NIU_rebate','TX_HU_odds','TX_HU_rebate','TX_TU_odds','TX_TU_rebate','TX_LONG_odds','TX_LONG_rebate','TX_SHE_odds','TX_SHE_rebate','TX_MA_odds','TX_MA_rebate','TX_YANG_odds','TX_YANG_rebate','TX_HOU_odds','TX_HOU_rebate','TX_JI_odds','TX_JI_rebate','TX_GOU_odds','TX_GOU_rebate','TX_ZHU_odds','TX_ZHU_rebate','HX_2X_odds','HX_2X_rebate','HX_3X_odds','HX_3X_rebate','HX_4X_odds','HX_4X_rebate','HX_5X_odds','HX_5X_rebate','HX_6X_odds','HX_6X_rebate','HX_7X_odds','HX_7X_rebate','HX_8X_odds','HX_8X_rebate','HX_9X_odds','HX_9X_rebate','HX_10X_odds','HX_10X_rebate','HX_11X_odds','HX_11X_rebate','TWS_0T_odds','TWS_0T_rebate','TWS_T_rebate','TWS_T_odds','TWS_0W_odds','TWS_0W_rebate','TWS_W_rebate','TWS_W_odds','ZM_odds','ZM_rebate','WX_JIN_odds','WX_JIN_rebate','WX_MU_odds','WX_MU_rebate','WX_SHUI_odds','WX_SHUI_rebate','WX_HUO_odds','WX_HUO_rebate','WX_TU_odds','WX_TU_rebate','PTYX_SHU_odds','PTYX_SHU_rebate','PTYX_NIU_odds','PTYX_NIU_rebate','PTYX_HU_odds','PTYX_HU_rebate','PTYX_TU_odds','PTYX_TU_rebate','PTYX_LONG_odds','PTYX_LONG_rebate','PTYX_SHE_odds','PTYX_SHE_rebate','PTYX_MA_odds','PTYX_MA_rebate','PTYX_YANG_odds','PTYX_YANG_rebate','PTYX_HOU_odds','PTYX_HOU_rebate','PTYX_JI_odds','PTYX_JI_rebate','PTYX_GOU_odds','PTYX_GOU_rebate','PTYX_ZHU_odds','PTYX_ZHU_rebate','ZTM_rebate','ZTM_odds','ZTM_HBO_odds','ZTM_HBO_rebate','ZTM_H_L_L_odds','ZTM_H_L_L_rebate','PTYX_0W_odds','PTYX_0W_rebate','PTYX_1W_odds','PTYX_1W_rebate','PTYX_2W_odds','PTYX_2W_rebate','PTYX_3W_odds','PTYX_3W_rebate','PTYX_4W_odds','PTYX_4W_rebate','PTYX_5W_odds','PTYX_5W_rebate','PTYX_6W_odds','PTYX_6W_rebate','PTYX_7W_odds','PTYX_7W_rebate','PTYX_8W_odds','PTYX_8W_rebate','PTYX_9W_odds','PTYX_9W_rebate','7SB_HJ_odds','7SB_HJ_rebate','7SB_LB_LB_odds','7SB_LB_LB_rebate','7SB_HONG_odds','7SB_HONG_rebate','ZONGXIAO_2X_odds','ZONGXIAO_2X_rebate','ZONGXIAO_3X_odds','ZONGXIAO_3X_rebate','ZONGXIAO_4X_odds','ZONGXIAO_4X_rebate','ZONGXIAO_5X_odds','ZONGXIAO_5X_rebate','ZONGXIAO_6X_odds','ZONGXIAO_6X_rebate','ZONGXIAO_7X_odds','ZONGXIAO_7X_rebate','ZONGXIAO_DAN_odds','ZONGXIAO_DAN_rebate','ZONGXIAO_S_odds','ZONGXIAO_S_rebate','3Z2_Z2_odds','3Z2_Z2_rebate','3Z2_Z3_odds','3Z2_Z3_rebate','3QZ_odds','3QZ_rebate','2QZ_odds','2QZ_rebate','2ZT_ZT_odds','2ZT_ZT_rebate','2ZT_Z2_odds','2ZT_Z2_rebate','TC_ZT_odds','TC_ZT_rebate','4QZ_odds','4QZ_rebate','ZXIAO_SHU_odds','ZXIAO_SHU_rebate','ZXIAO_NIU_odds','ZXIAO_NIU_rebate','ZXIAO_HU_odds','ZXIAO_HU_rebate','ZXIAO_TU_odds','ZXIAO_TU_rebate','ZXIAO_LONG_odds','ZXIAO_LONG_rebate','ZXIAO_SHE_odds','ZXIAO_SHE_rebate','ZXIAO_MA_odds','ZXIAO_MA_rebate','ZXIAO_YANG_odds','ZXIAO_YANG_rebate','ZXIAO_HOU_odds','ZXIAO_HOU_rebate','ZXIAO_JI_odds','ZXIAO_JI_rebate','ZXIAO_GOU_odds','ZXIAO_GOU_rebate','ZXIAO_ZHU_odds','ZXIAO_ZHU_rebate','ELX_SHU_odds','ELX_SHU_rebate','ELX_NIU_odds','ELX_NIU_rebate','ELX_HU_odds','ELX_HU_rebate','ELX_TU_odds','ELX_TU_rebate','ELX_LONG_odds','ELX_LONG_rebate','ELX_SHE_odds','ELX_SHE_rebate','ELX_MA_odds','ELX_MA_rebate','ELX_YANG_odds','ELX_YANG_rebate','ELX_HOU_odds','ELX_HOU_rebate','ELX_JI_odds','ELX_JI_rebate','ELX_GOU_odds','ELX_GOU_rebate','ELX_ZHU_odds','ELX_ZHU_rebate','SLX_SHU_odds','SLX_SHU_rebate','SLX_NIU_odds','SLX_NIU_rebate','SLX_HU_odds','SLX_HU_rebate','SLX_TU_odds','SLX_TU_rebate','SLX_LONG_odds','SLX_LONG_rebate','SLX_SHE_odds','SLX_SHE_rebate','SLX_MA_odds','SLX_MA_rebate','SLX_YANG_odds','SLX_YANG_rebate','SLX_HOU_odds','SLX_HOU_rebate','SLX_JI_odds','SLX_JI_rebate','SLX_GOU_odds','SLX_GOU_rebate','SLX_ZHU_odds','SLX_ZHU_rebate','SILX_SHU_odds','SILX_SHU_rebate','SILX_NIU_odds','SILX_NIU_rebate','SILX_HU_odds','SILX_HU_rebate','SILX_TU_odds','SILX_TU_rebate','SILX_LONG_odds','SILX_LONG_rebate','SILX_SHE_odds','SILX_SHE_rebate','SILX_MA_odds','SILX_MA_rebate','SILX_YANG_odds','SILX_YANG_rebate','SILX_HOU_odds','SILX_HOU_rebate','SILX_JI_odds','SILX_JI_rebate','SILX_GOU_odds','SILX_GOU_rebate','SILX_ZHU_odds','SILX_ZHU_rebate','WLX_SHU_odds','WLX_SHU_rebate','WLX_NIU_odds','WLX_NIU_rebate','WLX_HU_odds','WLX_HU_rebate','WLX_TU_odds','WLX_TU_rebate','WLX_LONG_odds','WLX_LONG_rebate','WLX_SHE_odds','WLX_SHE_rebate','WLX_MA_odds','WLX_MA_rebate','WLX_YANG_odds','WLX_YANG_rebate','WLX_HOU_odds','WLX_HOU_rebate','WLX_JI_odds','WLX_JI_rebate','WLX_GOU_odds','WLX_GOU_rebate','WLX_ZHU_odds','WLX_ZHU_rebate','EELW_0W_odds','EELW_0W_rebate','EELW_W_odds','EELW_W_rebate','SSLW_0W_odds','SSLW_0W_rebate','SSLW_W_odds','SSLW_W_rebate','SILW_0W_odds','SILW_0W_rebate','SILW_W_odds','SILW_W_rebate','WULW_0W_odds','WULW_0W_rebate','WULW_W_odds','WULW_W_rebate','ZXBZ_12BZ_odds','ZXBZ_12BZ_rebate','ZXBZ_11BZ_odds','ZXBZ_11BZ_rebate','ZXBZ_10BZ_odds','ZXBZ_10BZ_rebate','ZXBZ_9BZ_odds','ZXBZ_9BZ_rebate','ZXBZ_8BZ_odds','ZXBZ_8BZ_rebate','ZXBZ_7BZ_odds','ZXBZ_7BZ_rebate','ZXBZ_6BZ_odds','ZXBZ_6BZ_rebate','ZXBZ_5BZ_odds','ZXBZ_5BZ_rebate','ZMLM_odds','ZMLM_rebate'];
        return $this->OddsAndRebate($data,$filter,85);
    }
    
    function OddsAndRebate($data,$filter,$id){
        $fromDBOdds = collect([]);
        $fromDBRebate = collect([]);
        foreach ($data as $item){
            foreach ($filter as $i){
                if($item->odds_tag == $i)
                {
                    $fromDBOdds->put($item->odds_tag,$item->odds);
                }
            }
            foreach ($filter as $s){
                if($item->rebate_tag == $s){
                    $fromDBRebate->put($item->rebate_tag,$item->rebate);
                }
            }
        }
        return view('back.gameTables.'.$id)->with('odds',$fromDBOdds->all())->with('rebate',$fromDBRebate->all());
    }
}
