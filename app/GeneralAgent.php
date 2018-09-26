<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class GeneralAgent extends Model
{
    protected $table = 'general_agent';
    protected $primaryKey = 'ga_id';

    public static function betGeneralReportData(){
        return self::select(DB::raw("`general_agent`.`account` AS `generalAccount`,`general_agent`.`ga_id` AS `generalId`,`general_agent`.`name` AS `generalName`"))->get();
    }
}
