<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/10 0010
 * Time: 11:13
 */

namespace App\Http\Services;


class CurlService
{
    private $ch;
    private $timeout = 30;
    private static $instance;
    public static function  getInstance(){
        if(empty(self::$instance)){
            self::$instance = new self();
        }
        return self::$instance;
    }
    public function __construct()
    {
        $this->ch = curl_init();
    }
    public function get($url){
        curl_setopt($this->ch,CURLOPT_URL,$url);
        curl_setopt($this->ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($this->ch,CURLOPT_HEADER,0);
        $output = curl_exec($this->ch);
        return $output;
        echo 'asd';
        $this->close();
    }
    public function get_https($url){
        curl_setopt($this->ch,CURLOPT_URL,$url);
        curl_setopt($this->ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, false); // 跳过证书检查
        curl_setopt($this->ch,CURLOPT_HEADER,0);
        $output = curl_exec($this->ch);
        return $output;
        $this->close();
    }
    public function post($url,$data=[]){
        curl_setopt($this->ch,CURLOPT_URL,$url);
//        curl_setopt($this->ch, CURLOPT_HTTPHEADER  , ["Content-Type:text/html;charset=UTF-8"]);
        curl_setopt($this->ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($this->ch,CURLOPT_POST,1);
        curl_setopt($this->ch,CURLOPT_POSTFIELDS,$data);
        curl_setopt($this->ch, CURLOPT_TIMEOUT, $this->timeout);
        $output = curl_exec($this->ch);
        return $output;
        $this->close();
    }
    public  function  post_https_query($url,$data=[]){
        curl_setopt($this->ch,CURLOPT_URL,$url);
        curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($this->ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($this->ch, CURLOPT_POST, true);
        curl_setopt($this->ch, CURLOPT_HEADER, false);
        curl_setopt($this->ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($this->ch);
        return $output;
        $this->close();
    }
    public function post_https($url,$data=[]){
        curl_setopt($this->ch,CURLOPT_URL,$url);
        curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, false); // 跳过证书检查
        curl_setopt($this->ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($this->ch,CURLOPT_POST,1);
        curl_setopt($this->ch,CURLOPT_POSTFIELDS,$data);
        curl_setopt($this->ch, CURLOPT_TIMEOUT, $this->timeout);
        $output = curl_exec($this->ch);
        return $output;
        $this->close();
    }
    private function close(){
        curl_close($this->ch);
    }
}