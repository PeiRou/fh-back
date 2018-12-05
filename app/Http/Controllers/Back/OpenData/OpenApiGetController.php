<?php

namespace App\Http\Controllers\Back\OpenData;

use App\Excel;
use App\Games;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;

class OpenApiGetController extends Controller
{
    //获取开奖
    public function open($type,$date,$issue){
        if(!empty($this->apiArray[$type])) {
            $http = new Client();
            try {
                if(in_array($type,['cqssc','lhc','bjkl8','pk10','gsk3','gd11x5','gxk3','gzk3','hebeik3','hbk3','jsk3'])) {
                    $res = $http->request('get', $this->apiArray[$type] . '&date=' . $date);
                }
                if(in_array($type,['xync','gdkl10'])){
                    $res = $http->request('get', $this->apiArray[$type]);
                }
                $json = json_decode((string)$res->getBody(), true);
                return response()->json($this->$type($json, $issue));
            } catch (\Exception $e) {
                return [
                    'code' => $e->getCode(),
                    'status' => false,
                    'msg' => '获取失败，原因1.本期暂未开奖，2.接口数据返回异常'
                ];
            }
        }

        $excelModel = new Excel();
        $openCode = $excelModel->opennum('game_'.Games::$aCodeGameName[$type]);
        if(empty($openCode)) return [
            'code' => 200,
            'status' => false,
            'msg' => '获取失败，号码未获取'
        ];
        return $this->$type($openCode);
    }

    //获取开奖号码
    public function parsingParameters($type,$issue){
        $http = new Client();
        $res = $http->request('get',$this->apiArray[$type].'&issue='.$issue);
        $json = json_decode((string) $res->getBody(), true);
        return $this->strongConversionInt(explode(',',$json['number']));
    }

    //开奖API
    public $apiArray = [
        'cqssc' => 'http://api.caipiaokong.cn/lottery/?name=cqssc&format=json&uid=973140&token=10b2f648e496015c7e8f4d82caade52b02d9905d',
        'lhc' => 'http://api.caipiaokong.cn/lottery/?name=xglhc&format=json&uid=973140&token=10b2f648e496015c7e8f4d82caade52b02d9905d',
        'bjkl8' => 'http://api.caipiaokong.cn/lottery/?name=bjklb&format=json&uid=973140&token=10b2f648e496015c7e8f4d82caade52b02d9905d',
        'pk10' => 'http://api.caipiaokong.cn/lottery/?name=bjpks&format=json&uid=973140&token=10b2f648e496015c7e8f4d82caade52b02d9905d',
        'gsk3' => 'http://api.caipiaokong.cn/lottery/?name=gsks&format=json&uid=973140&token=10b2f648e496015c7e8f4d82caade52b02d9905d',
        'gd11x5' => 'http://api.caipiaokong.cn/lottery/?name=gdsyxw&format=json&uid=973140&token=10b2f648e496015c7e8f4d82caade52b02d9905d',
        'gxk3' => 'http://api.caipiaokong.cn/lottery/?name=gxks&format=json&uid=973140&token=10b2f648e496015c7e8f4d82caade52b02d9905d',
        'gzk3' => 'http://api.caipiaokong.cn/lottery/?name=gzks&format=json&uid=973140&token=10b2f648e496015c7e8f4d82caade52b02d9905d',
        'hebeik3' => 'http://api.caipiaokong.cn/lottery/?name=hbks&format=json&uid=973140&token=10b2f648e496015c7e8f4d82caade52b02d9905d',
        'hbk3' => 'http://api.caipiaokong.cn/lottery/?name=hubks&format=json&uid=973140&token=10b2f648e496015c7e8f4d82caade52b02d9905d',
        'jsk3' => 'http://api.caipiaokong.cn/lottery/?name=jsks&format=json&uid=973140&token=10b2f648e496015c7e8f4d82caade52b02d9905d',
        'xync' => 'http://vip.jiangyuan365.com/K25ae456c03d2df/cqxync-5.json',
        'gdkl10' => 'http://vip.jiangyuan365.com/K25ae456c03d2df/gdkl10-5.json',
    ];

    //强转整形
    public function strongConversionInt($aParam){
        $aArray = [];
        foreach ($aParam as $value){
            $aArray[] = (int)$value;
        }
        return implode(',',$aArray);
    }

    //幸运六合彩
    public function xylhc($arrCode){
        $arrCode = explode(',',$arrCode);
        return [
            'code' => 200,
            'data'=> [],
            'status' => true,
            'openCode' => $this->strongConversionInt($arrCode),
            'n1' => (int)$arrCode[0],
            'n2' => (int)$arrCode[1],
            'n3' => (int)$arrCode[2],
            'n4' => (int)$arrCode[3],
            'n5' => (int)$arrCode[4],
            'n6' => (int)$arrCode[5],
            'n7' => (int)$arrCode[6],
        ];
    }


    //秒速快3
    public function msjsk3($arrCode){
        $arrCode = explode(',',$arrCode);
        return [
            'code' => 200,
            'data'=> [],
            'status' => true,
            'openCode' => $this->strongConversionInt($arrCode),
            'n1' => (int)$arrCode[0],
            'n2' => (int)$arrCode[1],
            'n3' => (int)$arrCode[2],
        ];
    }

    //秒速时时彩
    public function jsssc($arrCode){
        $arrCode = explode(',',$arrCode);
        return [
            'code' => 200,
            'data'=> [],
            'status' => true,
            'openCode' => $this->strongConversionInt($arrCode),
            'n1' => (int)$arrCode[0],
            'n2' => (int)$arrCode[1],
            'n3' => (int)$arrCode[2],
            'n4' => (int)$arrCode[3],
            'n5' => (int)$arrCode[4],
        ];
    }
    //重庆幸运农场
    public function xync($aJson,$issue){
        $arrCode = '';
        foreach ($aJson as $iJson){
            if($iJson['officialissue'] == $issue){
                $arrCode = $iJson['code'];
            }
        }
        if(empty($arrCode))
            return [
                'code'=> '201',
                'status' => false,
                'msg' => '获取失败，原因1.本期暂未开奖'
            ];

        $arrCode = explode(',',$arrCode);
        return [
            'code' => 200,
            'data'=> [],
            'status' => true,
            'openCode' => $this->strongConversionInt($arrCode),
            'n1' => (int)$arrCode[0],
            'n2' => (int)$arrCode[1],
            'n3' => (int)$arrCode[2],
            'n4' => (int)$arrCode[3],
            'n5' => (int)$arrCode[4],
            'n6' => (int)$arrCode[5],
            'n7' => (int)$arrCode[6],
            'n8' => (int)$arrCode[7],
        ];
    }
    //广东快乐十分
    public function gdkl10($aJson,$issue){
        $arrCode = '';
        foreach ($aJson as $iJson){
            if($iJson['issue'] == $issue){
                $arrCode = $iJson['code'];
            }
        }
        if(empty($arrCode))
            return [
                'code'=> '201',
                'status' => false,
                'msg' => '获取失败，原因1.本期暂未开奖'
            ];

        $arrCode = explode(',',$arrCode);
        return [
            'code' => 200,
            'data'=> [],
            'status' => true,
            'openCode' => $this->strongConversionInt($arrCode),
            'n1' => (int)$arrCode[0],
            'n2' => (int)$arrCode[1],
            'n3' => (int)$arrCode[2],
            'n4' => (int)$arrCode[3],
            'n5' => (int)$arrCode[4],
            'n6' => (int)$arrCode[5],
            'n7' => (int)$arrCode[6],
            'n8' => (int)$arrCode[7],
        ];
    }

    //祥光跑马
    public function paoma($arrCode){
        $arrCode = explode(',',$arrCode);
        return [
            'code' => 200,
            'data'=> [],
            'status' => true,
            'openCode' => $this->strongConversionInt($arrCode),
            'n1' => (int)$arrCode[0],
            'n2' => (int)$arrCode[1],
            'n3' => (int)$arrCode[2],
            'n4' => (int)$arrCode[3],
            'n5' => (int)$arrCode[4],
            'n6' => (int)$arrCode[5],
            'n7' => (int)$arrCode[6],
            'n8' => (int)$arrCode[7],
            'n9' => (int)$arrCode[8],
            'n10' => (int)$arrCode[9],
        ];
    }

    //秒速飞艇
    public function jsft($arrCode){
        $arrCode = explode(',',$arrCode);
        return [
            'code' => 200,
            'data'=> [],
            'status' => true,
            'openCode' => $this->strongConversionInt($arrCode),
            'n1' => (int)$arrCode[0],
            'n2' => (int)$arrCode[1],
            'n3' => (int)$arrCode[2],
            'n4' => (int)$arrCode[3],
            'n5' => (int)$arrCode[4],
            'n6' => (int)$arrCode[5],
            'n7' => (int)$arrCode[6],
            'n8' => (int)$arrCode[7],
            'n9' => (int)$arrCode[8],
            'n10' => (int)$arrCode[9],
        ];
    }

    //秒速赛车
    public function jspk10($arrCode){
        $arrCode = explode(',',$arrCode);
        return [
            'code' => 200,
            'data'=> [],
            'status' => true,
            'openCode' => $this->strongConversionInt($arrCode),
            'n1' => (int)$arrCode[0],
            'n2' => (int)$arrCode[1],
            'n3' => (int)$arrCode[2],
            'n4' => (int)$arrCode[3],
            'n5' => (int)$arrCode[4],
            'n6' => (int)$arrCode[5],
            'n7' => (int)$arrCode[6],
            'n8' => (int)$arrCode[7],
            'n9' => (int)$arrCode[8],
            'n10' => (int)$arrCode[9],
        ];
    }

    //江苏快3开奖
    public function jsk3($aJson,$issue){
        if(empty($aJson[$issue])){
            return [
                'code'=> '201',
                'status' => false,
                'msg' => '获取失败，原因1.本期暂未开奖'
            ];
        }
        $result = $aJson[$issue];
        $arrCode = explode(',',$result['number']);
        return [
            'code' => 200,
            'data'=> $aJson,
            'status' => true,
            'openCode' => $this->strongConversionInt($arrCode),
            'n1' => (int)$arrCode[0],
            'n2' => (int)$arrCode[1],
            'n3' => (int)$arrCode[2],
        ];
    }

    //湖北快3
    public function hbk3($aJson,$issue){
        if(empty($aJson[$issue])){
            return [
                'code'=> '201',
                'status' => false,
                'msg' => '获取失败，原因1.本期暂未开奖'
            ];
        }
        $result = $aJson[$issue];
        $arrCode = explode(',',$result['number']);
        return [
            'code' => 200,
            'data'=> $aJson,
            'status' => true,
            'openCode' => $this->strongConversionInt($arrCode),
            'n1' => (int)$arrCode[0],
            'n2' => (int)$arrCode[1],
            'n3' => (int)$arrCode[2],
        ];
    }

    //河北快3开奖
    public function hebeik3($aJson,$issue){
        if(empty($aJson[$issue])){
            return [
                'code'=> '201',
                'status' => false,
                'msg' => '获取失败，原因1.本期暂未开奖'
            ];
        }
        $result = $aJson[$issue];
        $arrCode = explode(',',$result['number']);
        return [
            'code' => 200,
            'data'=> $aJson,
            'status' => true,
            'openCode' => $this->strongConversionInt($arrCode),
            'n1' => (int)$arrCode[0],
            'n2' => (int)$arrCode[1],
            'n3' => (int)$arrCode[2],
        ];
    }

    //贵州快3开奖
    public function gzk3($aJson,$issue){
        if(empty($aJson[$issue])){
            return [
                'code'=> '201',
                'status' => false,
                'msg' => '获取失败，原因1.本期暂未开奖'
            ];
        }
        $result = $aJson[$issue];
        $arrCode = explode(',',$result['number']);
        return [
            'code' => 200,
            'data'=> $aJson,
            'status' => true,
            'openCode' => $this->strongConversionInt($arrCode),
            'n1' => (int)$arrCode[0],
            'n2' => (int)$arrCode[1],
            'n3' => (int)$arrCode[2],
        ];
    }

    //广西快3
    public function gxk3($aJson,$issue){
        if(empty($aJson[$issue])){
            return [
                'code'=> '201',
                'status' => false,
                'msg' => '获取失败，原因1.本期暂未开奖'
            ];
        }
        $result = $aJson[$issue];
        $arrCode = explode(',',$result['number']);
        return [
            'code' => 200,
            'data'=> $aJson,
            'status' => true,
            'openCode' => $this->strongConversionInt($arrCode),
            'n1' => (int)$arrCode[0],
            'n2' => (int)$arrCode[1],
            'n3' => (int)$arrCode[2],
        ];
    }

    //广东11选5开奖
    public function gd11x5($aJson,$issue){
        if(empty($aJson[$issue])){
            return [
                'code'=> '201',
                'status' => false,
                'msg' => '获取失败，原因1.本期暂未开奖'
            ];
        }
        $result = $aJson[$issue];
        $arrCode = explode(',',$result['number']);
        return [
            'code' => 200,
            'data'=> $aJson,
            'status' => true,
            'openCode' => $this->strongConversionInt($arrCode),
            'n1' => (int)$arrCode[0],
            'n2' => (int)$arrCode[1],
            'n3' => (int)$arrCode[2],
            'n4' => (int)$arrCode[3],
            'n5' => (int)$arrCode[4],
        ];
    }

    //甘肃快3开奖
    public function gsk3($aJson,$issue){
        if(empty($aJson[$issue])){
            return [
                'code'=> '201',
                'status' => false,
                'msg' => '获取失败，原因1.本期暂未开奖'
            ];
        }
        $result = $aJson[$issue];
        $arrCode = explode(',',$result['number']);
        return [
            'code' => 200,
            'data'=> $aJson,
            'status' => true,
            'openCode' => $this->strongConversionInt($arrCode),
            'n1' => (int)$arrCode[0],
            'n2' => (int)$arrCode[1],
            'n3' => (int)$arrCode[2],
        ];
    }

    //北京pk10开奖
    public function pk10($aJson,$issue){
        if(empty($aJson[$issue])){
            return [
                'code'=> '201',
                'status' => false,
                'msg' => '获取失败，原因1.本期暂未开奖'
            ];
        }
        $result = $aJson[$issue];
        $arrCode = explode(',',$result['number']);
        return [
            'code' => 200,
            'data'=> $aJson,
            'status' => true,
            'openCode' => $this->strongConversionInt($arrCode),
            'n1' => (int)$arrCode[0],
            'n2' => (int)$arrCode[1],
            'n3' => (int)$arrCode[2],
            'n4' => (int)$arrCode[3],
            'n5' => (int)$arrCode[4],
            'n6' => (int)$arrCode[5],
            'n7' => (int)$arrCode[6],
            'n8' => (int)$arrCode[7],
            'n9' => (int)$arrCode[8],
            'n10' => (int)$arrCode[9],
        ];
    }

    //北京快乐8开奖
    public function bjkl8($aJson,$issue){
        if(empty($aJson[$issue])){
            return [
                'code'=> '201',
                'status' => false,
                'msg' => '获取失败，原因1.本期暂未开奖'
            ];
        }
        $result = $aJson[$issue];
        $arrCode = explode(',',$result['number']);
        return [
            'code' => 200,
            'data'=> $aJson,
            'status' => true,
            'openCode' => substr($result['number'],0,strripos($result['number'],',')),
            'n1' => (int)$arrCode[0],
            'n2' => (int)$arrCode[1],
            'n3' => (int)$arrCode[2],
            'n4' => (int)$arrCode[3],
            'n5' => (int)$arrCode[4],
            'n6' => (int)$arrCode[5],
            'n7' => (int)$arrCode[6],
            'n8' => (int)$arrCode[7],
            'n9' => (int)$arrCode[8],
            'n10' => (int)$arrCode[9],
            'n11' => (int)$arrCode[10],
            'n12' => (int)$arrCode[11],
            'n13' => (int)$arrCode[12],
            'n14' => (int)$arrCode[13],
            'n15' => (int)$arrCode[14],
            'n16' => (int)$arrCode[15],
            'n17' => (int)$arrCode[16],
            'n18' => (int)$arrCode[17],
            'n19' => (int)$arrCode[18],
            'n20' => (int)$arrCode[19],
        ];
    }

    //重庆时时彩开奖
    public function cqssc($aJson,$issue){
        if(empty($aJson[$issue])){
            return [
                'code'=> '201',
                'status' => false,
                'msg' => '获取失败，原因1.本期暂未开奖'
            ];
        }
        $result = $aJson[$issue];
        $arrCode = explode(',',$result['number']);
        return [
            'code' => 200,
            'data'=> $aJson,
            'status' => true,
            'openCode' => $this->strongConversionInt($arrCode),
            'n1' => (int)$arrCode[0],
            'n2' => (int)$arrCode[1],
            'n3' => (int)$arrCode[2],
            'n4' => (int)$arrCode[3],
            'n5' => (int)$arrCode[4],
        ];
    }

    //六合彩开奖
    public function lhc($json,$issue)
    {
        $num_str = '';
        foreach ($json as $k => $v){
            $num_str .= $v['number'];
        }
        $arrCode = explode(',',$num_str);
        return [
            'code' => 200,
            'data'=> $json,
            'status' => true,
            'openCode' => $num_str,
            'n1' => (int)$arrCode[0],
            'n2' => (int)$arrCode[1],
            'n3' => (int)$arrCode[2],
            'n4' => (int)$arrCode[3],
            'n5' => (int)$arrCode[4],
            'n6' => (int)$arrCode[5],
            'n7' => (int)$arrCode[6],
        ];
    }
}
