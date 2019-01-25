@extends('back.master')

@section('title','系统参数配置')

@section('content')
    <div class="content-top">
        <div class="breadcrumb">
            <b>位置：</b>系统参数配置
            <button style="line-height: 20px;border:0;margin-left: 10px;cursor:pointer;" onclick="javascript:history.go(-1)">返回</button>
        </div>
    </div>
    <div class="table-content">
        <table align="center" class="ui small selectable celled striped table">
            <tbody>
            <tr class="firstRow" style="background: #dbe8f0;text-align: center;font-size: 16px;font-weight: bold;">
                <td width="320" valign="top" style="word-break: break-all;">参数说明</td>
                <td valign="top" style="word-break: break-all;">参数值</td>
                <td width="200" valign="top" style="word-break: break-all;">操作</td>
            </tr>
            <tr>
                <td valign="top" style="word-break: break-all;vertical-align: middle;">试玩账号默认金额</td>
                <td valign="top" style="word-break: break-all;text-align: center;">
                    <div class="ui input">
                        <input type="text" name="" style="width: 700px;height: 28px;" value="{{ $set->test_account_money }}" data-id-input="test_account_money"/>
                    </div>
                </td>
                <td valign="top" style="word-break: break-all;vertical-align: middle;" data-id="test_account_money" data-c="试玩账号默认金额" class="edit-link">修改</td>
            </tr>
            <tr>
                <td valign="top" style="word-break: break-all;vertical-align: middle;">同一IP每天试玩次数</td>
                <td valign="top" style="word-break: break-all;text-align: center;">
                    <div class="ui input">
                        <input type="text" name="" style="width: 700px;height: 28px;" value="{{ $set->test_account_num }}" data-id-input="test_account_num"/>
                    </div>
                </td>
                <td valign="top" style="word-break: break-all;vertical-align: middle;" data-id="test_account_num" data-c="同一IP每天试玩次数" class="edit-link">修改</td>
            </tr>
            <tr>
                <td valign="top" style="word-break: break-all;vertical-align: middle;">注册黑名单</td>
                <td valign="top" style="word-break: break-all;text-align: center;">
                    <div class="ui input">
                        <input type="text" name="" style="width: 700px;height: 28px;" value="{{ $set->reg_black_list }}" data-id-input="reg_black_list"/>
                    </div>
                </td>
                <td valign="top" style="word-break: break-all;vertical-align: middle;" data-id="reg_black_list" data-c="注册黑名单" class="edit-link">修改</td>
            </tr>
            <tr>
                <td valign="top" style="word-break: break-all;vertical-align: middle;">六合彩【金】号码</td>
                <td valign="top" style="word-break: break-all;text-align: center;">
                    <div class="ui input">
                        <input type="text" name="" style="width: 700px;height: 28px;" value="{{ $set->lhc_jin_num }}" data-id-input="lhc_jin_num"/>
                    </div>
                </td>
                <td valign="top" style="word-break: break-all;vertical-align: middle;" data-id="lhc_jin_num" data-c="六合彩【金】号码" class="edit-link">修改</td>
            </tr>
            <tr>
                <td valign="top" style="word-break: break-all;vertical-align: middle;">六合彩【木】号码</td>
                <td valign="top" style="word-break: break-all;text-align: center;">
                    <div class="ui input">
                        <input type="text" name="" style="width: 700px;height: 28px;" value="{{ $set->lhc_mu_num }}" data-id-input="lhc_mu_num"/>
                    </div>
                </td>
                <td valign="top" style="word-break: break-all;vertical-align: middle;" data-id="lhc_mu_num" data-c="六合彩【木】号码" class="edit-link">修改</td>
            </tr>
            <tr>
                <td valign="top" style="word-break: break-all;vertical-align: middle;">六合彩【水】号码</td>
                <td valign="top" style="word-break: break-all;text-align: center;">
                    <div class="ui input">
                        <input type="text" name="" style="width: 700px;height: 28px;" value="{{ $set->lhc_shui_num }}" data-id-input="lhc_shui_num"/>
                    </div>
                </td>
                <td valign="top" style="word-break: break-all;vertical-align: middle;" data-id="lhc_shui_num" data-c="六合彩【水】号码" class="edit-link">修改</td>
            </tr>
            <tr>
                <td valign="top" style="word-break: break-all;vertical-align: middle;">六合彩【火】号码</td>
                <td valign="top" style="word-break: break-all;text-align: center;">
                    <div class="ui input">
                        <input type="text" name="" style="width: 700px;height: 28px;" value="{{ $set->lhc_huo_num }}" data-id-input="lhc_huo_num"/>
                    </div>
                </td>
                <td valign="top" style="word-break: break-all;vertical-align: middle;" data-id="lhc_huo_num" data-c=">六合彩【火】号码" class="edit-link">修改</td>
            </tr>
            <tr>
                <td valign="top" style="word-break: break-all;vertical-align: middle;">六合彩【土】号码</td>
                <td valign="top" style="word-break: break-all;text-align: center;">
                    <div class="ui input">
                        <input type="text" name="" style="width: 700px;height: 28px;" value="{{ $set->lhc_tu_num }}" data-id-input="lhc_tu_num"/>
                    </div>
                </td>
                <td valign="top" style="word-break: break-all;vertical-align: middle;" data-id="lhc_tu_num" data-c="六合彩【土】号码" class="edit-link">修改</td>
            </tr>
            {{--<tr>--}}
                {{--<td valign="top" style="word-break: break-all;vertical-align: middle;">在线客服</td>--}}
                {{--<td valign="top" style="word-break: break-all;text-align: center;">--}}
                    {{--<div class="ui input">--}}
                        {{--<input type="text" name="" style="width: 700px;height: 28px;" value="{{ $set->online_service_url }}" data-id-input="online_service_url"/>--}}
                    {{--</div>--}}
                {{--</td>--}}
                {{--<td valign="top" style="word-break: break-all;vertical-align: middle;" data-id="online_service_url" data-c="在线客服" class="edit-link">修改</td>--}}
            {{--</tr>--}}
            {{--<tr>--}}
                {{--<td valign="top" style="word-break: break-all;vertical-align: middle;">系统默认皮肤（blue：蓝色，red：红色）</td>--}}
                {{--<td valign="top" style="word-break: break-all;text-align: center;">--}}
                    {{--<div class="ui input">--}}
                        {{--<input type="text" name="" style="width: 700px;height: 28px;" value="{{ $set->default_skin }}" data-id-input="default_skin"/>--}}
                    {{--</div>--}}
                {{--</td>--}}
                {{--<td valign="top" style="word-break: break-all;vertical-align: middle;" data-id="default_skin" data-c="系统默认皮肤（blue：蓝色，red：红色）" class="edit-link">修改</td>--}}
            {{--</tr>--}}
            {{--<tr>--}}
                {{--<td valign="top" style="word-break: break-all;vertical-align: middle;">推广页面QQ连接</td>--}}
                {{--<td valign="top" style="word-break: break-all;text-align: center;">--}}
                    {{--<div class="ui input">--}}
                        {{--<input type="text" name="" style="width: 700px;height: 28px;" value="{{ $set->index_qq_url }}" data-id-input="index_qq_url"/>--}}
                    {{--</div>--}}
                {{--</td>--}}
                {{--<td valign="top" style="word-break: break-all;vertical-align: middle;" data-id="index_qq_url" data-c="推广页面QQ连接" class="edit-link">修改</td>--}}
            {{--</tr>--}}
            {{--<tr>--}}
                {{--<td valign="top" style="word-break: break-all;vertical-align: middle;">推广页面微信连接</td>--}}
                {{--<td valign="top" style="word-break: break-all;text-align: center;">--}}
                    {{--<div class="ui input">--}}
                        {{--<input type="text" name="" style="width: 700px;height: 28px;" value="{{ $set->index_wechat_url }}" data-id-input="index_wechat_url"/>--}}
                    {{--</div>--}}
                {{--</td>--}}
                {{--<td valign="top" style="word-break: break-all;vertical-align: middle;" data-id="index_wechat_url" data-c="推广页面微信连接" class="edit-link">修改</td>--}}
            {{--</tr>--}}
            {{--<tr>--}}
                {{--<td valign="top" style="word-break: break-all;vertical-align: middle;">推广页面联系电话</td>--}}
                {{--<td valign="top" style="word-break: break-all;text-align: center;">--}}
                    {{--<div class="ui input">--}}
                        {{--<input type="text" name="" style="width: 700px;height: 28px;" value="{{ $set->index_phone_url }}" data-id-input="index_phone_url"/>--}}
                    {{--</div>--}}
                {{--</td>--}}
                {{--<td valign="top" style="word-break: break-all;vertical-align: middle;" data-id="index_phone_url" data-c="推广页面联系电话" class="edit-link">修改</td>--}}
            {{--</tr>--}}
            {{--<tr>--}}
                {{--<td valign="top" style="word-break: break-all;vertical-align: middle;">推广页面客服QQ</td>--}}
                {{--<td valign="top" style="word-break: break-all;text-align: center;">--}}
                    {{--<div class="ui input">--}}
                        {{--<input type="text" name="" style="width: 700px;height: 28px;" value="{{ $set->index_service_qq_url }}" data-id-input="index_service_qq_url"/>--}}
                    {{--</div>--}}
                {{--</td>--}}
                {{--<td valign="top" style="word-break: break-all;vertical-align: middle;" data-id="index_service_qq_url" data-c="推广页面客服QQ" class="edit-link">修改</td>--}}
            {{--</tr>--}}
            {{--<tr>--}}
                {{--<td valign="top" style="word-break: break-all;vertical-align: middle;">推广页面代理QQ</td>--}}
                {{--<td valign="top" style="word-break: break-all;text-align: center;">--}}
                    {{--<div class="ui input">--}}
                        {{--<input type="text" name="" style="width: 700px;height: 28px;" value="{{ $set->index_agent_qq_url }}" data-id-input="index_agent_qq_url"/>--}}
                    {{--</div>--}}
                {{--</td>--}}
                {{--<td valign="top" style="word-break: break-all;vertical-align: middle;" data-id="index_agent_qq_url" data-c="推广页面代理QQ" class="edit-link">修改</td>--}}
            {{--</tr>--}}
            {{--<tr>--}}
                {{--<td valign="top" style="word-break: break-all;vertical-align: middle;">推广页面代理Email</td>--}}
                {{--<td valign="top" style="word-break: break-all;text-align: center;">--}}
                    {{--<div class="ui input">--}}
                        {{--<input type="text" name="" style="width: 700px;height: 28px;" value="{{ $set->index_agent_email_url }}" data-id-input="index_agent_email_url"/>--}}
                    {{--</div>--}}
                {{--</td>--}}
                {{--<td valign="top" style="word-break: break-all;vertical-align: middle;" data-id="index_agent_email_url" data-c="推广页面代理Email" class="edit-link">修改</td>--}}
            {{--</tr>--}}
            <tr>
                <td valign="top" style="word-break: break-all;vertical-align: middle;">一天一个IP能注册多少用户</td>
                <td valign="top" style="word-break: break-all;text-align: center;">
                    <div class="ui input">
                        <input type="text" name="" style="width: 700px;height: 28px;" value="{{ $set->oneday_reg_user_num }}" data-id-input="oneday_reg_user_num"/>
                    </div>
                </td>
                <td valign="top" style="word-break: break-all;vertical-align: middle;" data-id="oneday_reg_user_num" data-c="一天一个IP能注册多少用户" class="edit-link">修改</td>
            </tr>
            <tr>
                <td valign="top" style="word-break: break-all;vertical-align: middle;">注册IP黑名单，多个使用（;）隔开</td>
                <td valign="top" style="word-break: break-all;text-align: center;">
                    <div class="ui input">
                        <input type="text" name="" style="width: 700px;height: 28px;" value="{{ $set->reg_ip_black_list }}" data-id-input="reg_ip_black_list"/>
                    </div>
                </td>
                <td valign="top" style="word-break: break-all;vertical-align: middle;" data-id="reg_ip_black_list" data-c="注册IP黑名单，多个使用（;）隔开" class="edit-link">修改</td>
            </tr>
            {{--<tr>--}}
                {{--<td valign="top" style="word-break: break-all;vertical-align: middle;">开奖直播地址：为空不显示，不为空则显示</td>--}}
                {{--<td valign="top" style="word-break: break-all;text-align: center;">--}}
                    {{--<div class="ui input">--}}
                        {{--<input type="text" name="" style="width: 700px;height: 28px;" value="{{ $set->open_site_url }}" data-id-input="open_site_url"/>--}}
                    {{--</div>--}}
                {{--</td>--}}
                {{--<td valign="top" style="word-break: break-all;vertical-align: middle;" data-id="open_site_url" data-c="开奖直播地址：为空不显示，不为空则显示" class="edit-link">修改</td>--}}
            {{--</tr>--}}
            <tr>
                <td valign="top" style="word-break: break-all;vertical-align: middle;">是否允许注册同样的姓名：1-禁止，0-允许</td>
                <td valign="top" style="word-break: break-all;text-align: center;">
                    <div class="ui input">
                        <input type="text" name="" style="width: 700px;height: 28px;" value="{{ $set->allow_same_fullname_reg }}" data-id-input="allow_same_fullname_reg"/>
                    </div>
                </td>
                <td valign="top" style="word-break: break-all;vertical-align: middle;" data-id="allow_same_fullname_reg" data-c="是否允许注册同样的姓名：1-禁止，0-允许" class="edit-link">修改</td>
            </tr>
            {{--<tr>--}}
                {{--<td valign="top" style="word-break: break-all;vertical-align: middle;">禁止投注区下注8码：1-开启，0-关闭</td>--}}
                {{--<td valign="top" style="word-break: break-all;text-align: center;">--}}
                    {{--<div class="ui input">--}}
                        {{--<input type="text" name="" style="width: 700px;height: 28px;" value="{{ $set->noallow_bet_8_num }}" data-id-input="noallow_bet_8_num"/>--}}
                    {{--</div>--}}
                {{--</td>--}}
                {{--<td valign="top" style="word-break: break-all;vertical-align: middle;" data-id="noallow_bet_8_num" data-c="禁止投注区下注8码：1-开启，0-关闭" class="edit-link">修改</td>--}}
            {{--</tr>--}}
            <tr>
                <td valign="top" style="word-break: break-all;vertical-align: middle;">提现间隔时间（分钟）</td>
                <td valign="top" style="word-break: break-all;text-align: center;">
                    <div class="ui input">
                        <input type="text" name="" style="width: 700px;height: 28px;" value="{{ $set->drawing_time }}" data-id-input="drawing_time"/>
                    </div>
                </td>
                <td valign="top" style="word-break: break-all;vertical-align: middle;" data-id="drawing_time" data-c="提现间隔时间" class="edit-link">修改</td>
            </tr>
            <tr>
                <td valign="top" style="word-break: break-all;vertical-align: middle;">提现检查打码量(参数是充值金额的倍数，0-关闭)</td>
                <td valign="top" style="word-break: break-all;text-align: center;">
                    <div class="ui input">
                        <input type="text" name="" style="width: 700px;height: 28px;" value="{{ $set->drawing_money_check_code }}" data-id-input="drawing_money_check_code"/>
                    </div>
                </td>
                <td valign="top" style="word-break: break-all;vertical-align: middle;" data-id="drawing_money_check_code" data-c="提现检查打码量(参数是充值金额的倍数，0-关闭)" class="edit-link">修改</td>
            </tr>
            {{--<tr>--}}
                {{--<td valign="top" style="word-break: break-all;vertical-align: middle;">网页验证码开关：0-关闭，1-开启</td>--}}
                {{--<td valign="top" style="word-break: break-all;text-align: center;">--}}
                    {{--<div class="ui input">--}}
                        {{--<input type="text" name="" style="width: 700px;height: 28px;" value="{{ $set->web_captcha }}" data-id-input="web_captcha"/>--}}
                    {{--</div>--}}
                {{--</td>--}}
                {{--<td valign="top" style="word-break: break-all;vertical-align: middle;" data-id="web_captcha" data-c="网页验证码开关：0-关闭，1-开启" class="edit-link">修改</td>--}}
            {{--</tr>--}}
            <tr>
                <td valign="top" style="word-break: break-all;vertical-align: middle;">快汇宝自动收款安全码</td>
                <td valign="top" style="word-break: break-all;text-align: center;">
                    <div class="ui input">
                        <input type="text" name="" style="width: 700px;height: 28px;" value="{{ $set->kfb_auto_savecode }}" data-id-input="kfb_auto_savecode"/>
                    </div>
                </td>
                <td valign="top" style="word-break: break-all;vertical-align: middle;" data-id="kfb_auto_savecode" data-c="快汇宝自动收款安全码" class="edit-link">修改</td>
            </tr>
            <tr>
                <td valign="top" style="word-break: break-all;vertical-align: middle;">是否限制会员注册：0-不限制，1-限制</td>
                <td valign="top" style="word-break: break-all;text-align: center;">
                    <div class="ui input">
                        <input type="text" name="" style="width: 700px;height: 28px;" value="{{ $set->allow_user_register }}" data-id-input="allow_user_register"/>
                    </div>
                </td>
                <td valign="top" style="word-break: break-all;vertical-align: middle;" data-id="allow_user_register" data-c="是否限制会员注册：0-不限制，1-限制" class="edit-link">修改</td>
            </tr>
            <tr>
                <td valign="top" style="word-break: break-all;vertical-align: middle;">会员注册方式：0-关闭，1-手机，2-qq，3-微信</td>
                <td valign="top" style="word-break: break-all;text-align: center;">
                    <div class="ui input">
                        <input type="text" name="" style="width: 700px;height: 28px;" value="{{ $set->user_register_type ?? 0 }}" data-id-input="user_register_type"/>
                    </div>
                </td>
                <td valign="top" style="word-break: break-all;vertical-align: middle;" data-id="user_register_type" data-c="会员注册方式：0-关闭，1-手机，2-qq，3-微信" class="edit-link">修改</td>
            </tr>
            <tr>
                <td valign="top" style="word-break: break-all;vertical-align: middle;">抽奖活动，派奖审核的金额分界点，如填0表示所有金额都需要审核</td>
                <td valign="top" style="word-break: break-all;text-align: center;">
                    <div class="ui input">
                        <input type="text" name="" style="width: 700px;height: 28px;" value="{{ $set->activity_money_admin }}" data-id-input="activity_money_admin"/>
                    </div>
                </td>
                <td valign="top" style="word-break: break-all;vertical-align: middle;" data-id="activity_money_admin" data-c="抽奖活动，派奖审核的金额分界点，如填0表示所有金额都需要审核" class="edit-link">修改</td>
            </tr>
            {{--<tr>--}}
                {{--<td valign="top" style="word-break: break-all;vertical-align: middle;">维护页面开关：0-关闭，1-开启</td>--}}
                {{--<td valign="top" style="word-break: break-all;text-align: center;">--}}
                    {{--<div class="ui input">--}}
                        {{--<input type="text" name="" style="width: 700px;height: 28px;" value="{{ $set->maintain_page }}" data-id-input="maintain_page"/>--}}
                    {{--</div>--}}
                {{--</td>--}}
                {{--<td valign="top" style="word-break: break-all;vertical-align: middle;"  data-id="maintain_page" data-c="维护页面开关：0-关闭，1-开启" class="edit-link">修改</td>--}}
            {{--</tr>--}}
            <tr>
                <td valign="top" style="word-break: break-all;vertical-align: middle;">维护页面描述</td>
                <td valign="top" style="word-break: break-all;text-align: center;">
                    <div class="ui input">
                        <input type="text" name="" style="width: 700px;height: 28px;" value="{{ $set->maintain_page_info }}" data-id-input="maintain_page_info"/>
                    </div>
                </td>
                <td valign="top" style="word-break: break-all;vertical-align: middle;" data-id="maintain_page_info" data-c="维护页面描述" class="edit-link">修改</td>
            </tr>
            <tr>
                <td valign="top" style="word-break: break-all;vertical-align: middle;">最低充值金额</td>
                <td valign="top" style="word-break: break-all;text-align: center;">
                    <div class="ui input">
                        <input type="text" name="" style="width: 700px;height: 28px;" value="{{ $set->low_recharge_money }}" data-id-input="low_recharge_money"/>
                    </div>
                </td>
                <td valign="top" style="word-break: break-all;vertical-align: middle;" data-id="low_recharge_money" data-c="最低充值金额" class="edit-link">修改</td>
            </tr>
            {{--<tr>--}}
                {{--<td valign="top" style="word-break: break-all;vertical-align: middle;">提现审核方式：0-直接通过驳回，1-锁定方式</td>--}}
                {{--<td valign="top" style="word-break: break-all;text-align: center;">--}}
                    {{--<div class="ui input">--}}
                        {{--<input type="text" name="" style="width: 700px;height: 28px;" value="{{ $set->drawing_way }}" data-id-input="drawing_way"/>--}}
                    {{--</div>--}}
                {{--</td>--}}
                {{--<td valign="top" style="word-break: break-all;vertical-align: middle;" data-id="drawing_way" data-c="提现审核方式：0-直接通过驳回，1-锁定方式" class="edit-link">修改</td>--}}
            {{--</tr>--}}
            {{--<tr>--}}
                {{--<td valign="top" style="word-break: break-all;vertical-align: middle;">APP域名</td>--}}
                {{--<td valign="top" style="word-break: break-all;text-align: center;">--}}
                    {{--<div class="ui input">--}}
                        {{--<input type="text" name="" style="width: 700px;height: 28px;" value="{{ $set->app_domain }}" data-id-input="app_domain"/>--}}
                    {{--</div>--}}
                {{--</td>--}}
                {{--<td valign="top" style="word-break: break-all;vertical-align: middle;" data-id="app_domain" data-c="APP域名" class="edit-link">修改</td>--}}
            {{--</tr>--}}
            {{--<tr>--}}
                {{--<td valign="top" style="word-break: break-all;vertical-align: middle;">电脑版APP下载地址：为空不显示，不为空则显示</td>--}}
                {{--<td valign="top" style="word-break: break-all;text-align: center;">--}}
                    {{--<div class="ui input">--}}
                        {{--<input type="text" name="" style="width: 700px;height: 28px;" value="{{ $set->pc_app_download_url }}" data-id-input="pc_app_download_url"/>--}}
                    {{--</div>--}}
                {{--</td>--}}
                {{--<td valign="top" style="word-break: break-all;vertical-align: middle;" data-id="pc_app_download_url" data-c="电脑版APP下载地址：为空不显示，不为空则显示" class="edit-link">修改</td>--}}
            {{--</tr>--}}
            {{--<tr>--}}
                {{--<td valign="top" style="word-break: break-all;vertical-align: middle;">手机版APP下载地址：为空不显示，不为空则显示</td>--}}
                {{--<td valign="top" style="word-break: break-all;text-align: center;">--}}
                    {{--<div class="ui input">--}}
                        {{--<input type="text" name="" style="width: 700px;height: 28px;" value="{{ $set->mobile_app_download_url }}" data-id-input="mobile_app_download_url"/>--}}
                    {{--</div>--}}
                {{--</td>--}}
                {{--<td valign="top" style="word-break: break-all;vertical-align: middle;" data-id="mobile_app_download_url" data-c="手机版APP下载地址：为空不显示，不为空则显示" class="edit-link">修改</td>--}}
            {{--</tr>--}}
            {{--<tr>--}}
                {{--<td valign="top" style="word-break: break-all;vertical-align: middle;">APP域名开关，0-关闭，1-开启</td>--}}
                {{--<td valign="top" style="word-break: break-all;text-align: center;">--}}
                    {{--<div class="ui input">--}}
                        {{--<input type="text" name="" style="width: 700px;height: 28px;" value="{{ $set->app_domain_open }}" data-id-input="app_domain_open"/>--}}
                    {{--</div>--}}
                {{--</td>--}}
                {{--<td valign="top" style="word-break: break-all;vertical-align: middle;" data-id="app_domain_open" data-c="APP域名开关，0-关闭，1-开启" class="edit-link">修改</td>--}}
            {{--</tr>--}}
            {{--<tr>--}}
                {{--<td valign="top" style="word-break: break-all;vertical-align: middle;">是否开启登录Google验证码：0-关闭，1-开启</td>--}}
                {{--<td valign="top" style="word-break: break-all;text-align: center;">--}}
                    {{--<div class="ui input">--}}
                        {{--<input type="text" name="" style="width: 700px;height: 28px;" value="{{ $set->open_login_google_captcha }}" data-id-input="open_login_google_captcha"/>--}}
                    {{--</div>--}}
                {{--</td>--}}
                {{--<td valign="top" style="word-break: break-all;vertical-align: middle;" data-id="open_login_google_captcha" data-c="是否开启登录Google验证码：0-关闭，1-开启" class="edit-link">修改</td>--}}
            {{--</tr>--}}
            {{--<tr>--}}
                {{--<td valign="top" style="word-break: break-all;vertical-align: middle;">用户注册页显示QQ字段：0-关，1-开</td>--}}
                {{--<td valign="top" style="word-break: break-all;text-align: center;">--}}
                    {{--<div class="ui input">--}}
                        {{--<input type="text" name="" style="width: 700px;height: 28px;" value="{{ $set->user_reg_qq_input }}" data-id-input="user_reg_qq_input"/>--}}
                    {{--</div>--}}
                {{--</td>--}}
                {{--<td valign="top" style="word-break: break-all;vertical-align: middle;" data-id="user_reg_qq_input" data-c="用户注册页显示QQ字段：0-关，1-开" class="edit-link">修改</td>--}}
            {{--</tr>--}}
            {{--<tr>--}}
                {{--<td valign="top" style="word-break: break-all;vertical-align: middle;">用户注册页显示邮箱字段：0-关，1-开</td>--}}
                {{--<td valign="top" style="word-break: break-all;text-align: center;">--}}
                    {{--<div class="ui input">--}}
                        {{--<input type="text" name="" style="width: 700px;height: 28px;" value="{{ $set->user_reg_email_input }}" data-id-input="user_reg_email_input"/>--}}
                    {{--</div>--}}
                {{--</td>--}}
                {{--<td valign="top" style="word-break: break-all;vertical-align: middle;" data-id="user_reg_email_input" data-c="用户注册页显示邮箱字段：0-关，1-开" class="edit-link">修改</td>--}}
            {{--</tr>--}}
            {{--<tr>--}}
                {{--<td valign="top" style="word-break: break-all;vertical-align: middle;">用户注册页显示手机字段：0-关，1-开</td>--}}
                {{--<td valign="top" style="word-break: break-all;text-align: center;">--}}
                    {{--<div class="ui input">--}}
                        {{--<input type="text" name="" style="width: 700px;height: 28px;" value="{{ $set->user_reg_mobile_input }}" data-id-input="user_reg_mobile_input"/>--}}
                    {{--</div>--}}
                {{--</td>--}}
                {{--<td valign="top" style="word-break: break-all;vertical-align: middle;" data-id="user_reg_mobile_input" data-c="用户注册页显示手机字段：0-关，1-开" class="edit-link">修改</td>--}}
            {{--</tr>--}}
            <tr>
                <td valign="top" style="word-break: break-all;vertical-align: middle;">IOS注册送彩金</td>
                <td valign="top" style="word-break: break-all;text-align: center;">
                    <div class="ui input">
                        <input type="text" name="" style="width: 700px;height: 28px;" value="{{ $set->user_reg_send_lottery }}" data-id-input="user_reg_send_lottery"/>
                    </div>
                </td>
                <td valign="top" style="word-break: break-all;vertical-align: middle;" data-id="user_reg_send_lottery" data-c="IOS注册送彩金" class="edit-link">修改</td>
            </tr>
            {{--<tr>--}}
                {{--<td valign="top" style="word-break: break-all;vertical-align: middle;">代理专属域名</td>--}}
                {{--<td valign="top" style="word-break: break-all;text-align: center;">--}}
                    {{--<div class="ui input">--}}
                        {{--<input type="text" name="" style="width: 700px;height: 28px;" value="{{ $set->agent_vip_domain }}" data-id-input="agent_vip_domain"/>--}}
                    {{--</div>--}}
                {{--</td>--}}
                {{--<td valign="top" style="word-break: break-all;vertical-align: middle;" data-id="agent_vip_domain" data-c="代理专属域名" class="edit-link">修改</td>--}}
            {{--</tr>--}}
            <tr>
                <td valign="top" style="word-break: break-all;vertical-align: middle;">提现金额限制</td>
                <td valign="top" style="word-break: break-all;text-align: center;">
                    <div class="ui input">
                        <input type="text" name="" style="width: 700px;height: 28px;" value="{{ $set->drawing_money_limit }}" data-id-input="drawing_money_limit"/>
                    </div>
                </td>
                <td valign="top" style="word-break: break-all;vertical-align: middle;" data-id="drawing_money_limit" data-c="提现金额限制" class="edit-link">修改</td>
            </tr>
            <tr>
                <td valign="top" style="word-break: break-all;vertical-align: middle;">用户注册成功平台向用户发送的消息内容</td>
                <td valign="top" style="word-break: break-all;text-align: center;">
                    <div class="ui input">
                        <input type="text" name="" style="width: 700px;height: 28px;" value="{{ $set->user_reg_message_info }}" data-id-input="user_reg_message_info"/>
                    </div>
                </td>
                <td valign="top" style="word-break: break-all;vertical-align: middle;" data-id="user_reg_message_info" data-c="用户注册成功平台向用户发送的消息内容" class="edit-link">修改</td>
            </tr>
            {{--<tr>--}}
                {{--<td valign="top" style="word-break: break-all;vertical-align: middle;">除六合彩外，所有游戏的早上封盘时间，最小从7点开始，为空不设置，格式hh:mm:ss,如：07:25:00</td>--}}
                {{--<td valign="top" style="word-break: break-all;text-align: center;">--}}
                    {{--<div class="ui input">--}}
                        {{--<input type="text" name="" style="width: 700px;height: 28px;" value="{{ $set->game_nobet_time }}" data-id-input="game_nobet_time"/>--}}
                    {{--</div>--}}
                {{--</td>--}}
                {{--<td valign="top" style="word-break: break-all;vertical-align: middle;" data-id="game_nobet_time" data-c="除六合彩外，所有游戏的早上封盘时间，最小从7点开始，为空不设置，格式hh:mm:ss,如：07:25:00" class="edit-link">修改</td>--}}
            {{--</tr>--}}
            {{--<tr>--}}
                {{--<td valign="top" style="word-break: break-all;vertical-align: middle;">代理专属客服地址</td>--}}
                {{--<td valign="top" style="word-break: break-all;text-align: center;">--}}
                    {{--<div class="ui input">--}}
                        {{--<input type="text" name="" style="width: 700px;height: 28px;" value="{{ $set->agent_vip_service_url }}" data-id-input="agent_vip_service_url"/>--}}
                    {{--</div>--}}
                {{--</td>--}}
                {{--<td valign="top" style="word-break: break-all;vertical-align: middle;" data-id="agent_vip_service_url" data-c="代理专属客服地址" class="edit-link">修改</td>--}}
            {{--</tr>--}}
            {{--<tr>--}}
                {{--<td valign="top" style="word-break: break-all;vertical-align: middle;">原生APP域名</td>--}}
                {{--<td valign="top" style="word-break: break-all;text-align: center;">--}}
                    {{--<div class="ui input">--}}
                        {{--<input type="text" name="" style="width: 700px;height: 28px;" value="{{ $set->native_app_domain }}" data-id-input="native_app_domain"/>--}}
                    {{--</div>--}}
                {{--</td>--}}
                {{--<td valign="top" style="word-break: break-all;vertical-align: middle;" data-id="native_app_domain" data-c="原生APP域名" class="edit-link">修改</td>--}}
            {{--</tr>--}}
            {{--<tr>--}}
                {{--<td valign="top" style="word-break: break-all;vertical-align: middle;">飞单前端显示域名接口</td>--}}
                {{--<td valign="top" style="word-break: break-all;text-align: center;">--}}
                    {{--<div class="ui input">--}}
                        {{--<input type="text" name="" style="width: 700px;height: 28px;" value="{{ $set->feidan_before_domain_api }}" data-id-input="feidan_before_domain_api"/>--}}
                    {{--</div>--}}
                {{--</td>--}}
                {{--<td valign="top" style="word-break: break-all;vertical-align: middle;" data-id="feidan_before_domain_api" data-c="飞单前端显示域名接口" class="edit-link">修改</td>--}}
            {{--</tr>--}}
            {{--<tr>--}}
                {{--<td valign="top" style="word-break: break-all;vertical-align: middle;">飞单管理后台域名接口</td>--}}
                {{--<td valign="top" style="word-break: break-all;text-align: center;">--}}
                    {{--<div class="ui input">--}}
                        {{--<input type="text" name="" style="width: 700px;height: 28px;" value="{{ $set->feidan_back_domain_api }}" data-id-input="feidan_back_domain_api"/>--}}
                    {{--</div>--}}
                {{--</td>--}}
                {{--<td valign="top" style="word-break: break-all;vertical-align: middle;" data-id="feidan_back_domain_api" data-c="飞单管理后台域名接口" class="edit-link">修改</td>--}}
            {{--</tr>--}}
            @if(Session::get('account') === 'admin')
            <tr>
                <td valign="top" style="word-break: break-all;vertical-align: middle;">支付平台ID</td>
                <td valign="top" style="word-break: break-all;text-align: center;">
                    <div class="ui input">
                        <input type="text" name="" style="width: 700px;height: 28px;" value="{{ $set->payment_platform_id }}" data-id-input="payment_platform_id"/>
                    </div>
                </td>
                <td valign="top" style="word-break: break-all;vertical-align: middle;" data-id="payment_platform_id" data-c="支付平台ID" class="edit-link">修改</td>
            </tr>
            <tr>
                <td valign="top" style="word-break: break-all;vertical-align: middle;">支付平台获取支付接口</td>
                <td valign="top" style="word-break: break-all;text-align: center;">
                    <div class="ui input">
                        <input type="text" name="" style="width: 700px;height: 28px;" value="{{ $set->payment_platform_interface }}" data-id-input="payment_platform_interface"/>
                    </div>
                </td>
                <td valign="top" style="word-break: break-all;vertical-align: middle;" data-id="payment_platform_interface" data-c="支付平台获取支付接口" class="edit-link">修改</td>
            </tr>
            <tr>
                <td valign="top" style="word-break: break-all;vertical-align: middle;">支付平台接口</td>
                <td valign="top" style="word-break: break-all;text-align: center;">
                    <div class="ui input">
                        <input type="text" name="" style="width: 700px;height: 28px;" value="{{ $set->payment_platform_url }}" data-id-input="payment_platform_url"/>
                    </div>
                </td>
                <td valign="top" style="word-break: break-all;vertical-align: middle;" data-id="payment_platform_url" data-c="支付平台接口" class="edit-link">修改</td>
            </tr>
            <tr>
                <td valign="top" style="word-break: break-all;vertical-align: middle;">支付平台密钥</td>
                <td valign="top" style="word-break: break-all;text-align: center;">
                    <div class="ui input">
                        <input type="text" name="" style="width: 700px;height: 28px;" value="{{ $set->payment_platform_key }}" data-id-input="payment_platform_key"/>
                    </div>
                </td>
                <td valign="top" style="word-break: break-all;vertical-align: middle;" data-id="payment_platform_key" data-c="支付平台密钥" class="edit-link">修改</td>
            </tr>
            <tr>
                <td valign="top" style="word-break: break-all;vertical-align: middle;">支付平台查询订单</td>
                <td valign="top" style="word-break: break-all;text-align: center;">
                    <div class="ui input">
                        <input type="text" name="" style="width: 700px;height: 28px;" value="{{ $set->payment_platform_inquire }}" data-id-input="payment_platform_inquire"/>
                    </div>
                </td>
                <td valign="top" style="word-break: break-all;vertical-align: middle;" data-id="payment_platform_inquire" data-c="支付平台查询订单" class="edit-link">修改</td>
            </tr>
            <tr>
                <td valign="top" style="word-break: break-all;vertical-align: middle;">支付平台代付接口</td>
                <td valign="top" style="word-break: break-all;text-align: center;">
                    <div class="ui input">
                        <input type="text" name="" style="width: 700px;height: 28px;" value="{{ $set->payment_platform_dispensing }}" data-id-input="payment_platform_dispensing"/>
                    </div>
                </td>
                <td valign="top" style="word-break: break-all;vertical-align: middle;" data-id="payment_platform_dispensing" data-c="支付平台代付接口" class="edit-link">修改</td>
            </tr>
            <tr>
                <td valign="top" style="word-break: break-all;vertical-align: middle;">平台基本赔率</td>
                <td valign="top" style="word-break: break-all;text-align: center;">
                    <div class="ui input">
                        <input type="text" name="" style="width: 700px;height: 28px;" value="{{ $set->agent_odds_basis }}" data-id-input="agent_odds_basis"/>
                    </div>
                </td>
                <td valign="top" style="word-break: break-all;vertical-align: middle;" data-id="agent_odds_basis" data-c="平台基本赔率" class="edit-link">修改</td>
            </tr>
            {{--<tr>--}}
                {{--<td valign="top" style="word-break: break-all;vertical-align: middle;">聊天室开关 0关 1开</td>--}}
                {{--<td valign="top" style="word-break: break-all;text-align: center;">--}}
                    {{--<div class="ui input">--}}
                        {{--<input type="text" name="" style="width: 700px;height: 28px;" value="{{ $set->chat_open }}" data-id-input="chat_open"/>--}}
                    {{--</div>--}}
                {{--</td>--}}
                {{--<td valign="top" style="word-break: break-all;vertical-align: middle;" data-id="chat_open" data-c="聊天室开关" class="edit-link">修改</td>--}}
            {{--</tr>--}}
            @endif
            </tbody>
        </table>
    </div>
@endsection

@section('page-js')
    <script src="/back/js/pages/system_setting.js"></script>
@endsection