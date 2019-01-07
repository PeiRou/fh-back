<?php

namespace App\Http\Controllers\Chat\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use App\Models\Chat\Platcfg;
use Illuminate\Support\Facades\Cache;

class PlatcfgController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            try{
                $itmes = Platcfg::first();
                return response()->json(array(
                    'status' => 0,
                    'data' => $itmes,
                ));
            }catch (\Exception $exception) {
                writeLog('error', __CLASS__ . '->' . __FUNCTION__ . ' Line:' . $exception->getLine() . ' ' . $exception->getMessage());
                return response()->json(array(
                    'status' => 1,
                    'message' => '数据获取失败',
                ));
            }
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($request->ajax()){
            try{
                $platcfg                    = Platcfg::find($request->input('id'));
                $platcfg->is_open           = $request->input('is_open');
                $platcfg->is_auto           = $request->input('is_auto');
                $platcfg->start_time        = $request->input('start_time');
                $platcfg->end_time          = $request->input('end_time');
                $platcfg->min_money         = $request->input('min_money');
                $platcfg->schedule_games    = implode(',',array_filter($request->input('schedule_games')));
                $platcfg->schedule_msg      = $request->input('schedule_msg');
                $platcfg->schedule_type     = $request->input('schedule_type');
                $platcfg->save();
                Cache::forever('platcfg',$platcfg);
                return response()->json(array(
                    'status' => 0,
                    'message' => '保存成功',
                ));
            }catch (\Exception $exception) {
                writeLog('error', __CLASS__ . '->' . __FUNCTION__ . ' Line:' . $exception->getLine() . ' ' . $exception->getMessage());
                return response()->json(array(
                    'status' => 1,
                    'message' => '保存失败',
                ));
            }
        }
    }
}
