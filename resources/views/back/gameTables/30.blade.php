<!-- 福彩3D -->
<form id="game30Form" action="{{ url('/game/table/save/fc3d') }}">
<table align="center" class="ui celled small table">
    <tbody>
    <tr class="firstRow">
        <td valign="middle" rowspan="1" colspan="4" align="center" class="blue-title-table">福彩3D</td>
    </tr>
    <tr class="firstRow">
        <td valign="middle" rowspan="1" colspan="2" align="center" class="blue-title-table" style="font-size: 13px;padding: 4px !important;">种类</td>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-title-table" style="font-size: 13px;padding: 4px !important;">赔率</td>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-title-table" style="font-size: 13px;padding: 4px !important;">退水</td>
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" width="200" class="deep-blue-td">主势盘</td>
        <td valign="middle" colspan="1" rowspan="1" align="center" width="200" class="blue-td"></td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="ZSP_odds" value="{{ $odds['ZSP_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="ZSP_rebate" value="{{ $rebate['ZSP_rebate'] }}">
            </div>
        </td>
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="deep-blue-td">一字组合</td>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">0~9</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="YZZH_odds" value="{{ $odds['YZZH_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="YZZH_rebate" value="{{ $rebate['YZZH_rebate'] }}">
            </div>
        </td>
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="2" align="center" class="deep-blue-td">二字组合</td>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">对子</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="EZZH_duizi_odds" value="{{ $odds['EZZH_duizi_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="EZZH_duizi_rebate" value="{{ $rebate['EZZH_duizi_rebate'] }}">
            </div>
        </td>
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">其他</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="EZZH_qita_odds" value="{{ $odds['EZZH_qita_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="EZZH_qita_rebate" value="{{ $rebate['EZZH_qita_rebate'] }}">
            </div>
        </td>
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="3" align="center" class="deep-blue-td">三字组合</td>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">对子</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="SZZH_duizi_odds" value="{{ $odds['SZZH_duizi_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="SZZH_duizi_rebate" value="{{ $rebate['SZZH_duizi_rebate'] }}">
            </div>
        </td>
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">豹子</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="SZZH_baozi_odds" value="{{ $odds['SZZH_baozi_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="SZZH_baozi_rebate" value="{{ $rebate['SZZH_baozi_rebate'] }}">
            </div>
        </td>
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">其他</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="SZZH_qita_odds" value="{{ $odds['SZZH_qita_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="SZZH_qita_rebate" value="{{ $rebate['SZZH_qita_rebate'] }}">
            </div>
        </td>
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="deep-blue-td">一字定位</td>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td"></td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="YZDW_odds" value="{{ $odds['YZDW_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="YZDW_rebate" value="{{ $rebate['YZDW_rebate'] }}">
            </div>
        </td>
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="3" align="center" class="deep-blue-td">二字定位</td>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">佰拾定位</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="EZDW_bs_odds" value="{{ $odds['EZDW_bs_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="EZDW_bs_rebate" value="{{ $rebate['EZDW_bs_rebate'] }}">
            </div>
        </td>
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">佰个定位</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="EZDW_bg_odds" value="{{ $odds['EZDW_bg_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="EZDW_bg_rebate" value="{{ $rebate['EZDW_bg_rebate'] }}">
            </div>
        </td>
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">拾个定位</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="EZDW_sg_odds" value="{{ $odds['EZDW_sg_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="EZDW_sg_rebate" value="{{ $rebate['EZDW_sg_rebate'] }}">
            </div>
        </td>
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" width="200" class="deep-blue-td">三字定位</td>
        <td valign="middle" colspan="1" rowspan="1" align="center" width="200" class="blue-td"></td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="SZDW_odds" value="{{ $odds['SZDW_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="SZDW_rebate" value="{{ $rebate['SZDW_rebate'] }}">
            </div>
        </td>
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="7" align="center" width="200" class="deep-blue-td">二字和数</td>
        <td valign="middle" colspan="1" rowspan="1" align="center" width="200" class="blue-td">和数：0~4，14~18</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="EZHS_00041418_odds" value="{{ $odds['EZHS_00041418_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="EZHS_00041418_rebate" value="{{ $rebate['EZHS_00041418_rebate'] }}">
            </div>
        </td>
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" width="200" class="blue-td">和数：5，13</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="EZHS_0513_odds" value="{{ $odds['EZHS_0513_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="EZHS_0513_rebate" value="{{ $rebate['EZHS_0513_rebate'] }}">
            </div>
        </td>
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" width="200" class="blue-td">和数：6，12</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="EZHS_0612_odds" value="{{ $odds['EZHS_0612_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="EZHS_0612_rebate" value="{{ $rebate['EZHS_0612_rebate'] }}">
            </div>
        </td>
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" width="200" class="blue-td">和数：7，11</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="EZHS_0711_odds" value="{{ $odds['EZHS_0711_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="EZHS_0711_rebate" value="{{ $rebate['EZHS_0711_rebate'] }}">
            </div>
        </td>
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" width="200" class="blue-td">和数：8，10</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="EZHS_0810_odds" value="{{ $odds['EZHS_0810_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="EZHS_0810_rebate" value="{{ $rebate['EZHS_0810_rebate'] }}">
            </div>
        </td>
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" width="200" class="blue-td">和数：9</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="EZHS_09_odds" value="{{ $odds['EZHS_09_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="EZHS_09_rebate" value="{{ $rebate['EZHS_09_rebate'] }}">
            </div>
        </td>
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" width="200" class="blue-td">尾数</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="EZHS_ws_odds" value="{{ $odds['EZHS_ws_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="EZHS_ws_rebate" value="{{ $rebate['EZHS_ws_rebate'] }}">
            </div>
        </td>
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="9" align="center" width="200" class="deep-blue-td">三字和数</td>
        <td valign="middle" colspan="1" rowspan="1" align="center" width="200" class="blue-td">和数：0~6，21~27</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="SZHS_00062127_odds" value="{{ $odds['SZHS_00062127_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="SZHS_00062127_rebate" value="{{ $rebate['SZHS_00062127_rebate'] }}">
            </div>
        </td>
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" width="200" class="blue-td">和数：7，20</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="SZHS_0720_odds" value="{{ $odds['SZHS_0720_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="SZHS_0720_rebate" value="{{ $rebate['SZHS_0720_rebate'] }}">
            </div>
        </td>
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" width="200" class="blue-td">和数：8，19</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="SZHS_0819_odds" value="{{ $odds['SZHS_0819_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="SZHS_0819_rebate" value="{{ $rebate['SZHS_0819_rebate'] }}">
            </div>
        </td>
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" width="200" class="blue-td">和数：9，18</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="SZHS_0918_odds" value="{{ $odds['SZHS_0918_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="SZHS_0918_rebate" value="{{ $rebate['SZHS_0918_rebate'] }}">
            </div>
        </td>
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" width="200" class="blue-td">和数：10，17</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="SZHS_1017_odds" value="{{ $odds['SZHS_1017_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="SZHS_1017_rebate" value="{{ $rebate['SZHS_1017_rebate'] }}">
            </div>
        </td>
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" width="200" class="blue-td">和数：11，16</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="SZHS_1116_odds" value="{{ $odds['SZHS_1116_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="SZHS_1116_rebate" value="{{ $rebate['SZHS_1116_rebate'] }}">
            </div>
        </td>
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" width="200" class="blue-td">和数：12，15</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="SZHS_1215_odds" value="{{ $odds['SZHS_1215_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="SZHS_1215_rebate" value="{{ $rebate['SZHS_1215_rebate'] }}">
            </div>
        </td>
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" width="200" class="blue-td">和数：13，14</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="SZHS_1314_odds" value="{{ $odds['SZHS_1314_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="SZHS_1314_rebate" value="{{ $rebate['SZHS_1314_rebate'] }}">
            </div>
        </td>
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" width="200" class="blue-td">尾数</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="SZHS_ws_odds" value="{{ $odds['SZHS_ws_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="SZHS_ws_rebate" value="{{ $rebate['SZHS_ws_rebate'] }}">
            </div>
        </td>
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="6" align="center" class="deep-blue-td">组选三</td>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">5</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="ZX3_5_odds" value="{{ $odds['ZX3_5_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="ZX3_5_rebate" value="{{ $rebate['ZX3_5_rebate'] }}">
            </div>
        </td>
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">6</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="ZX3_6_odds" value="{{ $odds['ZX3_6_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="ZX3_6_rebate" value="{{ $rebate['ZX3_6_rebate'] }}">
            </div>
        </td>
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">7</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="ZX3_7_odds" value="{{ $odds['ZX3_7_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="ZX3_7_rebate" value="{{ $rebate['ZX3_7_rebate'] }}">
            </div>
        </td>
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">8</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="ZX3_8_odds" value="{{ $odds['ZX3_8_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="ZX3_8_rebate" value="{{ $rebate['ZX3_8_rebate'] }}">
            </div>
        </td>
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">9</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="ZX3_9_odds" value="{{ $odds['ZX3_9_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="ZX3_9_rebate" value="{{ $rebate['ZX3_9_rebate'] }}">
            </div>
        </td>
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">10</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="ZX3_10_odds" value="{{ $odds['ZX3_10_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="ZX3_10_rebate" value="{{ $rebate['ZX3_10_rebate'] }}">
            </div>
        </td>
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="5" align="center" class="deep-blue-td">组选六</td>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">4</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="ZX6_4_odds" value="{{ $odds['ZX6_4_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="ZX6_4_rebate" value="{{ $rebate['ZX6_4_rebate'] }}">
            </div>
        </td>
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">5</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="ZX6_5_odds" value="{{ $odds['ZX6_5_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="ZX6_5_rebate" value="{{ $rebate['ZX6_5_rebate'] }}">
            </div>
        </td>
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">6</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="ZX6_6_odds" value="{{ $odds['ZX6_6_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="ZX6_6_rebate" value="{{ $rebate['ZX6_6_rebate'] }}">
            </div>
        </td>
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">7</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="ZX6_7_odds" value="{{ $odds['ZX6_7_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="ZX6_7_rebate" value="{{ $rebate['ZX6_7_rebate'] }}">
            </div>
        </td>
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">8</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="ZX6_8_odds" value="{{ $odds['ZX6_8_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="ZX6_8_rebate" value="{{ $rebate['ZX6_8_rebate'] }}">
            </div>
        </td>
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="10" align="center" class="deep-blue-td">跨度</td>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">0</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="KD_0_odds" value="{{ $odds['KD_0_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="KD_0_rebate" value="{{ $rebate['KD_0_rebate'] }}">
            </div>
        </td>
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">1</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="KD_1_odds" value="{{ $odds['KD_1_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="KD_1_rebate" value="{{ $rebate['KD_1_rebate'] }}">
            </div>
        </td>
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">2</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="KD_2_odds" value="{{ $odds['KD_2_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="KD_2_rebate" value="{{ $rebate['KD_2_rebate'] }}">
            </div>
        </td>
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">3</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="KD_3_odds" value="{{ $odds['KD_3_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="KD_3_rebate" value="{{ $rebate['KD_3_rebate'] }}">
            </div>
        </td>
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">4</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="KD_4_odds" value="{{ $odds['KD_4_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="KD_4_rebate" value="{{ $rebate['KD_4_rebate'] }}">
            </div>
        </td>
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">5</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="KD_5_odds" value="{{ $odds['KD_5_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="KD_5_rebate" value="{{ $rebate['KD_5_rebate'] }}">
            </div>
        </td>
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">6</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="KD_6_odds" value="{{ $odds['KD_6_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="KD_6_rebate" value="{{ $rebate['KD_6_rebate'] }}">
            </div>
        </td>
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">7</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="KD_7_odds" value="{{ $odds['KD_7_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="KD_7_rebate" value="{{ $rebate['KD_7_rebate'] }}">
            </div>
        </td>
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">8</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="KD_8_odds" value="{{ $odds['KD_8_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="KD_8_rebate" value="{{ $rebate['KD_8_rebate'] }}">
            </div>
        </td>
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">9</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="KD_9_odds" value="{{ $odds['KD_9_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="KD_9_rebate" value="{{ $rebate['KD_9_rebate'] }}">
            </div>
        </td>
    </tr>
    </tbody>
    <div class="foot-submit">
        <button class="ui primary button">保 存</button>
    </div>
</table>
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