<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 2018/8/19
 * Time: 23:35
 */

namespace App\Http\Services;

class CryptService
{

    private static $instance;

    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function decrypt( $data , $key )
    {
        $key = md5($key);
        $x = 0;
        $data = base64_decode($data);
        $len = strlen($data);
        $l = strlen($key);
        $char = $str = '';
        for ($i = 0; $i < $len; $i++) {
            if ($x == $l) {
                $x = 0;
            }
            $char .= substr($key , $x , 1);
            $x++;
        }
        for ($i = 0; $i < $len; $i++) {
            if (ord(substr($data , $i , 1)) < ord(substr($char , $i , 1))) {
                $str .= chr((ord(substr($data , $i , 1)) + 256) - ord(substr($char , $i , 1)));
            } else {
                $str .= chr(ord(substr($data , $i , 1)) - ord(substr($char , $i , 1)));
            }
        }
        $data_str_s = explode('&',$str);
        $res = [];
        foreach ($data_str_s as $key => $val){
            $val = explode('=',$val);
            $res[$val[0]] = $val[1];
        }
        return $res;
    }

    public function __clone()
    {

    }
}
