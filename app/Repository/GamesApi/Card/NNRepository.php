<?php
/* NN棋牌 */

namespace App\Repository\GamesApi\Card;


use Illuminate\Support\Facades\Redis;

class NNRepository extends BaseRepository
{
    public function __construct($config){
        parent::__construct($config,'Utils');
    }

    public function hook($f, ...$args)
    {
        try{
            return call_user_func([$this, $f], ...$args);
        }catch (\Throwable $e){
            if(!$e->getCode())
                throw  $e;
            return $this->show($e->getCode(), $e->getMessage());
        }
    }

    public function getBet1()
    {
        $param = [
            'data' => [
                "agentId" => $this->getConfig('agentId'),
                "index" => 'index',
                "token" => $this->getToken(),
            ],
        ];
        $param['sign'] = $this->sign($param);
        $res = $this->request('/api/game/getRecord', $param);
        $code = $res['code'] == 0 ? 1 : $res['code'];
        if($res['code'] === 200){
            $this->createData($res['data']['list']);
            $code = 0;
        }
        $this->insertError($code, $this->code($res['code']) ?? $res['msg']);
        return $this->show($code, $this->code($res['code']) ?? $res['msg']);
    }

    public function getBet()
    {
        return $this->hook('getBet1');
    }

    public function createData($aData)
    {
        $GameIDs = $this->distinct($aData, 'id');
        $insert = [];
        foreach ($aData as $v){
            if(isset($v['is_try']) && $v['is_try'] == 1){
                continue;
            }
            !isset($v['userName']) && $v['userName'] = '';
            if(!preg_match("/^".$this->getVal('agent')."/", $v['userName']))
                continue;
            if(in_array($v['id'], $GameIDs))
                continue;
            $array = [
                'g_id' => $this->gameInfo->g_id,
                'GameID' => $v['id'],
                'sessionId' => $v['gameNo'] ?? '',
                'username' => str_replace($this->getConfig('agent'),'', $v['userName']),
                'AllBet' => $v['initBet'],
                'bunko' => $v['winLost'],
                'bet_money' => $v['initBet'],
                'GameStartTime' => $v['startTime'],
                'GameEndTime' =>  $v['endTime'],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => $v['endTime'],
                'gameCategory' => 'PVP',
                'bet_info' => $v['showId'],
                'game_type' => $v['roomName'] ?? '',
                'service_money' => $v['fee'] ?? 0,
                'flag' => 1,
                'game_id' => 10,
                'round_id' => $v['gameNo'] ?? '',  //局号
            ];
            $array['content'] = $this->content($v) ?: $array['game_type'];
            $user = $this->getUser($array['username']);
            $array['agent'] = $user->agent ?? 0;
            $array['user_id'] = $user->id ?? 0;
            $array['agent_account'] = $this->getAgent($user->agent ?? 0)->account ?? '';
            $array['agent_name'] = $this->getAgent($user->agent ?? 0)->name ?? '';
            $insert[] = $array;
        }
        return count($insert) && $this->insertDB($insert);
    }

    public function content($v)
    {
        try{
            $str = '局号：'.$v['gameNo'].'<br />';
            $str .= '下注前余额：'.$v['enterGold'].'<br />';
            return $str;
        }catch (\Throwable $e){
            writeLog('error', var_export($e->getTraceAsString(), 1));
            return false;
        }
    }

    public function getUserName()
    {
        return $this->getConfig('agent').$this->user['username'];
    }

    private function agentLogin()
    {
        $param = [
            'data' => [
                "agentId" => $this->getConfig('agentId'),
                "userName" => $this->getConfig('userName'),
                "password" => $this->getConfig('password'),
            ],
        ];
        $param['sign'] = $this->sign($param);
        $res = $this->request('/api/agent/login', $param);

        if($res['code'] !== 200){
            throw new \Exception($this->code($res['code']) ?? $res['msg'], $res['code']);
        }
        return $res['data']['token'];
    }

    private function getToken()
    {
        $redis = Redis::connection();
        $redis->select(12);
        $key = 'nnqipai_token';
        if(!$token = $redis->get($key)){
            $token = $this->agentLogin();
            $redis->setex($key, 60 * 20, $token);
        }
        return $token;
    }

    private function request($uri, $param)
    {
        $res = $this->curl_post_content($this->getConfig('apiUrl').$uri, json_encode($param), null, ['Content-Type: application/json']);
        if($res = json_decode($res, 1)){
            return $res;
        }
        throw new \Exception('未知异常，请联系客服', 500);
    }

    private function sign($arr = [])
    {
        $str = $this->pkcs5_pad(json_encode($arr), 16);
        $key = $this->getConfig('key');
        $key1 = substr($key, 0, 16);
        $iv = substr($key, -16);
        $sign = openssl_encrypt($str, 'AES-128-CBC', $key1, OPENSSL_RAW_DATA | OPENSSL_NO_PADDING, $iv);
        return base64_encode($sign);
    }
    function pkcs5_pad($text, $blocksize)
    {
        $pad = $blocksize - (strlen($text) % $blocksize);
        return $text . str_repeat(chr($pad), $pad);
    }


    public function createOrderId()
    {
        $this->param['orderid'] = $this->Config[$this->ConfigPrefix.'agent'] . $this->orderNumber() . $this->user['username'];
        return $this->param['orderid'];
    }


    private function code($code)
    {
        return [
                200=>'成功',
                500=>'未知异常',
                1000400=>'服务连接失败',
                1000401=>'服务异常，发送失败',
                1000402=>'发送失败',
                1000406=>'服务异常，接收失败',
                1000407=>'收到消息，但返回错误',
                1000408=>'服务器登录异常',
                1000409=>'远程服务器异常',
                1000410=>'远程服务器数据不存在',
                1000411=>'字典已经存在',
                1000412=>'创建字典失败',
                1000413=>'包装字典属性失败',
                1000414=>'字典类型不能为空',
                1000415=>'文件读取失败',
                1000416=>'文件未找到',
                1000417=>'上传图片出错',
                1000418=>'分页参数有误',
                1000419=>'数据库中没有该资源',
                1000420=>'权限异常',
                1000421=>'请求数据格式不正确',
                1000422=>'验证码不正确',
                1000427=>'该用户已经注册',
                1000428=>'没有此用户',
                1000429=>'当前用户已存在记录',
                1000430=>'此账号无效',
                1000431=>'没有此用户',
                1000432=>'账号被冻结',
                1000433=>'原密码不正确',
                1000434=>'两次输入密码不一致',
                1000435=>'此账号已被禁用',
                1000436=>'用户名不能为空',
                1000437=>'密码不能为空',
                1000438=>'用户名或密码错误',
                1000440=>'参数错误',
                1000441=>'验证失败',
                1000444=>'记录不存在',
                1000446=>'请求有错误',
                1000447=>'会话超时',
                1000448=>'服务器异常',
                1000449=>'token过期',
                1000450=>'token验证失败',
                1000451=>'token不能为空',
                1000452=>'签名验证失败',
                1000453=>'交易密码错误',
                1000454=>'未绑定银行卡',
                1000455=>'余额不足',
                1000456=>'请先设置交易密码',
                1000457=>'当前代理没有绑定银行卡',
                1000458=>'申请兑换找不到当前代理',
                1000459=>'原始登陆密码错误',
                1000460=>'系统内部异常',
                1000461=>'登陆密码错误',
                1000462=>'账号密码错误',
                1000463=>'返回客户端总数大于服务器数量',
                1000464=>'组ID已存在',
                1000465=>'组名称已存在',
                1000466=>'策略代码已存在',
                1000467=>'策略名称已存在',
                1000468=>'上级代理不存在',
                1000469=>'当前代理商已存在',
                1000470=>'当前代理商不存在',
                1000472=>'当前级别必须小于上级的抽水比例',
                1000473=>'存在相同的活动编号',
                1000474=>'存在相同的活动名称',
                1000475=>'当前活动已存在,请先删除活动',
                1000476=>'充值开始时间不能超过结束时间',
                1000477=>'服务器未启动',
                1000478=>'已经审核无法再进行审核',
                1000479=>'未申请的无法进行审核操作',
                1000480=>'金额格式不正确',
                1000481=>'已处理过，不可重复处理',
                1000482=>'只有通过审核的才可以发放',
                1000483=>'代理商不存在或已禁用',
                1000484=>'代理商申请的公钥不存在',
                1000485=>'充值失败',
                1000486=>'提款失败,请联系运维人员',
                1000487=>'查询游戏房间异常',
                1000488=>'操作IP白名单失败',
                1000491=>'审核通过的不可再次审核',
                1000492=>'超过最大限额',
                1000493=>'小于最小限额',
                1000494=>'订单重复提交',
                1000495=>'公告时间已过有效期',
                1000496=>'当前代理还未通过授权',
                1000497=>'请求过于频繁',
                1000498=>'金额转换异常',
                1000499=>'商家id或订单错误',
                1000501=>'代理商id或代理商姓名错误',
                1000502=>'代理商api接入的域名列表超过了最大数量限制',
                1000503=>'游戏类型添加重复',
                1000504=>'游戏配置错误',
                1000505=>'游戏活动类型添加重复',
                1000506=>'解析包异常',
                1000507=>'解析返回数据异常',
                1000508=>'远程通信异常',
                -20003=>'远程服务超时',
                -20002=>'解析异常',
                -20001=>'无对应错误信息',
                20001=>'未知错误',
                20002=>'参数错误',
                20003=>'服务繁忙',
                20004=>'转发协议失败',
                20005=>'解析协议失败',
                20006=>'解析包头出错',
                20007=>'解析包体出错',
                20008=>'未知协议id',
                20009=>'未知协议',
                200010=>'未知房间地址',
                200011=>'非法协议',
                200012=>'未登录帐号',
                200013=>'服务故障',
                200014=>'未登陆游戏',
                200015=>'服务未实现',
                200016=>'模块未实现',
                200017=>'函数未实现',
                200018=>'服务维护',
                200019=>'权限未配置',
                200020=>'代理服务器故障',
                20001001=>'帐号为空',
                20001002=>'密码为空',
                20001003=>'电话号码为空',
                20001004=>'帐号存在',
                20001005=>'玩家id已达上限',
                20001006=>'重复登录',
                20001007=>'不存在此帐号',
                20001008=>'密码错误',
                20001009=>'对应的玩家不存在',
                20001010=>'union_id为空',
                20001011=>'头像地址为空',
                20001014=>'非法IP地址',
                20001018=>'ip登陆限制',
                20001019=>'账号停用',
                20002001=>'找不到房间',
                20004501=>'机器人不存在',
                20004502=>'机器人类型错误',
                20004503=>'房间失去连接',
                20006001=>'该邮件没有附件',
                20006002=>'邮件附件已被领取',
                20006003=>'邮件不存在或已过期',
                20006004=>'邮件发送重复',
                20006201=>'玩家不存在',
                20006202=>'充值订单重复',
                20006203=>'充值未知错误',
                20006204=>'充值签名错误',
                20006205=>'系统公告配置错误',
                20006206=>'邮件重复',
                20006207=>'用户在线',
                20006208=>'金币不足',
                20006209=>'已存在',
                20006210=>'停服公告不存在',
            ][$code] ?? '';
    }
}