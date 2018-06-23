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
        $filter = ['sanjun_odds','sanjun_rebate','daxiao_odds','daxiao_rebate','weitou_odds','weitou_rebate','quantou_odds','quantou_rebate','changpai_odds','changpai_rebate','duanpai_odds','duanpai_rebate','0417_odds','0417_rebate','0516_odds','0516_rebate','0615_odds','0615_rebate','0714_odds','0714_rebate','0813_odds','0813_rebate','0912_odds','0912_rebate','1011_odds','1011_rebate'];
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
        $filter = ['TMA_odds','TMA_rebate','TMB_odds','TMB_rebate','LM_rebate','LM_odds','HB_odds','HB_rebate','LB_LB_odds','LB_LB_rebate','HD_LX_LX_odds','HD_LX_LX_rebate','SB_HX_odds','SB_HX_rebate','SB_LVD_odds','SB_LVD_rebate','SB_LD_odds','SB_LD_rebate','HD_LD_LS_LD_odds','HD_LD_LS_LD_rebate','SB_HSHUANG_odds','SB_HSHUANG_rebate','SB_LVSHUANG_odds','SB_LVSHUANG_rebate','SB_HDD_LXD_LXS_odds','SB_HDD_LXD_LXS_rebate','SB_HXD_HXS_LDD_odds','SB_HXD_HXS_LDD_rebate','HDS_LXS_LDS_LDD_LXD_LDS_odds','HDS_LXS_LDS_LDD_LXD_LDS_rebate','TX_SHU_odds','TX_SHU_rebate','TX_NIU_odds','TX_NIU_rebate','TX_HU_odds','TX_HU_rebate','TX_TU_odds','TX_TU_rebate','TX_LONG_odds','TX_LONG_rebate','TX_SHE_odds','TX_SHE_rebate','TX_MA_odds','TX_MA_rebate','TX_YANG_odds','TX_YANG_rebate','TX_HOU_odds','TX_HOU_rebate','TX_JI_odds','TX_JI_rebate','TX_GOU_odds','TX_GOU_rebate','TX_ZHU_odds','TX_ZHU_rebate','HX_2X_odds','HX_2X_rebate','HX_3X_odds','HX_3X_rebate','HX_4X_odds','HX_4X_rebate','HX_5X_odds','HX_5X_rebate','HX_6X_odds','HX_6X_rebate','HX_7X_odds','HX_7X_rebate','HX_8X_odds','HX_8X_rebate','HX_9X_odds','HX_9X_rebate','HX_10X_odds','HX_10X_rebate','HX_11X_odds','HX_11X_rebate','TWS_0T_odds','TWS_0T_rebate','TWS_T_rebate','TWS_T_odds','TWS_0W_odds','TWS_0W_rebate','TWS_W_rebate','TWS_W_odds','ZM_odds','ZM_rebate','WX_JIN_odds','WX_JIN_rebate','WX_MU_odds','WX_MU_rebate','WX_SHUI_odds','WX_SHUI_rebate','WX_HUO_odds','WX_HUO_rebate','WX_TU_odds','WX_TU_rebate','PTYX_SHU_odds','PTYX_SHU_rebate','PTYX_NIU_odds','PTYX_NIU_rebate','PTYX_HU_odds','PTYX_HU_rebate','PTYX_TU_odds','PTYX_TU_rebate','PTYX_LONG_odds','PTYX_LONG_rebate','PTYX_SHE_odds','PTYX_SHE_rebate','PTYX_MA_odds','PTYX_MA_rebate','PTYX_YANG_odds','PTYX_YANG_rebate','PTYX_HOU_odds','PTYX_HOU_rebate','PTYX_JI_odds','PTYX_JI_rebate','PTYX_GOU_odds','PTYX_GOU_rebate','PTYX_ZHU_odds','PTYX_ZHU_rebate','ZTM_rebate','ZTM_odds','ZTM_HBO_odds','ZTM_HBO_rebate','ZTM_H_L_L_odds','ZTM_H_L_L_rebate','PTYX_W_rebate','PTYX_W_odds','PTYX_0W_odds','PTYX_0W_rebate','7SB_HJ_odds','7SB_HJ_rebate','7SB_LB_LB_odds','7SB_LB_LB_rebate','7SB_HONG_odds','7SB_HONG_rebate','ZONGXIAO_2X_odds','ZONGXIAO_2X_rebate','ZONGXIAO_3X_odds','ZONGXIAO_3X_rebate','ZONGXIAO_4X_odds','ZONGXIAO_4X_rebate','ZONGXIAO_5X_odds','ZONGXIAO_5X_rebate','ZONGXIAO_6X_odds','ZONGXIAO_6X_rebate','ZONGXIAO_7X_odds','ZONGXIAO_7X_rebate','ZONGXIAO_DAN_odds','ZONGXIAO_DAN_rebate','ZONGXIAO_S_odds','ZONGXIAO_S_rebate','3Z2_Z2_odds','3Z2_Z2_rebate','3Z2_Z3_odds','3Z2_Z3_rebate','3QZ_odds','3QZ_rebate','2QZ_odds','2QZ_rebate','2ZT_ZT_odds','2ZT_ZT_rebate','2ZT_Z2_odds','2ZT_Z2_rebate','TC_ZT_odds','TC_ZT_rebate','4QZ_odds','4QZ_rebate'];
        return $this->OddsAndRebate($data,$filter,70);
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
