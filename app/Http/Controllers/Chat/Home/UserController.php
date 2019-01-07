<?php

namespace App\Http\Controllers\Chat\Home;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller
{
    public function userNick(Request $request){

        if($request->ajax()){
            //判断是否已修改过昵称
            $user = User::find(auth()->user()['id']);
            if($user->isChangeName){
                return response()->json(['code'=>-1], 200);
            }
            try {
                $user->name = $request->get('nick');
                $user->isChangeName = 1;
                $user->save();
                return response()->json(['code'=>0], 200);
            }catch (\Exception $exception) {
                writeLog('error', __CLASS__ . '->' . __FUNCTION__ . ' Line:' . $exception->getLine() . ' ' . $exception->getMessage());
                return response()->json(array(
                    'status' => -1,
                    'message' => '修改昵称失败',
                ),200);
            }
        }
    }

    public function userAvatar(Request $request){
        if($request->file('avatar')){
            //判断是否已经修改过头像
            $user = User::find(auth()->user()['id']);
            if($user->isChangeAvatar){
                return response()->json(['code'=>-1], 200);
            }
            $file       = $request->file('avatar');//获取文件
            $extension  = $file->getClientOriginalExtension();
            $allowed_extensions = ['jpg','png','jpeg'];
            if ($extension && in_array($extension, $allowed_extensions)) {
                $fileName        = md5(str_random(10)).'.'.$extension;
                $destinationPath = 'chat'.DIRECTORY_SEPARATOR.'avatars';
                $file->move($destinationPath, $fileName);
                /**修改user表**/
                $user->chatAvatar = $fileName;
                $user->isChangeAvatar = 1;
                $user->save();
                return response()->json(['code'=>0,'userAvatar'=>$fileName],200);
            }else{
                return response()->json(['code'=>-1],200);
            }
        }
    }

}
