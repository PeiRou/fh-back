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
                    'GameStartTime' => $v['betTime'],//游戏开始时间
                    'GameEndTime' => $v['recalcuTime'] ?? $v['betTime'],  //游戏结束时间
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => $v['recalcuTime'] ?? $v['betTime'],
                    'gameCategory' => $this->getCategory($v['platformType']), //棋牌
                    'service_money' => 0, // + 服务费
                    'bet_info' => '',
                    'flag' => $v['flag'] == '1' ? 'ok' : $v['flag'],
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
                    'gameCategory' => 'FISH', //
                    'service_money' => 0, // + 服务费
                    'bet_info' => '',
                    'flag' => $v['flag'] == '0' ? 'ok' : $v['flag'],
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
                    'gameCategory' => 'RNG', //
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
        if(!$this->all && count($files))
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

}