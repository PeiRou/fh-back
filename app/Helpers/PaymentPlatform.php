<?php
/**
 * Created by PhpStorm.
 * User: vincent
 * Date: 2018/7/9
 * Time: 下午6:35
 */

namespace App\Helpers;

class PaymentPlatform
{
    public function getSign($data,$customKey){
        ksort($data);
        $signStr = '';
        foreach ($data as $k=>$v){
            $signStr .= $k.'='.$v.'&';
        }
        $signStr .= $customKey;
        $sign = md5($signStr);
        return $sign;
    }

    //
    public function postCurl($url,$aData){
        $curl = curl_init();  //初始化
        curl_setopt($curl,CURLOPT_URL,$url);  //设置url
        curl_setopt($curl,CURLOPT_HTTPAUTH,CURLAUTH_BASIC);  //设置http验证方法
        curl_setopt($curl,CURLOPT_HEADER,0);  //设置头信息
        curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);  //设置curl_exec获取的信息的返回方式
        curl_setopt($curl,CURLOPT_POST,1);  //设置发送方式为post请求
        curl_setopt($curl,CURLOPT_POSTFIELDS,$aData);  //设置post的数据

        $result = curl_exec($curl);
        curl_close($curl);
        if(empty($result))  return json_encode([
            'errorCode' => 0,
            'msg' => '接口访问失败'
        ]);
        return $result;
    }
}