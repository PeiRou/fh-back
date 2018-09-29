<?php

namespace App;

use App\Helpers\RouteConfig;
use App\Http\Proxy\SettleMssc;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

class LogAbnormal extends Model
{
    protected $table = 'log_abnormal';
    protected $primaryKey = 'id';

    public static function addExceptionRecord($request,$e){
        $routeData = LogHandle::getTypeAction(Route::currentRouteName());
        $account = empty(Session::get('account')) ? null : Session::get('account');
        if($account !== 'admin') {
            $data = [
                'user_id' => empty(Session::get('account_id')) ? null : Session::get('account_id'),
                'username' => $account,
                'name' => empty(Session::get('account_name')) ? null : Session::get('account_name'),
                'ip' => $request->ip(),
                'type_id' => $routeData['type_id'],
                'type_name' => $routeData['type_name'],
                'route' => $routeData['route'],
                'action' => $routeData['action'],
                'param' => json_encode($request->all()),
                'content' => $e->getMessage()
            ];
            self::insert($data);
        }
    }
}
