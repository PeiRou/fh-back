<?php

namespace App\Http\Controllers\Obtain;

use Illuminate\Support\Facades\DB;

class OfferController extends BaseController
{
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
        if(!isset($aParam['order_id'], $aParam['money']))
            return $this->returnAction([
                'code' => 1,
                'msg' => $this->code[1],
            ]);
        $data = [
            'order_id' => addslashes($aParam['order_id']),
            'money' => (float)$aParam['money'],
            'status' => 0,
            'content' => addslashes($aParam['content'] ?? ''),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        if(DB::table('offer')->insert($data))
            return $this->returnAction([
                'code' => 0,
                'msg' => $this->code[0],
                'order_id' => $aParam['order_id'],
                'money' => (float)$aParam['money'],
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
        if (DB::table('offer')->where('order_id', $aParam['order_id'])->update(['status' => $aParam['status']]))
            return $this->returnAction([
                'code' => 0,
                'msg' => $this->code[0],
                'order_id' => $aParam['order_id'],
                'status' => $aParam['status']
            ]);
        return $this->returnAction([
            'code' => 5,
            'msg' => 'error',
        ]);
    }

}
