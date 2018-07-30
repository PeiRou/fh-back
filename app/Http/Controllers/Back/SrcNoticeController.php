<?php

namespace App\Http\Controllers\Back;

use App\MessagePush;
use App\Notices;
use App\Swoole;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;

class SrcNoticeController extends Controller
{
    //添加公告
    public function addNotice(Request $request)
    {
        $levels = $request->input('level_id');
        if ($levels !== null) {
            $new_levels = implode(',', $levels);
        } else {
            $new_levels = null;
        }
        $title = $request->input('title');
        $content = $request->input('content');
        $type = $request->input('type');

        $notice = new Notices();
        $notice->title = $title;
        $notice->content = $content;
        $notice->type = $type;
        $notice->userLevel = $new_levels;
        $save = $notice->save();
        if ($save == 1) {
            $this->writeToFile();
            return response()->json([
                'status' => true,
                'msg' => "添加成功！"
            ]);
        } else {
            return response()->json([
                'status' => false,
                'msg' => '暂时无法添加，请稍后重试'
            ]);
        }
    }

    //删除公告
    public function delNoticeSetting(Request $request)
    {
        $id = $request->get('id');
        $del = Notices::where('id', $id)->delete();
        if ($del == 1) {
            $this->writeToFile();
            return response()->json([
                'status' => true,
            ]);
        } else {
            return response()->json([
                'status' => false,
                'msg' => '暂时无法删除，请稍后重试'
            ]);
        }
    }

    function writeToFile()
    {
        $notice1 = Notices::select('id', 'type', 'content as message', 'title', 'updated_at as updateTime', 'created_at as addTime', 'userLevel as rechLevels')->where('type', 1)->get();
        $notice2 = Notices::select('id', 'type', 'content as message', 'title', 'updated_at as updateTime', 'created_at as addTime', 'userLevel as rechLevels')->where('type', 2)->get();
        $notice3 = Notices::select('id', 'type', 'content as message', 'title', 'updated_at as updateTime', 'created_at as addTime', 'userLevel as rechLevels')->where('type', 3)->get();
        $notice4 = Notices::select('id', 'type', 'content as message', 'title', 'updated_at as updateTime', 'created_at as addTime', 'userLevel as rechLevels')->where('type', 4)->get();
        $notice5 = Notices::select('id', 'type', 'content as message', 'title', 'updated_at as updateTime', 'created_at as addTime', 'userLevel as rechLevels')->where('type', 5)->get();
        $data = 'var MESSAGES = {"type_4":' . $notice4 . ',"type_3":' . $notice3 . ',"type_2":' . $notice2 . ',"type_1":' . $notice1 . ',"type_0":[],"type_5":' . $notice5 . '};';
        $write = Storage::disk('static')->put('messages.js', $data);
    }


    //添加消息
    public function addSendMessage(Request $request)
    {
        if($request->post('user_level') != null){
            $user_level =  $request->post('user_level','');
        }else{
            $user_level = null;
        }
        $user_str = $request->post('user_str');
        if($user_str !== null){
            $user_str = implode(',',$request->post('user_str') );
            $user_str = preg_replace("/(\n)|(\s)|(\t)|(\')|(')|(，)|(\.)/", ',', $user_str);
        }else{
            $user_str = null;
        }

        $title = $request->post('title', '');
        $content = $request->post('content', '');
        $user_type = $request->post('user_type');           //用户类型 1 部分用户 2 在线用户 3 所有用户 4 支付层级
        $message_type = $request->post('message_type');     //消息类型 1 发送至用户中心 2 右下角弹出提示 3 页面中央弹出提示

        $MessagePush = new MessagePush();
        $MessagePush->title = $title;
        $MessagePush->content = $content;
        $MessagePush->user_type = $user_type;
        $MessagePush->message_type = $message_type;
        $MessagePush->user_level = $user_level;
        $MessagePush->user_str = $user_str;
        $MessagePush->sa_id = Session::get('account_id');
        $MessagePush->sa_account = Session::get('account');
        $save = $MessagePush->save();
        if ($save == 1) {
            $redis = Redis::connection();
            switch ($user_type){
                case 1:             //1 部分用户
                    $users = explode(',',$user_str);
                    $usersArray = DB::table('users')
                        ->select('id','username')
                        ->whereIn('username', $users)
                        ->get();
                    break;
                case 2:             //2 在线用户
                    $redis->select(2);
                    $keys = $redis->keys('user:'.'*');
                    $onlineUser = [];
                    foreach ($keys as $item){
                        $data = "[".Redis::get($item)."]";
                        $get = json_decode($data,true);
                        $onlineUser[] = $get[0]['user_id'];
                    }
                    $usersArray = DB::table('users')
                        ->select('id','username')
                        ->whereIn('id', $onlineUser)
                        ->get();
                    break;
                case 3:             //3 所有用户
                    $usersArray = DB::table('users')
                        ->select('id','username')
                        ->get();
                    break;
                case 4:             //4 支付层级
                    $usersArray = DB::table('users')
                        ->select('id','username')
                        ->where('rechLevel', $user_level)
                        ->get();
                    break;
            }
            $redis->select(1);
            $rsKeyH = 'chatList';         //切换到聊天平台
            foreach ($usersArray as $key => $user){
                $tmp = [];
                $tmp['user_id'] = $user->id;
                $tmp['username'] = $user->username;
                $tmp['send_type'] = 1;
                $tmp['msg'] = $content;
                $tmp['send_sa_id'] = Session::get('account_id');
                $tmp['send_sa_account'] = Session::get('account');
                $tmp['created_at'] = date("Y-m-d H:i:s",time());
                $msgdata [] = $tmp;
                //消息推送
                switch ($message_type){
                    case 2:             //2 右下角弹出提示
                        $redis->HSET($rsKeyH,'sendR='.$user->id,$content);
                        break;
                    case 3:             //3 页面中央弹出提示
                        $redis->HSET($rsKeyH,'sendC='.$user->id,$content);
                        break;
                }
            }
            $swoole = new Swoole();
            switch ($message_type){
                case 2:             //2 右下角弹出提示
                    $swoole->swooletest('msgSendR',1);
                    break;
                case 3:             //3 页面中央弹出提示
                    $swoole->swooletest('msgSendC',1);
                    break;
            }
            if(isset($msgdata) && count($msgdata)>0)
                DB::table('user_messages')->insert($msgdata);
            return response()->json([
                'status' => true,
                'msg' => "添加成功！"
            ]);
        } else {
            return response()->json([
                'status' => false,
                'msg' => '暂时无法添加，请稍后重试'
            ]);
        }
    }


    //删除公告
    public function delSendMessage(Request $request)
    {
        $id = $request->get('id');
        $del = MessagePush::where('id', $id)->delete();
        if ($del == 1) {
            return response()->json([
                'status' => true,
            ]);
        } else {
            return response()->json([
                'status' => false,
                'msg' => '暂时无法删除，请稍后重试'
            ]);
        }
    }
}
