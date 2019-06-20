<?php
/* 开元棋牌 */

namespace App\Repository\GamesApi\Card;


use Illuminate\Support\Facades\Storage;

class AGRepository extends BaseRepository
{
    public function __construct($config){
        $this->Config = $config;
        $this->newPath = storage_path($this->storage_path);
        $this->file = new \Illuminate\Filesystem\Filesystem();
    }

    public $storage_path = 'GamesApi/AG/bet/';
    public $remote_directory = '/';
    public $all = true; //是否要所有文件
    public $newPath;


    /**
     * 下注记录"BR"
     * 捕鱼王場景的下注记录"HSR"
     * 捕鱼王的户口转账记录"HTR"
     * 捕鱼王的养鱼游戏记录“HPR”
     * 电子游戏的下注记录"EBR"
     * 户口转账记录"TR"
     * 游戏结果"GR"备注: 游戏结果"GR"仅导出 AGIN 平台的真人视讯游戏相关数据
     * YOPLAY 下注记录"BR" (platformType 为 YOPLAY 时, 请使用这解析)
     */
    public function createData($data){
        $data = $this->splitCate($data);
        foreach ($data as $k=>$v){
            if(in_array($k, [
                'TR',
            ]))
                continue;
            if(method_exists($this, $k)) {
                call_user_func([$this, $k], $v);
            }
        }
    }
    //找出重复id
    public function distinct($data, $val = '')
    {
        $GameID = array_map(function($v)use($val){
            return $v[$val] ?? '';
        },$data);
        return $this->getExists($GameID);
    }
    //下注记录格式化
    private function BR($aData){
        $GameIDs = $this->distinct($aData, 'billNo');
        $aArray = array_chunk($aData,1000);
        foreach ($aArray as $data) {
            $insert = [];
            $update = [];
            foreach ($data as $v) {
                if(!preg_match("/^".$this->getVal('agent')."/", $v['playerName']))
                    continue;
                $array = [
                    'g_id' => $this->gameInfo->g_id,
                    'GameID' => $v['billNo'],   //游戏代码
                    'username' => $v['playerName'],  //玩家账号
                    'AllBet' => $v['betAmount'],//总下注
                    'bunko' => $v['netAmount'],       //盈利-下注
                    'bet_money' => $v['validBetAmount'],//有效投注额
                    'GameStartTime' => $this->getDate($v['betTime']),//游戏开始时间
                    'GameEndTime' => $this->getDate($v['recalcuTime'] ?? $v['betTime']),  //游戏结束时间
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => $this->getDate($v['recalcuTime'] ?? $v['betTime']),
                    'gameCategory' => $this->getGameType($v['gameType'] ?? '')['gameCategory'] ?? $this->getCategory($v['platformType']), //
                    'game_type' => $this->getGameType($v['gameType'] ?? '')['name'] ?? '',
                    'service_money' => 0, // + 服务费
                    'bet_info' => '',
                    'flag' => $v['flag'] == '1' ? 1 : $v['flag'],
                    'productType' => $v['platformType']
                ];
                $this->arrInfo($array, $v, 'AGIN');
                if (in_array($v['billNo'], $GameIDs))
                    $update[] = $array;
                else
                    $insert[] = $array;
            }
            count($insert) && $this->saveDB($insert);
            count($update) && $this->saveDB($update, 'GameID');
        }
    }
    private function getCategory($platformType)
    {
        switch ($platformType){
            case 'SABAH':
                $name = 'SPORTS';
                break;
            case 'SBTA':
                $name = 'SPORTS';
                break;
            case 'XIN':
                $name = 'RNG';
                break;
            case 'HUNTER':
                $name = 'FISH';
                break;
            case 'YOPLAY':
                $name = 'RNG';
                break;
            default:
                $name = 'PVP';
                break;
        }
        return $name;
    }

    //捕鱼王場景的下注记录"HSR"
    private function HSR($aData)
    {
        $GameIDs = $this->distinct($aData, 'ID');
        $aArray = array_chunk($aData,1000);
        foreach ($aArray as $data) {
            $insert = [];
            $update = [];
            foreach ($data as $v) {
                if(!preg_match("/^".$this->getVal('agent')."/", $v['playerName']))
                    continue;
                $array = [
                    'g_id' => $this->gameInfo->g_id,
                    'GameID' => $v['ID'],   //游戏代码
                    'username' => $v['playerName'],  //玩家账号
                    'AllBet' => $v['Cost'],//总下注
                    'bunko' => $v['transferAmount'],       //盈利 输赢
                    'bet_money' => $v['Cost'],//有效投注额
                    'GameStartTime' => $v['SceneStartTime'],//游戏开始时间
                    'GameEndTime' => $v['SceneEndTime'] ?? $v['SceneStartTime'],  //游戏结束时间
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => $v['SceneEndTime'] ?? $v['SceneStartTime'],
                    'gameCategory' => $this->getGameType($v['gameType'] ?? '')['gameCategory'] ?? 'FISH', //
                    'game_type' => $this->getGameType($v['gameType'] ?? '')['name'] ?? '捕鱼',
                    'service_money' => 0, // + 服务费
                    'bet_info' => '',
                    'flag' => $v['flag'] == '0' ? 1 : 0,
                    'productType' => $v['platformType']
                ];
                $this->arrInfo($array, $v);
                if (in_array($v['ID'], $GameIDs))
                    $update[] = $array;
                else
                    $insert[] = $array;
            }
            count($insert) && $this->saveDB($insert);
            count($update) && $this->saveDB($update, 'GameID');
        }
    }
    //电子游戏的下注记录"EBR"
    private function EBR($aData)
    {
        $aArray = array_chunk($aData,1000);
        foreach ($aArray as $data) {
            $GameIDs = $this->distinct($aData, 'billNo');
            $insert = [];
            $update = [];
            foreach ($data as $v) {
                if(!preg_match("/^".$this->getVal('agent')."/", $v['playerName']))
                    continue;
                $array = [
                    'g_id' => $this->gameInfo->g_id,
                    'GameID' => $v['billNo'],   //游戏代码
                    'username' => $v['playerName'],  //玩家账号
                    'AllBet' => $v['betAmount'],//总下注
                    'bunko' => $v['netAmount'],       //盈利 输赢
                    'bet_money' => $v['validBetAmount'],//有效投注额
                    'GameStartTime' => $v['betTime'],//游戏开始时间
                    'GameEndTime' => $v['recalcuTime'] ?? $v['betTime'],  //游戏结束时间
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => $v['recalcuTime'] ?? $v['betTime'],
                    'gameCategory' => $this->getGameType($v['gameType'] ?? '')['gameCategory'] ?? 'RNG', //
                    'game_type' => $this->getGameType($v['gameType'] ?? '')['name'] ?? '',
                    'service_money' => 0, // + 服务费
                    'bet_info' => '',
                    'flag' => $v['flag'] == 1 ? 'ok' : $v['flag'],
                    'productType' => $v['platformType']
                ];
                $this->arrInfo($array, $v);
                if (in_array($v['billNo'], $GameIDs))
                    $update[] = $array;
                else
                    $insert[] = $array;
            }
            count($insert) && $this->saveDB($insert);
            count($update) && $this->saveDB($update, 'GameID');
        }
    }

    private function arrInfo(&$array, $v, $key = 'AGIN')
    {
        $user = $this->getUser($array['username'], 'platformType', $key);
        $array['username'] = $user->username ?? $array['username'];
        $array['agent'] = $user->agent ?? 0;
        $array['user_id'] = $user->id ?? 0;
        $array['agent_account'] = $this->getAgent($user->agent ?? 0)->account ?? '';
        $array['agent_name'] = $this->getAgent($user->agent ?? 0)->name ?? '';
    }

    private function splitCate($data)
    {
        $r = [];
        $len = count($data);
        while ($data){
            $arr = array_shift($data);
            ($len > 1) && $arr = array_shift($arr);
            $r[$arr['dataType']][] = $arr;
        }
        return $r;
    }
    /** ************************************************************************************************* */
    public function All()
    {
        //获取所有文件夹
        $this->remote_directory = '/';
        $files = $this->ftp->files($this->remote_directory);
        foreach ($files as $v){
            $this->param['platformType'] = $v;
            $this->getOne();
        }

    }

    public function getOne()
    {
        try{
            $this->directory = substr($this->param['time'], 0, 8);
            $this->remote_directory = $this->param['platformType'].'/'.($this->param['lostAndfoundPath']??'').substr($this->param['time'], 0, 8);
            //获取需要的文件列表
            $files = $this->getFileList();
            $this->delFile($this->newPath.$this->param['platformType'].'/');

            foreach ($files as $v){
                $str = $this->readFile($v);
                $this->createData($this->resolveXml($str));
            }
        }catch (\Throwable $e){
            $msg = $this->param['platformType'].'数据获取失败'.$e->getMessage();
            $code = 1;
            $this->WriteLog($this->param['platformType'].'数据获取失败'.$e->getMessage().$e->getFile().'('.$e->getLine().')'.$e->getTraceAsString());
        }finally{
            $this->insertError($code ?? 0, $msg ?? '', $this->param);
        }
    }
    public function getBet()
    {
        try{
            !isset($this->ftp) &&
            $this->ftp = new \App\Repository\GamesApi\Card\Utils\Ftp($this->getConfig('ftpH'),$this->getConfig('ftpU'),$this->getConfig('ftpP'));
        }catch (\Throwable $e){
            $this->insertError(2, 'FTP链接失败'.$e->getMessage());
            $this->WriteLog($e->getMessage().$e->getFile().'('.$e->getLine().')'.$e->getTraceAsString());
            return false;
        }
        if(!isset($this->param['platformType']))
            return $this->All();
        else
            return $this->getOne();
    }

    private function readFile($files)
    {
        try{
            $o = fopen($files['file'], 'r');
            $size = filesize($files['file']);
            fseek($o,$files['open_size']);
            $str = $size - $files['open_size'] ? fread($o, $size - $files['open_size']) : '';
            fclose($o);
            return $str;
        }catch (\Throwable $e){
            throw $e;
        }finally{
            @fclose($o);
        }
    }

    public function resolveXml($str)
    {
        return array_values(json_decode(json_encode(simplexml_load_string("<?xml version=\"1.0\" encoding=\"utf-8\"?><xml>$str</xml>"), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),1))[0] ?? [];
    }

    //删除之前的 并且不是正在更新的文件
    private function delFile($path = '')
    {
        try{
            if(!$this->file->isDirectory($path))
                return true;
            foreach ($this->file->directories($path) as $k=>$v){
                $a = explode('/', $v);
                $name = array_pop($a);
                if($name == $this->directory || $name == date('Ymd')){
                    continue;
                }
                $this->file->deleteDirectory($v);
            }
        }catch (\Throwable $e){
            $this->WriteLog($e->getMessage().$e->getFile().'('.$e->getLine().')'.$e->getTraceAsString());
        }
    }

    public function getFileList()
    {
        $ftp = $this->ftp;

        $files = $ftp->files($this->remote_directory);

        $this->files = [];
        if(!$this->all && $files && count($files))
            $files = array_slice($files, -12);
        foreach ($files as $v){
            $fileName = str_replace($this->remote_directory.'/', '', $v);
            $newPath = $this->newPath.$this->param['platformType'].'/'.$this->directory.'/'.$fileName;
            $array = [
                'name' => $fileName,
                'file' => $newPath,
                'remote_file' => $v,
                'open_size' => 0, //标记文件指针位置
            ];
            if(!$this->all && !$this->param['clear']){
                if(file_exists($newPath))
                    $array['open_size'] = filesize($newPath);
            }

            $ftp->downNb($v, $newPath, $array['open_size']);
            $this->files[] = $array;
        }
        return $this->files;
    }

    public function getGameType($key = '')
    {
        return [
            'BAC'=>['name'=>'百家乐','gameCategory'=>'LIVE'],
            'CBAC'=>['name'=>'包桌百家乐','gameCategory'=>'LIVE'],
            'LINK'=>['name'=>'多台','gameCategory'=>'LIVE'],
            'DT'=>['name'=>'龙虎','gameCategory'=>'LIVE'],
            'SHB'=>['name'=>'骰宝','gameCategory'=>'LIVE'],
            'ROU'=>['name'=>'轮盘','gameCategory'=>'LIVE'],
            'FT'=>['name'=>'番摊','gameCategory'=>'LIVE'],
            'LBAC'=>['name'=>'竞咪百家乐','gameCategory'=>'LIVE'],
            'ULPK'=>['name'=>'终极德州扑克','gameCategory'=>'LIVE'],
            'SBAC'=>['name'=>'保险百家乐','gameCategory'=>'LIVE'],
            'NN'=>['name'=>'牛牛','gameCategory'=>'LIVE'],
            'BJ'=>['name'=>'21点','gameCategory'=>'LIVE'],
            'ZJH'=>['name'=>'炸金花','gameCategory'=>'LIVE'],
            'BF'=>['name'=>'斗牛','gameCategory'=>'LIVE'],
            'SL1'=>['name'=>'巴西世界杯','gameCategory'=>'RNG'],
            'SL2'=>['name'=>'疯狂水果店','gameCategory'=>'RNG'],
            'SL3'=>['name'=>'3D水族馆','gameCategory'=>'RNG'],
            'PK_J'=>['name'=>'视频扑克(杰克高手)','gameCategory'=>'RNG'],
            'SL4'=>['name'=>'极速赛车','gameCategory'=>'RNG'],
            'PKBJ'=>['name'=>'新视频扑克(杰克高手)','gameCategory'=>'RNG'],
            'FRU'=>['name'=>'水果拉霸','gameCategory'=>'RNG'],
            'HUNTER'=>['name'=>'捕鱼王','gameCategory'=>'RNG'],
            'SLM1'=>['name'=>'美女沙排(沙滩排球)','gameCategory'=>'RNG'],
            'SLM2'=>['name'=>'运财羊(新年运财羊)','gameCategory'=>'RNG'],
            'SLM3'=>['name'=>'武圣传','gameCategory'=>'RNG'],
            'TGLW'=>['name'=>'极速幸运轮','gameCategory'=>'RNG'],
            'SB01'=>['name'=>'太空漫游','gameCategory'=>'RNG'],
            'SB02'=>['name'=>'复古花园','gameCategory'=>'RNG'],
            'SB03'=>['name'=>'关东煮','gameCategory'=>'RNG'],
            'SB04'=>['name'=>'牧场咖啡','gameCategory'=>'RNG'],
            'SB05'=>['name'=>'甜一甜屋','gameCategory'=>'RNG'],
            'SB06'=>['name'=>'日本武士','gameCategory'=>'RNG'],
            'SB07'=>['name'=>'象棋老虎机','gameCategory'=>'RNG'],
            'SB08'=>['name'=>'麻将老虎机','gameCategory'=>'RNG'],
            'SB09'=>['name'=>'西洋棋老虎机','gameCategory'=>'RNG'],
            'SB10'=>['name'=>'开心农场','gameCategory'=>'RNG'],
            'SB11'=>['name'=>'夏日营地','gameCategory'=>'RNG'],
            'SB12'=>['name'=>'海底漫游','gameCategory'=>'RNG'],
            'SB13'=>['name'=>'鬼马小丑','gameCategory'=>'RNG'],
            'SB14'=>['name'=>'机动乐园','gameCategory'=>'RNG'],
            'SB15'=>['name'=>'惊吓鬼屋','gameCategory'=>'RNG'],
            'SB16'=>['name'=>'疯狂马戏团','gameCategory'=>'RNG'],
            'SB17'=>['name'=>'海洋剧场','gameCategory'=>'RNG'],
            'SB18'=>['name'=>'水上乐园','gameCategory'=>'RNG'],
            'SB25'=>['name'=>'土地神','gameCategory'=>'RNG'],
            'SB26'=>['name'=>'布袋和尚','gameCategory'=>'RNG'],
            'SB27'=>['name'=>'正财神','gameCategory'=>'RNG'],
            'SB28'=>['name'=>'武财神','gameCategory'=>'RNG'],
            'SB29'=>['name'=>'偏财神','gameCategory'=>'RNG'],
            'SB19'=>['name'=>'空中战争','gameCategory'=>'RNG'],
            'SB20'=>['name'=>'摇滚狂迷','gameCategory'=>'RNG'],
            'SB21'=>['name'=>'越野机车','gameCategory'=>'RNG'],
            'SB22'=>['name'=>'埃及奥秘','gameCategory'=>'RNG'],
            'SB23'=>['name'=>'欢乐时光','gameCategory'=>'RNG'],
            'SB24'=>['name'=>'侏罗纪','gameCategory'=>'RNG'],
            'AV01'=>['name'=>'性感女仆','gameCategory'=>'RNG'],
            'XG01'=>['name'=>'龙珠','gameCategory'=>'RNG'],
            'XG02'=>['name'=>'幸运8','gameCategory'=>'RNG'],
            'XG03'=>['name'=>'闪亮女郎','gameCategory'=>'RNG'],
            'XG04'=>['name'=>'金鱼','gameCategory'=>'RNG'],
            'XG05'=>['name'=>'中国新年','gameCategory'=>'RNG'],
            'XG06'=>['name'=>'海盗王','gameCategory'=>'RNG'],
            'XG07'=>['name'=>'鲜果狂热','gameCategory'=>'RNG'],
            'XG08'=>['name'=>'小熊猫','gameCategory'=>'RNG'],
            'XG09'=>['name'=>'大豪客','gameCategory'=>'RNG'],
            'SB30'=>['name'=>'灵猴献瑞','gameCategory'=>'RNG'],
            'SB31'=>['name'=>'天空守护者','gameCategory'=>'RNG'],
            'PKBD'=>['name'=>'百搭二王','gameCategory'=>'RNG'],
            'PKBB'=>['name'=>'红利百搭','gameCategory'=>'RNG'],
            'SB32'=>['name'=>'齐天大圣','gameCategory'=>'RNG'],
            'SB33'=>['name'=>'糖果碰碰乐','gameCategory'=>'RNG'],
            'SB34'=>['name'=>'冰河世界','gameCategory'=>'RNG'],
            'FRU2'=>['name'=>'水果拉霸2','gameCategory'=>'RNG'],
            'SB35'=>['name'=>'欧洲列强争霸','gameCategory'=>'RNG'],
            'SB36'=>['name'=>'捕鱼王者','gameCategory'=>'RNG'],
            'SB37'=>['name'=>'上海百乐门','gameCategory'=>'RNG'],
            'SB38'=>['name'=>'竞技狂热','gameCategory'=>'RNG'],
            'SB39'=>['name'=>'太空水果','gameCategory'=>'RNG'],
            'SB40'=>['name'=>'秦始皇','gameCategory'=>'RNG'],
            'XG10'=>['name'=>'龙舟竞渡','gameCategory'=>'RNG'],
            'XG11'=>['name'=>'中秋佳节','gameCategory'=>'RNG'],
            'XG12'=>['name'=>'韩风劲舞','gameCategory'=>'RNG'],
            'XG13'=>['name'=>'美女大格斗','gameCategory'=>'RNG'],
            'XG16'=>['name'=>'黄金对垒','gameCategory'=>'RNG'],
            'SX02'=>['name'=>'街头烈战','gameCategory'=>'RNG'],
            'SC03'=>['name'=>'金拉霸','gameCategory'=>'RNG'],
            'SB45'=>['name'=>'猛龙传奇','gameCategory'=>'RNG'],
            'SB49'=>['name'=>'金龙珠','gameCategory'=>'RNG'],
            'SB50'=>['name'=>'XIN哥来了','gameCategory'=>'RNG'],
            'SB47'=>['name'=>'神奇宝石','gameCategory'=>'RNG'],
            'WH01'=>['name'=>'阿里巴巴','gameCategory'=>'RNG'],
            'EP03'=>['name'=>'骰宝','gameCategory'=>'RNG'],
            'SB51'=>['name'=>'王者传说','gameCategory'=>'RNG'],
            'WH03'=>['name'=>'冠军足球','gameCategory'=>'RNG'],
            'WH04'=>['name'=>'穆夏女神','gameCategory'=>'RNG'],
            'EP02'=>['name'=>'龙虎','gameCategory'=>'RNG'],
            'WH06'=>['name'=>'亚瑟王','gameCategory'=>'RNG'],
            'WH10'=>['name'=>'爱丽丝大冒险','gameCategory'=>'RNG'],
            'WH11'=>['name'=>'战火风云','gameCategory'=>'RNG'],
            'WH17'=>['name'=>'嫦娥奔月','gameCategory'=>'RNG'],
            'WA01'=>['name'=>'钻石女王','gameCategory'=>'RNG'],
            'SC05'=>['name'=>'百搭777','gameCategory'=>'RNG'],
            'SV41'=>['name'=>'富贵金鸡(巨奖厅)','gameCategory'=>'RNG'],
            'WH21'=>['name'=>'永恒之吻','gameCategory'=>'RNG'],
            'WH22'=>['name'=>'恐怖嘉年华','gameCategory'=>'RNG'],
            'WH24'=>['name'=>'僵尸来袭','gameCategory'=>'RNG'],
            'WH29'=>['name'=>'狂野女巫','gameCategory'=>'RNG'],
            'WC01'=>['name'=>'跳跳乐','gameCategory'=>'RNG'],
            'SB55'=>['name'=>'多宝鱼虾蟹','gameCategory'=>'RNG'],
            'WH18'=>['name'=>'白雪公主','gameCategory'=>'RNG'],
            'WH20'=>['name'=>'葫芦兄弟','gameCategory'=>'RNG'],
            'WH34'=>['name'=>'内衣橄榄球','gameCategory'=>'RNG'],
            'WH32'=>['name'=>'贪玩蓝月','gameCategory'=>'RNG'],
            'WH35'=>['name'=>'招财锦鲤','gameCategory'=>'RNG'],
            'WH38'=>['name'=>'十二生肖','gameCategory'=>'RNG'],
            'WH02'=>['name'=>'圣女贞德','gameCategory'=>'RNG'],
            'WH07'=>['name'=>'五狮进宝','gameCategory'=>'RNG'],
            'WH12'=>['name'=>'发财熊猫','gameCategory'=>'RNG'],
            'WH23'=>['name'=>'封神演义','gameCategory'=>'RNG'],
            'WH27'=>['name'=>'和风剧院','gameCategory'=>'RNG'],
            'WH30'=>['name'=>'点石成金','gameCategory'=>'RNG'],
            'WH16'=>['name'=>'神秘飞碟','gameCategory'=>'RNG'],
            'WH19'=>['name'=>'财宝塔罗','gameCategory'=>'RNG'],
            'WH28'=>['name'=>'埃及宝藏','gameCategory'=>'RNG'],
            'FIFA'=>['name'=>'体育','gameCategory'=>'SPORTS'],
            'SPTA'=>['name'=>'AG体育','gameCategory'=>'SPORTS'],
            'YFP'=>['name'=>'水果派对','gameCategory'=>'YOPLAY'],
            'YDZ'=>['name'=>'德州牛仔','gameCategory'=>'YOPLAY'],
            'YBIR'=>['name'=>'飞禽走兽','gameCategory'=>'YOPLAY'],
            'YMFD'=>['name'=>'森林舞会多人版','gameCategory'=>'YOPLAY'],
            'YFD'=>['name'=>'森林舞会','gameCategory'=>'YOPLAY'],
            'YBEN'=>['name'=>'奔驰宝马','gameCategory'=>'YOPLAY'],
            'YHR'=>['name'=>'极速赛马','gameCategory'=>'YOPLAY'],
            'YMFR'=>['name'=>'水果拉霸多人版','gameCategory'=>'YOPLAY'],
            'YGS'=>['name'=>'猜猜乐','gameCategory'=>'YOPLAY'],
            'YFR'=>['name'=>'水果拉霸','gameCategory'=>'YOPLAY'],
            'YMBN'=>['name'=>'百人牛牛','gameCategory'=>'YOPLAY'],
            'YGFS'=>['name'=>'多宝水果拉霸','gameCategory'=>'YOPLAY'],
            'YJFS'=>['name'=>'彩金水果拉霸','gameCategory'=>'YOPLAY'],
            'YMBI'=>['name'=>'飞禽走兽多人版','gameCategory'=>'YOPLAY'],
            'YMBA'=>['name'=>'牛牛对战','gameCategory'=>'YOPLAY'],
            'YMBZ'=>['name'=>'奔驰宝马多人版','gameCategory'=>'YOPLAY'],
            'YMAC'=>['name'=>'动物狂欢','gameCategory'=>'YOPLAY'],
            'YMJW'=>['name'=>'西游争霸','gameCategory'=>'YOPLAY'],
            'YMJH'=>['name'=>'翻倍炸金花','gameCategory'=>'YOPLAY'],
            'YMBF'=>['name'=>'刺激战场','gameCategory'=>'YOPLAY'],
            'YMSG'=>['name'=>'斗三公','gameCategory'=>'YOPLAY'],
            'YMJJ'=>['name'=>'红黑梅方','gameCategory'=>'YOPLAY'],
            'YJTW'=>['name'=>'彩金宝藏世界','gameCategory'=>'YOPLAY'],
            'YMD2'=>['name'=>'疯狂德州','gameCategory'=>'YOPLAY'],
            'YJBZ'=>['name'=>'彩金奔驰宝马','gameCategory'=>'YOPLAY'],
            'YMSL'=>['name'=>'海陆争霸','gameCategory'=>'YOPLAY'],
            'YMDD'=>['name'=>'百人推筒子','gameCategory'=>'YOPLAY'],
            'YMKM'=>['name'=>'功夫万条筒','gameCategory'=>'YOPLAY'],
            'YMDL'=>['name'=>'双喜炸金花','gameCategory'=>'YOPLAY'],
            'YMPL'=>['name'=>'凤凰传奇','gameCategory'=>'YOPLAY'],
            'YMBJ'=>['name'=>'全民21点','gameCategory'=>'YOPLAY'],
            'YMLD'=>['name'=>'福星推筒子','gameCategory'=>'YOPLAY'],
            'YMGG'=>['name'=>'YP刮刮卡','gameCategory'=>'YOPLAY'],
            'YMFW'=>['name'=>'财富转盘','gameCategory'=>'YOPLAY'],
        ][$key] ?? [];
    }

    public function getPlayType($key = '')
    {
        return [
            1=>'庄',
            2=>'闲',
            3=>'和',
            4=>'庄对',
            5=>'闲对',
            6=>'大',
            7=>'小',
            8=>'庄保险',
            9=>'闲保险',
            11=>'庄免佣',
            12=>'庄龙宝',
            13=>'闲龙宝',
            14=>'超级六',
            15=>'任意对子',
            16=>'完美对子',
            21=>'龙',
            22=>'虎',
            23=>'和（龙虎）',
            41=>'大(big)',
            42=>'小(small)',
            43=>'单(odd)',
            44=>'双(even)',
            45=>'全围(allwei)',
            46=>'围1(wei1)',
            47=>'围2(wei2)',
            48=>'围3(wei3)',
            49=>'围4(wei4)',
            50=>'围5(wei5)',
            51=>'围6(wei6)',
            52=>'单点1(single1)',
            53=>'单点2(single2)',
            54=>'单点3(single3)',
            55=>'单点4(single4)',
            56=>'单点5(single5)',
            57=>'单点6(single6)',
            58=>'对子1(double1)',
            59=>'对子2(double2)',
            60=>'对子3(double3)',
            61=>'对子4(double4)',
            62=>'对子5(double5)',
            63=>'对子6(double6)',
            64=>'组合12(combine12)',
            65=>'组合13(combine13)',
            66=>'组合14(combine14)',
            67=>'组合15(combine15)',
            68=>'组合16(combine16)',
            69=>'组合23(combine23)',
            70=>'组合24(combine24)',
            71=>'组合25(combine25)',
            72=>'组合26(combine26)',
            73=>'组合34(combine34)',
            74=>'组合35(combine35)',
            75=>'组合36(combine36)',
            76=>'组合45(combine45)',
            77=>'组合46(combine46)',
            78=>'组合56(combine56)',
            79=>'和值4(sum4)',
            80=>'和值5(sum5)',
            81=>'和值6(sum6)',
            82=>'和值7(sum7)',
            83=>'和值8(sum8)',
            84=>'和值9(sum9)',
            85=>'和值10(sum10)',
            86=>'和值11(sum11)',
            87=>'和值12(sum12)',
            88=>'和值13(sum13)',
            89=>'和值14(sum14)',
            90=>'和值15(sum15)',
            91=>'和值16(sum16)',
            92=>'和值17(sum17)',
            101=>'直接注',
            102=>'分注',
            103=>'街注',
            104=>'三数',
            105=>'4个号码',
            106=>'角注',
            107=>'列注(列1)',
            108=>'列注(列2)',
            109=>'列注(列3)',
            110=>'线注',
            111=>'打一',
            112=>'打二',
            113=>'打三',
            114=>'红',
            115=>'黑',
            116=>'大',
            117=>'小',
            118=>'单',
            119=>'双',
            130=>'1番',
            131=>'2番',
            132=>'3番',
            133=>'4番',
            134=>'1念2',
            135=>'1念3',
            136=>'1念4',
            137=>'2念1',
            138=>'2念3',
            139=>'2念4',
            140=>'3念1',
            141=>'3念2',
            142=>'3念4',
            143=>'4念1',
            144=>'4念2',
            145=>'4念3',
            146=>'角(1,2)',
            147=>'单',
            148=>'角(1,4)',
            149=>'角(2,3)',
            150=>'双',
            151=>'角(3,4)',
            152=>'1,2四通',
            153=>'1,2三通',
            154=>'1,3四通',
            155=>'1,3二通',
            156=>'1,4三通',
            157=>'1,4二通',
            158=>'2,3四通',
            159=>'2,3一通',
            160=>'2,4三通',
            161=>'2,4一通',
            162=>'3,4二通',
            163=>'3,4一通',
            164=>'三门(3,2,1)',
            165=>'三门(2,1,4)',
            166=>'三门(1,4,3)',
            167=>'三门(4,3,2)',
            180=>'底注+盲注',
            181=>'一倍加注',
            182=>'二倍加注',
            183=>'三倍加注',
            184=>'四倍加注',
            211=>'闲1平倍',
            212=>'闲1翻倍',
            213=>'闲2平倍',
            214=>'闲2翻倍',
            215=>'闲3平倍',
            216=>'闲3翻倍',
            207=>'庄1平倍',
            208=>'庄1翻倍',
            209=>'庄2平倍',
            210=>'庄2翻倍',
            217=>'庄3平倍',
            218=>'庄3翻倍',
            220=>'底注',
            221=>'分牌',
            222=>'保险',
            223=>'分牌保险',
            224=>'加注',
            225=>'分牌加注',
            226=>'完美对子',
            227=>'21+3',
            228=>'旁注',
            229=>'旁注分牌',
            230=>'旁注保险',
            231=>'旁注分牌保险',
            232=>'旁注加注',
            233=>'旁注分牌加注',
            260=>'龙',
            261=>'凤',
            262=>'对8以上',
            263=>'同花',
            264=>'顺子',
            265=>'豹子',
            266=>'同花顺',
            270=>'黑牛',
            271=>'红牛',
            272=>'和',
            273=>'牛一',
            274=>'牛二',
            275=>'牛三',
            276=>'牛四',
            277=>'牛五',
            278=>'牛六',
            279=>'牛七',
            280=>'牛八',
            281=>'牛九',
            282=>'牛牛',
            283=>'双牛牛',
            284=>'银牛/金牛/炸弹/五小牛',
        ][$key] ?? '';
    }
}