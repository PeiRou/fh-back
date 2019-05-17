<?php

namespace App\Http\Controllers\Obtain;



use App\Http\Services\CurlService;

class SendController extends BaseController
{
    function __construct($aParam)
    {
        parent::__construct();
        $this->aParam = $aParam;
        $this->aParam['sign'] = $this->getSignature();
    }

    //发送post参数
    public function sendParameter($url){
        $paramStr = json_encode($this->aParam);
        $aArray = [
            'platform_id' => $this->aParam['platform_id'],
            'data' => $this->rsaPublicEncrypt($paramStr)
        ];
        $result = CurlService::getInstance()->post(env('GENERAL_INTERFACE_URL').'/'.$url,
            $aArray);
        return json_decode($result,true);
    }

    public function sendPlatformOffer($url)
    {
        $paramStr = json_encode($this->aParam);
        $aArray = [
            'platform_id' => $this->aParam['platform_id'],
            'data' => $this->rsaPublicEncrypt($paramStr)
        ];
        $result = CurlService::getInstance()->post(env('GENERAL_INTERFACE_URL').'/'.$url,
            $aArray);
        return json_decode($result,true) ?? $result;
    }


}
