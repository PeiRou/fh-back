<?php

namespace App\Http\Controllers\Obtain;

use Illuminate\Support\Facades\DB;

class OfferController extends BaseController
{
    public $table = 'offer';

    //执行方法
    public function doAction ($aParam)
    {
        $action = $aParam['action'] ?? '';
        if(method_exists($this, $action)){
            return call_user_func([$this, $action], $aParam);
        }
        return $this->returnAction([
            'code' => 1,
            'msg' => $this->code[1],
        ]);
    }

    //新增一条报价
    public function add ($aParam)
    {
        if(!isset($aParam['order_id']))
            return $this->returnAction([
                'code' => 1,
                'msg' => $this->code[1],
            ]);
        $data = [
            'order_id' => addslashes($aParam['order_id']),
            'money' => (float)$aParam['money'],
            'status' => 0,
            'type' => (int)$aParam['type'],
            'typestr' => addslashes($aParam['typestr']),
            'content' => addslashes($aParam['content'] ?? ''),
            'created_at' => date('Y-m-d H:i:s', strtotime($aParam['created_at'])),
            'updated_at' => date('Y-m-d H:i:s', strtotime($aParam['updated_at'])),
            'overstayed' => date('Y-m-d H:i:s', strtotime($aParam['overstayed'])),
        ];
        if(DB::table($this->table)->where('order_id', $data['order_id'])->count()) {
            DB::table($this->table)->where('order_id', $data['order_id'])->update($data);
            return $this->returnAction([
                'code' => 0,
                'msg' => $this->code[0],
                'order_id' => $aParam['order_id'],
            ]);
        }
        if(DB::table($this->table)->insert($data))
            return $this->returnAction([
                'code' => 0,
                'msg' => $this->code[0],
                'order_id' => $aParam['order_id'],
            ]);
        return $this->returnAction([
            'code' => 5,
            'msg' => 'error',
        ]);
    }

    //报价审核
    public function upstatus ($aParam)
    {
        if(!isset($aParam['order_id'], $aParam['status']))
            return $this->returnAction([
                'code' => 1,
                'msg' => $this->code[1],
            ]);
        $res = DB::table($this->table)->where('order_id', $aParam['order_id'])->update(['status' => $aParam['status']]);
        return $this->returnAction([
            'code' => 0,
            'msg' => $res ? $this->code[0] : '成功，状态没有改变',
            'order_id' => $aParam['order_id'],
        ]);
    }

}
