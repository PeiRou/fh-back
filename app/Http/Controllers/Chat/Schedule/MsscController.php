<?php

namespace App\Http\Controllers\Chat\Schedule;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Redis;
use App\Http\Controllers\Chat\Home\PlatcfgController;
use Illuminate\Support\Facades\Cache;
use App\Models\Chat\Schedule;

class MsscController extends Controller
{
    protected $platcfg;
    private   $type = '秒速赛车';
    public function __construct(PlatcfgController $platcfg){
        $this->platcfg  = $platcfg;
    }
    public function index(Request $request){
        if($this->platcfg->is_open && $this->platcfg->schedule_type() && in_array($this->type,$this->platcfg->schedule_games())){
            if($request->get('key')==='Mssc'){
                $opencode = explode(',',$request->get('opencode'));
                $expect = substr($request->get('expect'),6,3);
                $guanSchedule = $this->getGuanSchedule($opencode,$expect,'Guan');
                $guanScheduleRecord = Schedule::where('type','猜冠军定位胆')->orderBy('id','DESC')->offset(0)->limit(5)->pluck('content')->implode('</br>');
                $ysSchedule = $this->getGuanSchedule($opencode,$expect,'Ya');
                $ysScheduleRecord = Schedule::where('type','猜亚军定位胆')->orderBy('id','DESC')->offset(0)->limit(5)->pluck('content')->implode('</br>');
                $content = "$guanScheduleRecord</br>$guanSchedule</br>
                            --------------------</br>
                            $ysScheduleRecord</br>$ysSchedule</br>
                            $this->type"."第【".$expect."】期 开奖号码【".implode(',',$opencode)."】 开奖时间【".$request->get('opentime')."】";
                Redis::publish('chat-system',
                    json_encode([
                        'schedule' => 'mssc',
                        'content' => $content."</br>".$this->platcfg->schedule_msg,
                        'date'    => date('H:i:s')
                    ])
                );
//                return 'SUCCEED';
            }
        }
    }

    public function getGuanSchedule($opencode,$expect,$type){
        $_scheduleType = $type==='Guan'?'猜冠军定位胆':'猜亚军定位胆';
        if(!Cache::has($type)){
            $scheduleArr = $this->getScheduleNum($expect);
        }else{
            if(end(Cache::get($type)['expect'])===$expect){    //如果是最后一期， 重新获取
                $checkResult = $this->checkerNum($opencode,Cache::get($type),$expect,'a');
                if($checkResult['checker']>0){
                    $_str = $checkResult['last_checker_expect']." 期 开".$checkResult['opencode']." 中 ".$checkResult['checker']." 中 ";
                }else{
                    $_str = end($checkResult['expect'])." 期 开".$checkResult['opencode']." 错 ";
                }
                Schedule::create([
                    'type'      => $_scheduleType,
                    'content'   => reset($checkResult['expect'])."-".end($checkResult['expect'])." 期 ".$_scheduleType." 【 ".$checkResult['schedule_num']." 】".$_str
                ]);
                $scheduleArr = $this->getScheduleNum($expect);
            }else{
                $scheduleArr = Cache::get($type);
            }
        }
        $scheduleArr = $this->checkerNum($opencode,$scheduleArr,$expect,'1');
        $_key = array_search($expect,$scheduleArr['expect']);
        $scheduleIng    = $_key===false?$_key+1:$_key+2;
        $str = reset($scheduleArr['expect'])."-".end($scheduleArr['expect'])." 期 ".$_scheduleType." 【 ".$scheduleArr['schedule_num']." 】 进行中[".$scheduleIng."]";
        Cache::forever($type,$scheduleArr);
        return $str;
    }

    public function getScheduleNum($expect){
        $numArr = ['01','02','03','04','05','06','07','08','09','10'];
        $random = collect($numArr)->random(5)->implode(' ');
        $_scheduleArr = Collection::times(3, function ($number) use ($expect){
            if($expect==='001'){
                return sprintf('%03d',$number);
            }else{
                return sprintf('%03d',$number+$expect);
            }
        });
        $scheduleArr = [
            'expect'        =>  $_scheduleArr->toArray(),
            'schedule_num'  =>  $random,
            'checker'       =>  0,
            'opencode'      =>  '',
            'last_checker_expect'=> ''
        ];
        return $scheduleArr;
    }

    public function checkerNum($codeArr,$scheduleArr,$_expect,$last=false){
        $_scheduleCodeArr = explode(' ',$scheduleArr['schedule_num']);
        if(in_array($codeArr[0],$_scheduleCodeArr)){
            $newScheduleArr['checker']              = $scheduleArr['checker']+1;
            $newScheduleArr ['last_checker_expect'] = $_expect;

        }else{
            $newScheduleArr['checker']              = $scheduleArr['checker'];
            $newScheduleArr ['last_checker_expect'] = $scheduleArr['last_checker_expect'];
        }
        $newScheduleArr ['expect']       = $scheduleArr['expect'];
        $newScheduleArr ['schedule_num'] = $scheduleArr['schedule_num'];
        $newScheduleArr ['opencode']     = reset($codeArr);
        return $newScheduleArr;
    }


}