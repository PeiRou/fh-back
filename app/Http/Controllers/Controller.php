<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function __get($value){
        if('permissionArray' == $value){
            $getAccountPermission = \Illuminate\Support\Facades\Session::get('account_permission');
            $this->permissionArray = explode(',',$getAccountPermission);
            return $this->permissionArray;
        }
    }
}
