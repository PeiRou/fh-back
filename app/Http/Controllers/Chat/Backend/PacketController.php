<?php

namespace App\Http\Controllers\Chat\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Chat\Packet;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;
class PacketController extends Controller
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
                $rows     = $request->input('rows', 15);
                $itmes    = Packet::ofDate($request->input('date'))
                                    ->ofId($request->input('packet_id'))
                                    ->ofType($request->input('type'))
                                    ->ofStatus($request->input('status'))
                                    ->orderBy('id','DESC')
                                    ->paginate($rows);
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        if($request->ajax()){
            try{
                $_data = [
                    'type'          => $request->input('type'),
                    'money'         => $request->input('money'),
                    'sel_money'     => sprintf("%.2f",$request->input('money')),
                    'count'         => $request->input('count'),
                    'sel_count'     => 0,
                    'recharge'      => $request->input('recharge'),
                    'chip'          => $request->input('chip'),
                    'status'        => '疯抢中',
                    'created_hand'  => Auth::guard('chat')->user()['name'],
                ];
                $packet = Packet::create($_data);
                Redis::publish('chat-packet',
                    json_encode([
                            'data'  => $packet->id,
                            'date'  => date('H:i:s')
                        ])
                );
                return response()->json(array(
                    'status' => 0,
                    'message' => '发红包成功',
                ));
            }catch (\Exception $exception) {
                writeLog('error', __CLASS__ . '->' . __FUNCTION__ . ' Line:' . $exception->getLine() . ' ' . $exception->getMessage());
                return response()->json(array(
                    'status' => 1,
                    'message' => '发红包失败',
                ));
            }
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
                $packet         = Packet::find($id);
//                $packet->status = $request->input('status');
//                $packet->save();
                return response()->json(array(
                    'status' => 0,
                    'message' => '关闭红包成功',
                ));
            }catch (\Exception $exception) {
                writeLog('error', __CLASS__ . '->' . __FUNCTION__ . ' Line:' . $exception->getLine() . ' ' . $exception->getMessage());
                return response()->json(array(
                    'status' => 1,
                    'message' => '关闭红包失败',
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
    public  function disable(Request $request,$id){
        if($request->ajax()){
            try{
                $packet         = Packet::find($id);
                $packet->status = $request->input('status');
                $packet->save();
                return response()->json(array(
                    'status' => 0,
                    'message' => '关闭红包成功',
                ));
            }catch (\Exception $exception) {
                writeLog('error', __CLASS__ . '->' . __FUNCTION__ . ' Line:' . $exception->getLine() . ' ' . $exception->getMessage());
                return response()->json(array(
                    'status' => 1,
                    'message' => '关闭红包失败',
                ));
            }
        }
    }




    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
