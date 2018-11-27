<?php

namespace App\Http\Controllers\Obtain;

use App\Permissions;
use App\Roles;
use App\SubAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Session;

class LoginController extends BaseController
{
    public function doAction(Request $request){
        $this->aParam = json_decode($this->rsaPublicDecrypt($request->post('data')),true);
        if(empty($this->aParam))
            abort(404);
        if($this->isVerifySignature())
            abort(419);
        $find = SubAccount::where('account',$this->aParam['platform_account'])->first();
        if(empty($find))
            abort(502);
//        if(!Hash::check($this->aParam['platform_password'],$find->password))
//            abort(504);

        $getRole = Roles::where('id',$find->role)->first();
        $getPermissionId = $getRole->permission_id;
        $explode = explode(',',$getPermissionId);
        $getAllAuth = [];
        foreach ($explode as $item)
        {
            $getPermissions_auth = Permissions::where('id',$item)->first();
            array_push($getAllAuth,$getPermissions_auth->auth);
        }
        $collection = collect($getAllAuth);
        $collectionAuth = $collection->implode(',');

        Session::put('isLogin',true);
        Session::put('account_id',$find->sa_id);
        Session::put('account',$find->account);
        Session::put('account_name',$find->name);
        Session::put('account_permission',$collectionAuth);

        //用户状态存入Redis
        $session_id = Session::getId();
        Session::put('account_session_id',$session_id);
        $key = 'sa:'.md5($find->sa_id);
        $redisData = [
            'session_id' => (string)Session::get('account_session_id'),
            'sa_id' => (string)$find->sa_id
        ];
        $jsonEncode = json_encode($redisData);
        Redis::select(4);
        Redis::setex($key,600,$jsonEncode);
        return redirect()->route('dash');
    }
}
