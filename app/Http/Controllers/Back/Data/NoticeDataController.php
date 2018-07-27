<?php

namespace App\Http\Controllers\Back\Data;

use App\MessagePush;
use App\Notices;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;

class NoticeDataController extends Controller
{
    public function notice()
    {
        $notice = Notices::all();
        return DataTables::of($notice)
            ->editColumn('type',function ($notice){
                switch ($notice->type){
                    case '1';
                        return '最新消息(投注区底部公告)';
                        break;
                    case '2';
                        return '最新消息(登录弹窗公告)';
                        break;
                    case '3';
                        return '推广页公告';
                        break;
                    case '4';
                        return '所有类型公告';
                        break;
                    case '5';
                        return '代理专属公告';
                        break;
                }
            })
            ->editColumn('control',function ($notice){
                return '<span class="edit-link" onclick="edit(\''.$notice->id.'\')"><i class="iconfont">&#xe602;</i> 修改</span> |
                        <span class="edit-link" onclick="del(\''.$notice->id.'\')"><i class="iconfont">&#xe600;</i> 删除</span>';
            })
            ->rawColumns(['control'])
            ->make(true);
    }


    public function sendMessage()
    {
        $MessagePush = MessagePush::orderBy('id','desc')->get();
        return DataTables::of($MessagePush)
            ->editColumn('user_type',function ($MessagePush){
                switch ($MessagePush->user_type){
                    case '1';
                        return '部分用户';
                        break;
                    case '2';
                        return '在线用户';
                        break;
                    case '3';
                        return '所有用户';
                        break;
                    case '4';
                        return '支付层级';
                        break;
                }
            })
            ->editColumn('message_type',function ($MessagePush){
                switch ($MessagePush->message_type){
                    case '1';
                        return '发送至用户中心';
                        break;
                    case '2';
                        return '右下角弹出提示';
                        break;
                    case '3';
                        return '页面中央弹出提示';
                        break;
                }
            })
            ->editColumn('user_level',function ($MessagePush){
                switch ($MessagePush->user_level){
                    case '1';
                        return '默认层';
                        break;
                    case '2';
                        return '第一层';
                        break;
                    case '3';
                        return '第二层';
                        break;
                    case '5';
                        return '第三层';
                        break;
                    case '6';
                        return '第四层';
                        break;
                    case '7';
                        return '第五层';
                        break;
                    case '8';
                        return '国外用户';
                        break;
                    case '9';
                        return 'VIP用户';
                        break;
                    case '10';
                        return '测试专用';
                        break;
                    case '11';
                        return '黑名单';
                        break;
                }
            })
            ->editColumn('control',function ($MessagePush){
                return '<span class="edit-link" onclick="del(\''.$MessagePush->id.'\')"><i class="iconfont">&#xe600;</i> 删除</span>';
            })
            ->rawColumns(['control'])
            ->make(true);
    }
}
