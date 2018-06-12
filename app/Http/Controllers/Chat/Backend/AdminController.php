<?php

namespace App\Http\Controllers\Chat\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Chat\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
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
                $admins   = User::orderBy('id','DESC')->paginate($rows);
                return response()->json(array(
                    'status' => 0,
                    'data' => $admins,
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
        if($request->ajax()){
            try{
                $_data = [
                    'name'      =>$request->input('name'),
                    'nickname'  =>$request->input('nickname'),
                    'password'  => Hash::make($request->input('password'))
                ];
                User::create($_data);
                return response()->json(array(
                    'status' => 0,
                    'message' => '添加成功',
                ));
            }catch (\Exception $exception) {
                Log::info(__CLASS__ . '->' . __FUNCTION__ . ' Line:' . $exception->getLine() . ' ' . $exception->getMessage());
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
                $user       = User::find($request->input('id'));
                $user->name = $request->input('name');
                $user->nickname = $request->input('nickname');
                if($request->input('password')!=''){
                    $user->password = Hash::make($request->input('password'));
                }
               $user->save();
                return response()->json(array(
                    'status' => 0,
                    'message' => '修改成功',
                ));
            }catch (\Exception $exception) {
                Log::info(__CLASS__ . '->' . __FUNCTION__ . ' Line:' . $exception->getLine() . ' ' . $exception->getMessage());
                return response()->json(array(
                    'status' => 1,
                    'message' => '修改失败',
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
    public function destroy(Request $request)
    {
        if($request->ajax()){
            try {
                User::destroy($request->input('id'));
                return response()->json(array(
                    'status' => 0,
                    'message' => '删除成功',
                ));
            }catch (\Exception $exception) {
                Log::info(__CLASS__ . '->' . __FUNCTION__ . ' Line:' . $exception->getLine() . ' ' . $exception->getMessage());
                return response()->json(array(
                    'status' => 1,
                    'message' => '删除失败',
                ));
            }
        }
    }
}
