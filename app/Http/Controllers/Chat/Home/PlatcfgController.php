<?php

namespace App\Http\Controllers\Chat\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Chat\Platcfg;
use Illuminate\Support\Facades\Cache;
class PlatcfgController extends Controller
{
    private $model;
    public  $is_open;
    public  $is_auto;
    private $start_time;
    private $end_time;
    private $is_black;
    private $schedule_games;
    private $schedule_type;
    public  $schedule_msg;

    public function __construct(){
        $this->model = Cache::remember('platcfg', $minutes=30, function() {
            return Platcfg::first();
        });
        $this->is_open          = $this->model->is_open;
        $this->is_auto          = $this->model->is_auto;
        $this->start_time       = $this->model->start_time;
        $this->end_time         = $this->model->end_time;
        $this->is_black         = $this->model->is_black;
        $this->schedule_games   = $this->model->schedule_games;
        $this->schedule_msg     = $this->model->schedule_msg;
        $this->schedule_type    = $this->model->schedule_type;
    }

    public function time_out(){
        if(strtotime($this->start_time)<time() && strtotime($this->end_time)+86400>time()){
            return true;
        }else{
            return false;
        }
    }

    public function is_black(){
        return $this->is_black;
    }

    public function schedule_games(){
        return explode(',',$this->schedule_games);
    }

    public function schedule_type(){
        if($this->schedule_type === '软件发布'){
            return true;
        } else{
            return false;
        }
    }

}
