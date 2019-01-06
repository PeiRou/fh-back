<?php

namespace App\Http\Controllers\Chat\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Chat\Room;
use Illuminate\Support\Facades\Log;

class RoomController extends Controller
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
                $itmes    = Room::orderBy('id','DESC')->paginate($rows);
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
                    'name'      => $request->input('name'),
                    'type'      => '平台聊天室',
                    'is_disable'=> 'true',
                    'recharge'  => $request->input('recharge'),
                    'chip'      => $request->input('chip'),
                ];
                Room::create($_data);
                return response()->json(array(
                    'status' => 0,
                    'message' => '添加成功',
                ));
            }catch (\Exception $exception) {
                writeLog('error', __CLASS__ . '->' . __FUNCTION__ . ' Line:' . $exception->getLine() . ' ' . $exception->getMessage());
                return response()->json(array(
                    'status' => 1,
                    'message' => '添加失败',
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
                $room = Room::find($request->input('id'));
                $room->name     = $request->input('name');
                $room->recharge = $request->input('recharge');
                $room->chip     = $request->input('chip');
                $room->save();
                return response()->json(array(
                    'status' => 0,
                    'message' => '修改成功',
                ));
            }catch (\Exception $exception) {
                writeLog('error', __CLASS__ . '->' . __FUNCTION__ . ' Line:' . $exception->getLine() . ' ' . $exception->getMessage());
                return response()->json(array(
                    'status' => 1,
                    'message' => '修改失败',
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
    public function disable(Request $request, $id){
        if($request->ajax()){
            try{
                $room = Room::find($id);
                $room->is_disable     = 'false';
                $room->save();
                return response()->json(array(
                    'status' => 0,
                    'message' => '禁言成功',
                ));
            }catch (\Exception $exception) {
                writeLog('error', __CLASS__ . '->' . __FUNCTION__ . ' Line:' . $exception->getLine() . ' ' . $exception->getMessage());
                return response()->json(array(
                    'status' => 1,
                    'message' => '禁言失败',
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
    public function destroy(Request $request,$id)
    {
        if($request->ajax()){
            try {
                Room::destroy($request->input('id'));
                return response()->json(array(
                    'status' => 0,
                    'message' => '删除成功',
                ));
            }catch (\Exception $exception) {
                writeLog('error', __CLASS__ . '->' . __FUNCTION__ . ' Line:' . $exception->getLine() . ' ' . $exception->getMessage());
                return response()->json(array(
                    'status' => 1,
                    'message' => '删除失败',
                ));
            }
        }
    }

}
