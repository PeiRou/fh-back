<template>
    <div>
        <div>
            <div class="cont-col3-bd">
                <Mspk10ComProduct_1 v-for="(item,index) in info.product_1" :info="{ productId: item, productInfo: info}" :key="index"></Mspk10ComProduct_1>
                <!--<table class="u-table2 play_tab_10">-->
                    <!--<thead>-->
                    <!--<tr>-->
                        <!--<th colspan="12">冠、亚军和</th>-->
                    <!--</tr>-->
                    <!--</thead>-->
                    <!--<tbody>-->
                    <!--<tr>-->
                        <!--<td data-id="8014005" class="name">3</td>-->
                        <!--<td data-id="8014005" class="odds"><span class="c-txt3">42.5</span></td>-->
                        <!--<td data-id="8014005" class="amount"><input type="text" style=""></td>-->
                        <!--<td data-id="8014006" class="name">4</td>-->
                        <!--<td data-id="8014006" class="odds"><span class="c-txt3">42.5</span></td>-->
                        <!--<td data-id="8014006" class="amount"><input type="text" style=""></td>-->
                        <!--<td data-id="8014007" class="name">5</td>-->
                        <!--<td data-id="8014007" class="odds"><span class="c-txt3">21.5</span></td>-->
                        <!--<td data-id="8014007" class="amount"><input type="text" style=""></td>-->
                        <!--<td data-id="8014008" class="name">6</td>-->
                        <!--<td data-id="8014008" class="odds"><span class="c-txt3">21.5</span></td>-->
                        <!--<td data-id="8014008" class="amount"><input type="text" style=""></td>-->
                    <!--</tr>-->
                    <!--<tr>-->
                        <!--<td data-id="8014009" class="name">7</td>-->
                        <!--<td data-id="8014009" class="odds"><span class="c-txt3">14.5</span></td>-->
                        <!--<td data-id="8014009" class="amount"><input type="text" style=""></td>-->
                        <!--<td data-id="8014010" class="name">8</td>-->
                        <!--<td data-id="8014010" class="odds"><span class="c-txt3">14.5</span></td>-->
                        <!--<td data-id="8014010" class="amount"><input type="text" style=""></td>-->
                        <!--<td data-id="8014011" class="name">9</td>-->
                        <!--<td data-id="8014011" class="odds"><span class="c-txt3">10.5</span></td>-->
                        <!--<td data-id="8014011" class="amount"><input type="text" style=""></td>-->
                        <!--<td data-id="8014012" class="name">10</td>-->
                        <!--<td data-id="8014012" class="odds"><span class="c-txt3">10.5</span></td>-->
                        <!--<td data-id="8014012" class="amount"><input type="text" style=""></td>-->
                    <!--</tr>-->
                    <!--<tr>-->
                        <!--<td data-id="8014013" class="name">11</td>-->
                        <!--<td data-id="8014013" class="odds"><span class="c-txt3">8.5</span></td>-->
                        <!--<td data-id="8014013" class="amount"><input type="text" style=""></td>-->
                        <!--<td data-id="8014014" class="name">12</td>-->
                        <!--<td data-id="8014014" class="odds"><span class="c-txt3">10.5</span></td>-->
                        <!--<td data-id="8014014" class="amount"><input type="text" style=""></td>-->
                        <!--<td data-id="8014015" class="name">13</td>-->
                        <!--<td data-id="8014015" class="odds"><span class="c-txt3">10.5</span></td>-->
                        <!--<td data-id="8014015" class="amount"><input type="text" style=""></td>-->
                        <!--<td data-id="8014016" class="name">14</td>-->
                        <!--<td data-id="8014016" class="odds"><span class="c-txt3">14.5</span></td>-->
                        <!--<td data-id="8014016" class="amount"><input type="text" style=""></td>-->
                    <!--</tr>-->
                    <!--<tr>-->
                        <!--<td data-id="8014017" class="name">15</td>-->
                        <!--<td data-id="8014017" class="odds"><span class="c-txt3">14.5</span></td>-->
                        <!--<td data-id="8014017" class="amount"><input type="text" style=""></td>-->
                        <!--<td data-id="8014018" class="name">16</td>-->
                        <!--<td data-id="8014018" class="odds"><span class="c-txt3">21.5</span></td>-->
                        <!--<td data-id="8014018" class="amount"><input type="text" style=""></td>-->
                        <!--<td data-id="8014019" class="name">17</td>-->
                        <!--<td data-id="8014019" class="odds"><span class="c-txt3">21.5</span></td>-->
                        <!--<td data-id="8014019" class="amount"><input type="text" style=""></td>-->
                        <!--<td data-id="8014020" class="name">18</td>-->
                        <!--<td data-id="8014020" class="odds"><span class="c-txt3">42.5</span></td>-->
                        <!--<td data-id="8014020" class="amount"><input type="text" style=""></td>-->
                    <!--</tr>-->
                    <!--<tr>-->
                        <!--<td data-id="8014021" class="name">19</td>-->
                        <!--<td data-id="8014021" class="odds"><span class="c-txt3">42.5</span></td>-->
                        <!--<td data-id="8014021" class="amount"><input type="text" style=""></td>-->
                        <!--<td colspan="9" class="name not-event"></td>-->
                    <!--</tr>-->
                    <!--<tr>-->
                        <!--<td data-id="8014001" class="name">冠亚大</td>-->
                        <!--<td data-id="8014001" class="odds"><span class="c-txt3">2.19</span></td>-->
                        <!--<td data-id="8014001" class="amount"><input type="text" style=""></td>-->
                        <!--<td data-id="8014002" class="name">冠亚小</td>-->
                        <!--<td data-id="8014002" class="odds"><span class="c-txt3">1.78</span></td>-->
                        <!--<td data-id="8014002" class="amount"><input type="text" style=""></td>-->
                        <!--<td data-id="8014003" class="name">冠亚单</td>-->
                        <!--<td data-id="8014003" class="odds"><span class="c-txt3">1.78</span></td>-->
                        <!--<td data-id="8014003" class="amount"><input type="text" style=""></td>-->
                        <!--<td data-id="8014004" class="name">冠亚双</td>-->
                        <!--<td data-id="8014004" class="odds"><span class="c-txt3">2.19</span></td>-->
                        <!--<td data-id="8014004" class="amount"><input type="text" style=""></td>-->
                    <!--</tr>-->
                    <!--</tbody>-->
                <!--</table>-->
            </div>
        </div>
    </div>
</template>

<script>
    import Mspk10ComProduct_1 from './Mspk10ComProduct_1/Mspk10ComProduct_1'

    export default {
        name: "mspk10-com-product",
        props: {
            info: Object
        },
        components: {
            Mspk10ComProduct_1
        }
    }
</script>

<style scoped>

    table {
        border-collapse: collapse;
        border-spacing: 0
    }
    h6 {
        font-size: 100%
    }

    body {
        font: 12px/1.5 '\5FAE\8F6F\96C5\9ED1', '\5b8b\4f53', Arial, Helvetica, sans-serif;
        overflow-y: hidden
    }

    .wrap {
        position: relative
    }

    .clearfix:after {
        content: "";
        height: 0;
        visibility: hidden;
        display: block;
        clear: both
    }

    .clearfix {
        zoom: 1
    }

    .clear {
        clear: both
    }

    .pr {
        position: relative
    }

    .dib {
        display: inline-block
    }

    .hdn {
        display: none
    }

    .vm {
        vertical-align: middle
    }

    .t-left {
        text-align: left
    }

    .t-center {
        text-align: center
    }

    .t-right {
        text-align: right
    }

    .fl {
        float: left
    }

    .fr {
        float: right
    }

    .db {
        display: block
    }

    .main-body {
        position: absolute;
        overflow-x: auto;
        top: 0;
        left: 0;
        right: 0;
        bottom: 30px
    }

    .iframe-body {
        overflow-x: hidden;
        overflow-y: auto;
        background-color: #fff;
        display: none
    }

    a {
        text-decoration: none
    }

    a:hover {
        text-decoration: none
    }

    .trial-cls {
        display: none
    }
    .icon {
        display: inline-block;
        vertical-align: middle;
        overflow: hidden;
        /*background: url(/src/assets/userimg/044contMain_gy/images/icon-sprites.png) no-repeat 0 0*/
    }

    .icon1 {
        width: 16px;
        height: 8px
    }

    .icon2 {
        width: 18px;
        height: 18px;
        background-position: 0 -9px
    }

    .u-btn1 {
        display: inline-block;
        width: 56px;
        height: 20px;
        line-height: 20px;
        text-align: center;
        vertical-align: bottom;
        border-radius: 3px;
        font-size: 12px;
        margin-left: 3px
    }
    .c-txt3 {
        color: red;
        font-family: Verdana, Arial, Helvetica, sans-serif;
        padding: 0 4px
    }

    .fs-1 {
        font-size: 14px
    }
    input {
        font-family: '\5FAE\8F6F\96C5\9ED1'
    }
    #result_balls {
        position: absolute;
        left: 130px;
        top: 10px
    }
    .main-wrap {
        position: absolute;
        width: 100%;
        top: 137px;
        bottom: 0
    }

    .logo2 {
        height: 57px;
        width: 190px;
        text-align: center;
        position: absolute;
        left: 7px;
        top: 5px
    }

    .logo a {
        display: block;
        height: 100%;
        color: #fff;
        font-size: 20px;
        text-decoration: none
    }

    .logo img {
        max-width: 100%
    }

    .service {
        display: block;
        margin-bottom: 20px;
        text-align: center
    }

    .service img {
        vertical-align: top
    }

    .u-table1 {
        width: 100%;
        table-layout: fixed;
        text-align: center
    }

    .u-table1 th {
        height: 26px;
        background: #e0cec8;
        font-size: 12px;
        color: #310a07
    }

    .u-table1 td {
        padding: 2px
    }

    .guide-list {
        margin-left: 2px
    }
    .arrow {
        display: inline-block;
        vertical-align: middle;
        margin-left: 5px;
        margin-top: 3px;
        width: 0;
        height: 0;
        overflow: hidden;
        border-style: solid;
        border-width: 5px;
        border-color: #fff transparent transparent transparent
    }

    .subnav-box li.other {
        padding: 0 5px
    }

    .subnav-box li.other:hover {
        text-decoration: none;
        background: #660901
    }

    .more-extend {
        display: none;
        position: absolute;
        left: -1px;
        top: 56px;
        width: 100%;
        background: #660901;
        border: 1px solid #660901
    }

    .subnav-box li .more-extend a {
        display: block;
        height: 34px;
        line-height: 34px;
        padding: 0 10px;
        border: none;
        white-space: nowrap
    }

    .subnav-box li .more-extend a:hover {
        background: #9e040a
    }

    .cont-main {
        overflow: hidden;
        width: 839px;
        float: left
    }

    .cont-box1 {
        margin-top: 12px
    }

    .cont-col1,
    .cont-col2 {
        float: left;
        width: 44%;
        height: 116px;
        background: #892122;
        color: #f5e8c4
    }

    .cont-col2 {
        float: right;
        width: 55%
    }
    .cont-col3 {
        margin-top: 4px;
        padding: 0 5px 10px
    }

    .cont-col3-hd {
        padding: 8px 0;
        color: #310a07
    }

    .cont-col3-box1 {
        float: left;
        width: 222px;
        padding-left: 10px
    }

    .cont-col3-box1 a {
        display: inline-block;
        height: 20px;
        line-height: 20px;
        padding: 0 7px;
        vertical-align: middle;
        background: #fbdada;
        color: #310a07;
        border: 1px solid #af3230;
        border-radius: 3px
    }

    .cont-col3-box1 a:hover {
        background: #f9b1b0;
        text-decoration: none
    }

    .cont-col3-box1 a.cur {
        background: #f59593
    }
    .u-table2 {
        width: 100%;
        text-align: center
    }

    .u-table2 th {
        font-weight: 700;
        height: 23px
    }

    .u-table2 thead th.select {
        background-position: 0 -59px
    }

    .u-table2 td {
        height: 28px;
        background: #fff;
        cursor: pointer
    }

    .u-table2 .name {
        width: 60px;
        min-width: 40px;
        font-weight: 700
    }

    .u-table2.sevenrow .name {
        width: auto;
        min-width: auto
    }

    .u-table2 .amount {
        width: 65px
    }

    .u-table2.sevenrow .amount {
        width: 60px
    }

    .u-table2 .amount>input {
        width: 80%;
        min-width: 40px;
        height: 15px;
        /*background: url(/src/assets/userimg/044contMain_gy/images/skin/blue/text_input.gif) repeat-x left top;*/
        border: #b9c2cb 1px solid;
        padding: 0 2px
    }

    .u-table2 .odds {
        width: 50px;
        font-weight: 700
    }

    .u-table2 .qiu {
        text-align: left;
        padding-left: 10px
    }

    .bet-money {
        width: 70px;
        height: 18px;
        /*background: url(/src/assets/userimg/044contMain_gy/images/skin/blue/text_input.gif) repeat-x left top;*/
        border: #b9c2cb 1px solid;
        text-align: center
    }
    .cont-list1 {
        margin-top: 10px;
        width: 100%
    }

    .cont-list1 li {
        float: left;
        width: 19.6%;
        margin-right: .5%
    }

    .cont-list1 li:last-child {
        margin-right: 0
    }

    .cont-list1>tbody>tr>td {
        padding: 0 1px
    }

    .cont-btnbox1 {
        padding: 20px 0;
        text-align: center
    }

    .u-table3 {
        width: 100%;
        table-layout: fixed;
        border: 1px solid #eac0bf;
        border-bottom: none
    }

    .u-table3 th {
        height: 39px;
        font-size: 16px;
        color: #310a07
    }

    .u-tb3-th2 {
        cursor: pointer
    }

    .u-table4 {
        width: 100%;
        table-layout: fixed;
        text-align: center
    }

    .u-table4 td {
        height: 28px;
        background: #fff
    }

    .cont-col3-box2 {
        text-align: center
    }

    .cont-col3-box2 span {
        margin-right: 6px;
        font-weight: 700;
        font-size: 13px
    }

    .cont-sider {
        float: left;
        width: 180px
    }

    .cont-sider .u-table2 thead th {
        height: 30px;
        border-top-left-radius: 3px;
        border-top-right-radius: 3px;
        border: none;
        font-size: 13px;
        letter-spacing: 1px
    }

    .sider-box1-bd,
    .sider-box1-ft,
    .sider-box1-hd {
        background-color: #ececec
    }

    .sider-box1-hd {
        height: 42px;
        line-height: 42px;
        padding: 0 18px;
        font-size: 14px;
        color: #fff
    }

    .sider-box1-bd {
        background-position: -180px 0;
        background-repeat: repeat-y
    }

    .sider-box1-ft {
        height: 14px;
        background-position: -360px bottom
    }

    .u-table5 {
        width: 100%
    }

    .u-table5 .statFont {
        color: red
    }

    .u-table5 td,
    .u-table5 th {
        height: 23px;
        padding: 0 5px;
        text-align: left;
        font-size: 12px;
        border: 1px solid #daa4a3;
        font-weight: 400;
        color: #4f4d4d
    }

    .u-tb5-tr1 {
        background: #f7ebeb
    }

    .count-wrap {
        padding: 0 5px 5px
    }

    .u-header {
        height: 30px;
        border-radius: 4px;
        line-height: 30px;
        font-weight: 700;
        font-size: 13px
    }

    #page_game_name {
        margin-left: 1em
    }

    #open-date {
        margin-right: 1em
    }

    #total_sum_money {
        font-size: 14px;
        color: red;
        padding: 2px 5px;
        background: #fff;
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 3px
    }

    #bet-date {
        color: red;
        font-size: 14px;
        padding: 2px 5px;
        background: #fff;
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 3px
    }

    #open-date {
        color: #26d026;
        font-size: 14px;
        padding: 2px 5px;
        background: #fff;
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 3px
    }
    .u-table4 td.f1 {
        background-color: #fff
    }

    .bg_td {
        background-color: #f7ebeb!important
    }
    .bg_yellow {
        background-color: #ffc214!important
    }

    .td_f1 {
        color: #e6b3be
    }

    .hide {
        display: none
    }

    .show {
        display: block
    }


    .not-event {
        cursor: auto!important
    }

    .u-ipt1-disable {
        background: #e3e3d3!important
    }

    .checkbox_td>input {
        cursor: pointer
    }

    .radio_td {
        cursor: pointer
    }
    .history-main {
        background: 0 0;
        overflow-x: hidden;
        min-width: auto
    }

    #lastBets {
        display: none
    }

    #lastBets .bets {
        border-left: 1px solid #b9c2cb;
        border-right: 1px solid #b9c2cb;
        color: #000;
        width: 188px;
        overflow-y: auto;
        text-indent: 5px;
        text-align: left;
        margin: 4px 4px 0 4px;
        max-height: 300px
    }

    #betResultPanel li {
        background: #fff none repeat scroll 0 0;
        border-top: 1px solid;
        padding: 1px
    }

    #lastBets li {
        background: #fff none repeat scroll 0 0;
        padding: 1px
    }

    #lastBets li:nth-child(2n) {
        background: #efefef none repeat scroll 0 0
    }

    .side_left .bets .bid {
        color: #119400
    }

    .side_left .bets .text {
        color: #0017c7
    }

    .side_left .bets .odds {
        color: red;
        font-family: Arial, Helvetica, Verdana, Geneva, sans-serif;
        font-weight: 700
    }

    .side_left li {
        position: relative
    }

    .side_left li a {
        display: block;
        width: 100%;
        height: 100%
    }

    .side_left .r-wrap {
        width: 190px;
        font-weight: 700;
        margin: 4px 5px 0 5px;
        line-height: 16px
    }

    .side_left .r-nowrap1 {
        font-size: 14px;
        height: 32px;
        line-height: 32px;
        text-align: center;
        -webkit-border-radius: 4px;
        -moz-border-radius: 4px;
        border-radius: 4px
    }

    .side_left .nowrap2 {
        display: inline-block;
        width: 88px;
        height: 34px;
        line-height: 34px;
        font-size: 12px;
        font-weight: 700;
        text-align: center;
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 3px
    }

    .skinbtn {
        background-image: none;
        border: 1px solid transparent;
        border-radius: 4px;
        cursor: pointer;
        font-size: 14px;
        font-weight: 400;
        line-height: 1.42857;
        margin-bottom: 0;
        text-align: center;
        vertical-align: middle;
        white-space: nowrap;
        width: 100px;
        height: 30px;
        margin: 0 5px
    }

    .pop-detail {
        padding: 20px
    }

    .pop-detail p {
        font-size: 14px;
        line-height: 25px
    }

    .mask {
        display: none;
        position: fixed;
        z-index: 998;
        width: 100%;
        top: 0;
        bottom: 0;
        background: #000;
        opacity: .5
    }
    .btn-pop-close {
        position: absolute;
        right: -5px;
        top: -5px;
        line-height: 1;
        color: #4c4c4c;
        font-size: 20px;
        font-family: '\5b8b\4f53'
    }
    .btn-pop-close:hover {
        text-decoration: none;
        color: #f03838
    }
    #skinPanel {
        display: inline-block;
        color: #fff;
        cursor: pointer
    }

    #skinPanel ul {
        padding: 0 0 10px 0;
        margin-left: -5px;
        list-style: none;
        position: absolute;
        width: 62px;
        z-index: 999;
        display: none
    }
    .skin_blue .sub {
        color: #666;
        background: #e6e6e6;
        background: -moz-linear-gradient(top, rgba(230, 230, 230, 1) 0, rgba(231, 231, 231, 1) 100%);
        background: -webkit-linear-gradient(top, rgba(230, 230, 230, 1) 0, rgba(231, 231, 231, 1) 100%);
        background: linear-gradient(to bottom, rgba(230, 230, 230, 1) 0, rgba(231, 231, 231, 1) 100%);
        border-bottom: 1px solid #ccc
    }

    .skin_blue .sub a {
        color: #666
    }
    .skin_blue .sub .selected,
    .skin_blue .sub a:hover {
        color: #f98d5c
    }
    .skin_blue .lotterys .selected,
    .skin_blue .lotterys .show>a:hover {
        color: #143679;
        background: #e6e6e6;
        background: -moz-linear-gradient(top, rgba(230, 230, 230, 1) 0, rgba(231, 231, 231, 1) 100%);
        background: -webkit-linear-gradient(top, rgba(230, 230, 230, 1) 0, rgba(231, 231, 231, 1) 100%);
        background: linear-gradient(to bottom, rgba(230, 230, 230, 1) 0, rgba(231, 231, 231, 1) 100%)
    }

    .skin_blue .lotterys.menu-editMode .show>a:hover {
        background: 0 0;
        color: #fff
    }

    .skin_blue .header-top {
        /*background: url(/src/assets/userimg/044contMain_gy/images/skin/blue/main_bg.jpg) no-repeat 0 0*/
    }

    .skin_blue #skinPanel:hover .skin_blue .skinHover ul,
    .skin_blue #skinPanel:hover ul,
    .skin_blue .skinHover {
        background: #234b95
    }
    .skin_blue .u-table2 .name {
        background-color: #edf4fe
    }

    .skin_blue .u-table2 td,
    .skin_blue .u-table4 td {
        border: 1px solid #b9c2cb;
        color: #35406d
    }

    .skin_blue .u-table2 .hover {
        background: none repeat 0 0 #c3d9f1
    }

    .skin_blue .u-table5 td,
    .skin_blue .u-table5 th {
        border: 1px solid #b9c2cb
    }

    .skin_blue .u-tb5-tr1 {
        background: #fff
    }

    .skin_blue .u-table2 thead th.select {
        background: #dee9f3;
        background: -moz- linear-gradient(top, #dee9f3 0, #dee9f3 50%, #cfd9e3 51%, #cfd9e3 100%);
        background: -webkit- linear-gradient(top, #dee9f3 0, #dee9f3 50%, #cfd9e3 51%, #cfd9e3 100%);
        background: linear-gradient(to bottom, #dee9f3 0, #dee9f3 50%, #cfd9e3 51%, #cfd9e3 100%);
        color: #000;
        font-weight: 700
    }
    .skin_blue .bet-bottom {
        border: 1px solid #b9c2cb
    }

    .skin_blue .bet-bottom .bcount {
        border-right: 1px solid #b9c2cb
    }

    .skin_blue .skinbtn {
        background-color: #4987d7;
        color: #fff
    }

    .skin_blue .skin-font-color {
        color: #35406d
    }

    .skin_blue #lastBets li {
        border-top: 1px solid #b9c2cb
    }

    .skin_blue .pop-tips {
        border: 1px solid #4092f6
    }

    .skin_blue .pop-tips-hd {
        background: #4987d7;
        color: #fff
    }

    .skin_blue .r-wrap,
    .skin_blue .r-wrap a {
        color: #fff
    }

    .skin_blue .r-nowrap1 {
        background: #2161b3
    }

    .skin_blue .nowrap2 {
        border: 1px solid #f4521b;
        background: #ff9461;
        background: -moz-linear-gradient(top, rgba(255, 148, 97, 1) 0, rgba(255, 104, 53, 1) 100%);
        background: -webkit-linear-gradient(top, rgba(255, 148, 97, 1) 0, rgba(255, 104, 53, 1) 100%);
        background: linear-gradient(to bottom, rgba(255, 148, 97, 1) 0, rgba(255, 104, 53, 1) 100%)
    }

    .skin_blue .nowrap2:hover {
        /*background: url(/src/assets/userimg/044contMain_gy/images/skin/blue/announce-bg.png) no-repeat center bottom*/
    }

    .skin_blue li.link:hover {
        background: #346fb9;
        background: -moz-linear-gradient(top, rgba(52, 111, 185, 1) 0, rgba(52, 111, 185, 1) 100%);
        background: -webkit-linear-gradient(top, rgba(52, 111, 185, 1) 0, rgba(52, 111, 185, 1) 100%);
        background: linear-gradient(to bottom, rgba(52, 111, 185, 1) 0, rgba(52, 111, 185, 1) 100%)
    }

    .skin_blue .u-header {
        background-color: #2161b3;
        color: #fff
    }

    .skin_blue .u-table2 th {
        color: #4f4d4d;
        border: 1px solid #b9c2cb;
        background-color: #edf4fe
    }

    .skin_blue .cont-col3-box2 span {
        color: #38539a
    }
    .skin_blue .u-btn1 {
        background: #5b8ac7;
        background: -moz-linear-gradient(top, #5b8ac7 0, #2765b5 100%);
        background: -webkit-linear-gradient(top, #5b8ac7 0, #2765b5 100%);
        background: linear-gradient(to bottom, #5b8ac7 0, #2765b5 100%);
        border: 1px solid #1e57a0;
        color: #fff
    }
    .skin_blue .u-btn1:hover {
        color: #f98d5c;
        font-weight: 700
    }
    .skin_blue .cont-sider thead th {
        background: #2161b3;
        color: #fff
    }
    .skin_blue .header .lotterys .more-game {
        border-left: 1px solid #2161b3
    }
    .skin_blue .header .more-game-drop a {
        color: #fff
    }
    .skin_blue .header .more-game-drop a:hover {
        background: #143679;
        color: #fff
    }
    .skin_blue .header .lotterys .more-game.selected>a,
    .skin_blue .header .lotterys .more-game:hover>a,
    .skin_blue .header .lotterys.menu-editMode .more-game>a {
        background: #e6e6e6;
        background: -moz-linear-gradient(top, rgba(230, 230, 230, 1) 0, rgba(231, 231, 231, 1) 100%);
        background: -webkit-linear-gradient(top, rgba(230, 230, 230, 1) 0, rgba(231, 231, 231, 1) 100%);
        background: linear-gradient(to bottom, rgba(230, 230, 230, 1) 0, rgba(231, 231, 231, 1) 100%);
        border-bottom: 1px solid #e6e6e6;
        color: #143679
    }
    .skin_blue .header .lotterys .more-game:hover>a,
    .skin_blue .header .lotterys.menu-editMode .more-game>a {
        color: #143679
    }
    .skin_blue .header .more-game-drop {
        background-color: #e7e7e7;
        border: 1px solid #2161b3
    }
    .skin_blue .header .gamebox a {
        background: #2161b3
    }
    .skin_blue .header .actionBtn {
        background: #2161b3
    }
    .skin_blue .notice-wrap .bg {
        background: #1e5799;
        background: -moz-linear-gradient(top, rgba(30, 87, 153, 1) 0, rgba(0, 219, 255, 1) 0, rgba(0, 165, 255, 1) 100%);
        background: -webkit-linear-gradient(top, rgba(30, 87, 153, 1) 0, rgba(0, 219, 255, 1) 0, rgba(0, 165, 255, 1) 100%);
        background: linear-gradient(to bottom, rgba(30, 87, 153, 1) 0, rgba(0, 219, 255, 1) 0, rgba(0, 165, 255, 1) 100%)
    }
    .button {
        -moz-user-select: none;
        cursor: pointer;
        display: inline-block;
        line-height: normal;
        margin-left: 2px;
        text-align: center;
        vertical-align: middle;
        white-space: nowrap
    }

    .button::-moz-focus-inner {
        border: 0 none;
        padding: 0
    }

    .button {
        background-color: #eda220;
        border: medium none;
        border-radius: 2px;
        color: #fff;
        font-family: inherit;
        font-size: 100%;
        line-height: 24px;
        padding: 0 16px;
        text-decoration: none
    }

    .button-hover,
    .button:focus,
    .button:hover {
        background-image: linear-gradient(transparent, rgba(0, 0, 0, .05) 40%, rgba(0, 0, 0, .1))
    }

    .button:focus {
        outline: 0 none
    }
</style>