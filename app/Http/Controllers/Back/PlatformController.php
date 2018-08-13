<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class PlatformController extends Controller
{
    //平台费用结算-手动结算
    public function addPlatformSettlement(Request $request){
        Artisan::call('PlatformSettle:Settlement');
        return response()->json([
            'status'=>true,
            'msg'=>'结算成功'
        ]);
    }

}
