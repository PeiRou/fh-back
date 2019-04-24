<?php

namespace App\Http\Controllers\Obtain;

use App\Feedback;
use App\FeedbackMessage;
use App\GamesList;

class GamesApiController extends BaseController
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

    private function GamesListSave($aParam)
    {
        if(!isset($aParam['list']))
            $this->returnAction([
                'code' => 1,
                'msg' => $this->code[1],
            ]);
        GamesList::where(function($sql){})->update(['weihu' => 0]);
        if(!GamesList::whereRaw('game_id in ('.$aParam['list'].')')->update(['weihu' => 1]))
            return $this->returnAction([
                'code' => 6,
                'msg' => '修改失败',
            ]);
        return $this->returnAction([
            'code' => 0,
            'msg' => $this->code[0],
        ]);
    }
}
