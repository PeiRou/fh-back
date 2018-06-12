<?php

namespace App\Http\Controllers\Chat\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Chat\Record;
use Illuminate\Support\Facades\Log;

class RecordController extends Controller
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
                $itmes    = Record::ofDate($request->input('date'))
                    ->ofPacketId($request->input('packet_id'))
                    ->ofOrder($request->input('order'))
                    ->ofUser($request->input('username'))
                    ->ofStatus($request->input('status'))
                    ->ofMinMoney($request->input('min_money'))
                    ->ofMaxMoney($request->input('max_money'))
                    ->orderBy('id','DESC')
                    ->paginate($rows);
                return response()->json(array(
                    'status' => 0,
                    'data' => $itmes,
                ));
            }catch (\Exception $exception) {
                Log::info(__CLASS__ . '->' . __FUNCTION__ . ' Line:' . $exception->getLine() . ' ' . $exception->getMessage());
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
        //
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




        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editAll(Request $request)
    {
        if($request->ajax()){


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
