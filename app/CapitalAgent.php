<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CapitalAgent extends Model
{
    protected $table = 'capital_agent';

    //类型选项
    public static $playTypeOption = [
        't01' => '彩票返点',
    ];


}
