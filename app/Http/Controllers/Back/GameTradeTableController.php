<?php

namespace App\Http\Controllers\Back;

use App\Play;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GameTradeTableController extends Controller
{
    //北京赛车
    public function gameTradeTable50(Request $request)
    {
        $filter = ['GAME50_GYDXDS_min','GAME50_GYZH_min','GAME50_DXDS_min','GAME50_1D10_min','GAME50_GYDXDS_max','GAME50_GYZH_max','GAME50_DXDS_max','GAME50_1D10_max','GAME50_GYDXDS_turnMax','GAME50_GYZH_turnMax','GAME50_DXDS_turnMax','GAME50_1D10_turnMax'];
        return $this->gameTradeTable(50,$filter,$request->input('userId',0));
    }

    //重庆时时彩
    public function gameTradeTable1(Request $request)
    {
        $filter = ['GAME1_DXDSLHH_min','GAME1_DXDSLHH_max','GAME1_DXDSLHH_turnMax','GAME1_1D5_min','GAME1_1D5_max','GAME1_1D5_turnMax','GAME1_BAOZI_min','GAME1_BAOZI_max','GAME1_BAOZI_turnMax','GAME1_SHUNZI_min','GAME1_SHUNZI_max','GAME1_SHUNZI_turnMax','GAME1_DBZ_min','GAME1_DBZ_max','GAME1_DBZ_turnMax'];
        return $this->gameTradeTable(1,$filter,$request->input('userId',0));
    }
    
    //新疆时时彩
    public function gameTradeTable4(Request $request)
    {
        $filter = ['GAME4_DXDSLHH_min','GAME4_DXDSLHH_max','GAME4_DXDSLHH_turnMax','GAME4_1D5_min','GAME4_1D5_max','GAME4_1D5_turnMax','GAME4_BAOZI_min','GAME4_BAOZI_max','GAME4_BAOZI_turnMax','GAME4_SHUNZI_min','GAME4_SHUNZI_max','GAME4_SHUNZI_turnMax','GAME4_DBZ_min','GAME4_DBZ_max','GAME4_DBZ_turnMax'];
        return $this->gameTradeTable(4,$filter,$request->input('userId',0));
    }

    //天津时时彩
    public function gameTradeTable5(Request $request)
    {
        $filter = ['GAME5_DXDSLHH_min','GAME5_DXDSLHH_max','GAME5_DXDSLHH_turnMax','GAME5_1D5_min','GAME5_1D5_max','GAME5_1D5_turnMax','GAME5_BAOZI_min','GAME5_BAOZI_max','GAME5_BAOZI_turnMax','GAME5_SHUNZI_min','GAME5_SHUNZI_max','GAME5_SHUNZI_turnMax','GAME5_DBZ_min','GAME5_DBZ_max','GAME5_DBZ_turnMax'];
        return $this->gameTradeTable(5,$filter,$request->input('userId',0));
    }

    //广东快乐十分
    public function gameTradeTable60(Request $request)
    {
        $filter = ['GAME60_1D8_min','GAME60_1D8_max','GAME60_1D8_turnMax','GAME60_DNXBZFB_turnMax','GAME60_DNXBZFB_max','GAME60_DNXBZFB_min','GAME60_ZM_turnMax','GAME60_ZM_min','GAME60_ZM_max','GAME60_RXE_min','GAME60_RXE_max','GAME60_RXE_turnMax','GAME60_XELZ_min','GAME60_XELZ_max','GAME60_XELZ_turnMax','GAME60_RXS_min','GAME60_RXS_max','GAME60_RXS_turnMax','GAME60_XSQZ_min','GAME60_XSQZ_max','GAME60_XSQZ_turnMax','GAME60_RXSI_min','GAME60_RXSI_max','GAME60_RXSI_turnMax','GAME60_RXW_min','GAME60_RXW_max','GAME60_RXW_turnMax','GAME60_DXDSLH_turnMax','GAME60_DXDSLH_min','GAME60_DXDSLH_max'];
        return $this->gameTradeTable(60,$filter,$request->input('userId',0));
    }

    //江苏快3
    public function gameTradeTable10(Request $request)
    {
        $filter = ['GAME10_DXDS_min','GAME10_DXDS_max','GAME10_DXDS_turnMax','GAME10_318_turnMax','GAME10_318_max','GAME10_318_min','GAME10_451617_turnMax','GAME10_451617_max','GAME10_451617_min','GAME10_6D15_turnMax','GAME10_6D15_min','GAME10_6D15_max','GAME10_SLH_turnMax','GAME10_SLH_min','GAME10_SLH_max','GAME10_SLTX_min','GAME10_SLTX_max','GAME10_SLTX_turnMax','GAME10_STH_turnMax','GAME10_STH_min','GAME10_STH_max','GAME10_STTX_min','GAME10_STTX_max','GAME10_STTX_turnMax','GAME10_ETH_turnMax','GAME10_ETH_min','GAME10_ETH_max','GAME10_KD0_min','GAME10_KD0_max','GAME10_KD0_turnMax','GAME10_KDQT_turnMax','GAME10_KDQT_max','GAME10_KDQT_min','GAME10_KDDXDS_turnMax','GAME10_KDDXDS_min','GAME10_KDDXDS_max','GAME10_PDDXDS_turnMax','GAME10_PDDXDS_min','GAME10_PDDXDS_max','GAME10_PDQT_turnMax','GAME10_PDQT_max','GAME10_PDQT_min','GAME10_BUCUBICHU_turnMax','GAME10_BUCUBICHU_min','GAME10_BUCUBICHU_max'];
        return $this->gameTradeTable(10,$filter,$request->input('userId',0));
    }

    //安徽快3
    public function gameTradeTable11(Request $request)
    {
        $filter = ['GAME11_DXDS_min','GAME11_DXDS_max','GAME11_DXDS_turnMax','GAME11_318_turnMax','GAME11_318_max','GAME11_318_min','GAME11_451617_turnMax','GAME11_451617_max','GAME11_451617_min','GAME11_6D15_turnMax','GAME11_6D15_min','GAME11_6D15_max','GAME11_SLH_turnMax','GAME11_SLH_min','GAME11_SLH_max','GAME11_SLTX_min','GAME11_SLTX_max','GAME11_SLTX_turnMax','GAME11_STH_turnMax','GAME11_STH_min','GAME11_STH_max','GAME11_STTX_min','GAME11_STTX_max','GAME11_STTX_turnMax','GAME11_ETH_turnMax','GAME11_ETH_min','GAME11_ETH_max','GAME11_KD0_min','GAME11_KD0_max','GAME11_KD0_turnMax','GAME11_KDQT_turnMax','GAME11_KDQT_max','GAME11_KDQT_min','GAME11_KDDXDS_turnMax','GAME11_KDDXDS_min','GAME11_KDDXDS_max','GAME11_PDDXDS_turnMax','GAME11_PDDXDS_min','GAME11_PDDXDS_max','GAME11_PDQT_turnMax','GAME11_PDQT_max','GAME11_PDQT_min','GAME11_BUCUBICHU_turnMax','GAME11_BUCUBICHU_min','GAME11_BUCUBICHU_max'];
        return $this->gameTradeTable(11,$filter,$request->input('userId',0));
    }

    //广西快3
    public function gameTradeTable12(Request $request)
    {
        $filter = ['GAME12_DXDS_min','GAME12_DXDS_max','GAME12_DXDS_turnMax','GAME12_318_turnMax','GAME12_318_max','GAME12_318_min','GAME12_451617_turnMax','GAME12_451617_max','GAME12_451617_min','GAME12_6D15_turnMax','GAME12_6D15_min','GAME12_6D15_max','GAME12_SLH_turnMax','GAME12_SLH_min','GAME12_SLH_max','GAME12_SLTX_min','GAME12_SLTX_max','GAME12_SLTX_turnMax','GAME12_STH_turnMax','GAME12_STH_min','GAME12_STH_max','GAME12_STTX_min','GAME12_STTX_max','GAME12_STTX_turnMax','GAME12_ETH_turnMax','GAME12_ETH_min','GAME12_ETH_max','GAME12_KD0_min','GAME12_KD0_max','GAME12_KD0_turnMax','GAME12_KDQT_turnMax','GAME12_KDQT_max','GAME12_KDQT_min','GAME12_KDDXDS_turnMax','GAME12_KDDXDS_min','GAME12_KDDXDS_max','GAME12_PDDXDS_turnMax','GAME12_PDDXDS_min','GAME12_PDDXDS_max','GAME12_PDQT_turnMax','GAME12_PDQT_max','GAME12_PDQT_min','GAME12_BUCUBICHU_turnMax','GAME12_BUCUBICHU_min','GAME12_BUCUBICHU_max'];
        return $this->gameTradeTable(12,$filter,$request->input('userId',0));
    }

    //湖北快3
    public function gameTradeTable13(Request $request)
    {
        $filter = ['GAME13_DXDS_min','GAME13_DXDS_max','GAME13_DXDS_turnMax','GAME13_318_turnMax','GAME13_318_max','GAME13_318_min','GAME13_451617_turnMax','GAME13_451617_max','GAME13_451617_min','GAME13_6D15_turnMax','GAME13_6D15_min','GAME13_6D15_max','GAME13_SLH_turnMax','GAME13_SLH_min','GAME13_SLH_max','GAME13_SLTX_min','GAME13_SLTX_max','GAME13_SLTX_turnMax','GAME13_STH_turnMax','GAME13_STH_min','GAME13_STH_max','GAME13_STTX_min','GAME13_STTX_max','GAME13_STTX_turnMax','GAME13_ETH_turnMax','GAME13_ETH_min','GAME13_ETH_max','GAME13_KD0_min','GAME13_KD0_max','GAME13_KD0_turnMax','GAME13_KDQT_turnMax','GAME13_KDQT_max','GAME13_KDQT_min','GAME13_KDDXDS_turnMax','GAME13_KDDXDS_min','GAME13_KDDXDS_max','GAME13_PDDXDS_turnMax','GAME13_PDDXDS_min','GAME13_PDDXDS_max','GAME13_PDQT_turnMax','GAME13_PDQT_max','GAME13_PDQT_min','GAME13_BUCUBICHU_turnMax','GAME13_BUCUBICHU_min','GAME13_BUCUBICHU_max'];
        return $this->gameTradeTable(13,$filter,$request->input('userId',0));
    }

    //重庆幸运农场
    public function gameTradeTable61(Request $request)
    {
        $filter = ['GAME61_DH1D8_min','GAME61_DH1D8_max','GAME61_DH1D8_turnMax','GAME61_DNXBZFB_min','GAME61_DNXBZFB_max','GAME61_DNXBZFB_turnMax','GAME61_ZM_turnMax','GAME61_ZM_min','GAME61_ZM_max','GAME61_RXE_min','GAME61_RXE_max','GAME61_RXE_turnMax','GAME61_XELZ_min','GAME61_XELZ_max','GAME61_XELZ_turnMax','GAME61_RXS_min','GAME61_RXS_max','GAME61_RXS_turnMax','GAME61_XSQZ_min','GAME61_XSQZ_max','GAME61_XSQZ_turnMax','GAME61_RXSI_min','GAME61_RXSI_max','GAME61_RXSI_turnMax','GAME61_RXW_max','GAME61_RXW_min','GAME61_RXW_turnMax','GAME61_DXDS_min','GAME61_DXDS_max','GAME61_DXDS_turnMax'];
        return $this->gameTradeTable(61,$filter,$request->input('userId',0));
    }

    //北京快乐8
    public function gameTradeTable65(Request $request)
    {
        $filter = ['GAME65_ZH810_min','GAME65_ZH810_max','GAME65_ZH810_turnMax','GAME65_ZM_turnMax','GAME65_ZM_min','GAME65_ZM_max','GAME65_JIN_min','GAME65_JIN_max','GAME65_JIN_turnMax','GAME65_MU_min','GAME65_MU_max','GAME65_MU_turnMax','GAME65_SHUI_min','GAME65_SHUI_max','GAME65_SHUI_turnMax','GAME65_HUO_min','GAME65_HUO_max','GAME65_HUO_turnMax','GAME65_TU_min','GAME65_TU_max','GAME65_TU_turnMax','GAME65_ZHDXDS_turnMax','GAME65_ZHDXDS_min','GAME65_ZHDXDS_max','GAME65_QHHDSH_turnMax','GAME65_QHHDSH_min','GAME65_QHHDSH_max','GAME65_DXDS_turnMax','GAME65_DXDS_min','GAME65_DXDS_max'];
        return $this->gameTradeTable(65,$filter,$request->input('userId',0));
    }

    //广东11选5
    public function gameTradeTable21(Request $request)
    {
        $filter = ['GAME21_1D5_turnMax','GAME21_1D5_min','GAME21_1D5_max','GAME21_1Z1_min','GAME21_1Z1_max','GAME21_1Z1_turnMax','GAME21_2Z2_min','GAME21_2Z2_max','GAME21_2Z2_turnMax','GAME21_3Z3_min','GAME21_3Z3_max','GAME21_3Z3_turnMax','GAME21_4Z4_min','GAME21_4Z4_max','GAME21_4Z4_turnMax','GAME21_5Z5_min','GAME21_5Z5_max','GAME21_5Z5_turnMax','GAME21_6Z5_min','GAME21_6Z5_max','GAME21_6Z5_turnMax','GAME21_7Z5_min','GAME21_7Z5_max','GAME21_7Z5_turnMax','GAME21_8Z5_min','GAME21_8Z5_max','GAME21_8Z5_turnMax','GAME21_Q2ZUX_min','GAME21_Q2ZUX_max','GAME21_Q2ZUX_turnMax','GAME21_Q3ZUX_min','GAME21_Q3ZUX_max','GAME21_Q3ZUX_turnMax','GAME21_Q2ZHIX_min','GAME21_Q2ZHIX_max','GAME21_Q2ZHIX_turnMax','GAME21_Q3ZHIX_turnMax','GAME21_Q3ZHIX_min','GAME21_Q3ZHIX_max','GAME21_DXDSLH_min','GAME21_DXDSLH_max','GAME21_DXDSLH_turnMax'];
        return $this->gameTradeTable(21,$filter,$request->input('userId',0));
    }

    //PC蛋蛋
    public function gameTradeTable66(Request $request)
    {
        $filter = ['GAME66_HHDXDS_turnMax','GAME66_HHDXDS_min','GAME66_HHDXDS_max','GAME66_HHDDDSXDXS_min','GAME66_HHDDDSXDXS_max','GAME66_HHDDDSXDXS_turnMax','GAME66_JDJX_min','GAME66_JDJX_max','GAME66_JDJX_turnMax','GAME66_BAOZI_turnMax','GAME66_BAOZI_min','GAME66_BAOZI_max','GAME66_BOSE_min','GAME66_BOSE_max','GAME66_BOSE_turnMax','GAME66_TM027_min','GAME66_TM027_max','GAME66_TM027_turnMax','GAME66_TM126_turnMax','GAME66_TM126_min','GAME66_TM126_max','GAME66_TM225_turnMax','GAME66_TM225_min','GAME66_TM225_max','GAME66_TM3423_turnMax','GAME66_TM3423_min','GAME66_TM3423_max','GAME66_TM522_turnMax','GAME66_TM522_min','GAME66_TM522_max','GAME66_TM672021_min','GAME66_TM672021_max','GAME66_TM672021_turnMax','GAME66_TM891819_min','GAME66_TM891819_max','GAME66_TM891819_turnMax','GAME66_TM10D17_min','GAME66_TM10D17_max','GAME66_TM10D17_turnMax','GAME66_TM24_min','GAME66_TM24_max','GAME66_TM24_turnMax'];
        return $this->gameTradeTable(66,$filter,$request->input('userId',0));
    }

    //秒速赛车
    public function gameTradeTable80(Request $request)
    {
        $filter = ['GAME80_1D10_min','GAME80_1D10_max','GAME80_1D10_turnMax','GAME80_GYZH_min','GAME80_GYZH_max','GAME80_GYZH_turnMax','GAME80_GYDXDS_turnMax','GAME80_GYDXDS_min','GAME80_GYDXDS_max','GAME80_DXDSLH_min','GAME80_DXDSLH_max','GAME80_DXDSLH_turnMax'];
        return $this->gameTradeTable(80,$filter,$request->input('userId',0));
    }
    //三分赛车
    public function gameTradeTable901(Request $request)
    {
        $filter = ['GAME901_1D10_min','GAME901_1D10_max','GAME901_1D10_turnMax','GAME901_GYZH_min','GAME901_GYZH_max','GAME901_GYZH_turnMax','GAME901_GYDXDS_turnMax','GAME901_GYDXDS_min','GAME901_GYDXDS_max','GAME901_DXDSLH_min','GAME901_DXDSLH_max','GAME901_DXDSLH_turnMax'];
        return $this->gameTradeTable(901,$filter,$request->input('userId',0));
    }

    //秒速飞艇
    public function gameTradeTable82(Request $request)
    {
        $filter = ['GAME82_1D10_min','GAME82_1D10_max','GAME82_1D10_turnMax','GAME82_GYZH_min','GAME82_GYZH_max','GAME82_GYZH_turnMax','GAME82_GYDXDS_turnMax','GAME82_GYDXDS_min','GAME82_GYDXDS_max','GAME82_DXDSLH_min','GAME82_DXDSLH_max','GAME82_DXDSLH_turnMax'];
        return $this->gameTradeTable(82,$filter,$request->input('userId',0));
    }
    //幸运飞艇
    public function gameTradeTable55(Request $request)
    {
        $filter = ['GAME55_1D10_min','GAME55_1D10_max','GAME55_1D10_turnMax','GAME55_GYZH_min','GAME55_GYZH_max','GAME55_GYZH_turnMax','GAME55_GYDXDS_turnMax','GAME55_GYDXDS_min','GAME55_GYDXDS_max','GAME55_DXDSLH_min','GAME55_DXDSLH_max','GAME55_DXDSLH_turnMax'];
        return $this->gameTradeTable(55,$filter,$request->input('userId',0));
    }
    //台湾幸运飞艇
    public function gameTradeTable804(Request $request)
    {
        $filter = ['GAME804_1D10_min','GAME804_1D10_max','GAME804_1D10_turnMax','GAME804_GYZH_min','GAME804_GYZH_max','GAME804_GYZH_turnMax','GAME804_GYDXDS_turnMax','GAME804_GYDXDS_min','GAME804_GYDXDS_max','GAME804_DXDSLH_min','GAME804_DXDSLH_max','GAME804_DXDSLH_turnMax']; $fromDB = collect([]);
        return $this->gameTradeTable(804,$filter,$request->input('userId',0));
    }

    //秒速时时彩
    public function gameTradeTable81(Request $request)
    {
        $filter = ['GAME81_DXDSLHH_min','GAME81_DXDSLHH_max','GAME81_DXDSLHH_turnMax','GAME81_1D5_min','GAME81_1D5_max','GAME81_1D5_turnMax','GAME81_BAOZI_min','GAME81_BAOZI_max','GAME81_BAOZI_turnMax','GAME81_SHUNZI_min','GAME81_SHUNZI_max','GAME81_SHUNZI_turnMax','GAME81_DBZ_min','GAME81_DBZ_max','GAME81_DBZ_turnMax'];
        return $this->gameTradeTable(81,$filter,$request->input('userId',0));
    }

    //跑马
    public function gameTradeTable99(Request $request)
    {
        $filter = ['GAME99_1D10_min','GAME99_1D10_max','GAME99_1D10_turnMax','GAME99_GYZH_min','GAME99_GYZH_max','GAME99_GYZH_turnMax','GAME99_GYDXDS_turnMax','GAME99_GYDXDS_min','GAME99_GYDXDS_max','GAME99_DXDSLH_min','GAME99_DXDSLH_max','GAME99_DXDSLH_turnMax'];
        return $this->gameTradeTable(99,$filter,$request->input('userId',0));
    }

    //秒速快3
    public function gameTradeTable86(Request $request)
    {
        $filter = ['GAME86_DXDS_min','GAME86_DXDS_max','GAME86_DXDS_turnMax','GAME86_318_turnMax','GAME86_318_max','GAME86_318_min','GAME86_451617_turnMax','GAME86_451617_max','GAME86_451617_min','GAME86_6D15_turnMax','GAME86_6D15_min','GAME86_6D15_max','GAME86_SLH_turnMax','GAME86_SLH_min','GAME86_SLH_max','GAME86_SLTX_min','GAME86_SLTX_max','GAME86_SLTX_turnMax','GAME86_STH_turnMax','GAME86_STH_min','GAME86_STH_max','GAME86_STTX_min','GAME86_STTX_max','GAME86_STTX_turnMax','GAME86_ETH_turnMax','GAME86_ETH_min','GAME86_ETH_max','GAME86_KD0_min','GAME86_KD0_max','GAME86_KD0_turnMax','GAME86_KDQT_turnMax','GAME86_KDQT_max','GAME86_KDQT_min','GAME86_KDDXDS_turnMax','GAME86_KDDXDS_min','GAME86_KDDXDS_max','GAME86_PDDXDS_turnMax','GAME86_PDDXDS_min','GAME86_PDDXDS_max','GAME86_PDQT_turnMax','GAME86_PDQT_max','GAME86_PDQT_min','GAME86_BUCUBICHU_turnMax','GAME86_BUCUBICHU_min','GAME86_BUCUBICHU_max'];
        return $this->gameTradeTable(86,$filter,$request->input('userId',0));
    }

    //幸运快乐8
    public function gameTradeTable83(Request $request)
    {
        $filter = ['GAME83_ZM_min','GAME83_ZM_max','GAME83_ZM_turnMax','GAME83_LM_min','GAME83_LM_max','GAME83_LM_turnMax','GAME83_ZH810_min','GAME83_ZH810_max','GAME83_ZH810_turnMax','GAME83_WX_turnMax','GAME83_WX_min','GAME83_WX_max'];
        return $this->gameTradeTable(83,$filter,$request->input('userId',0));
    }

    //幸运蛋蛋
    public function gameTradeTable84(Request $request)
    {
        $filter = ['GAME84_HHDXDS_turnMax','GAME84_HHDXDS_min','GAME84_HHDXDS_max','GAME84_HHDDDSXDXS_min','GAME84_HHDDDSXDXS_max','GAME84_HHDDDSXDXS_turnMax','GAME84_JDJX_min','GAME84_JDJX_max','GAME84_JDJX_turnMax','GAME84_BAOZI_turnMax','GAME84_BAOZI_min','GAME84_BAOZI_max','GAME84_BOSE_min','GAME84_BOSE_max','GAME84_BOSE_turnMax','GAME84_TM027_min','GAME84_TM027_max','GAME84_TM027_turnMax','GAME84_TM126_turnMax','GAME84_TM126_min','GAME84_TM126_max','GAME84_TM225_turnMax','GAME84_TM225_min','GAME84_TM225_max','GAME84_TM3423_turnMax','GAME84_TM3423_min','GAME84_TM3423_max','GAME84_TM522_turnMax','GAME84_TM522_min','GAME84_TM522_max','GAME84_TM672021_min','GAME84_TM672021_max','GAME84_TM672021_turnMax','GAME84_TM891819_min','GAME84_TM891819_max','GAME84_TM891819_turnMax','GAME84_TM10D17_min','GAME84_TM10D17_max','GAME84_TM10D17_turnMax','GAME84_TM24_min','GAME84_TM24_max','GAME84_TM24_turnMax'];
        return $this->gameTradeTable(84,$filter,$request->input('userId',0));
    }

    //幸运六合彩
    public function gameTradeTable85(Request $request)
    {
        $filter = ['GAME85_TMAB_min','GAME85_TMAB_max','GAME85_TMAB_turnMax','GAME85_LM_min','GAME85_LM_max','GAME85_LM_turnMax','GAME85_SB_min','GAME85_SB_max','GAME85_SB_turnMax','GAME85_TX_turnMax','GAME85_TX_min','GAME85_TX_max','GAME85_HX_min','GAME85_HX_max','GAME85_HX_turnMax','GAME85_TWS_turnMax','GAME85_TWS_min','GAME85_TWS_max','GAME85_ZM_turnMax','GAME85_ZM_min','GAME85_ZM_max','GAME85_WUXING_min','GAME85_WUXING_max','GAME85_WUXING_turnMax','GAME85_PTYXWS_min','GAME85_PTYXWS_max','GAME85_PTYXWS_turnMax','GAME85_ZXIAO_turnMax','GAME85_ZXIAO_min','GAME85_ZXIAO_max','GAME85_7SB_min','GAME85_7SB_max','GAME85_7SB_turnMax','GAME85_7SBHJ_turnMax','GAME85_7SBHJ_min','GAME85_7SBHJ_max','GAME85_ZONGXIAO234_min','GAME85_ZONGXIAO234_max','GAME85_ZONGXIAO234_turnMax','GAME85_ZONGXIAOQT_min','GAME85_ZONGXIAOQT_max','GAME85_ZONGXIAOQT_turnMax','GAME85_ZXBZ_turnMax','GAME85_ZXBZ_min','GAME85_ZXBZ_max','GAME85_ELX_min','GAME85_ELX_max','GAME85_ELX_turnMax','GAME85_SLX_turnMax','GAME85_SLX_min','GAME85_SLX_max','GAME85_SILX_min','GAME85_SILX_max','GAME85_SILX_turnMax','GAME85_WLX_min','GAME85_WLX_max','GAME85_WLX_turnMax','GAME85_EELW_turnMax','GAME85_EELW_min','GAME85_EELW_max','GAME85_SSLW_min','GAME85_SSLW_max','GAME85_SSLW_turnMax','GAME85_SILW_min','GAME85_SILW_max','GAME85_SILW_turnMax','GAME85_WULW_min','GAME85_WULW_max','GAME85_WULW_turnMax','GAME85_3Z2_min','GAME85_3Z2_max','GAME85_3Z2_turnMax','GAME85_3QZ_min','GAME85_3QZ_max','GAME85_3QZ_turnMax','GAME85_2QZ_min','GAME85_2QZ_max','GAME85_2QZ_turnMax','GAME85_2ZT_min','GAME85_2ZT_max','GAME85_2ZT_turnMax','GAME85_TC_min','GAME85_TC_max','GAME85_TC_turnMax','GAME85_SQZ_min','GAME85_SQZ_max','GAME85_SQZ_turnMax','GAME85_ZMT_min','GAME85_ZMT_max','GAME85_ZMT_turnMax'];
        return $this->gameTradeTable(85,$filter,$request->input('userId',0));
    }

    //极速六合彩
    public function gameTradeTable903(Request $request)
    {
        $filter = ['GAME903_TMAB_min','GAME903_TMAB_max','GAME903_TMAB_turnMax','GAME903_LM_min','GAME903_LM_max','GAME903_LM_turnMax','GAME903_SB_min','GAME903_SB_max','GAME903_SB_turnMax','GAME903_TX_turnMax','GAME903_TX_min','GAME903_TX_max','GAME903_HX_min','GAME903_HX_max','GAME903_HX_turnMax','GAME903_TWS_turnMax','GAME903_TWS_min','GAME903_TWS_max','GAME903_ZM_turnMax','GAME903_ZM_min','GAME903_ZM_max','GAME903_WUXING_min','GAME903_WUXING_max','GAME903_WUXING_turnMax','GAME903_PTYXWS_min','GAME903_PTYXWS_max','GAME903_PTYXWS_turnMax','GAME903_ZXIAO_turnMax','GAME903_ZXIAO_min','GAME903_ZXIAO_max','GAME903_7SB_min','GAME903_7SB_max','GAME903_7SB_turnMax','GAME903_7SBHJ_turnMax','GAME903_7SBHJ_min','GAME903_7SBHJ_max','GAME903_ZONGXIAO234_min','GAME903_ZONGXIAO234_max','GAME903_ZONGXIAO234_turnMax','GAME903_ZONGXIAOQT_min','GAME903_ZONGXIAOQT_max','GAME903_ZONGXIAOQT_turnMax','GAME903_ZXBZ_turnMax','GAME903_ZXBZ_min','GAME903_ZXBZ_max','GAME903_ELX_min','GAME903_ELX_max','GAME903_ELX_turnMax','GAME903_SLX_turnMax','GAME903_SLX_min','GAME903_SLX_max','GAME903_SILX_min','GAME903_SILX_max','GAME903_SILX_turnMax','GAME903_WLX_min','GAME903_WLX_max','GAME903_WLX_turnMax','GAME903_EELW_turnMax','GAME903_EELW_min','GAME903_EELW_max','GAME903_SSLW_min','GAME903_SSLW_max','GAME903_SSLW_turnMax','GAME903_SILW_min','GAME903_SILW_max','GAME903_SILW_turnMax','GAME903_WULW_min','GAME903_WULW_max','GAME903_WULW_turnMax','GAME903_3Z2_min','GAME903_3Z2_max','GAME903_3Z2_turnMax','GAME903_3QZ_min','GAME903_3QZ_max','GAME903_3QZ_turnMax','GAME903_2QZ_min','GAME903_2QZ_max','GAME903_2QZ_turnMax','GAME903_2ZT_min','GAME903_2ZT_max','GAME903_2ZT_turnMax','GAME903_TC_min','GAME903_TC_max','GAME903_TC_turnMax','GAME903_SQZ_min','GAME903_SQZ_max','GAME903_SQZ_turnMax','GAME903_ZMT_min','GAME903_ZMT_max','GAME903_ZMT_turnMax'];
        return $this->gameTradeTable(903,$filter,$request->input('userId',0));
    }

    //三分六合彩
    public function gameTradeTable904(Request $request)
    {
        $filter = ['GAME904_TMAB_min','GAME904_TMAB_max','GAME904_TMAB_turnMax','GAME904_LM_min','GAME904_LM_max','GAME904_LM_turnMax','GAME904_SB_min','GAME904_SB_max','GAME904_SB_turnMax','GAME904_TX_turnMax','GAME904_TX_min','GAME904_TX_max','GAME904_HX_min','GAME904_HX_max','GAME904_HX_turnMax','GAME904_TWS_turnMax','GAME904_TWS_min','GAME904_TWS_max','GAME904_ZM_turnMax','GAME904_ZM_min','GAME904_ZM_max','GAME904_WUXING_min','GAME904_WUXING_max','GAME904_WUXING_turnMax','GAME904_PTYXWS_min','GAME904_PTYXWS_max','GAME904_PTYXWS_turnMax','GAME904_ZXIAO_turnMax','GAME904_ZXIAO_min','GAME904_ZXIAO_max','GAME904_7SB_min','GAME904_7SB_max','GAME904_7SB_turnMax','GAME904_7SBHJ_turnMax','GAME904_7SBHJ_min','GAME904_7SBHJ_max','GAME904_ZONGXIAO234_min','GAME904_ZONGXIAO234_max','GAME904_ZONGXIAO234_turnMax','GAME904_ZONGXIAOQT_min','GAME904_ZONGXIAOQT_max','GAME904_ZONGXIAOQT_turnMax','GAME904_ZXBZ_turnMax','GAME904_ZXBZ_min','GAME904_ZXBZ_max','GAME904_ELX_min','GAME904_ELX_max','GAME904_ELX_turnMax','GAME904_SLX_turnMax','GAME904_SLX_min','GAME904_SLX_max','GAME904_SILX_min','GAME904_SILX_max','GAME904_SILX_turnMax','GAME904_WLX_min','GAME904_WLX_max','GAME904_WLX_turnMax','GAME904_EELW_turnMax','GAME904_EELW_min','GAME904_EELW_max','GAME904_SSLW_min','GAME904_SSLW_max','GAME904_SSLW_turnMax','GAME904_SILW_min','GAME904_SILW_max','GAME904_SILW_turnMax','GAME904_WULW_min','GAME904_WULW_max','GAME904_WULW_turnMax','GAME904_3Z2_min','GAME904_3Z2_max','GAME904_3Z2_turnMax','GAME904_3QZ_min','GAME904_3QZ_max','GAME904_3QZ_turnMax','GAME904_2QZ_min','GAME904_2QZ_max','GAME904_2QZ_turnMax','GAME904_2ZT_min','GAME904_2ZT_max','GAME904_2ZT_turnMax','GAME904_TC_min','GAME904_TC_max','GAME904_TC_turnMax','GAME904_SQZ_min','GAME904_SQZ_max','GAME904_SQZ_turnMax','GAME904_ZMT_min','GAME904_ZMT_max','GAME904_ZMT_turnMax'];
        return $this->gameTradeTable(904,$filter,$request->input('userId',0));
    }

    //福彩3D
    public function gameTradeTable30(Request $request)
    {
        $filter = ['GAME30_ZSP_min','GAME30_ZSP_max','GAME30_ZSP_turnMax','GAME30_YZZH_min','GAME30_YZZH_max','GAME30_YZZH_turnMax','GAME30_EZZHDZ_min','GAME30_EZZHDZ_max','GAME30_EZZHDZ_turnMax','GAME30_EZZHQT_min','GAME30_EZZHQT_max','GAME30_EZZHQT_turnMax','GAME30_SZZHDZ_min','GAME30_SZZHDZ_max','GAME30_SZZHDZ_turnMax','GAME30_SZZHBZ_turnMax','GAME30_SZZHBZ_min','GAME30_SZZHBZ_max','GAME30_SZZHQT_turnMax','GAME30_SZZHQT_min','GAME30_SZZHQT_max','GAME30_YZDW_min','GAME30_YZDW_max','GAME30_YZDW_turnMax','GAME30_EZDWSB_min','GAME30_EZDWSB_max','GAME30_EZDWSB_turnMax','GAME30_EZDWBG_min','GAME30_EZDWBG_max','GAME30_EZDWBG_turnMax','GAME30_EZDWSG_min','GAME30_EZDWSG_max','GAME30_EZDWSG_turnMax','GAME30_SZDW_min','GAME30_SZDW_max','GAME30_SZDW_turnMax','GAME30_EZHS041418_turnMax','GAME30_EZHS041418_min','GAME30_EZHS041418_max','GAME30_EZHS513_turnMax','GAME30_EZHS513_min','GAME30_EZHS513_max','GAME30_EZHS612_turnMax','GAME30_EZHS612_min','GAME30_EZHS612_max','GAME30_EZHS711_min','GAME30_EZHS711_max','GAME30_EZHS711_turnMax','GAME30_EZHS810_min','GAME30_EZHS810_max','GAME30_EZHS810_turnMax','GAME30_EZHS9_min','GAME30_EZHS9_max','GAME30_EZHS9_turnMax','GAME30_EZHSWS_min','GAME30_EZHSWS_max','GAME30_EZHSWS_turnMax','GAME30_SZHS062127_min','GAME30_SZHS062127_max','GAME30_SZHS062127_turnMax','GAME30_SZHS720_min','GAME30_SZHS720_max','GAME30_SZHS720_turnMax','GAME30_SZHS819_min','GAME30_SZHS819_max','GAME30_SZHS819_turnMax','GAME30_SZHS918_min','GAME30_SZHS918_max','GAME30_SZHS918_turnMax','GAME30_SZHS1017_min','GAME30_SZHS1017_max','GAME30_SZHS1017_turnMax','GAME30_SZHS1116_min','GAME30_SZHS1116_max','GAME30_SZHS1116_turnMax','GAME30_SZHS1215_min','GAME30_SZHS1215_max','GAME30_SZHS1215_turnMax','GAME30_SZHS1314_min','GAME30_SZHS1314_max','GAME30_SZHS1314_turnMax','GAME30_SZHSWS_min','GAME30_SZHSWS_max','GAME30_SZHSWS_turnMax','GAME30_ZXS5_min','GAME30_ZXS5_max','GAME30_ZXS5_turnMax','GAME30_ZXS6_min','GAME30_ZXS6_max','GAME30_ZXS6_turnMax','GAME30_ZXS7_min','GAME30_ZXS7_max','GAME30_ZXS7_turnMax','GAME30_ZXS8_min','GAME30_ZXS8_max','GAME30_ZXS8_turnMax','GAME30_ZXS9_min','GAME30_ZXS9_max','GAME30_ZXS9_turnMax','GAME30_ZXS10_min','GAME30_ZXS10_max','GAME30_ZXS10_turnMax','GAME30_ZXL4_min','GAME30_ZXL4_max','GAME30_ZXL4_turnMax','GAME30_ZXL5_min','GAME30_ZXL5_max','GAME30_ZXL5_turnMax','GAME30_ZXL6_min','GAME30_ZXL6_max','GAME30_ZXL6_turnMax','GAME30_ZXL7_min','GAME30_ZXL7_max','GAME30_ZXL7_turnMax','GAME30_ZXL8_min','GAME30_ZXL8_max','GAME30_ZXL8_turnMax','GAME30_KD0_min','GAME30_KD0_max','GAME30_KD0_turnMax','GAME30_KD1_min','GAME30_KD1_max','GAME30_KD1_turnMax','GAME30_KD2_min','GAME30_KD2_max','GAME30_KD2_turnMax','GAME30_KD3_min','GAME30_KD3_max','GAME30_KD3_turnMax','GAME30_KD5_max','GAME30_KD5_min','GAME30_KD5_turnMax','GAME30_KD6_min','GAME30_KD6_max','GAME30_KD6_turnMax','GAME30_KD7_min','GAME30_KD7_max','GAME30_KD7_turnMax','GAME30_KD8_min','GAME30_KD8_max','GAME30_KD8_turnMax','GAME30_KD9_min','GAME30_KD9_max','GAME30_KD9_turnMax','GAME30_KD4_max','GAME30_KD4_min','GAME30_KD4_turnMax'];
        return $this->gameTradeTable(30,$filter,$request->input('userId',0));
    }

    //六合彩
    public function gameTradeTable70(Request $request)
    {
        $filter = ['GAME70_TMAB_min','GAME70_TMAB_max','GAME70_TMAB_turnMax','GAME70_LM_min','GAME70_LM_max','GAME70_LM_turnMax','GAME70_SB_min','GAME70_SB_max','GAME70_SB_turnMax','GAME70_TX_turnMax','GAME70_TX_min','GAME70_TX_max','GAME70_HX_min','GAME70_HX_max','GAME70_HX_turnMax','GAME70_TWS_turnMax','GAME70_TWS_min','GAME70_TWS_max','GAME70_ZM_turnMax','GAME70_ZM_min','GAME70_ZM_max','GAME70_WUXING_min','GAME70_WUXING_max','GAME70_WUXING_turnMax','GAME70_PTYXWS_min','GAME70_PTYXWS_max','GAME70_PTYXWS_turnMax','GAME70_ZXIAO_turnMax','GAME70_ZXIAO_min','GAME70_ZXIAO_max','GAME70_7SB_min','GAME70_7SB_max','GAME70_7SB_turnMax','GAME70_7SBHJ_turnMax','GAME70_7SBHJ_min','GAME70_7SBHJ_max','GAME70_ZONGXIAO234_min','GAME70_ZONGXIAO234_max','GAME70_ZONGXIAO234_turnMax','GAME70_ZONGXIAOQT_min','GAME70_ZONGXIAOQT_max','GAME70_ZONGXIAOQT_turnMax','GAME70_ZXBZ_turnMax','GAME70_ZXBZ_min','GAME70_ZXBZ_max','GAME70_ELX_min','GAME70_ELX_max','GAME70_ELX_turnMax','GAME70_SLX_turnMax','GAME70_SLX_min','GAME70_SLX_max','GAME70_SILX_min','GAME70_SILX_max','GAME70_SILX_turnMax','GAME70_WLX_min','GAME70_WLX_max','GAME70_WLX_turnMax','GAME70_EELW_turnMax','GAME70_EELW_min','GAME70_EELW_max','GAME70_SSLW_min','GAME70_SSLW_max','GAME70_SSLW_turnMax','GAME70_SILW_min','GAME70_SILW_max','GAME70_SILW_turnMax','GAME70_WULW_min','GAME70_WULW_max','GAME70_WULW_turnMax','GAME70_3Z2_min','GAME70_3Z2_max','GAME70_3Z2_turnMax','GAME70_3QZ_min','GAME70_3QZ_max','GAME70_3QZ_turnMax','GAME70_2QZ_min','GAME70_2QZ_max','GAME70_2QZ_turnMax','GAME70_2ZT_min','GAME70_2ZT_max','GAME70_2ZT_turnMax','GAME70_TC_min','GAME70_TC_max','GAME70_TC_turnMax','GAME70_SQZ_min','GAME70_SQZ_max','GAME70_SQZ_turnMax','GAME70_ZMT_min','GAME70_ZMT_max','GAME70_ZMT_turnMax'];
        return $this->gameTradeTable(70,$filter,$request->input('userId',0));
    }

    //qq分分彩
    public function gameTradeTable113(Request $request){
        $filter = ['GAME113_1D5_min','GAME113_1D5_max','GAME113_1D5_turnMax','GAME113_BAOZI_min','GAME113_BAOZI_max','GAME113_BAOZI_turnMax','GAME113_DBZ_min','GAME113_DBZ_max','GAME113_DBZ_turnMax','GAME113_DXDSLHH_min','GAME113_DXDSLHH_max','GAME113_DXDSLHH_turnMax','GAME113_SHUNZI_min','GAME113_SHUNZI_max','GAME113_SHUNZI_turnMax'];
        return $this->gameTradeTable(113,$filter,$request->input('userId',0));
    }

    //快速赛车
    public function gameTradeTable801(Request $request)
    {
        $filter = ['GAME801_1D10_min','GAME801_1D10_max','GAME801_1D10_turnMax','GAME801_GYZH_min','GAME801_GYZH_max','GAME801_GYZH_turnMax','GAME801_GYDXDS_turnMax','GAME801_GYDXDS_min','GAME801_GYDXDS_max','GAME801_DXDSLH_min','GAME801_DXDSLH_max','GAME801_DXDSLH_turnMax'];
        return $this->gameTradeTable(801,$filter,$request->input('userId',0));
    }

    //快速飞艇
    public function gameTradeTable802(Request $request)
    {
        $filter = ['GAME802_1D10_min','GAME802_1D10_max','GAME802_1D10_turnMax','GAME802_GYZH_min','GAME802_GYZH_max','GAME802_GYZH_turnMax','GAME802_GYDXDS_turnMax','GAME802_GYDXDS_min','GAME802_GYDXDS_max','GAME802_DXDSLH_min','GAME802_DXDSLH_max','GAME802_DXDSLH_turnMax'];
        return $this->gameTradeTable(802,$filter,$request->input('userId',0));
    }

    //快速时时彩
    public function gameTradeTable803(Request $request)
    {
        $filter = ['GAME803_DXDSLHH_min','GAME803_DXDSLHH_max','GAME803_DXDSLHH_turnMax','GAME803_1D5_min','GAME803_1D5_max','GAME803_1D5_turnMax','GAME803_BAOZI_min','GAME803_BAOZI_max','GAME803_BAOZI_turnMax','GAME803_SHUNZI_min','GAME803_SHUNZI_max','GAME803_SHUNZI_turnMax','GAME803_DBZ_min','GAME803_DBZ_max','GAME803_DBZ_turnMax'];
        return $this->gameTradeTable(803,$filter,$request->input('userId',0));
    }

    //三分时时彩
    public function gameTradeTable902(Request $request)
    {
        $filter = ['GAME902_DXDSLHH_min','GAME902_DXDSLHH_max','GAME902_DXDSLHH_turnMax','GAME902_1D5_min','GAME902_1D5_max','GAME902_1D5_turnMax','GAME902_BAOZI_min','GAME902_BAOZI_max','GAME902_BAOZI_turnMax','GAME902_SHUNZI_min','GAME902_SHUNZI_max','GAME902_SHUNZI_turnMax','GAME902_DBZ_min','GAME902_DBZ_max','GAME902_DBZ_turnMax'];
        return $this->gameTradeTable(902,$filter,$request->input('userId',0));
    }

    //交易设定总
    public function gameTradeTable($gameId,$filter,$userId){
        if(empty($userId))
            $data = Play::where('play.gameId',$gameId)->get();
        else
            $data = Play::select('play.min_tag','play.minMoney','play.max_tag','play.maxMoney','play.turnMax_tag','play.maxTurnMoney','play_user.minMoney as uMinMoney','play_user.maxMoney as uMaxMoney','play_user.maxTurnMoney as uMaxTurnMoney')
                ->where('play.gameId',$gameId)
                ->leftJoin('play_user',function ($aSql) use($userId){
                    $aSql->on('play_user.min_tag','=','play.min_tag');
                    $aSql->on('play_user.game_id','=','play.gameId');
                    $aSql->where('play_user.user_id',$userId);
                })->get();
        $fromDB = collect([]);
        foreach ($data as $item)
            foreach ($filter as $i){
                if($item->min_tag == $i)
                    if(empty($item->uMinMoney))
                        $fromDB->put($item->min_tag,$item->minMoney);
                    else
                        $fromDB->put($item->min_tag,$item->uMinMoney);

                if($item->max_tag == $i)
                    if(empty($item->uMaxMoney))
                        $fromDB->put($item->max_tag,$item->maxMoney);
                    else
                        $fromDB->put($item->max_tag,$item->uMaxMoney);

                if($item->turnMax_tag == $i)
                    if(empty($item->uMaxTurnMoney))
                        $fromDB->put($item->turnMax_tag,$item->maxTurnMoney);
                    else
                        $fromDB->put($item->turnMax_tag,$item->uMaxTurnMoney);
            }
        return view('back.gameTradeTables.'.$gameId)->with('mm',$fromDB->all())->with('userId',$userId);
    }
}
