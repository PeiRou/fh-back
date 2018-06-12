<?php

namespace App\Http\Controllers\Chat\Home;

use App\Models\Chat\Record;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Chat\Packet;
use App\User;

class PacketController extends Controller
{

    public function getPacket($id){
        $packet = Packet::find($id);
        //判断红包状态
        if($packet->status==='已关闭'){
            return ['code'=>-1];
        }
        if($packet->status==='已抢完' and $packet->count===$packet->sel_count){
            return ['code'=>-1];
        }
        try{
            $total  =   $packet->sel_money; //剩余红包金额
            $num    =   $packet->count-$packet->sel_count-1;// 剩余红包数 = 红包总数-已抽数
            $min    =   0.01;           //每个人最少能收到0.01元
            if($num>0){
                $safe_total = ($total-($num)*$min)/($num);      //随机安全上限
                $money      = mt_rand($min*100,$safe_total*100)/100; //随机获取当前红包金额
            }else{
                $money      = $total;
                $packet->status = "已抢完";
            }
            $sel_money  = $total-$money;  //余额
            $packet->sel_count += 1;
            $packet->sel_money = $sel_money;
            $packet->save();
            Record::create([
                'username'  => auth()->user()['username'],
                'packet_id' => $packet->id,
                'order'     => substr(date('YmdHis'),2,12).mt_rand(100000000000,999999999999),
                'money'     => $money,
                'status'    => '成功'
            ]);
            $user = User::find(auth()->user()['id']);
            $user->money = $user->money + $money;
            $user->save();
            return response()->json(['code'=>0,'money'=>$money],200);
        }catch (\Exception $exception) {
            \Log::info(__CLASS__ . '->' . __FUNCTION__ . ' Line:' . $exception->getLine() . ' ' . $exception->getMessage());
            return response()->json(array(
                'status' => 1,
                'message' => '领取红包失败',
            ));
        }



    }

}
