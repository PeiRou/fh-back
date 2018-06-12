<?php

namespace App\Http\Controllers\Back\Data;

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
}
