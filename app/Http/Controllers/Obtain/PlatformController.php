<?php

namespace App\Http\Controllers\Obtain;

use Illuminate\Support\Facades\DB;

class PlatformController extends BaseController
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

   public function switchPlatform ($aParam)
   {
       if(!isset($aParam['status']))
           return $this->returnAction([
               'code' => 1,
               'msg' => $this->code[1],
           ]);
       $res = DB::table('system_setting')->where('id', 1)->update([
           'back_switch' => $aParam['status']
       ]);
       if($aParam['status'] == 0) //如果是关闭后台 将admin以外的所有用户踢下线
           \App\Repository\BackActionRepository::clearAccount();
       return $this->returnAction([
           'code' => 0,
           'msg' => $res ? $this->code[0] : '成功，状态没有改变',
       ]);
   }

}
