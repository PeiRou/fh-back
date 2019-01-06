<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\UserBank;

class UserController extends Controller
{
    //

    public function bindBank(Request $request)
    {

        if($request->ajax()){
            $auth = auth()->user();
            try{
                UserBank::create([
                    'user_id'=>$auth['id'],
                    'bank_name'=>$request->input('bank_name'),
                    'subAddress'=>$request->input('subAddress'),
                    'cardNo'=>$request->input('cardNo'),
                ]);
                return response()->json(['code'=>1],200);
            }catch (\Exception $exception){
                writeLog('error', __CLASS__ . '->' . __FUNCTION__ . ' Line:' . $exception->getLine() . ' ' . $exception->getMessage());
                return response()->json(['code'=>-1],200);
            }
        }
    }

}
