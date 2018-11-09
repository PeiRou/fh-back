<?php
/**
 * Created by PhpStorm.
 * User: ashen
 * Date: 18-11-8
 * Time: 下午5:04
 */

namespace App\Helpers;

class Common{

    //写入日志
    function customWriteLog($directory,$msg){
        $path = storage_path().'/logs/'.$directory;
        if(!is_dir($path)){
            mkdir($path);
        }
        $path .= '/'.date('Y-m');
        if(!is_dir($path)){
            mkdir($path);
        }
        $path .= '/'.date('d').'.log';
        \Illuminate\Support\Facades\Log::useFiles($path);
        \Illuminate\Support\Facades\Log::info($msg);
    }
}