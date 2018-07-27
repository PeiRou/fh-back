<?php

namespace App\Http\Controllers\Back;

use App\Activity;
use App\ActivityCondition;
use App\ActivityPrize;
use App\ActivitySend;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ActivityController extends Controller
{
    //活动列表-新增活动
    public function addActivity(Request $request){
        $params = $request->post();
        $validator = Validator::make($request->post(),Activity::$role);
        if($validator->fails()){
            return response()->json([
                'status'=> false,
                'msg'=> $validator->errors()->first()
            ]);
        }
        $data = [];
        if(isset($params['name']) && array_key_exists('name',$params)){
            $data['name'] = $params['name'];
        }
        if(isset($params['start_time']) && array_key_exists('start_time',$params)){
            $data['start_time'] = $params['start_time'] . ' 00:00:00';
        }
        if(isset($params['end_time']) && array_key_exists('end_time',$params)){
            $data['end_time'] = $params['end_time'] . ' 23:59:59';
        }
        if(isset($params['type']) && array_key_exists('type',$params)){
            $data['type'] = $params['type'];
        }
        if(isset($params['content']) && array_key_exists('content',$params)){
            $data['content'] = $params['content'];
        }
        if(Activity::insert($data)){
            return response()->json([
                'status'=>true,
                'msg'=>'新增成功'
            ]);
        }else{
            return response()->json([
                'status'=>false,
                'msg'=>'新增失败'
            ]);
        }
    }

    //活动列表-修改活动
    public function editActivity(Request $request){
        $params = $request->post();
        $validator = Validator::make($request->post(),Activity::$role);
        if($validator->fails()){
            return response()->json([
                'status'=> false,
                'msg'=> $validator->errors()->first()
            ]);
        }
        $data = [];
        if(!isset($params['id']) && !array_key_exists('id',$params)){
            return response()->json([
                'status'=>false,
                'msg'=>'修改参数错误'
            ]);
        }
        if(isset($params['name']) && array_key_exists('name',$params)){
            $data['name'] = $params['name'];
        }
        if(isset($params['start_time']) && array_key_exists('start_time',$params)){
            $data['start_time'] = $params['start_time'] . ' 00:00:00';
        }
        if(isset($params['end_time']) && array_key_exists('end_time',$params)){
            $data['end_time'] = $params['end_time'] . ' 23:59:59';
        }
        if(isset($params['type']) && array_key_exists('type',$params)){
            $data['type'] = $params['type'];
        }
        if(isset($params['content']) && array_key_exists('content',$params)){
            $data['content'] = $params['content'];
        }
        if(Activity::where('id','=',$params['id'])->update($data)){
            return response()->json([
                'status'=>true,
                'msg'=>'修改成功'
            ]);
        }else{
            return response()->json([
                'status'=>false,
                'msg'=>'修改失败'
            ]);
        }
    }

    //活动列表-开启关闭
    public function onOffActivity(Request $request){
        $params = $request->post();
        if(!isset($params['id']) && !array_key_exists('id',$params)){
            return response()->json([
                'status'=>false,
                'msg'=>'修改参数错误'
            ]);
        }
        $status = (Activity::where('id','=',$params['id'])->value('status') == 1) ? 2 : 1;
        if(Activity::where('id','=',$params['id'])->update(['status'=>$status])){
            return response()->json([
                'status'=>true,
                'msg'=>'修改成功'
            ]);
        }else{
            return response()->json([
                'status'=>false,
                'msg'=>'修改失败'
            ]);
        }
    }

    //活动条件-新增条件
    public function addCondition(Request $request){
        $params = $request->post();
        $validator = Validator::make($request->post(),ActivityCondition::$role);
        if($validator->fails()){
            return response()->json([
                'status'=> false,
                'msg'=> $validator->errors()->first()
            ]);
        }
        $data = [];
        if(isset($params['activity_id']) && array_key_exists('activity_id',$params)){
            $data['activity_id'] = $params['activity_id'];
        }
        if(isset($params['day']) && array_key_exists('day',$params)){
            $data['day'] = $params['day'];
        }
        if(isset($params['money']) && array_key_exists('money',$params)){
            $data['money'] = $params['money'];
        }
        if(isset($params['bet']) && array_key_exists('bet',$params)){
            $data['bet'] = $params['bet'];
        }
        $content = [];
        foreach ($params['award'] as $key => $value){
            if(isset($params['num'][$key]) && array_key_exists($key,$params['num']) && isset($params['ranking'][$key]) && array_key_exists($key,$params['ranking']) && isset($params['bonus'][$key]) && array_key_exists($key,$params['bonus'])){
                $content[] = [
                    'award' => $value,
                    'num' => $params['num'][$key],
                    'ranking' => $params['ranking'][$key],
                    'bonus' => $params['bonus'][$key],
                ];
            }
        }
        $data['content'] = json_encode($content);
        $data['total_money'] = $params['total_money'];
        if(ActivityCondition::insert($data)){
            return response()->json([
                'status'=>true,
                'msg'=>'新增成功'
            ]);
        }else{
            return response()->json([
                'status'=>false,
                'msg'=>'新增失败'
            ]);
        }
    }

    //活动条件-修改条件
    public function editCondition(Request $request){
        $params = $request->post();
        $validator = Validator::make($request->post(),ActivityCondition::$role);
        if($validator->fails()){
            return response()->json([
                'status'=> false,
                'msg'=> $validator->errors()->first()
            ]);
        }
        $data = [];
        if(!isset($params['id']) && !array_key_exists('id',$params)){
            return response()->json(['status'=>false, 'msg'=>'修改参数错误']);
        }
        if(isset($params['activity_id']) && array_key_exists('activity_id',$params)){
            $data['activity_id'] = $params['activity_id'];
        }
        if(isset($params['day']) && array_key_exists('day',$params)){
            $data['day'] = $params['day'];
        }
        if(isset($params['money']) && array_key_exists('money',$params)){
            $data['money'] = $params['money'];
        }
        if(isset($params['bet']) && array_key_exists('bet',$params)){
            $data['bet'] = $params['bet'];
        }
        $content = [];
        foreach ($params['award'] as $key => $value){
            if(isset($params['num'][$key]) && array_key_exists($key,$params['num']) && isset($params['ranking'][$key]) && array_key_exists($key,$params['ranking']) && isset($params['bonus'][$key]) && array_key_exists($key,$params['bonus'])){
                $content[] = [
                    'award' => $value,
                    'num' => $params['num'][$key],
                    'ranking' => $params['ranking'][$key],
                    'bonus' => $params['bonus'][$key],
                ];
            }
        }
        $data['content'] = json_encode($content);
        $data['total_money'] = $params['total_money'];
        if(ActivityCondition::where('id','=',$params['id'])->update($data)){
            return response()->json([
                'status'=>true,
                'msg'=>'新增成功'
            ]);
        }else{
            return response()->json([
                'status'=>false,
                'msg'=>'新增失败'
            ]);
        }
    }

    //活动条件-删除条件
    public function delCondition(Request $request){
        $params = $request->post();
        if(!isset($params['id']) && !array_key_exists('id',$params)){
            return response()->json(['status'=>false, 'msg'=>'修改参数错误']);
        }
        if(ActivityCondition::where('id','=',$params['id'])->delete()){
            return response()->json([
                'status'=>true,
                'msg'=>'删除成功'
            ]);
        }else{
            return response()->json([
                'status'=>false,
                'msg'=>'删除失败'
            ]);
        }
    }

    //奖品配置-新增奖品
    public function addPrize(Request $request){
        $params = $request->post();
        $validator = Validator::make($request->post(),ActivityPrize::$role);
        if($validator->fails()){
            return response()->json([
                'status'=> false,
                'msg'=> $validator->errors()->first()
            ]);
        }
        $data = [];
        if(isset($params['name']) && array_key_exists('name',$params)){
            $data['name'] = $params['name'];
        }
        if(isset($params['type']) && array_key_exists('type',$params)){
            $data['type'] = $params['type'];
        }
        if(isset($params['quantity']) && array_key_exists('quantity',$params)){
            $data['quantity'] = $params['quantity'];
        }
        if(ActivityPrize::insert($data)){
            return response()->json([
                'status'=>true,
                'msg'=>'新增成功'
            ]);
        }else{
            return response()->json([
                'status'=>false,
                'msg'=>'新增失败'
            ]);
        }
    }

    //奖品配置-修改奖品
    public function editPrize(Request $request){
        $params = $request->post();
        $validator = Validator::make($request->post(),ActivityPrize::$role);
        if($validator->fails()){
            return response()->json([
                'status'=> false,
                'msg'=> $validator->errors()->first()
            ]);
        }
        $data = [];
        if(!isset($params['id']) && !array_key_exists('id',$params)){
            return response()->json([
                'status'=>false,
                'msg'=>'修改参数错误'
            ]);
        }
        if(isset($params['name']) && array_key_exists('name',$params)){
            $data['name'] = $params['name'];
        }
        if(isset($params['type']) && array_key_exists('type',$params)){
            $data['type'] = $params['type'];
        }
        if(isset($params['quantity']) && array_key_exists('quantity',$params)){
            $data['quantity'] = $params['quantity'];
        }
        if(ActivityPrize::where('id','=',$params['id'])->update($data)){
            return response()->json([
                'status'=>true,
                'msg'=>'修改成功'
            ]);
        }else{
            return response()->json([
                'status'=>false,
                'msg'=>'修改失败'
            ]);
        }
    }

    //奖品配置-删除奖品
    public function delPrize(Request $request){
        $params = $request->post();
        $data = [];
        if(!isset($params['id']) && !array_key_exists('id',$params)){
            return response()->json([
                'status'=>false,
                'msg'=>'修改参数错误'
            ]);
        }
        if(ActivityPrize::where('id','=',$params['id'])->delete()){
            return response()->json([
                'status'=>true,
                'msg'=>'删除成功'
            ]);
        }else{
            return response()->json([
                'status'=>false,
                'msg'=>'删除失败'
            ]);
        }
    }

    //派奖审核-审核奖品
    public function reviewAward(Request $request){
        $params = $request->post();
        if(!isset($params['id']) && !array_key_exists('id',$params)){
            return response()->json([
                'status'=>false,
                'msg'=>'修改参数错误'
            ]);
        }
        $status = 3;
        if(isset($params['status']) && array_key_exists('status',$params)){
            if($params['status'] == 2){
                $status = 4;
            }
        }
        if(ActivitySend::where('id','=',$params['id'])->update(['status'=>$status])){
            return response()->json([
                'status'=>true,
                'msg'=>'审核成功'
            ]);
        }else{
            return response()->json([
                'status'=>false,
                'msg'=>'审核失败'
            ]);
        }
    }
}
