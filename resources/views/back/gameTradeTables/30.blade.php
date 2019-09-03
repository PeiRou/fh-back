<style>
    .table-small-title{
        word-break: break-all;
        text-align: center !important;
        color: #2d2d2d;
        background: #f9f9f9;
        font-weight: bold;
    }
    .table-title{
        word-break: break-all;
        text-align: center !important;
        font-size: 16px;
        background: #fdf1f1;
        font-weight: bold;
        color: red;
        padding: 6px !important;
    }
    input{
        border: 1px solid #a2a2a2;
        height: 20px;
    }
    .small-padding{
        padding: 5px !important;
    }
</style>
<form id="game30Form" action="{{ url('/game/trade/table/save/fc3d') }}">
    <input type="hidden" name="userId" value="{{ $userId }}">
<table align="center" class="ui celled small table selectable">
    <tbody>
    <tr class="firstRow">
        <td width="190" align="center" class="table-small-title">玩法</td>
        <td width="190" align="center" class="table-small-title">单注下注最低金额</td>
        <td width="190" align="center" class="table-small-title">单注下注最高金额</td>
        <td width="190" align="center" class="table-small-title">当期下注最大</td>
    </tr>
    <tr>
        <td align="center" rowspan="1" colspan="4" class="table-title">
            福彩3D
        </td>
    </tr>
    <tr>
        <td width="190" valign="top" class="small-padding">主势盘-主势盘</td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_ZSP_min" value="{{ $mm['GAME30_ZSP_min'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_ZSP_max" value="{{ $mm['GAME30_ZSP_max'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_ZSP_turnMax" value="{{ $mm['GAME30_ZSP_turnMax'] }}"></td>
    </tr>
    <tr>
        <td width="190" valign="top" class="small-padding">一字组合-0～9</td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_YZZH_min" value="{{ $mm['GAME30_YZZH_min'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_YZZH_max" value="{{ $mm['GAME30_YZZH_max'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_YZZH_turnMax" value="{{ $mm['GAME30_YZZH_turnMax'] }}"></td>
    </tr>
    <tr>
        <td width="190" valign="top" class="small-padding">二字组合-对子</td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_EZZHDZ_min" value="{{ $mm['GAME30_EZZHDZ_min'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_EZZHDZ_max" value="{{ $mm['GAME30_EZZHDZ_max'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_EZZHDZ_turnMax" value="{{ $mm['GAME30_EZZHDZ_turnMax'] }}"></td>
    </tr>
    <tr>
        <td width="190" valign="top" class="small-padding">二字组合-其他</td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_EZZHQT_min" value="{{ $mm['GAME30_EZZHQT_min'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_EZZHQT_max" value="{{ $mm['GAME30_EZZHQT_max'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_EZZHQT_turnMax" value="{{ $mm['GAME30_EZZHQT_turnMax'] }}"></td>
    </tr>
    <tr>
        <td width="190" valign="top" class="small-padding">三字组合-对子</td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_SZZHDZ_min" value="{{ $mm['GAME30_SZZHDZ_min'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_SZZHDZ_max" value="{{ $mm['GAME30_SZZHDZ_max'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_SZZHDZ_turnMax" value="{{ $mm['GAME30_SZZHDZ_turnMax'] }}"></td>
    </tr>
    <tr>
        <td width="190" valign="top" class="small-padding">三字组合-豹子</td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_SZZHBZ_min" value="{{ $mm['GAME30_SZZHBZ_min'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_SZZHBZ_max" value="{{ $mm['GAME30_SZZHBZ_max'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_SZZHBZ_turnMax" value="{{ $mm['GAME30_SZZHBZ_turnMax'] }}"></td>
    </tr>
    <tr>
        <td width="190" valign="top" class="small-padding">三字组合-其他</td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_SZZHQT_min" value="{{ $mm['GAME30_SZZHQT_min'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_SZZHQT_max" value="{{ $mm['GAME30_SZZHQT_max'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_SZZHQT_turnMax" value="{{ $mm['GAME30_SZZHQT_turnMax'] }}"></td>
    </tr>
    <tr>
        <td width="190" valign="top" class="small-padding">一字定位-一字定位</td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_YZDW_min" value="{{ $mm['GAME30_YZDW_min'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_YZDW_max" value="{{ $mm['GAME30_YZDW_max'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_YZDW_turnMax" value="{{ $mm['GAME30_YZDW_turnMax'] }}"></td>
    </tr>
    <tr>
        <td width="190" valign="top" class="small-padding">二字定位-佰拾定位</td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_EZDWSB_min" value="{{ $mm['GAME30_EZDWSB_min'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_EZDWSB_max" value="{{ $mm['GAME30_EZDWSB_max'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_EZDWSB_turnMax" value="{{ $mm['GAME30_EZDWSB_turnMax'] }}"></td>
    </tr>
    <tr>
        <td width="190" valign="top" class="small-padding">二字定位-佰个定位</td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_EZDWBG_min" value="{{ $mm['GAME30_EZDWBG_min'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_EZDWBG_max" value="{{ $mm['GAME30_EZDWBG_max'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_EZDWBG_turnMax" value="{{ $mm['GAME30_EZDWBG_turnMax'] }}"></td>
    </tr>
    <tr>
        <td width="190" valign="top" class="small-padding">二字定位-拾个定位</td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_EZDWSG_min" value="{{ $mm['GAME30_EZDWSG_min'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_EZDWSG_max" value="{{ $mm['GAME30_EZDWSG_max'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_EZDWSG_turnMax" value="{{ $mm['GAME30_EZDWSG_turnMax'] }}"></td>
    </tr>
    <tr>
        <td width="190" valign="top" class="small-padding">三字定位-三字定位</td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_SZDW_min" value="{{ $mm['GAME30_SZDW_min'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_SZDW_max" value="{{ $mm['GAME30_SZDW_max'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_SZDW_turnMax" value="{{ $mm['GAME30_SZDW_turnMax'] }}"></td>
    </tr>
    <tr>
        <td width="190" valign="top" class="small-padding">二字和数-和数0～4，14～18</td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_EZHS041418_min" value="{{ $mm['GAME30_EZHS041418_min'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_EZHS041418_max" value="{{ $mm['GAME30_EZHS041418_max'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_EZHS041418_turnMax" value="{{ $mm['GAME30_EZHS041418_turnMax'] }}"></td>
    </tr>
    <tr>
        <td width="190" valign="top" class="small-padding">二字和数-和数5，13</td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_EZHS513_min" value="{{ $mm['GAME30_EZHS513_min'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_EZHS513_max" value="{{ $mm['GAME30_EZHS513_max'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_EZHS513_turnMax" value="{{ $mm['GAME30_EZHS513_turnMax'] }}"></td>
    </tr>
    <tr>
        <td width="190" valign="top" class="small-padding">二字和数-和数6，12</td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_EZHS612_min" value="{{ $mm['GAME30_EZHS612_min'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_EZHS612_max" value="{{ $mm['GAME30_EZHS612_max'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_EZHS612_turnMax" value="{{ $mm['GAME30_EZHS612_turnMax'] }}"></td>
    </tr>
    <tr>
        <td width="190" valign="top" class="small-padding">二字和数-和数7，11</td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_EZHS711_min" value="{{ $mm['GAME30_EZHS711_min'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_EZHS711_max" value="{{ $mm['GAME30_EZHS711_max'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_EZHS711_turnMax" value="{{ $mm['GAME30_EZHS711_turnMax'] }}"></td>
    </tr>
    <tr>
        <td width="190" valign="top" class="small-padding">二字和数-和数8，10</td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_EZHS810_min" value="{{ $mm['GAME30_EZHS810_min'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_EZHS810_max" value="{{ $mm['GAME30_EZHS810_max'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_EZHS810_turnMax" value="{{ $mm['GAME30_EZHS810_turnMax'] }}"></td>
    </tr>
    <tr>
        <td width="190" valign="top" class="small-padding">二字和数-和数9</td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_EZHS9_min" value="{{ $mm['GAME30_EZHS9_min'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_EZHS9_max" value="{{ $mm['GAME30_EZHS9_max'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_EZHS9_turnMax" value="{{ $mm['GAME30_EZHS9_turnMax'] }}"></td>
    </tr>
    <tr>
        <td width="190" valign="top" class="small-padding">二字和数-尾数</td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_EZHSWS_min" value="{{ $mm['GAME30_EZHSWS_min'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_EZHSWS_max" value="{{ $mm['GAME30_EZHSWS_max'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_EZHSWS_turnMax" value="{{ $mm['GAME30_EZHSWS_turnMax'] }}"></td>
    </tr>
    <tr>
        <td width="190" valign="top" class="small-padding">三字和数-和数0～6，21～27</td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_SZHS062127_min" value="{{ $mm['GAME30_SZHS062127_min'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_SZHS062127_max" value="{{ $mm['GAME30_SZHS062127_max'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_SZHS062127_turnMax" value="{{ $mm['GAME30_SZHS062127_turnMax'] }}"></td>
    </tr>
    <tr>
        <td width="190" valign="top" class="small-padding">三字和数-和数7，20</td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_SZHS720_min" value="{{ $mm['GAME30_SZHS720_min'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_SZHS720_max" value="{{ $mm['GAME30_SZHS720_max'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_SZHS720_turnMax" value="{{ $mm['GAME30_SZHS720_turnMax'] }}"></td>
    </tr>
    <tr>
        <td width="190" valign="top" class="small-padding">三字和数-和数8，19</td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_SZHS819_min" value="{{ $mm['GAME30_SZHS819_min'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_SZHS819_max" value="{{ $mm['GAME30_SZHS819_max'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_SZHS819_turnMax" value="{{ $mm['GAME30_SZHS819_turnMax'] }}"></td>
    </tr>
    <tr>
        <td width="190" valign="top" class="small-padding">三字和数-和数9，18</td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_SZHS918_min" value="{{ $mm['GAME30_SZHS918_min'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_SZHS918_max" value="{{ $mm['GAME30_SZHS918_max'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_SZHS918_turnMax" value="{{ $mm['GAME30_SZHS918_turnMax'] }}"></td>
    </tr>
    <tr>
        <td width="190" valign="top" class="small-padding">三字和数-和数10，17</td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_SZHS1017_min" value="{{ $mm['GAME30_SZHS1017_min'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_SZHS1017_max" value="{{ $mm['GAME30_SZHS1017_max'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_SZHS1017_turnMax" value="{{ $mm['GAME30_SZHS1017_turnMax'] }}"></td>
    </tr>
    <tr>
        <td width="190" valign="top" class="small-padding">三字和数-和数11，16</td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_SZHS1116_min" value="{{ $mm['GAME30_SZHS1116_min'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_SZHS1116_max" value="{{ $mm['GAME30_SZHS1116_max'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_SZHS1116_turnMax" value="{{ $mm['GAME30_SZHS1116_turnMax'] }}"></td>
    </tr>
    <tr>
        <td width="190" valign="top" class="small-padding">三字和数-和数12，15</td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_SZHS1215_min" value="{{ $mm['GAME30_SZHS1215_min'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_SZHS1215_max" value="{{ $mm['GAME30_SZHS1215_max'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_SZHS1215_turnMax" value="{{ $mm['GAME30_SZHS1215_turnMax'] }}"></td>
    </tr>
    <tr>
        <td width="190" valign="top" class="small-padding">三字和数-和数13，14</td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_SZHS1314_min" value="{{ $mm['GAME30_SZHS1314_min'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_SZHS1314_max" value="{{ $mm['GAME30_SZHS1314_max'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_SZHS1314_turnMax" value="{{ $mm['GAME30_SZHS1314_turnMax'] }}"></td>
    </tr>
    <tr>
        <td width="190" valign="top" class="small-padding">三字和数-尾数</td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_SZHSWS_min" value="{{ $mm['GAME30_SZHSWS_min'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_SZHSWS_max" value="{{ $mm['GAME30_SZHSWS_max'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_SZHSWS_turnMax" value="{{ $mm['GAME30_SZHSWS_turnMax'] }}"></td>
    </tr>
    <tr>
        <td width="190" valign="top" class="small-padding">组选三-5</td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_ZXS5_min" value="{{ $mm['GAME30_ZXS5_min'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_ZXS5_max" value="{{ $mm['GAME30_ZXS5_max'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_ZXS5_turnMax" value="{{ $mm['GAME30_ZXS5_turnMax'] }}"></td>
    </tr>
    <tr>
        <td width="190" valign="top" class="small-padding">组选三-6</td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_ZXS6_min" value="{{ $mm['GAME30_ZXS6_min'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_ZXS6_max" value="{{ $mm['GAME30_ZXS6_max'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_ZXS6_turnMax" value="{{ $mm['GAME30_ZXS6_turnMax'] }}"></td>
    </tr>
    <tr>
        <td width="190" valign="top" class="small-padding">组选三-7</td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_ZXS7_min" value="{{ $mm['GAME30_ZXS7_min'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_ZXS7_max" value="{{ $mm['GAME30_ZXS7_max'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_ZXS7_turnMax" value="{{ $mm['GAME30_ZXS7_turnMax'] }}"></td>
    </tr>
    <tr>
        <td width="190" valign="top" class="small-padding">组选三-8</td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_ZXS8_min" value="{{ $mm['GAME30_ZXS8_min'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_ZXS8_max" value="{{ $mm['GAME30_ZXS8_max'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_ZXS8_turnMax" value="{{ $mm['GAME30_ZXS8_turnMax'] }}"></td>
    </tr>
    <tr>
        <td width="190" valign="top" class="small-padding">组选三-9</td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_ZXS9_min" value="{{ $mm['GAME30_ZXS9_min'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_ZXS9_max" value="{{ $mm['GAME30_ZXS9_max'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_ZXS9_turnMax" value="{{ $mm['GAME30_ZXS9_turnMax'] }}"></td>
    </tr>
    <tr>
        <td width="190" valign="top" class="small-padding">组选三-10</td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_ZXS10_min" value="{{ $mm['GAME30_ZXS10_min'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_ZXS10_max" value="{{ $mm['GAME30_ZXS10_max'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_ZXS10_turnMax" value="{{ $mm['GAME30_ZXS10_turnMax'] }}"></td>
    </tr>
    <tr>
        <td width="190" valign="top" class="small-padding">组选六-4</td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_ZXL4_min" value="{{ $mm['GAME30_ZXL4_min'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_ZXL4_max" value="{{ $mm['GAME30_ZXL4_max'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_ZXL4_turnMax" value="{{ $mm['GAME30_ZXL4_turnMax'] }}"></td>
    </tr>
    <tr>
        <td width="190" valign="top" class="small-padding">组选六-5</td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_ZXL5_min" value="{{ $mm['GAME30_ZXL5_min'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_ZXL5_max" value="{{ $mm['GAME30_ZXL5_max'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_ZXL5_turnMax" value="{{ $mm['GAME30_ZXL5_turnMax'] }}"></td>
    </tr>
    <tr>
        <td width="190" valign="top" class="small-padding">组选六-6</td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_ZXL6_min" value="{{ $mm['GAME30_ZXL6_min'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_ZXL6_max" value="{{ $mm['GAME30_ZXL6_max'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_ZXL6_turnMax" value="{{ $mm['GAME30_ZXL6_turnMax'] }}"></td>
    </tr>
    <tr>
        <td width="190" valign="top" class="small-padding">组选六-7</td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_ZXL7_min" value="{{ $mm['GAME30_ZXL7_min'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_ZXL7_max" value="{{ $mm['GAME30_ZXL7_max'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_ZXL7_turnMax" value="{{ $mm['GAME30_ZXL7_turnMax'] }}"></td>
    </tr>
    <tr>
        <td width="190" valign="top" class="small-padding">组选六-8</td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_ZXL8_min" value="{{ $mm['GAME30_ZXL8_min'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_ZXL8_max" value="{{ $mm['GAME30_ZXL8_max'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_ZXL8_turnMax" value="{{ $mm['GAME30_ZXL8_turnMax'] }}"></td>
    </tr>
    <tr>
        <td width="190" valign="top" class="small-padding">跨度-0</td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_KD0_min" value="{{ $mm['GAME30_KD0_min'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_KD0_max" value="{{ $mm['GAME30_KD0_max'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_KD0_turnMax" value="{{ $mm['GAME30_KD0_turnMax'] }}"></td>
    </tr>
    <tr>
        <td width="190" valign="top" class="small-padding">跨度-1</td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_KD1_min" value="{{ $mm['GAME30_KD1_min'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_KD1_max" value="{{ $mm['GAME30_KD1_max'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_KD1_turnMax" value="{{ $mm['GAME30_KD1_turnMax'] }}"></td>
    </tr>
    <tr>
        <td width="190" valign="top" class="small-padding">跨度-2</td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_KD2_min" value="{{ $mm['GAME30_KD2_min'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_KD2_max" value="{{ $mm['GAME30_KD2_max'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_KD2_turnMax" value="{{ $mm['GAME30_KD2_turnMax'] }}"></td>
    </tr>
    <tr>
        <td width="190" valign="top" class="small-padding">跨度-3</td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_KD3_min" value="{{ $mm['GAME30_KD3_min'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_KD3_max" value="{{ $mm['GAME30_KD3_max'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_KD3_turnMax" value="{{ $mm['GAME30_KD3_turnMax'] }}"></td>
    </tr>
    <tr>
        <td width="190" valign="top" class="small-padding">跨度-4</td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_KD4_min" value="{{ $mm['GAME30_KD4_min'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_KD4_max" value="{{ $mm['GAME30_KD4_max'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_KD4_turnMax" value="{{ $mm['GAME30_KD4_turnMax'] }}"></td>
    </tr>
    <tr>
        <td width="190" valign="top" class="small-padding">跨度-5</td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_KD5_min" value="{{ $mm['GAME30_KD5_min'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_KD5_max" value="{{ $mm['GAME30_KD5_max'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_KD5_turnMax" value="{{ $mm['GAME30_KD5_turnMax'] }}"></td>
    </tr>
    <tr>
        <td width="190" valign="top" class="small-padding">跨度-6</td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_KD6_min" value="{{ $mm['GAME30_KD6_min'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_KD6_max" value="{{ $mm['GAME30_KD6_max'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_KD6_turnMax" value="{{ $mm['GAME30_KD6_turnMax'] }}"></td>
    </tr>
    <tr>
        <td width="190" valign="top" class="small-padding">跨度-7</td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_KD7_min" value="{{ $mm['GAME30_KD7_min'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_KD7_max" value="{{ $mm['GAME30_KD7_max'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_KD7_turnMax" value="{{ $mm['GAME30_KD7_turnMax'] }}"></td>
    </tr>
    <tr>
        <td width="190" valign="top" class="small-padding">跨度-8</td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_KD8_min" value="{{ $mm['GAME30_KD8_min'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_KD8_max" value="{{ $mm['GAME30_KD8_max'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_KD8_turnMax" value="{{ $mm['GAME30_KD8_turnMax'] }}"></td>
    </tr>
    <tr>
        <td width="190" valign="top" class="small-padding">跨度-9</td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_KD9_min" value="{{ $mm['GAME30_KD9_min'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_KD9_max" value="{{ $mm['GAME30_KD9_max'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME30_KD9_turnMax" value="{{ $mm['GAME30_KD9_turnMax'] }}"></td>
    </tr>
    </tbody>
</table>
<div class="foot-submit">
    <button class="ui primary button">保 存</button>
</div>
</form>
<script>
    $('#game30Form').formValidation({
        framework: 'semantic',
        icon: {
            valid: 'checkmark icon',
            invalid: 'remove icon',
            validating: 'refresh icon'
        },
        fields: {}
    }).on('success.form.fv', function(e) {
        loader(true);
        e.preventDefault();
        var $form = $(e.target),
            fv    = $form.data('formValidation');
        $.ajax({
            url: $form.attr('action'),
            type: 'POST',
            data: $form.serialize(),
            success: function(result) {
                if(result.status == true){
                    loader(false);
                }
            }
        });
    });
</script>