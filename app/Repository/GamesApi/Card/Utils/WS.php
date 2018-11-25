<?php
/**
 * <code>lt_common.php</code>
 * TC-Gaming Sample Code 天成游戏范例代码
 *  
 * @author PHOENIX WU
 * @Date 2017/06/19
 * @Version 1.0.1
 * @Desc 首先很感谢大家参考我的第一次写的 PHP 代码, 如果有需要改进的地方请多多指教, 欢迎来信 phoenix.w@tc-gaming.com
 *       您的指导与批判是我们成长的动力来源, 小编我是 Java 工程师, 这是我的第一次 PHP 开发
  */
namespace App\Repository\GamesApi\Card\Utils;
class WS {
	/**
	 * 共用参数区
	 */
    function __construct($config){
        $this->url = $config['url'];					//API 连接
        $this->merchant_code = $config['merchant_code'];//代理商号
        $this->desKey = $config['desKey'];				//加密金钥
        $this->signKey = $config['signKey'];		    //加密签名档
        $this->currency = $config['currency'] ?? 'CNY';
//        $this->url = 'http://www.tcgdemo.com/index.html';//API 连接
//        $this->merchant_code = '请参考上线文档';		//代理商号
//        $this->desKey = '请参考上线文档';				//加密金钥
//        $this->signKey = '请参考上线文档';				//加密签名档
//        $this->currency = 'CNY'; 						//币别
    }
	
    /**
     * 2.1. CREATE/REGISTER PLAYER API 创建/确认玩家接口
     * @param $username 会员名称
     * @param $password 会员密码
     * @return array|SimpleXMLElement
     */
    public function create_user($username, $password ){
        $registerParams = array('username' => $username, 'currency' => $this->currency, 'method' => 'cm', 'password' => $password);
		//print_r($getBalanceParams);
        $result = $this->send_require($registerParams);
        return $result;
    }
	
	/**
	 * 2.2. UPDATE PASSWORD API 更新密码接口
	 * @param $username 会员名称
	 * @param $password 会员密码
     * @return array|SimpleXMLElement
     */
	public function update_password($username,$password){
		$registerParams = array('username' => $username, 'currency' => $this->currency, 'method' => 'up', 'password' => $password);
		//print_r($getBalanceParams);
        $result = $this->send_require($registerParams);
        return $result;
	}
	
    /**
     * 2.3. GET BALANCE API 获取余额接口
     * @param $username  		会员名称
	 * @param $product_type   	产品代码
     * @return array|SimpleXMLElement
     */
    public function get_balance($username,$product_type){
        $getBalanceParams = array('username' => $username, 'method' => 'gb' , 'product_type' => $product_type);
		//print_r($getBalanceParams);
        $result = $this->send_require($getBalanceParams);
        return $result;
    }

    /**
     * 2.4. FUND TRANSFER API 资金转账接口
     * @param $username			会员名称
	 * @param $product_type   	产品代码
     * @param int $fund_type  	值1=转入到  值2=转出
     * @param $amount			金额
     * @param $reference_no		交易代码
     * @return array|SimpleXMLElement
     */
    public function user_transfer($username, $product_type, $fund_type, $amount, $reference_no){
        $getBalanceParams = array('username' => $username, 'method' => 'ft' , 'product_type' => $product_type,'fund_type' => $fund_type,'amount' => $amount,'reference_no' => $reference_no);
		//print_r($getBalanceParams);
        $result = $this->send_require($getBalanceParams);
        return $result;
    }

    /**
     * 2.5. CHECK TRANSACTION STATUS API 检查交易状态接口
     * @param $product_type	产品代码
     * @param $reference_no	交易代码
     * @return array|SimpleXMLElement
     */
    public function check_transfer($product_type, $reference_no){
        $getBalanceParams = array('method' => 'cs' , 'product_type' => $product_type, 'ref_no' => $reference_no);
		//print_r($getBalanceParams);
        $result = $this->send_require($getBalanceParams);
        return $result;
    }

    /**
	 * 2.6. LAUNCH GAME API 启动游戏接口 -电子游戏
     * @param $username 会员名称
     * @param $gameMode 值1=正式 值0=测试
     * @param $gameCode 游戏编码
     * @return string
     */
    public function getLaunchGameRng($username, $game_mode, $game_code){
        $product_type = 2;
		/** RNG GAME 电子游戏 **/
		$getBalanceParams = array('username' => $username, 'method' => 'lg' , 'product_type' => $product_type,'game_mode' => $game_mode,'game_code' => $game_code);
		//print_r($getBalanceParams);
		$result = $this->send_require($getBalanceParams);
        return $result;
    }
	
	/**
	 * 2.6. LAUNCH GAME API 启动游戏接口 - 彩票游戏
     * @param $username 	会员名称
	 * @param $product_type 彩票代码为 2 
     * @param $game_mode 	值1=正式 值0=测试
     * @param $game_code 	游戏编码
	 * @param $platform 	平台 flash，html5
	 * @param $view 		平台 
     * @return string
     */
	public function getLaunchGameLottery($username, $product_type, $game_mode, $game_code, $platform, $view){
		/** Lottery GAME 彩票游戏 **/
		// 模式 目前只能使用 Traditional 传统及 Traditional_Mobile 传统_移动两种模式
		$lottery_bet_mode = 'Traditional'; 
		$series = array();
		$series[] = array('game_group_code'=>'SSC','prize_mode_id'=>1,'max_series'=>1956,'min_series'=>1700,'max_bet_series'=>1950,'default_series'=>1800);
		$getBalanceParams = array('username'=>$username, 'method'=>'lg', 'product_type'=> $product_type, 'game_code'=>$game_code, 'game_mode'=>$game_mode, 'platform'=>$platform, 'lottery_bet_mode'=>$lottery_bet_mode, 'view'=>$view, 'series'=>$series);
		//print_r($getBalanceParams);
		$result = $this->send_require($getBalanceParams);
        return $result;
    }
    /**
     * 获取棋牌投注详情
     */
    public function getBetList($time, $page = 1){
        $param = [
            'method' => 'pvpbd',
            'batch_name' => $time,
            'page' => $page
        ];
        return $this->send_require($param);
    }
	/**
	 * 2.7. GAME LIST API 游戏列表接口
     * @param $product_type 产品代码
     * @param $platform 	平台 - flash or html5 or all
     * @param $client_type 	终端设备 - pc:电脑客户端, phone:手机客户端, web:网页浏览器, html5:手机浏览器
	 * @param $game_type 	游戏类型 - RNG, LIVE, PVP
	 * @param $page 		第几页 - 如果没有值默认为 page = 1
	 * @param $page_size 	每页显示几笔
     * @return string
     */
	public function getGameList($product_type, $platform, $client_type, $game_type, $page, $page_size){
		$getBalanceParams = array('method'=>'tgl', 'product_type'=>$product_type, 'platform'=>$platform, 'client_type'=>$client_type, 'game_type'=>$game_type, 'page'=>$page, 'page_size'=>$page_size);
		//print_r($getBalanceParams);
		$result = $this->send_require($getBalanceParams);
        return $result;
	}
	
	/**
	 * 2.8. Player Game Rank API 玩家游戏排名接口
	 * @param $product_type 	产品代码
	 * @param $game_category 	RNG，LIVE 这是必需的，仅在产品类型不是 1 和 2 和 5 时使用
	 * @param $game_code 		T2KSSC、SD11X5、P00001
	 * @param $start_date 		开始日期 2016-01-01 00:00:00
	 * @param $end_date 		结束日期 2016-01-01 00:00:00
	 * @param $count 			最大行数
	 *
	 */
	public function getGameRank($product_type, $game_category, $game_code, $start_date, $end_date, $count){
		$getBalanceParams = array('method'=>'pgr', 'product_type'=>$product_type, 'game_category'=>$game_category, 'game_code'=>$game_code, 'start_date'=>$start_date, 'end_date'=>$end_date, 'count'=>$count);
		$result = $this->send_require($getBalanceParams);
        return $result;
	} 

	/**
	 * 3.1. GET RNG BET DETAILS 获得电子游戏及真人投注详情接口
	 * @param $batch_name 	批次号
	 * @param $page 		第几页
	 */
    public function get_bet_details($batch_name, $page){
        $time_str = $stime;
        $getBalanceParams = array('method'=>'bd', 'batch_name'=>$batch_name, 'page'=>$page);
        $result = $this->send_require($getBalanceParams);
        return $result;
    }
	
	/**
	 * 3.2. GET RNG BET DETAILS BY MEMBER 获得玩家电子游戏及真人投注详情接口
	 * @param $username		会员名称	
	 * @param $start_date 	开始时间	
	 * @param $end_date 	结束时间
	 */
	public function get_bet_details_member($username, $start_date, $end_date, $page){
        $getBalanceParams = array('username'=>$username, 'method'=>'bdm', 'start_date'=>$start_date, 'end_date'=>$end_date, 'page'=>$page);
        $result = $this->send_require($getBalanceParams);
        return $result;
    }
	
	/**
	 * 4.1. GET LOTTO TRANSACTIONS BY MEMBER 取得会员的实时彩票交易记录
	 * @param $username		会员名称	
	 * @param $start_date 	开始时间	
	 * @param $end_date 	结束时间
	 */
	public function getLottoTxByMember($username, $start_date, $end_date, $page){
        $getBalanceParams = array('username'=>$username, 'method'=>'lmb', 'start_date'=>$start_date, 'end_date'=>$end_date, 'page'=>$page);
        $result = $this->send_require($getBalanceParams);
        return $result;
	}
	
	/**
	 * 基本上都是大同小异的写法, 如有任何问题请洽 TCG技术群 .... 抱歉小编懒的写了！
	 */
    public function get_lottoCode(){
        $getBalanceParams = array('method' => 'glgl');
        $result = $this->send_require($getBalanceParams);
        return $result;
    }
	
    /**
     * 公用发送请求
     * @param $sendParams
     * @return string
     */
    public function send_require($sendParams){
        \Log::info('无双'.json_encode($sendParams));
        $params =  $this->encryptText(json_encode($sendParams),$this->desKey);
        $sign = hash('sha256', $params . $this->signKey);
        $data = array('merchant_code' => $this->merchant_code, 'params' => $params , 'sign' => $sign);
        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($data)
            )
        );
        $context  = stream_context_create($options);
        $result = @file_get_contents($this->url, false, $context);
        \Log::info('无双'.$result);
        if(empty($result)){
            return [
                'status' => 500,
                'msg' => '请求超时'
            ];
        }
        $result = json_decode($result, true);
        return $result;
    }
	
    /**
     * 组建en json参数数组
     * @param $plainText
     * @param $key
     * @return string
     */
    function encryptText($plainText, $key) {
//        $key = 'RKnREuNE';
//        $plainText = '{"method":"cm","username":"phoenixTest","password":"1111qqqq","currency":"CNY"}';
        $padded = $this->pkcs5_pad($plainText,8);
//        $encText = mcrypt_encrypt("des",$key, $padded, "ecb");
        $options = OPENSSL_RAW_DATA | OPENSSL_NO_PADDING;
        $encText = openssl_encrypt($padded, 'DES-ECB', $key, $options);

        return base64_encode($encText);
    }

    /**
     * 组建dec json参数数组
     * @param $plainText
     * @param $key
     * @return string
     */
    function decryptText($encryptText, $key) {
        $cipherText = base64_decode($encryptText);
        $res = mcrypt_decrypt("des", $key, $cipherText, "ecb");
        $resUnpadded = $this->pkcs5_unpad($res);
        return $resUnpadded;
    }

    function pkcs5_pad ($text, $blocksize)
    {
        $pad = $blocksize - (strlen($text) % $blocksize);
        return $text . str_repeat(chr($pad), $pad);
    }

    function pkcs5_unpad($text)
    {
        $pad = ord($text{strlen($text)-1});
        if ($pad > strlen($text)) return false;
        if (strspn($text, chr($pad), strlen($text) - $pad) != $pad) return false;
        return substr($text, 0, -1 * $pad);
    }
}