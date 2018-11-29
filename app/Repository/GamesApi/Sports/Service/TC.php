<?php
/**/

namespace App\Repository\GamesApi\Sports\Service;

use App\Http\Services\CurlService;

class TC
{
    private $Config;
    public function __construct($Config)
    {
        $this->Config = $Config;
    }

    //获取体彩指数
    public function send_TCZS(){
        $url = 'open.sportnanoapi.com/api/sports/jc/odds';
        $param = [
            'user' => $this->Config['name'] ?? '',
            'secret' => $this->Config['secret'] ?? ''
        ];
        $url .= http_build_query($param);
        $res = CurlService::getInstance()->get($url);
        return $res;
    }


    
}