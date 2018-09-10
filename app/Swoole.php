<?php

namespace App;


class Swoole
{
    public function swooletest($type,$room)
    {
        $param['type'] = $type;
        $param['room'] = $room;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, env('WS_CURL',"http://127.0.0.1").":".env('WS_PORT',9500));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        //设置post数据
        $post_data = $param;
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        curl_exec($ch);
        curl_close($ch);
    }
}
