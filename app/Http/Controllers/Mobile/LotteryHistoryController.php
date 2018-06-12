<?php

namespace App\Http\Controllers\Mobile;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class LotteryHistoryController extends Controller
{
    public function lotteryHistory(Request $request)
    {
        $date = $request->date;
        $gameId = $request->gameId;
        $year = substr($date,0,4);
        $month = substr($date,4,2);
        $day = substr($date,6,2);

        switch ($gameId){
            case 80:
                $table = 'mssc';
                $gameId_table = 80;
                break;
            case 82:
                $table = 'msft';
                $gameId_table = 82;
                break;
            case 50:
                $table = 'bjpk10';
                $gameId_table = 50;
                break;
            case 81:
                $table = 'msssc';
                $gameId_table = 81;
                break;
            case 1:
                $table = 'cqssc';
                $gameId_table = 1;
                break;
            case 66:
                $table = 'pcdd';
                $gameId_table = 66;
                break;
            case 65:
                $table = 'bjkl8';
                $gameId_table = 65;
                break;
            case 99:
                $table = 'paoma';
                $gameId_table = 99;
                break;
        }

        $getData = DB::table('game_'.$table)->where('year','=',$year)->where('month','=',$month)->where('day','=',$day)->orderBy('issue','desc')->get();
        foreach($getData as $item){
            $data[] = [
                'id' => $item->id,
                'gameId'=> $gameId_table,
                'openNum' => $item->opennum,
                'openTime' => $item->opentime,
                'betEndTime' => Carbon::parse($item->opentime)->addSeconds(-15)->toDateTimeString(),
                'remark' => null,
                'turnNum' => $item->issue,
                'statDate' => date('Y-m-d 00:00:00',strtotime($item->opentime)),
                'status' => 2
            ];
        }

        return response()->json($data);
    }
}
