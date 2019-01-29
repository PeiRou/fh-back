<?php

namespace App\Http\Controllers\Back;

use App\Activity;
use App\Capital;
use App\User;
use App\ActivityCondition;
use App\ActivityPrize;
use App\ActivitySend;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ActivityController extends Controller
{
    private function getAdmin($params){
        $params['admin_id'] = Session::get('account_id');
        $params['admin_name'] = Session::get('account_name');
        $params['admin_account'] = Session::get('account');
        $params['updated_at'] = date("Y-m-d H:i:s",time());
        return $params;
    }
    //活动列表-新增活动
    public function addActivity(Request $request){
        $params = $request->post();
        $data = $this->getAdmin($params);
        $validator = Validator::make($request->post(),Activity::$role);
        if($validator->fails()){
            return response()->json([
                'status'=> false,
                'msg'=> $validator->errors()->first()
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
        $data['start_activity'] = $data['end_activity'] = '';
        if(isset($params['type']) && array_key_exists('type',$params)){
            $data['type'] = $params['type'];
            if ($data['type'] == 3) {//红包活动
                if(!isset($request->start_activity, $request->end_activity))
                    return response()->json([
                        'status'=>false,
                        'msg'=>'请填写活动时间段'
                    ]);
                $data['start_activity'] = date('H:i:s', strtotime($request->start_activity));
                $data['end_activity'] = date('H:i:s', strtotime($request->end_activity));
                if($data['start_activity'] > $data['end_activity'])
                    return response()->json([
                        'status'=>false,
                        'msg'=>'时间段错误'
                    ]);
            }
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
        $data = $this->getAdmin($params);
        $validator = Validator::make($request->post(),Activity::$role);
        if($validator->fails()){
            return response()->json([
                'status'=> false,
                'msg'=> $validator->errors()->first()
            ]);
        }
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
            if ($data['type'] == 3) {//红包活动
                if(!isset($request->start_activity, $request->end_activity))
                    return response()->json([
                        'status'=>false,
                        'msg'=>'请填写活动时间段'
                    ]);
                $data['start_activity'] = date('H:i:s', strtotime($request->start_activity));
                $data['end_activity'] = date('H:i:s', strtotime($request->end_activity));
                if($data['start_activity'] > $data['end_activity'])
                    return response()->json([
                        'status'=>false,
                        'msg'=>'时间段错误'
                    ]);
            }
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
        $params = $this->getAdmin($params);
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

    public function addConditionMoney(Request $request)
    {
        $request->money = (float)$request->money;
        if(!isset($request->id) || $request->money <= 0){
            return show(1, '参数错误');
        }
        $key = 'activity_hongbao_money_'.date('Ymd_').(int)$request->id;
        $redis = Redis::connection();
        $redis->select(14);
        $money = $redis->get($key);
        $money = (float)$money + $request->money;
        \App\ActivityCondition::where(function($sql) use($request){
            $sql->where('id', (int)$request->id);
        })->update([
            'money'=>$money,
            'total_money' => DB::raw('total_money+'.$request->money)
        ]);
        //数据库修改失败没关系  要redis修改成功 抢红包后会将redis的金额更新到数据库
        if($redis->set($key, $money))
            return show(0);
        return show(1, 'error');
    }

    public function addConditionHongbao(Request $request)
    {
        $data = $this->getAdmin([]);
        $validator = Validator::make($request->post(),[
            'activity_id' => 'required|integer',
            'total_money1' => 'required|numeric',
            'min_money' => 'required|array',
            'max_money' => 'required|array',
            'times' => 'required|array',
        ]);
        if($validator->fails()){
            return response()->json([
                'status'=> false,
                'msg'=> $validator->errors()->first()
            ]);
        }

        if(!count($request->min_money) || count($request->min_money) !== count($request->max_money) && count($request->min_money) !== count($request->times)){
            return response()->json([
                'status'=> false,
                'msg'=> '抽奖设置参数不能为空'
            ]);
        }
        $param = [];
        foreach ($request->min_money as $k => $v) {
            if(!isset($request->min_money[$k], $request->max_money[$k], $request->times[$k])){
                continue;
            }
            if($request->min_money[$k] > $request->max_money[$k]){
                return response()->json([
                    'status'=> false,
                    'msg'=> '最小金额大于最大金额'
                ]);
            }
            foreach ($param as $kk=>$vv){
                //每个最大最小金额不能在其它的金额范围内 不然不能计算
                if($request->min_money[$k] >= $vv['min_money'] && $request->min_money[$k] <= $vv['max_money'] || $request->max_money[$k] >= $vv['min_money'] && $request->max_money[$k] <= $vv['max_money']){
                    return response()->json([
                        'status'=> false,
                        'msg'=> '金额范围不能包含其它金额范围'
                    ]);
                }
            }
            $param[] = [
                'min_money' => (float)$request->min_money[$k],
                'max_money' => (float)$request->max_money[$k],
                'times' => (int)$request->times[$k],
            ];
        }
        if(!isset($request->id) && \App\ActivityCondition::where('activity_id', (int)$request->activity_id)->count())
            return response()->json([
                'status'=>false,
                'msg'=>'已经添加过此活动'
            ]);
        $arr = [
            'activity_id' => (int)$request->activity_id,
//            'money' => (float)$request->money,
            'total_money' => (float)$request->total_money1,
//            'times' => (int)$request->times,
            'updated_at' => date('Y-m-d H:i:s'),
            'admin_id' => $data['admin_id'],
            'admin_name' => $data['admin_name'],
            'admin_account' => $data['admin_account'],
            'content' => json_encode($param, JSON_UNESCAPED_UNICODE)
        ];
        if (isset($request->id)) {
            if(\App\ActivityCondition::where('id', $request->id)->update($arr))
                return response()->json([
                    'status'=>true,
                    'msg'=>'修改成功'
                ]);
        } else  {
            $arr['created_at'] = date('Y-m-d H:i:s');
            $arr['money'] = $arr['total_money'];

            if(\App\ActivityCondition::insert($arr)){
                return response()->json([
                    'status'=>true,
                    'msg'=>'新增成功'
                ]);
            }
        }
        return response()->json([
            'status'=>false,
            'msg'=>isset($request->id) ? '修改失败' : '新增失败'
        ]);
    }
    //活动条件-新增条件
    public function addCondition(Request $request){
        if(isset($request->activity_id)) {
            if(\App\Activity::where('id', (int)$request->activity_id)->value('type') == 3)
                return $this->addConditionHongbao($request);
        }
        $params = $request->post();
        $data = $this->getAdmin($params);
        $validator = Validator::make($request->post(),ActivityCondition::$role);
        if($validator->fails()){
            return response()->json([
                'status'=> false,
                'msg'=> $validator->errors()->first()
            ]);
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
//        unset($data['award']);
//        unset($data['num']);
//        unset($data['ranking']);
//        unset($data['bonus']);
        $arr = [
            'day' => $data['day'],
            'money' => $data['money'],
            'bet' => $data['bet'],
            'total_money' => $data['total_money'],
            'activity_id' => $data['activity_id'],
            'admin_id' => $data['admin_id'],
            'admin_name' => $data['admin_name'],
            'admin_account' => $data['admin_account'],
            'updated_at' => $data['updated_at'],
            'updated_at' => date('Y-m-d H:i:s'),
            'content' => $data['content'],
        ];
        if(ActivityCondition::insert($arr)){
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
        if(isset($request->activity_id))
            if(\App\Activity::where('id', (int)$request->activity_id)->value('type') == 3)
                return $this->addConditionHongbao($request);
        $params = $request->post();
        $data = $this->getAdmin($params);
        $validator = Validator::make($request->post(),ActivityCondition::$role);
        if($validator->fails()){
            return response()->json([
                'status'=> false,
                'msg'=> $validator->errors()->first()
            ]);
        }
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
//        unset($data['award']);
//        unset($data['num']);
//        unset($data['ranking']);
//        unset($data['bonus']);
        $arr = [
            'day' => $data['day'],
            'money' => $data['money'],
            'bet' => $data['bet'],
            'total_money' => $data['total_money'],
            'activity_id' => $data['activity_id'],
            'admin_id' => $data['admin_id'],
            'admin_name' => $data['admin_name'],
            'admin_account' => $data['admin_account'],
            'updated_at' => $data['updated_at'],
            'content' => $data['content'],
        ];
        if(ActivityCondition::where('id','=',$params['id'])->update($arr)){
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
//    public function delConditionHongbao(Request $request)
//    {
//        if(!isset($request->id))
//            return response()->json(['status'=>false, 'msg'=>'修改参数错误']);
//        if(\App\ActivityConditionHongbao::where('id','=',(int)$request->id)->delete()){
//            return response()->json([
//                'status'=>true,
//                'msg'=>'删除成功'
//            ]);
//        }else{
//            return response()->json([
//                'status'=>false,
//                'msg'=>'删除失败'
//            ]);
//        }
//    }
    //活动条件-删除条件
    public function delCondition(Request $request){
//        if(isset($request->activity_id))
//            if(\App\Activity::where('id', (int)$request->activity_id)->value('type') == 3)
//                return $this->delConditionHongbao($request);
        $params = $request->post();
        $params = $this->getAdmin($params);
        if(!isset($params['id']) && !array_key_exists('id',$params)){
            return response()->json(['status'=>false, 'msg'=>'参数错误']);
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
    private function addActivityCondition_add($data, Request $request){
        $model = \App\ActivityHongbaoProbability::class;
        $where = [
            'level_id' => (int)$request->level_id,
            'activity_id' => (int)$request->activity_id
        ];
        if($model::where($where)->count())
            return response()->json([
                'status'=>false,
                'msg'=>'此层级下已有红包'
            ]);
        DB::beginTransaction();
        try{
            $data['is_default'] == 1 && $model::clearDefault($request);
            $data['created_at'] = date('Y-m-d H:i:s');
            if($model::insert($data)) {
                DB::commit();
                return response()->json([
                    'status'=>true,
                    'msg'=>'添加成功'
                ]);
            }

        } catch (\Exception $e) {}
        DB::rollback();
        return response()->json([
            'status'=>false,
            'msg'=>'添加失败'
        ]);
    }

    private function addActivityCondition_edit($data, Request $request){
        $model = \App\ActivityHongbaoProbability::class;
        if($model::where(function ($sql) use ($data, $request) {
            $sql->where('level_id', (int)$data['level_id']);
            $sql->where('activity_id', (int)$data['activity_id']);
            $sql->where('id', '<>',(int)$request->id);
        })->count())
            return response()->json([
                'status'=>false,
                'msg'=>'此层级下已有红包'
            ]);
        DB::beginTransaction();
        try {
            $data['is_default'] == 1 && $model::clearDefault($request);
            if($model::where('id', (int)$request->id)->update($data)) {
                DB::commit();
                return response()->json([
                    'status'=>true,
                    'msg'=>'修改成功'
                ]);
            }
        } catch (\Exception $e) {}
        DB::rollback();
        return response()->json([
            'status'=>false,
            'msg'=>'修改失败'
        ]);
    }
    //活动红包-删除红包
    public function delActivityCondition(Request $request)
    {
        if(!isset($request->id))
            return response()->json([
                'status'=> false,
                'msg'=> '参数错误'
            ]);
        if(\App\ActivityHongbaoProbability::where('id', (int)$request->id)->delete())
            return response()->json([
                'status'=>true,
                'msg'=>'删除成功'
            ]);
        return response()->json([
            'status'=>false,
            'msg'=>'删除失败'
        ]);
    }
    //活动红包-新增修改红包
    public function addActivityCondition(Request $request)
    {
        if(!isset($request->activity_id, $request->level_id, $request->min_money, $request->max_money, $request->probability)){
            return response()->json([
                'status'=> false,
                'msg'=> '参数错误'
            ]);
        }
        if($request->min_money > $request->max_money)
            return response()->json([
                'status'=> false,
                'msg'=> '金额不正确'
            ]);
        $admin = $this->getAdmin([]);
        $data = [
            'is_default' => $request->is_default == 'on' ? 1 : 2,
            'activity_id' => (int)$request->activity_id,
            'level_id' => (int)$request->level_id,
            'min_money' => (float)$request->min_money,
            'max_money' => (float)$request->max_money,
            'probability' => (float)$request->probability,
//            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            'admin_id' => $admin['admin_id'],
            'admin_name' => $admin['admin_name'],
            'admin_account' => $admin['admin_account'],
        ];
        if(isset($request->id))
            return $this->addActivityCondition_edit($data, $request);
        return $this->addActivityCondition_add($data, $request);
    }

    //奖品配置-新增奖品
    public function addPrize(Request $request){
        $params = $request->post();
        $data = $this->getAdmin($params);
        $validator = Validator::make($request->post(),ActivityPrize::$role);
        if($validator->fails()){
            return response()->json([
                'status'=> false,
                'msg'=> $validator->errors()->first()
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
        $params = $this->getAdmin($params);
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
        $params = $this->getAdmin($params);
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
        $redis = Redis::connection();
        $redis->select(5);
        $key = 'reviewAward:'.$params['id'];
        if($redis->exists($key)){
            return response()->json([
                'status'=>false,
                'msg'=>'请勿连续点击,请等待10秒'
            ]);
        }
        $redis->setex($key,10,time());
        $data = $this->getAdmin($params);
        $params['updated_at'] = date("Y-m-d H:i:s",time());
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
        $data['status'] = $status;
        DB::beginTransaction();
        if(ActivitySend::where('id','=',$params['id'])->update($data)){
            Session::put('act_send',$params['id']);
            //如果是审核不通过就不需要后面的添加用户金额了
            if($data['status'] == 3){
                DB::commit();
                return response()->json([
                    'status'=>true,
                    'msg'=>'审核成功'
                ]);
            }
            $actSned = ActivitySend::where('activity_send.id','=',$params['id'])
                ->select('activity_send.*', 'activity.type')
                ->leftJoin('activity', 'activity.id', 'activity_send.activity_id')
                ->first();
            if(strpos($actSned->prize_name,'元')>0 || ($actSned->type == 3 && (float)$actSned->prize_name > 0)) {
                $actAmount = (float)substr($actSned->prize_name,0,-1);
                $actSned->type == 3 && $actAmount = (float)$actSned->prize_name;
                try{
                    $userInfo = DB::connection('mysql::write')->table('users')->select('money')->where('id', $actSned->user_id)->first();
                    User::where('id',$actSned->user_id)
                        ->increment('money',$actAmount);
                    $capital = new Capital();
                    $capital->to_user = $actSned->user_id;
                    $capital->user_type = 'user';
                    $capital->order_id = $capital->randOrder('C');
                    $capital->type = 't08';
                    $capital->money = $actAmount;
                    $capital->balance = $userInfo->money + $actAmount;
                    $capital->operation_id = 0;
                    $capital->content = $actSned->activity_name;
                    $capital->save();
                    DB::commit();
                    return response()->json([
                        'status'=>true,
                        'msg'=>'审核成功'
                    ]);
                }catch (\Exception $e){
                    DB::rollback();
                    writeLog('error', __CLASS__ . '->' . __FUNCTION__ . ' Line:' . $e->getLine() . ' ' . $e->getMessage());
                    return response()->json([
                        'status'=>false,
                        'msg'=>'审核失败'
                    ]);
                }
            }
            DB::rollback();
            return response()->json([
                'status'=>false,
                'msg'=>'审核失败'
            ]);
        }else{
            DB::rollback();
            return response()->json([
                'status'=>false,
                'msg'=>'审核失败'
            ]);
        }
    }

    //活动数据统计-每日统计
    public function dailyStatistics(){
        Artisan::call('Activity:DailyStatistics');
        return response()->json([
            'status'=>true,
            'msg'=>'统计成功'
        ]);
    }

    //每日数据统计-每日统计
    public function dataStatistics(){
        Artisan::call('StatisticsData:Daily');
        return response()->json([
            'status'=>true,
            'msg'=>'统计成功'
        ]);
    }
}
