<?php

namespace App\Http\Controllers\Obtain;

class ReportController extends BaseController
{
    //执行方法
    public function doAction(){
        echo $this->returnAction([
            'code' => 0,
            'msg' => $this->code[0],
        ]);
    }

}
