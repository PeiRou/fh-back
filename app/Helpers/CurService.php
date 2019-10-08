<?php
/**
 * Created by PhpStorm.
 * User: ashen
 * Date: 19-3-9
 * Time: 下午9:09
 */

namespace App\Helpers;

class CurService
{


    public function curlGet($url,$timeout = 1){
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // 跳过证书检查
        curl_setopt($ch,CURLOPT_HEADER,0);
        curl_setopt($ch, CURLOPT_POST, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
        $output = curl_exec($ch);
        return $output;
        curl_close($ch);
    }

    public function get($str){
        $adderIps = explode(',',env('TASK_SEND_IP',''));
        if(empty($adderIps)) return true;
        foreach ($adderIps as $adderIp){
            \Log::channel('CurService')->info($adderIp.$str);
            $res = $this->curlGet($adderIp.$str);
        }
    }
}