<?php

namespace App\Http\Controllers\Back;

use App\Notices;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class SrcNoticeController extends Controller
{
    //添加公告
    public function addNotice(Request $request)
    {
        $levels = $request->input('level_id');
        if($levels !== null){
            $new_levels = implode(',',$levels);
        } else {
            $new_levels = null;
        }
        $title = $request->input('title');
        $content = $request->input('content');
        $type = $request->input('type');

        $notice = new Notices();
        $notice->title = $title;
        $notice->content = $content;
        $notice->type = $type;
        $notice->userLevel = $new_levels;
        $save = $notice->save();
        if($save == 1){
            $this->writeToFile();
            return response()->json([
                'status'=>true,
                'msg'=>"添加成功！"
            ]);
        } else {
            return response()->json([
                'status'=>false,
                'msg'=>'暂时无法添加，请稍后重试'
            ]);
        }
    }

    //删除公告
    public function delNoticeSetting(Request $request)
    {
        $id =  $request->get('id');
        $del = Notices::where('id',$id)->delete();
        if($del == 1){
            $this->writeToFile();
            return response()->json([
                'status'=>true,
            ]);
        } else {
            return response()->json([
                'status'=>false,
                'msg'=>'暂时无法删除，请稍后重试'
            ]);
        }
    }

    function writeToFile(){
        $notice1 = Notices::select('id','type','content as message','title','updated_at as updateTime','created_at as addTime','userLevel as rechLevels')->where('type',1)->get();
        $notice2 = Notices::select('id','type','content as message','title','updated_at as updateTime','created_at as addTime','userLevel as rechLevels')->where('type',2)->get();
        $notice3 = Notices::select('id','type','content as message','title','updated_at as updateTime','created_at as addTime','userLevel as rechLevels')->where('type',3)->get();
        $notice4 = Notices::select('id','type','content as message','title','updated_at as updateTime','created_at as addTime','userLevel as rechLevels')->where('type',4)->get();
        $notice5 = Notices::select('id','type','content as message','title','updated_at as updateTime','created_at as addTime','userLevel as rechLevels')->where('type',5)->get();
        $data = 'var MESSAGES = {"type_4":'.$notice4.',"type_3":'.$notice3.',"type_2":'.$notice2.',"type_1":'.$notice1.',"type_0":[],"type_5":'.$notice5.'};';
        $write = Storage::disk('static')->put('messages.js',$data);
    }
}
