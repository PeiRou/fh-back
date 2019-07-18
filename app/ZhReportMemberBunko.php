<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ZhReportMemberBunko extends Model
{
    protected $table = 'zh_report_member_bunko';
    
    protected $primaryKey = 'id';

    public function getDataMemberBunko($aGameId = []){
        $aSql = "SELECT `user_id`,`agent_id`,SUM(`bet_bunko`) AS `sumBunko`";
    }
}
