<?php

namespace App\Http\Controllers\Chat\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Chat\Home\PacketController;
use App\Http\Controllers\Chat\Home\PlatcfgController;
use App\Models\Chat\Disable;
use App\Models\Chat\Bullet;
use Carbon\Carbon;

class IndexController extends Controller
{
    protected $platcfg;
    public function __construct(PlatcfgController $platcfg){
        $this->platcfg = $platcfg;
    }

    public function login(Request $request){
        if($request->ajax()){

            /***chat-room platcfg***/
            if(!$this->platcfg->is_open){
                return response()->json(['code'=>-1,'msg'=>'聊天室已关闭'],200);
            }
            if(!$this->platcfg->time_out()){
                return response()->json(['code'=>-1,'msg'=>'该时间段禁止发言'],200);
            }

            $bullets = Bullet::where('type','爱彩聊天室')->orderBy('id','DESC')->get()->pluck('content');   /***chat room bullets**/

            /** messages record**/
            $file        = file(base_path('messages.txt'));
            $messages    = collect($file)->map(function($line,$index){
                //$content = preg_replace("/\\n/","",$line);
                $content = trim($line);
                return $content;
            })->toArray();
            /***/

            /**返回当前用户信息**/
            $user = [
                'username' => auth()->user()['username'],
                'avatar' => auth()->user()['chatAvatar'],
                'chatRole' => auth()->user()['chatRole'],
            ];

            $disables  = Disable::all()->pluck('name')->implode('|');   /***chat room disables**/
            $schedules = $this->platcfg->schedule_games();
            $is_auto   = $this->platcfg->is_auto;

            return response()->json([
                'disables'  => $disables,
                'messages'  => $messages,
                'bullets'   => $bullets,
                'schedules' => $schedules,
                'is_auto'   => $is_auto,
                'user'      => $user
            ],200);
        }
    }



    public function upload(Request $request){
        if($request->ajax()){
            /***chat-room platcfg***/
            if(!$this->platcfg->is_open){
                return response()->json(['code'=>-1,'msg'=>'聊天室已关闭'],200);
            }
            if(!$this->platcfg->time_out()){
                return response()->json(['code'=>-1,'msg'=>'该时间段禁止发言'],200);
            }

            /**send img permission**/
//            if(){
//
//            }

            $file       = $request->file('file');//获取文件
            $extension  = $file->getClientOriginalExtension();
            $allowed_extensions = ['jpg','png','gif','jpeg'];
            if ($extension && in_array($extension, $allowed_extensions)) {
                $fileName        = md5(str_random(10)).'.'.$extension;
                $destinationPath = 'chat'.DIRECTORY_SEPARATOR.'uploads';
                $file->move($destinationPath, $fileName);
                //$_data = ['imgUrl'=>DIRECTORY_SEPARATOR.'chat'.DIRECTORY_SEPARATOR.$fileName,'message'=>$request->get('note')];  //$_SERVER['SERVER_NAME'].

                $_data = ['imgUrl'=>DIRECTORY_SEPARATOR.'chat'.DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.$fileName,'message'=>$request->get('note')];  //$_SERVER['SERVER_NAME'].
                return response()->json($_data,200);
            }
        }
    }

    public function getPacket(Request $request,PacketController $packetCon){
        if($request->ajax()){
            /***chat-room platcfg***/
            if(!$this->platcfg->is_open){
                return response()->json(['code'=>-1,'msg'=>'聊天室已关闭'],200);
            }
            if(!$this->platcfg->time_out()){
                return response()->json(['code'=>-1,'msg'=>'该时间段禁止发言'],200);
            }
            // 判断用户是有权限 (打码量，充值量)
           return  $result = $packetCon->getPacket($request->input('packet'));
        }
    }
}
