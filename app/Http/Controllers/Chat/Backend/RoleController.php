<?php

namespace App\Http\Controllers\Chat\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Chat\Role;
use Illuminate\Support\Facades\Log;

class RoleController extends Controller
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
                $itmes    = Role::orderBy('id','DESC')->paginate($rows);
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
                    'name'          => $request->input('name'),
                    'type'          => $request->input('type'),
                    'level'         => $request->input('level'),
                    'bg_color1'     => $request->input('bg_color1'),
                    'bg_color2'     => $request->input('bg_color2'),
                    'font_color'    => $request->input('font_color'),
                    'length'        => $request->input('length'),
                    'permission'    => implode(',',$request->input('permission')),
                    'description'   => $request->input('description'),
                ];
                Role::create($_data);
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
                $role = Role::find($request->input('id'));
                $role->name             = $request->input('name');
                $role->type             = $request->input('type');
                $role->level            = $request->input('level');
                $role->bg_color1        = $request->input('bg_color1');
                $role->bg_color2        = $request->input('bg_color2');
                $role->font_color       = $request->input('font_color');
                $role->length           = $request->input('length');
                $role->permission       = implode(',',$request->input('permission'));
                $role->description      = $request->input('description');
                $role->save();
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        if($request->ajax()){
            try {
                Role::destroy($request->input('id'));
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
