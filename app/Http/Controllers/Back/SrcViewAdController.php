<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class SrcViewAdController extends Controller
{
    function __construct()
    {
        $this->replaceMYSQL();
    }

    //动态更换mysql
    public function replaceMYSQL(){
        if(env('DB_HOST_AD')!='' || env('DB_HOST_AD')!='127.0.0.1' ) {
            Config::set("database.connections.mysql", [
                'driver' => 'mysql',
                "host" => env('DB_HOST_AD'),
                "database" => env('DB_DATABASE_AD'),
                "username" => env('DB_USERNAME_AD'),
                "password" => env('DB_PASSWORD_AD'),
                'charset' => 'utf8',
                'collation' => 'utf8_general_ci',
                'port' => env('DB_PORT_AD'),
            ]);
        }
    }

    //广告位
    public function advertise(){
        $this->replaceMYSQL();
        return view('back.system.advertise');
    }
    //广告详情
    public function advertiseInfo(){
        $this->replaceMYSQL();
        $aData = DB::table('advertise')->get();
        return view('back.system.advertiseInfo',compact('aData'));
    }
}
