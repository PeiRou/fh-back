<?php

namespace App\Http\Controllers\Obtain;

use App\Http\Controllers\Controller;
use App\Http\Services\CurlService;
use Illuminate\Support\Facades\Log;

class BaseController extends Controller
{

    //平台公钥
    private $publicKey;

    //平台秘钥
    private $platformKey;

    //处理后的接受参数
    protected $aParam;

    private $encryptedPublic = '';

    private $decryptedPublic = '';

    //code参数
    protected $code = [
        0 => 'OK',
        1 => '参数解析错误',
        2 => '签名错误',
        3 => '方法不存在',
        4 => '该订单不存在',
        5 => '订单修改失败',
    ];

    public function __construct()
    {
        $this->publicKey = $this->splicePublicKey();
        $this->platformKey = env('GENERAL_PLATFORM_KEY');
    }

    //接受主体
    public function callback($action){
        $this->aParam = json_decode($this->rsaPublicDecrypt(file_get_contents('php://input')),true);
        if(empty($this->aParam))
            echo $this->returnAction([
                'code' => 1,
                'msg' => $this->code[1],
            ]);
        if($this->isVerifySignature())
            echo $this->returnAction([
                'code' => 2,
                'msg' => $this->code[2],
            ]);
        unset($this->aParam['sign']);
        $actionName = '\App\\Http\\Controllers\\Obtain\\'.ucfirst($action).'Controller';
        if(!class_exists($actionName))
            echo $this->returnAction([
                'code' => 3,
                'msg' => $this->code[3],
            ]);
        $actionController = new $actionName();
        echo $actionController->doAction($this->aParam);
    }

    //验证签名
    public function isVerifySignature(){
        $sign = $this->aParam['sign'];
        unset($this->aParam['sign']);
        if($sign === $this->getSignature())
            return false;
        return true;
    }

    //获取签名
    public function getSignature(){
        return md5(strtoupper($this->conversionString().$this->platformKey));
    }

    //数组装换字符串
    public function conversionString(){
        ksort($this->aParam);
        $str = '';
        foreach ($this->aParam as $key => $value){
            $str .= $key.'='.$value.'|';
        }
        return rtrim($str,'|');
    }

    //回传方法
    public function returnAction($aParam){
        echo $this->rsaPublicEncrypt(json_encode($aParam));
        exit();
    }
    public function show($code = 0, $data = []){
        $data = [
            'code' => $code,
            'data' => $data,
            'msg' => $this->code[0],
        ];
        $this->returnAction($data);
    }

    //拼接公钥
    public function splicePublicKey($splitLength = 64){
        $publicKeyStr = env('GENERAL_PUBLIC_KEY');
        $public_key = "-----BEGIN PUBLIC KEY-----\r\n";
        foreach (str_split($publicKeyStr,$splitLength) as $str){
            $public_key .= $str . "\r\n";
        }
        $public_key .="-----END PUBLIC KEY-----";
        return $public_key;
    }

    //公钥加密
    function rsaPublicEncrypt($paramStr)
    {
        $encryptData = '';
        foreach (str_split($paramStr, 117) as $chunk){
            if (openssl_public_encrypt($chunk, $this->encryptedPublic, $this->publicKey)) {
                $encryptData .= $this->encryptedPublic;
            }
        }
        return base64_encode($encryptData);
    }

    //公钥解密
    function rsaPublicDecrypt($response)
    {
        $crypto = '';
        foreach (str_split(base64_decode($response), 128) as $chunk) {
            openssl_public_decrypt($chunk, $this->decryptedPublic, $this->publicKey);
            $crypto .= $this->decryptedPublic;
        }

        return $crypto;
    }

}
