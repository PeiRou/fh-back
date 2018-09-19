<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
class StatisticsData extends Model
{
    protected $table = 'statistics_data';
    protected $primaryKey = 'id';

}
