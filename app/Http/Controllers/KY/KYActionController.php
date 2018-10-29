<?php

namespace App\Http\Controllers\KY;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\KY\KYUtils;
use PhpParser\Node\Expr\Cast\Int_;

define( 'agent', env('KY_AGENT'));
define( 'desKey', env('KY_DESKEY'));
define( 'md5Key', env('KY_MD5KEY'));
define( 'apiUrl', env('KY_APIURL'));
define( 'recordUrl', env('KY_RECORDURL'));
define( 'lineCode', env('KY_LINECODE'));

define( 'agentTest', env('KY_AGENT_TEST'));
define( 'desKeyTest', env('KY_DESKEY_TEST'));
define( 'md5KeyTest', env('KY_MD5KEY_TEST'));
define( 'apiUrlTest', env('KY_APIURL_TEST'));
define( 'recordUrlTest', env('KY_RECORDURL_TEST'));
define( 'lineCodeTest', env('KY_LINECODE_TEST'));
define('DEBUG', false);
define('LOG_IDENT', 'kaiyuan-api');
class KYActionController extends Controller
{
    public function KY_gameBet(){
        $res = $this->res(6);
        if(!$res){
            return false;
        }

//        foreach ($res as $k => $v){
//            $data = [];
//            $data['GameID'] = $v['GameID'];
//            $data['Accounts'] = $v['Accounts'];
//            $data['ServerID'] = $v['ServerID'];
//            $data['KindID'] = $v['KindID'];
//            $data['TableID'] = $v['TableID'];
//            $data['ChairID'] = $v['ChairID'];
//            $data['UserCount'] = $v['UserCount'];
//            $data['UserCount'] = $v['UserCount'];
//            $data['UserCount'] = $v['UserCount'];
//            $data['UserCount'] = $v['UserCount'];
//            $data['UserCount'] = $v['UserCount'];
//            $data['UserCount'] = $v['UserCount'];
//        }
//        $table = DB::table('ky_bet')->insert();

    }
    public function res($s){
        $kyUtils = new KYUtils();
        $timestamp = $kyUtils->microtime_int();
        switch($subCmd = intval($s)) {
            case 6:
                $param = http_build_query(array(
                    's' => $s,
                    'startTime' => $kyUtils->get_param('startTime'),
                    'endTime' => $kyUtils->get_param('endTime')
                ));
                break;

        }
        $url = DEBUG ? recordUrlTest : recordUrl;
        $url .= '?' . http_build_query(array(
                'agent' => DEBUG ? agentTest : agent,
                'timestamp' => $timestamp,
                'param' => $kyUtils->desEncode(DEBUG ? desKeyTest : desKey, $param),
                'key' => md5(agent.$timestamp.(DEBUG ? md5KeyTest : md5Key))
            ));
        $res = $kyUtils->curl_get_content($url);
        if($res){
            $res = json_decode($res,true);
            if($res['d']['code'] == 0){
                return $res['d']['list'];
            }else{
                if(DEBUG){
                    \Log::info(json_encode($res));
                }
                return false;
            }
        }
        return false;
    }
}
