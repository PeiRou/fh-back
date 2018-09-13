<?php

namespace App;


class Swoole
{
    private $timeout = 30;
    public function swooletest($type,$room)
    {
        $param['type'] = $type;
        $param['room'] = $room;
        return $this->postSwoole($param);
    }
    private function postSwoole($param){
        $this->ch = curl_init();
        //设置post数据
        curl_setopt($this->ch,CURLOPT_URL,env('WS_CURL',"http://127.0.0.1")."/dows/?type=".$param['type']."&room=".$param['room']);
        curl_setopt($this->ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, false); // 跳过证书检查
        curl_setopt($this->ch,CURLOPT_HEADER,0);
        $output = curl_exec($this->ch);
        return $output;
    }
}
