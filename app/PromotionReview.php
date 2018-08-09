<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PromotionReview extends Model
{
    protected $table = 'promotion_review';
    protected $primaryKey = 'id';

    public static $role = [

    ];

    public static $reportStatus = [
        '0' => '未结算',
        '1' => '已结算',
        '2' => '未审核',
        '3' => '驳回',
        '4' => '结算过期',
    ];

}
