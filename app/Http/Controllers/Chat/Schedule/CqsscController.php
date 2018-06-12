<?php

namespace App\Http\Controllers\Chat\Schedule;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;
use App\Http\Controllers\Chat\Home\PlatcfgController;

class CqsscController extends Controller
{
    protected $platcfg;
    private   $type = '重庆时时彩';
    public function __construct(PlatcfgController $platcfg){
        $this->platcfg  = $platcfg;
    }
    public function index(Request $request){
        if($this->platcfg->is_open && $this->platcfg->schedule_type() && in_array($this->type,$this->platcfg->schedule_games())){
            if($request->get('key')==='Cqssc'){
                Redis::publish('chat-system',
                    json_encode([
                        'schedule' => 'cqssc',
                        'content' => $request->get('text').$this->platcfg->schedule_msg,
                        'date'    => date('H:i:s')
                    ])
                );
                return 'SUCCEED';
            }
        }
    }
}