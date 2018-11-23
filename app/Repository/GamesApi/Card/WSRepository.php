<?php
/* 无双棋牌 */

namespace App\Repository\GamesApi\Card;

use Illuminate\Support\Facades\Storage;

class WSRepository extends BaseRepository
{
    public $product_type = 2;//LOTTO 彩票, RNG 电子, PVP 棋牌,FISH 捕鱼
    public function __construct($config){
        parent::__construct($config, 'WS');
    }
    public function getBet(){
        $res = $this->Utils->getBetList($this->param['time'], $this->param['page'] ?? 1);
        if($res['status'] == 0){
            return $this->show(0, '', $res);
        }
        return $this->show($res['status'] ?? 102,  $this->errorMessage($res['status'] ?? -1) ?? '请求超时');
    }



    protected function errorMessage($code){
        $code = (int)$code;
        $data = [
            0 => '成功',
            1 => '未知的系统错误，请联系客服',
            2 => '缺少必需的参数',
            3 => '此产品类型不支持此方法',
            4 => '商家不允许使用此产品类型',
            5 => '找不到商家',
            6 => '参数无效，无法解密参数。',
            7 => '签名无效',
            8 => '不支持的货币',
            9 => '帐户类型无效',
            10 => '产品类型无效',
            11 => '提现余额不足',
            12 => '交易序号已經存在',
            14 => '游戏代码无效',
            15 => '用户不存在',
            16 => '信用额度不足',
            18 => '此游戏代码不支持试用模式',
            19 => '批次理未准备好',
            21=> '找不到方法',
            22=> '参数验证失败',
            23=> 'API 繁忙',
            500=> '请求超时',//自己加的
        ];
        if(isset($data[$code])){
            return $data[$code];
        }
        return '';
    }

}