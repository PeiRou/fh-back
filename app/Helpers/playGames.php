<?php
/**
 * Created by PhpStorm.
 * User: BeiYinMei
 * Date: 2018/3/23 0023
 * Time: 20:41
 */


if(!function_exists('curl')){
    function curl($url, $params = false, $ispost = 0, $https = 0)
    {
        //$httpInfo = array();
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.118 Safari/537.36');
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        if ($https) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); // 对认证证书来源的检查
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE); // 从证书中检查SSL加密算法是否存在
        }
        if ($ispost) {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
            curl_setopt($ch, CURLOPT_URL, $url);
        } else {
            if ($params) {
                if (is_array($params)) {
                    $params = http_build_query($params);
                }
                curl_setopt($ch, CURLOPT_URL, $url . '?' . $params);
            } else {
                curl_setopt($ch, CURLOPT_URL, $url);
            }
        }
        $response = curl_exec($ch);
        if ($response === FALSE) {
            //echo "cURL Error: " . curl_error($ch);
            return false;
        }
//        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
//        $httpInfo = array_merge($httpInfo, curl_getinfo($ch));
        curl_close($ch);
        return $response;
    }
}

/***
 * @param $str
 * @return string
 */
if(!function_exists('user_substr')){
    function user_substr($str){
        return  mb_substr($str,0,2,'UTF-8').'****';
    }
}
/***
 * @param $gameId
 * @return string
 */
if(!function_exists('getBetName')){
    function getBetName($gameId){
        switch ($gameId){
            case 82 :
                return "秒速时时彩";
            case 80 :
                return "秒速赛车";
            case 81 :
                return "秒速飞艇";
            case 1 :
                return "重庆时时彩";
            case 50 :
                return "北京赛车";
        }
    }
}

/***
 * @return string
 */
if(!function_exists('orderNumber')){
    function orderNumber(){
        $c = "B";
        $date = date('YmdHis');
        $randnum = rand(10000000,99999999);
        return $c.$date.$randnum;
    }
}

if(!function_exists('payOrderNumber')){
    function payOrderNumber(){
        $c = "PAY";
        $date = date('YmdHis');
        $randnum = rand(10000000,99999999);
        return $c.$date.$randnum;
    }
}

/***
 * @param $collect
 * @param $num
 * @param null $except
 * @return mixed
 */
if(!function_exists('da')){
    function da($collect,$num,$except=null){
        $result = $collect->filter(function($item,$index) use ($num){
            return (int)$item>=$num;
        })->except($except);
        return $result;
    }
}

/***
 * @param $collect
 * @param $num
 * @param null $except
 * @return mixed
 */
if(!function_exists('xiao')){
    function xiao($collect,$num,$except=null){
        $result = $collect->filter(function($item,$index) use ($num){
            return (int)$item<=$num;
        })->except($except);
        return $result;
    }
}

/***
 * @param $collect
 * @return mixed
 */
if(!function_exists('dan')){
    function dan($collect){
        $result = $collect->filter(function ($item, $index) {
            if ((int)$item % 2 === 1) return $item;
        });
        return $result;
    }
}

/***
 * @param $collect
 * @return mixed
 */
if(!function_exists('shuang')){
    function shuang($collect){
        $result = $collect->filter(function($item,$index) {
            if((int)$item%2===0) return $item;
        });
        return $result;
    }
}


/****
 * @param $openArr
 * @param $chunkSize
 * @param $playIds
 * @return array
 */
if(!function_exists('longHu')){
    function longHu($openArr,$chunkSize,$playIds){
        $_arrs    = array_chunk($openArr,$chunkSize);
        $firstArr = reset($_arrs);
        $_lastArr = end($_arrs);
        krsort($_lastArr);
        $result = [];
        $lastArr = array_values($_lastArr);
        for($i = 0;  $i<$chunkSize; $i++){
            if((int)$firstArr[$i]>(int)$lastArr[$i]){
                $result['long'][] = $playIds[$i];
            }else{
                $result['hu'][] = $playIds[$i];
            }
        }
        return $result;
    }
}

/****
 * @param $codes
 * @return string
 */
if(!function_exists('specialSsc')){
    function specialSsc($codes){
        sort($codes); //倒序排序
        $_codes = array_values($codes);//重新索引数组
        $_count = count(array_unique($_codes));
        if ($_count === 1) {    //豹子
            return 'BAOZI';
        } else if ($_count == 2) {   //对子
            return 'DUIZI';
        } else {
            $num1 = (int)reset($_codes);
            $num2 = (int)$_codes[1];
            $num3 = (int)end($_codes);
            $shunZi = ($num1 + 1 === $num2 && $num3 - 1 === $num2) || ($num1 + $num2 === 1 && $num3 === 9);
            $banShun = ($num1 + 1 === $num2 && $num3 - 1 === $num2) || ($num1 + $num2 === 1 && $num3 !== 9) || ($num1 === 0 && $num3 === 9);
            if ($shunZi) return 'SHUNZI'; //顺子
            else if ($banShun) return 'BANSHUN'; //半顺
            else    return 'ZALIU';        //杂六
        }
    }
}
/***
 * @param $table
 * @param $conditions_field
 * @param $values_field
 * @param $conditions
 * @return string
 */
if(!function_exists('betBatchWinUpdate')){
    function betBatchWinUpdate( $conditions)
    {
        if(count($conditions)>1){
            $sql  = 'update bet set  bunko = bunko+ case  bet_id ';
            foreach ($conditions as $key => $v) {
                $id []  = $v['bet_id'];
                $sum    = (float)$v['bet_money'] * (float)$v['play_odds'];
                $sql   .= ' when ' . $v['bet_id'] . ' then '.$sum;
            }
                $sql .= ' end where bet_id in(' . implode(',', $id) . ')';
        }else{
            $sum    = (float)reset($conditions)['bet_money'] * (float)reset($conditions)['play_odds'];
            $sql = 'update bet set  bunko = bunko+'.$sum .' where bet_id = '.reset($conditions)['bet_id'] ;
        }
        return $sql;
    }
}

/***
 * @param $table
 * @param $conditions_field
 * @param $values_field
 * @param $conditions
 * @return string
 */
if(!function_exists('betBatchNoWinUpdate')){
    function betBatchNoWinUpdate( $conditions)
    {
        if(count($conditions)>1){
            $sql  = 'update bet set  bunko = bunko- case  bet_id ';
            foreach ($conditions as $key => $v) {
                $id []  = $v['bet_id'];
                $sum    = (float)$v['bet_money'] ;
                $sql   .= ' when ' . $v['bet_id'] . ' then '.$sum;
            }
            $sql .= ' end where bet_id in(' . implode(',', $id) . ')';
        }else{
            $sum    = (float)reset($conditions)['bet_money'] ;
            $sql = 'update bet set  bunko = bunko+'.$sum .' where bet_id = '.reset($conditions)['bet_id'] ;
        }
        return $sql;
    }
}

/***
 * @param $table
 * @param $conditions_field
 * @param $values_field
 * @param $conditions
 * @return string
 */
if(!function_exists('userBatchUpdate')){
    function userBatchUpdate( $conditions)
    {
        $newArr = [];
        foreach ($conditions as $k=>$v){
            if(isset($newArr[$v['user_id']])){
                $newArr[$v['user_id']] += (float)$v['bunko'];
            }else{
                $newArr[$v['user_id']] = (float)$v['bunko'];
            }
        }
        if(count($newArr)>1){
            $sql  = 'update users set money = money+  case id ';
            foreach ($newArr as $k => $v) {
                $id []  = $k;
                $sql   .= ' when ' . $v['user_id'] . ' then '.$v;
            }
            $sql .= ' end where id in(' . implode(',', $id) . ')';
        }else{
            $sql = 'update users set money = money+ '.reset($newArr).' where id = '.key($newArr);
        }
        return $sql;
    }
}
/**
 * 获取cdn下的真实ip
*/
if(!function_exists('realIp')){
    function realIp(){

//        return isset($_SERVER['HTTP_X_FORWARDED_FOR'])?$_SERVER['HTTP_X_FORWARDED_FOR']:$_SERVER['REMOTE_ADDR'];
        $ip = false;
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        }
        if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $_SERVER['HTTP_X_FORWARDED_FOR'] = preg_replace('/\s+/','', $_SERVER['HTTP_X_FORWARDED_FOR']);
            $ips = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
            if ($ip) {
                array_unshift($ips, $ip);
                $ip = FALSE;
            }
            for ($i = 0; $i < count($ips); $i++) {
                if (!preg_match('/^(10│172.16│192.168)./', $ips[$i])) {
                    $ip = $ips[$i];
                    break;
                }
            }
        }

        return ($ip ? $ip : $_SERVER['REMOTE_ADDR']);
    }
}

if(!function_exists('show')){
    function show($code, $message = '', $data = [])
    {
        if ($message == '') {
            if ($code == 0) {
                $message = 'ok';
            } elseif ($code == 2) {
                $message = '参数错误!';
            } else {
                $message = 'error!';
            }
        }
        $data = [
            'code' => $code,
            'data' => $data,
            'msg' => $message,
        ];
        return response()->json($data);
    }
}
/**
 * 打印数据.
 *
 * @param [type] $var [description]
 * @param  int  是否结束
 */
if(!function_exists('p')){
    function p($var, $is_die = 0)
    {
        if (is_array($var)) {
            echo "<pre style='position:relative;z-index:1000;padding:10px;border-radius:5px;background:#f5f5f5;border:1px solid #aaa;font-size:14px;line-height:18px;opacity:0.9;'>".print_r($var, true).'</pre>';
        } else {
            var_dump($var);
        }
        if ($is_die == 1) {
            exit;
        }
    }
}
//记录日志 可以指定文件夹
if(!function_exists('writeLog')) {
    function writeLog($path = '', ...$args)
    {
        //如果资料夹不存在，则创建资料夹
//        if(!file_exists(storage_path().'/logs/'.$path))
//            mkdir(storage_path().'/logs/'.$path);

        $file = storage_path().'/logs/'.$path;
        if(!file_exists($file)){
            $paths = explode('/',$file);
            array_pop($paths);
            $p = '';
            foreach ($paths as $path){
                $p .= '/'.$path;
                if(!file_exists($p))
                    mkdir($p);
            }
        }

        if(isset($args[0]) && (is_array($args[0]) || is_object($args[0])))
            $args[0] = json_encode($args[0], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        if(isset($args[1]))
            $args[1] = (array)$args[1];

        try {
            $log = new \Monolog\Logger('back');
            $log->pushHandler(new \Monolog\Handler\StreamHandler($file . '/' . date('Y-m-d').'.log', \Monolog\Logger::DEBUG));
            $log->info(...$args);
        } catch (\Exception $e) {
            \Log::info('日志记录失败：' . $e->getMessage());
        }

    }
}
//上传图片可以上传的格式
if(!function_exists('checkImg')) {
    function checkImg($type = '')
    {
        return in_array(trim($type, '.'), [
            'png', 'jpeg', 'bmp', 'jpg', 'gif'
        ]);
    }
}
//获取队列真实名
if(!function_exists('setQueueRealName')){
    function setQueueRealName($queue){
        return env('QUEUE_PREFIX_NAME','') . $queue;
    }
}

if(!function_exists('ip')){
    function ip($ip){
        try{
            $checkIp = \Illuminate\Support\Facades\DB::table('ip')->where('ip',$ip)->first();
            if(!$checkIp){
                $http = new \GuzzleHttp\Client();
                $url = env('ASYNC_URL', 'http://127.0.0.1:9502').'/BF/User/ip?ip='.$ip;
                $res = $http->request('GET',$url, ['connect_timeout' => 5]);
                $response = json_decode((string) $res->getBody(), true);
                if(is_null($response))
                    return '网络波动，请重试';
                if($response['code'] == 0){
                    $ipInfo = $response['data']['info'];
                } else {
                    $ipInfo = 'IP定位系统错误';
                }
            } else {
                $ipInfo = $checkIp->country.' '.$checkIp->prov.' '.$checkIp->city.' '.$checkIp->district;
            }
        }catch (\Throwable $e){
//            die($e->getMessage());
            return 'IP定位系统错误';
        }
        return $ipInfo;
    }
}

//if(!function_exists('ip')){
//    function ip($ip){
//        try{
//            if( !filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4) ){
//                return '暂不支持识别此IP类型';
//            }
//            $checkIp = \Illuminate\Support\Facades\DB::table('ip')->where('ip',$ip)->first();
//            if(!$checkIp){
//                $http = new \GuzzleHttp\Client();
//                $key = 'BhE1TEz6FxQYVGt7F7eEhwfkwvEAHtMkEIKovK2zkT9Kx8to9R1sOzzgdnZzFM5p';
//                $res = $http->request('GET',"https://mall.ipplus360.com/ip/district/api?key=$key&ip=$ip&coord=WGS84", ['connect_timeout' => 2]);
//                $response = json_decode((string) $res->getBody(), true);
//                if(is_null($response))
//                    return '网络波动，请重试';
//                if($response['code'] == 200){
//                    $ipInfo = @$response['data']['country'].' '.@$response['data']['multiAreas'][0]['prov'].' '.@$response['data']['multiAreas'][0]['city'].' '.@$response['data']['multiAreas'][0]['district'];
//                    if(empty($ipInfo))
//                        return '暂无此IP';
//                    \Illuminate\Support\Facades\DB::table('ip')->insert([
//                        'ip' => $ip,
//                        'country' => @$response['data']['country'],
//                        'city' => @$response['data']['multiAreas'][0]['city'],
//                        'district' => @$response['data']['multiAreas'][0]['district'],
//                        'prov' => @$response['data']['multiAreas'][0]['prov']
//                    ]);
//                } else {
//                    $ipInfo = 'IP定位系统错误';
//                }
//            } else {
//                $ipInfo = $checkIp->country.' '.$checkIp->prov.' '.$checkIp->city.' '.$checkIp->district;
//            }
//        }catch (\Throwable $e){
//            return 'IP定位系统错误';
//        }
//        return $ipInfo;
//    }
//}
//循环生成待插入奖期values
if(!function_exists('issueSeedValues')) {
    function issueSeedValues($itemNum,$timeUp,$curDate,$len=3,$interval=300){
        for($sql='',$i=1;$i<=$itemNum;$i++){
            $timeUp = \Illuminate\Support\Carbon::parse($timeUp)->addSeconds($interval);
            $i = str_repeat('0',$len-strlen($i)).$i;
            $sql .= "('{$curDate}{$i}','$timeUp'),";
        }
        return rtrim($sql,',');
    }
}
//日志
if(!function_exists('mylog')) {
    function mylog($data, $attach = '', $dir = 'laravel', $dailyMode = 1, $days = 31){
        $traceinfo = debug_backtrace(DEBUG_BACKTRACE_PROVIDE_OBJECT, 1)[0];
        $attach or $attach = 'line:' . $traceinfo['line'] . ' in ' . $traceinfo['file'];
        $path = storage_path('logs/' . trim($dir, '/') . '.log');
        $handlers[] = ($monolog = Log::getMonolog())->popHandler();
        $dailyMode ? Log::useDailyFiles($path, $days) : Log::useFiles($path);
        Log::info($attach);
        Log::info($data);
        $monolog->setHandlers($handlers);
    }
}
//返回最近执行的sql
if (!function_exists('sql')) {
    function sql()
    {
        $DB = '\Illuminate\Support\Facades\DB';
        if ($sql = $DB::getQueryLog()) {
            foreach ($sql as $k => $v) {
                $sql[$k] = vsprintf(str_replace('?', "'%s'", $v['query']), $v['bindings']);
            }
            return $sql;
        }
        $DB::enableQueryLog();
    }
}