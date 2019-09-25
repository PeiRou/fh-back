<?php

namespace App\Http\Controllers\Bet;

use App\Excel;
use App\ExcelLotteryNC;
use App\Http\Controllers\Job\AgentBackwaterJob;
use Illuminate\Support\Facades\DB;

class New_gdklsf extends Excel
{
    protected $arrPlay_id = array(6053603,6053604,6053605,6053606,6053607,6053608,6054609,6054610,6054611,6054612,6054613,6054614,6054615,6054616,6054617,6054618,6054619,6054620,6054621,6054622,6054623,6054624,6054625,6054626,6054627,6054628,6054629,6054630,6054631,6054632,6054633,6054634,6054635,6054636,6054637,6054638,6054639,6054640,6054641,6054642,6054643,6054644,6054645,6055646,6055647,6055648,6055649,6055650,6055651,6055652,6055653,6055654,6055655,6055656,6055657,6055658,6055659,6055660,6055661,6055662,6055663,6055664,6055665,6055666,6055667,6055668,6055669,6055670,6055671,6055672,6055673,6055674,6055675,6055676,6055677,6055678,6055679,6055680,6055681,6055682,6056683,6056684,6056685,6056686,6056687,6056688,6056689,6056690,6056691,6056692,6056693,6056694,6056695,6056696,6056697,6056698,6056699,6056700,6056701,6056702,6056703,6056704,6056705,6056706,6056707,6056708,6056709,6056710,6056711,6056712,6056713,6056714,6056715,6056716,6056717,6056718,6056719,6057720,6057721,6057722,6057723,6057724,6057725,6057726,6057727,6057728,6057729,6057730,6057731,6057732,6057733,6057734,6057735,6057736,6057737,6057738,6057739,6057740,6057741,6057742,6057743,6057744,6057745,6057746,6057747,6057748,6057749,6057750,6057751,6057752,6057753,6057754,6057755,6057756,6058757,6058758,6058759,6058760,6058761,6058762,6058763,6058764,6058765,6058766,6058767,6058768,6058769,6058770,6058771,6058772,6058773,6058774,6058775,6058776,6058777,6058778,6058779,6058780,6058781,6058782,6058783,6058784,6058785,6058786,6058787,6058788,6058789,6058790,6058791,6058792,6058793,6059794,6059795,6059796,6059797,6059798,6059799,6059800,6059801,6059802,6059803,6059804,6059805,6059806,6059807,6059808,6059809,6059810,6059811,6059812,6059813,6059814,6059815,6059816,6059817,6059818,6059819,6059820,6059821,6059822,6059823,6059824,6059825,6059826,6059827,6059828,6059829,6059830,6060831,6060832,6060833,6060834,6060835,6060836,6060837,6060838,6060839,6060840,6060841,6060842,6060843,6060844,6060845,6060846,6060847,6060848,6060849,6060850,6060851,6060852,6060853,6060854,6060855,6060856,6060857,6060858,6060859,6060860,6060861,6060862,6060863,6060864,6060865,6060866,6060867,6061868,6061869,6061870,6061871,6061872,6061873,6061874,6061875,6061876,6061877,6061878,6061879,6061880,6061881,6061882,6061883,6061884,6061885,6061886,6061887,6061888,6061889,6061890,6061891,6061892,6061893,6061894,6061895,6061896,6061897,6061898,6061899,6061900,6061901,6061902,6061903,6061904,6062905,6062906,6062907,6062908,6062909,6062910,6062911,6062912,6062913,6062914,6062915,6062916,6062917,6062918,6062919,6062920,6062921,6062922,6062923,6062924,6063925,6063926,6063927,6063928,6063929,6063930);
    protected $arrPlayCate = array(
        'ZH' => 53,
        'QIU1' => 54,
        'QIU2' => 55,
        'QIU3' => 56,
        'QIU4' => 57,
        'QIU5' => 58,
        'QIU6' => 59,
        'QIU7' => 60,
        'QIU8' => 61,
        'ZM' => 62,
        'LM' => 63,
    );
    protected $arrPlayId = array(
        'ZONGHEDA' => 603,
        'ZONGHEXIAO' => 604,
        'ZONGHEDAN' => 605,
        'ZONGHESHUANG' => 606,
        'ZONGHEWEIDA' => 607,
        'ZONGHEWEIXIAO' => 608,
        'DIYIQIU1' => 609,
        'DIYIQIU2' => 610,
        'DIYIQIU3' => 611,
        'DIYIQIU4' => 612,
        'DIYIQIU5' => 613,
        'DIYIQIU6' => 614,
        'DIYIQIU7' => 615,
        'DIYIQIU8' => 616,
        'DIYIQIU9' => 617,
        'DIYIQIU10' => 618,
        'DIYIQIU11' => 619,
        'DIYIQIU12' => 620,
        'DIYIQIU13' => 621,
        'DIYIQIU14' => 622,
        'DIYIQIU15' => 623,
        'DIYIQIU16' => 624,
        'DIYIQIU17' => 625,
        'DIYIQIU18' => 626,
        'DIYIQIU19' => 627,
        'DIYIQIU20' => 628,
        'DIYIQIUDA' => 629,
        'DIYIQIUXIAO' => 630,
        'DIYIQIUDAN' => 631,
        'DIYIQIUSHUANG' => 632,
        'DIYIQIUWEIDA' => 633,
        'DIYIQIUWEIXIAO' => 634,
        'DIYIQIUHESHUDAN' => 635,
        'DIYIQIUHESHUSHUANG' => 636,
        'DIYIQIUDONG' => 637,
        'DIYIQIUNAN' => 638,
        'DIYIQIUXI' => 639,
        'DIYIQIUBEI' => 640,
        'DIYIQIUZHONG' => 641,
        'DIYIQIUFA' => 642,
        'DIYIQIUBAI' => 643,
        'DIYIQIULONG' => 644,
        'DIYIQIUHU' => 645,
        'DIERQIU1' => 646,
        'DIERQIU2' => 647,
        'DIERQIU3' => 648,
        'DIERQIU4' => 649,
        'DIERQIU5' => 650,
        'DIERQIU6' => 651,
        'DIERQIU7' => 652,
        'DIERQIU8' => 653,
        'DIERQIU9' => 654,
        'DIERQIU10' => 655,
        'DIERQIU11' => 656,
        'DIERQIU12' => 657,
        'DIERQIU13' => 658,
        'DIERQIU14' => 659,
        'DIERQIU15' => 660,
        'DIERQIU16' => 661,
        'DIERQIU17' => 662,
        'DIERQIU18' => 663,
        'DIERQIU19' => 664,
        'DIERQIU20' => 665,
        'DIERQIUDA' => 666,
        'DIERQIUXIAO' => 667,
        'DIERQIUDAN' => 668,
        'DIERQIUSHUANG' => 669,
        'DIERQIUWEIDA' => 670,
        'DIERQIUWEIXIAO' => 671,
        'DIERQIUHESHUDAN' => 672,
        'DIERQIUHESHUSHUANG' => 673,
        'DIERQIUDONG' => 674,
        'DIERQIUNAN' => 675,
        'DIERQIUXI' => 676,
        'DIERQIUBEI' => 677,
        'DIERQIUZHONG' => 678,
        'DIERQIUFA' => 679,
        'DIERQIUBAI' => 680,
        'DIERQIULONG' => 681,
        'DIERQIUHU' => 682,
        'DISANQIU1' => 683,
        'DISANQIU2' => 684,
        'DISANQIU3' => 685,
        'DISANQIU4' => 686,
        'DISANQIU5' => 687,
        'DISANQIU6' => 688,
        'DISANQIU7' => 689,
        'DISANQIU8' => 690,
        'DISANQIU9' => 691,
        'DISANQIU10' => 692,
        'DISANQIU11' => 693,
        'DISANQIU12' => 694,
        'DISANQIU13' => 695,
        'DISANQIU14' => 696,
        'DISANQIU15' => 697,
        'DISANQIU16' => 698,
        'DISANQIU17' => 699,
        'DISANQIU18' => 700,
        'DISANQIU19' => 701,
        'DISANQIU20' => 702,
        'DISANQIUDA' => 703,
        'DISANQIUXIAO' => 704,
        'DISANQIUDAN' => 705,
        'DISANQIUSHUANG' => 706,
        'DISANQIUWEIDA' => 707,
        'DISANQIUWEIXIAO' => 708,
        'DISANQIUHESHUDAN' => 709,
        'DISANQIUHESHUSHUANG' => 710,
        'DISANQIUDONG' => 711,
        'DISANQIUNAN' => 712,
        'DISANQIUXI' => 713,
        'DISANQIUBEI' => 714,
        'DISANQIUZHONG' => 715,
        'DISANQIUFA' => 716,
        'DISANQIUBAI' => 717,
        'DISANQIULONG' => 718,
        'DISANQIUHU' => 719,
        'DISIQIU1' => 720,
        'DISIQIU2' => 721,
        'DISIQIU3' => 722,
        'DISIQIU4' => 723,
        'DISIQIU5' => 724,
        'DISIQIU6' => 725,
        'DISIQIU7' => 726,
        'DISIQIU8' => 727,
        'DISIQIU9' => 728,
        'DISIQIU10' => 729,
        'DISIQIU11' => 730,
        'DISIQIU12' => 731,
        'DISIQIU13' => 732,
        'DISIQIU14' => 733,
        'DISIQIU15' => 734,
        'DISIQIU16' => 735,
        'DISIQIU17' => 736,
        'DISIQIU18' => 737,
        'DISIQIU19' => 738,
        'DISIQIU20' => 739,
        'DISIQIUDA' => 740,
        'DISIQIUXIAO' => 741,
        'DISIQIUDAN' => 742,
        'DISIQIUSHUANG' => 743,
        'DISIQIUWEIDA' => 744,
        'DISIQIUWEIXIAO' => 745,
        'DISIQIUHESHUDAN' => 746,
        'DISIQIUHESHUSHUANG' => 747,
        'DISIQIUDONG' => 748,
        'DISIQIUNAN' => 749,
        'DISIQIUXI' => 750,
        'DISIQIUBEI' => 751,
        'DISIQIUZHONG' => 752,
        'DISIQIUFA' => 753,
        'DISIQIUBAI' => 754,
        'DISIQIULONG' => 755,
        'DISIQIUHU' => 756,
        'DIWUQIU1' => 757,
        'DIWUQIU2' => 758,
        'DIWUQIU3' => 759,
        'DIWUQIU4' => 760,
        'DIWUQIU5' => 761,
        'DIWUQIU6' => 762,
        'DIWUQIU7' => 763,
        'DIWUQIU8' => 764,
        'DIWUQIU9' => 765,
        'DIWUQIU10' => 766,
        'DIWUQIU11' => 767,
        'DIWUQIU12' => 768,
        'DIWUQIU13' => 769,
        'DIWUQIU14' => 770,
        'DIWUQIU15' => 771,
        'DIWUQIU16' => 772,
        'DIWUQIU17' => 773,
        'DIWUQIU18' => 774,
        'DIWUQIU19' => 775,
        'DIWUQIU20' => 776,
        'DIWUQIUDA' => 777,
        'DIWUQIUXIAO' => 778,
        'DIWUQIUDAN' => 779,
        'DIWUQIUSHUANG' => 780,
        'DIWUQIUWEIDA' => 781,
        'DIWUQIUWEIXIAO' => 782,
        'DIWUQIUHESHUDAN' => 783,
        'DIWUQIUHESHUSHUANG' => 784,
        'DIWUQIUDONG' => 785,
        'DIWUQIUNAN' => 786,
        'DIWUQIUXI' => 787,
        'DIWUQIUBEI' => 788,
        'DIWUQIUZHONG' => 789,
        'DIWUQIUFA' => 790,
        'DIWUQIUBAI' => 791,
        'DIWUQIULONG' => 792,
        'DIWUQIUHU' => 793,
        'DILIUQIU1' => 794,
        'DILIUQIU2' => 795,
        'DILIUQIU3' => 796,
        'DILIUQIU4' => 797,
        'DILIUQIU5' => 798,
        'DILIUQIU6' => 799,
        'DILIUQIU7' => 800,
        'DILIUQIU8' => 801,
        'DILIUQIU9' => 802,
        'DILIUQIU10' => 803,
        'DILIUQIU11' => 804,
        'DILIUQIU12' => 805,
        'DILIUQIU13' => 806,
        'DILIUQIU14' => 807,
        'DILIUQIU15' => 808,
        'DILIUQIU16' => 809,
        'DILIUQIU17' => 810,
        'DILIUQIU18' => 811,
        'DILIUQIU19' => 812,
        'DILIUQIU20' => 813,
        'DILIUQIUDA' => 814,
        'DILIUQIUXIAO' => 815,
        'DILIUQIUDAN' => 816,
        'DILIUQIUSHUANG' => 817,
        'DILIUQIUWEIDA' => 818,
        'DILIUQIUWEIXIAO' => 819,
        'DILIUQIUHESHUDAN' => 820,
        'DILIUQIUHESHUSHUANG' => 821,
        'DILIUQIUDONG' => 822,
        'DILIUQIUNAN' => 823,
        'DILIUQIUXI' => 824,
        'DILIUQIUBEI' => 825,
        'DILIUQIUZHONG' => 826,
        'DILIUQIUFA' => 827,
        'DILIUQIUBAI' => 828,
        'DILIUQIULONG' => 829,
        'DILIUQIUHU' => 830,
        'DIQIQIU1' => 831,
        'DIQIQIU2' => 832,
        'DIQIQIU3' => 833,
        'DIQIQIU4' => 834,
        'DIQIQIU5' => 835,
        'DIQIQIU6' => 836,
        'DIQIQIU7' => 837,
        'DIQIQIU8' => 838,
        'DIQIQIU9' => 839,
        'DIQIQIU10' => 840,
        'DIQIQIU11' => 841,
        'DIQIQIU12' => 842,
        'DIQIQIU13' => 843,
        'DIQIQIU14' => 844,
        'DIQIQIU15' => 845,
        'DIQIQIU16' => 846,
        'DIQIQIU17' => 847,
        'DIQIQIU18' => 848,
        'DIQIQIU19' => 849,
        'DIQIQIU20' => 850,
        'DIQIQIUDA' => 851,
        'DIQIQIUXIAO' => 852,
        'DIQIQIUDAN' => 853,
        'DIQIQIUSHUANG' => 854,
        'DIQIQIUWEIDA' => 855,
        'DIQIQIUWEIXIAO' => 856,
        'DIQIQIUHESHUDAN' => 857,
        'DIQIQIUHESHUSHUANG' => 858,
        'DIQIQIUDONG' => 859,
        'DIQIQIUNAN' => 860,
        'DIQIQIUXI' => 861,
        'DIQIQIUBEI' => 862,
        'DIQIQIUZHONG' => 863,
        'DIQIQIUFA' => 864,
        'DIQIQIUBAI' => 865,
        'DIQIQIULONG' => 866,
        'DIQIQIUHU' => 867,
        'DIBAQIU1' => 868,
        'DIBAQIU2' => 869,
        'DIBAQIU3' => 870,
        'DIBAQIU4' => 871,
        'DIBAQIU5' => 872,
        'DIBAQIU6' => 873,
        'DIBAQIU7' => 874,
        'DIBAQIU8' => 875,
        'DIBAQIU9' => 876,
        'DIBAQIU10' => 877,
        'DIBAQIU11' => 878,
        'DIBAQIU12' => 879,
        'DIBAQIU13' => 880,
        'DIBAQIU14' => 881,
        'DIBAQIU15' => 882,
        'DIBAQIU16' => 883,
        'DIBAQIU17' => 884,
        'DIBAQIU18' => 885,
        'DIBAQIU19' => 886,
        'DIBAQIU20' => 887,
        'DIBAQIUDA' => 888,
        'DIBAQIUXIAO' => 889,
        'DIBAQIUDAN' => 890,
        'DIBAQIUSHUANG' => 891,
        'DIBAQIUWEIDA' => 892,
        'DIBAQIUWEIXIAO' => 893,
        'DIBAQIUHESHUDAN' => 894,
        'DIBAQIUHESHUSHUANG' => 895,
        'DIBAQIUDONG' => 896,
        'DIBAQIUNAN' => 897,
        'DIBAQIUXI' => 898,
        'DIBAQIUBEI' => 899,
        'DIBAQIUZHONG' => 900,
        'DIBAQIUFA' => 901,
        'DIBAQIUBAI' => 902,
        'DIBAQIULONG' => 903,
        'DIBAQIUHU' => 904,
        'ZHENGMA1' => 905,
        'ZHENGMA2' => 906,
        'ZHENGMA3' => 907,
        'ZHENGMA4' => 908,
        'ZHENGMA5' => 909,
        'ZHENGMA6' => 910,
        'ZHENGMA7' => 911,
        'ZHENGMA8' => 912,
        'ZHENGMA9' => 913,
        'ZHENGMA10' => 914,
        'ZHENGMA11' => 915,
        'ZHENGMA12' => 916,
        'ZHENGMA13' => 917,
        'ZHENGMA14' => 918,
        'ZHENGMA15' => 919,
        'ZHENGMA16' => 920,
        'ZHENGMA17' => 921,
        'ZHENGMA18' => 922,
        'ZHENGMA19' => 923,
        'ZHENGMA20' => 924,
        'RENXUANER' => 925,
        'XUANERLIANZU' => 926,
        'RENXUANSAN' => 927,
        'XUANSANQIANZU' => 928,
        'RENXUANSI' => 929,
        'RENXUANWU' => 930,
    );

    protected function exc_play($openCode,$gameId)
    {
        $win = collect([]);
        $ids_he = collect([]);
        $NC = new ExcelLotteryNC();
        $NC->setArrPlay($openCode,$this->arrPlayCate,$this->arrPlayId);
        $NC->LM($gameId,$win,$ids_he);
        $NC->ZM($openCode,$gameId,$win);
        return array('win'=>$win,'ids_he'=>$ids_he,'NC'=>$NC);
    }
    public function all($openCode,$issue,$gameId,$id,$excel,$code,$table,$gameName)
    {
        $betCount = DB::table('bet')->where('status',0)->where('game_id',$gameId)->where('issue',$issue)->where('bunko','=',0.00)->count();
        if($betCount > 0){
            $bunko = 0;
            $resData = $this->exc_play($openCode,$gameId);
            $win = @$resData['win'];
            $he = isset($resData['ids_he'])?$resData['ids_he']:array();
            $NC = isset($resData['NC'])?$resData['NC']:null;
            try{
                $bunko = $this->bunko_nc($win,$gameId,$issue,$openCode,$he,$NC);
            }catch (\exception $exception){
                writeLog('New_Bet', __CLASS__ . '->' . __FUNCTION__ . ' Line:' . $exception->getLine() . ' ' . $exception->getMessage());
                DB::table('bet')->where('issue',$issue)->where('game_id',$gameId)->update(['status' => 0,'bunko' => 0]);
            }
            if($bunko == 1){
                $updateUserMoney = $this->updateUserMoney($gameId,$issue,$gameName,$table,$id,true);
                if($updateUserMoney == 1){
                    writeLog('New_Bet', $gameName . $issue . "结算出错");
                }
            }
        }
        $update = DB::table($table)->where('id',$id)->update([
            'bunko' => 1
        ]);
        if ($update !== 1) {
            writeLog('New_Bet', $gameName . $issue . "结算not Finshed");
        }else{
            $this->stopBunko($gameId,1);
            //玩法退水
            if(env('AGENT_MODEL',1) == 1) {
                $res = DB::table($table)->where('id',$id)->where('returnwater',0)->update(['returnwater' => 2]);
                if(!$res){
                    writeLog('New_Bet', $gameName . $issue . "退水前失败！");
                    return 0;
                }
                //退水
                $res = $this->reBackUser($gameId, $issue, $gameName);
                if(!$res){
                    $res = DB::table($table)->where('id',$id)->where('returnwater',2)->update(['returnwater' => 1]);
                    if(empty($res)){
                        writeLog('New_Bet',$gameName.$issue.'退水中失败！');
                        return 0;
                    }
                }else
                    writeLog('New_Bet', $gameName . $issue . "退水前失败！");
            }else{//代理退水
                $agentJob = new AgentBackwaterJob($gameId,$issue);
                $agentJob->addQueue();
            }
        }
    }
}
