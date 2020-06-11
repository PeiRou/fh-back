<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ZhReportMember extends Model
{
    protected $table = 'zh_report_member';

    protected $primaryKey = 'id';

    public static function getVipUser($iOpenTime){
        $aSql = "SELECT `zh`.*,`user_vip`.vip_id,`users`.money as `user_money`,`users`.testFlag as `user_testFlag` FROM (
                    SELECT `user_account`,`user_name`,`user_id`,SUM(`recharges_money`) AS `recharges_money`,SUM(`bet_money`) AS `bet_money`
                        FROM `zh_report_member` WHERE `date` >= :iOpenTime
                        GROUP BY `user_id`
                    ) AS `zh`
                    LEFT JOIN `user_vip` ON `user_vip`.user_id = `zh`.user_id
                    INNER JOIN `users` ON `users`.id = `zh`.user_id";
        $aArray = [
            'iOpenTime' => $iOpenTime
        ];
        return DB::select($aSql,$aArray);
    }
}
