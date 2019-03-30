<?php

namespace App\Jobs;

use App\Excel;
use App\Games;
use App\Http\Controllers\Back\OpenData\OpenApiGetController;
use App\Http\Controllers\Back\OpenHistoryController;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class LotteryOneClick implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $aParam;

    private $gameType;

    private $type;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($aParam,$gameType,$type)
    {
        $this->aParam = $aParam;
        $this->gameType = $gameType;
        $this->type = $type;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $aCategory = Games::$aCodeCategory;
        $category = '';
        foreach ($aCategory as $kCategory => $iCategory){
            if(in_array($this->type,$iCategory))
                $category = $kCategory;
        }
        if(empty($category)) return false;
        switch ($category){
            case 'sc':
                $this->addscData();
                break;
        }
    }


    //添加赛车开奖数据
    public function addscData(){
        $table = 'game_'.$this->gameType;

        $openAPI = new OpenApiGetController();
        $openExcel = new Excel();
        if(in_array($this->type,$openAPI->apiArray))
            $openNum = $openExcel->getGuanIssueNum($this->aParam->issue,$this->type);
        else {
            $openNum = $openExcel->opennum($table);
        }
        Log::info($openNum);
        if(empty($openNum)){
            return false;
        }
        $data = [
            'opennum' => $openNum,
            'year'=> date('Y',strtotime($this->aParam->opentime)),
            'month'=> date('m',strtotime($this->aParam->opentime)),
            'day'=>  date('d',strtotime($this->aParam->opentime)),
            'is_open' => 1
        ];
        DB::table($table)->where('id',$this->aParam->id)->update($data);
//        //处理牛牛
        if($table == 'game_mssc'){//秒速赛车
            $niuniu = $this->exePK10nn($openNum);
            $data['niuniu'] =$this->openHistory->nn($niuniu[0]).','.$this->nn($niuniu[1]).','.$this->nn($niuniu[2]).','.$this->nn($niuniu[3]).','.$this->nn($niuniu[4]).','.$this->nn($niuniu[5]);
        }
        if($this->gameType == 'game_bjpk10'){//北京pk10
            //不能有两个以上相同的数
            $openNumArr =  explode(',',$openNum);
            $openNumArr1 = array_unique($openNumArr);
            if(count($openNumArr1) < count($openNumArr)){
                return response()->json(['status' => false,'msg' => '请勿提交重复号码']);
            }
            $niuniu = $this->exePK10nn($openNum);
            $data['niuniu'] =$this->nn($niuniu[0]).','.$this->nn($niuniu[1]).','.$this->nn($niuniu[2]).','.$this->nn($niuniu[3]).','.$this->nn($niuniu[4]).','.$this->nn($niuniu[5]);
            DB::table('game_pknn')->where('issue',$this->aParam->issue)->update($data);
        }
    }
}
