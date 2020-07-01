<?php

namespace App;

use App\Recharges;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Capital extends Model
{
    protected $table = 'capital';
    protected $primaryKey = 'capital_id';

    //类型选项
    //游戏类型选项包括

    public static $includePlayTypeOption = [
        't05'
    ];
    public static $playTypeOption = [
        't01' => '充值',
        't02' => '退本金',
        't03' => '撤单[退水金额]',
        't04' => '返利/手续费',
        't05' => '下注',
        't06' => '重新开奖',
        't07' => '重新开奖[退水金额]',
        't08' => '活动',
        't09' => '奖金',
        't10' => '代理结算佣金',
        't11' => '代理佣金提现',
        't12' => '代理佣金提现失败退回',
        't13' => '抢到红包',
        't14' => '退水',
        't15' => '提现',
        't16' => '撤单',
        't17' => '提现失败',
        't18' => '后台加钱',
        't19' => '后台扣钱',
//        't20' => '游戏未结算',
//        't21' => '游戏已结算',
//        't22' => '游戏撤销',
        't23' => '第三方游戏上分',
        't24' => '第三方游戏下分',
        't25' => '冻结提现金额',
        't26' => '解冻金额',
        't27' => '冻结',
        't28' => '推广人佣金',
        't29' => '冻结[退水金额]',
        't30' => '第三方游戏上分失败退回',
        't31' => '第三方游戏返点',
        't32' => '第三方游戏重新返点',
    ];

    //明细时间
    public static function getCapitalTimeOption(){
        $capitalTimeOption = [
            'today' => '今日明细',
            'yesterday' => '昨日明细',
            'history' => '历史明细',
        ];
        return $capitalTimeOption;
    }

    //资金明细组装-充值
    public static function AssemblyFundDetails_Rech($param){
        $aSql = Recharges::select('username','userId','orderNum as order_id','updated_at as created_at',DB::raw("'t01' as type"),'amount as money','balance',DB::raw("'' as issue"),DB::raw("'' as game_id"),DB::raw("'' as game_name"),DB::raw("'' as playcate_name"),'operation_id','operation_account as account','shou_info as content','ru_info as content2',DB::raw("'' as freeze_money,'' as unfreeze_money,'' as nn_view_money,amount as c_money,'' as bet_id,'' as rechargesType"))
            ->where(function ($sql) use($param){
                $sql->where('payType','!=','adminAddMoney');
                $sql->where('status','=',2);
                if(isset($param['startTime']) && array_key_exists('startTime',$param) && isset($param['endTime']) && array_key_exists('endTime',$param)){
                    $sql->whereBetween('updated_at',[date("Y-m-d 00:00:00",strtotime($param['startTime'])),date("Y-m-d 23:59:59",strtotime($param['endTime']))]);
                }else{
                    if(isset($param['time_point']) && array_key_exists('time_point',$param)) {
                        if($param['time_point'] == 'today'){
                            $time = date('Y-m-d');
                            $sql->whereBetween('updated_at', [$time . ' 00:00:00', $time . ' 23:59:59']);
                        }elseif($param['time_point'] == 'yesterday'){
                            $time = date('Y-m-d',strtotime('- 1 day',time()));
                            $sql->whereBetween('updated_at', [$time . ' 00:00:00', $time . ' 23:59:59']);
                        }else{
                            $time = date('Y-m-d',strtotime('- 2 day',time()));
                            $sql->whereBetween('updated_at', [$time . ' 00:00:00', $time . ' 23:59:59']);
                        }
                    }
                }
                if(isset($param['account_id']) && array_key_exists('account_id',$param)){
                    $sql->where('userId','=',$param['account_id']);
                }
                if(isset($param['account']) && array_key_exists('account',$param)){
                    $sql->where('username','=',$param['account']);
                }
                if(isset($param['game_id']) && array_key_exists('game_id',$param)){
                    $sql->where('game_id','=',$param['game_id']);
                }
                if(isset($param['order_id']) && array_key_exists('order_id',$param)){
                    $sql->where('orderNum','=',$param['order_id']);
                }
                if(isset($param['amount_min']) && array_key_exists('amount_min',$param)){
                    $sql->where('amount','>=',$param['amount_min']);
                }
                if(isset($param['amount_max']) && array_key_exists('amount_max',$param)){
                    $sql->where('amount','<=',$param['amount_max']);
                }
            });
        return $aSql;
    }

    //资金明细组装
    public static function AssemblyFundDetails($param){
        $aSql = Capital::select('users.username','capital.to_user','capital.order_id','capital.created_at','capital.type','capital.money','capital.balance as balance','capital.issue','capital.game_id','capital.game_name','capital.playcate_name','capital.operation_id','sub_account.account','capital.content',DB::raw("'' as content2,'' as freeze_money,'' as unfreeze_money,'' as nn_view_money,capital.money as c_money,`capital`.`capital_id` as bet_id"),'capital.rechargesType')
            ->where(function ($sql) use($param){
                if(isset($param['startTime']) && array_key_exists('startTime',$param) && isset($param['endTime']) && array_key_exists('endTime',$param)){
                    $sql->whereBetween('capital.updated_at',[date("Y-m-d 00:00:00",strtotime($param['startTime'])),date("Y-m-d 23:59:59",strtotime($param['endTime']))]);
                }else{
                    if(isset($param['time_point']) && array_key_exists('time_point',$param)) {
                        if($param['time_point'] == 'today'){
                            $time = date('Y-m-d');
                            $sql->whereBetween('capital.updated_at', [$time . ' 00:00:00', $time . ' 23:59:59']);
                        }elseif($param['time_point'] == 'yesterday'){
                            $time = date('Y-m-d',strtotime('- 1 day',time()));
                            $sql->whereBetween('capital.updated_at', [$time . ' 00:00:00', $time . ' 23:59:59']);
                        }else{
                            $time = date('Y-m-d',strtotime('- 2 day',time()));
                            $sql->whereBetween('capital.updated_at', [$time . ' 00:00:00', $time . ' 23:59:59']);
                        }
                    }
                }
                if(isset($param['account_id']) && array_key_exists('account_id',$param)){
                    $sql->where('users.id','=',$param['account_id']);
                }
                if(isset($param['account']) && array_key_exists('account',$param)){
                    $sql->where('users.username','=',$param['account']);
                }
                if(isset($param['game_id']) && array_key_exists('game_id',$param)){
                    $sql->where('capital.game_id','=',$param['game_id']);
                }
                if(isset($param['order_id']) && array_key_exists('order_id',$param)){
                    $sql->where('capital.order_id','=',$param['order_id']);
                }
                if(isset($param['issue']) && array_key_exists('issue',$param)){
                    $sql->where('capital.issue','=',$param['issue']);
                }
                if(isset($param['type']) && array_key_exists('type',$param)){
                    $sql->where('capital.type','=',$param['type']);
                    if($param['type'] === 't18' && isset($param['recharges_id']) && array_key_exists('recharges_id',$param)){
                        $sql->where('capital.rechargesType','=',$param['recharges_id']);
                    }
                }
                if(isset($param['amount_min']) && array_key_exists('amount_min',$param)){
                    $sql->where('capital.money','>=',$param['amount_min']);
                }
                if(isset($param['amount_max']) && array_key_exists('amount_max',$param)){
                    $sql->where('capital.money','<=',$param['amount_max']);
                }
            })->leftJoin('users','users.id','=','capital.to_user')->leftJoin('sub_account','sub_account.sa_id','=','capital.operation_id');
        return $aSql;
    }

    public function randOrder($fix)
    {
        $order_id_main = date('YmdHis').rand(10000000,99999999);
        $order_id_len = strlen($order_id_main);
        $order_id_sum = 0;
        for($i=0; $i<$order_id_len; $i++){
            $order_id_sum += (int)(substr($order_id_main,$i,1));
        }
        $order_id = $order_id_main . str_pad((100 - $order_id_sum % 100) % 100,2,'0',STR_PAD_LEFT);
        return $fix.$order_id;
    }

    //活动金额--会员
    public static function betMemberReportData($startTime = '',$endTime = ''){
        $aSql = "SELECT SUM(CASE WHEN `type` = 't08' THEN `money` ELSE 0 END ) AS `sumActivity`,
                        SUM(CASE WHEN `type` = 't04' THEN `money` ELSE 0 END ) AS `sumRecharge_fee`,
                        SUM(CASE WHEN `type` = 't13' THEN `money` ELSE 0 END ) AS `sumAmount`,
                  `to_user`,SUM(`money`) AS `moneySum`,LEFT(`created_at`,10) AS `date` FROM `capital`
                  WHERE `type` IN('t08','t04','t13') ";
        $aArray = [];
        if(!empty($startTime)){
            $aSql .= " AND `created_at` >= :startTime ";
            $aArray['startTime'] = $startTime;
        }
        if(!empty($endTime)){
            $aSql .= " AND `created_at` <= :endTime ";
            $aArray['endTime'] = $endTime;
        }
        $aSql .= " GROUP BY `to_user`,`date` ORDER BY `date` ASC";
        return DB::select($aSql,$aArray);
    }

    //获取
    public static function betMemberReportOtherData($startTime = '',$endTime = '', $types = []){

        $aSql = "SELECT
                    `to_user`,
                    SUM( `money` ) AS `moneySum`,
                    SUM( CASE WHEN (`capital`.`type` IN('".implode("','", $types)."') OR ((`capital`.`type` = 't18') AND `capital`.`rechargesType` = 3 )) THEN `money` ELSE 0 END  ) AS other_money,
                    SUM( CASE WHEN `capital`.`type` = 't18' AND `capital`.`rechargesType` IN (1,3) THEN `capital`.`money` ELSE 0 END ) AS cai_money,
                    LEFT ( `created_at`, 10 ) AS `date` 
                FROM
                    `capital` 
                WHERE 1 AND `capital`.`type` IN('".implode("','", $types)."','t18')  ";
        $aArray = [];
        if(!empty($startTime)){
            $aSql .= " AND `created_at` >= :startTime ";
            $aArray['startTime'] = $startTime;
        }
        if(!empty($endTime)){
            $aSql .= " AND `created_at` <= :endTime ";
            $aArray['endTime'] = $endTime;
        }
        $aSql .= " GROUP BY `to_user`,`date` ORDER BY `date` ASC";
        return DB::select($aSql,$aArray);
    }

    //红包金额--会员
    public static function betMemberReportHongBaoData($startTime = '',$endTime = ''){
        $aSql = "SELECT SUM(`money`) AS `amount`,LEFT(`created_at`,10) AS `date`,to_user AS `users_id` FROM `capital` WHERE `type` = 't13' ";
        $aArray = [];
        if(!empty($startTime)){
            $aSql .= " AND `created_at` >= :startTime ";
            $aArray['startTime'] = $startTime;
        }
        if(!empty($endTime)){
            $aSql .= " AND `created_at` <= :endTime ";
            $aArray['endTime'] = $endTime;
        }
        $aSql .= " GROUP BY `to_user`,`date` ORDER BY `date` ASC";
        return DB::select($aSql,$aArray);
    }

    //活动金额--代理
    public static function betAgentReportData($startTime = '',$endTime = ''){
        $aSql = "SELECT LEFT(`capital`.`created_at`,10) AS `date`,`users`.`agent` AS `agentId`,SUM(`capital`.`money`) AS `moneySum`,COUNT(DISTINCT(`users`.`id`)) AS `userIdCount`,
                   SUM(CASE WHEN `capital`.`type` = 't08' THEN `capital`.`money` ELSE 0 END ) AS `sumActivity`,
                   SUM(CASE WHEN `capital`.`type` = 't04' THEN `capital`.`money` ELSE 0 END ) AS `sumRecharge_fee`,
                   SUM(CASE WHEN `capital`.`type` = 't13' THEN `capital`.`money` ELSE 0 END ) AS `sumAmount`
                  FROM `capital`
                  JOIN `users` ON `users`.`id` = `capital`.`to_user`
                  WHERE `capital`.`type` IN('t08','t04','t13') AND `users`.`testFlag` = 0 ";
        $aArray = [];
        if(!empty($startTime)){
            $aSql .= " AND `capital`.`created_at` >= :startTime ";
            $aArray['startTime'] = $startTime;
        }
        if(!empty($endTime)){
            $aSql .= " AND `capital`.`created_at` <= :endTime ";
            $aArray['endTime'] = $endTime;
        }
        $aSql .= " GROUP BY `agentId`,`date` ORDER BY `date` ASC";
        return DB::select($aSql,$aArray);
    }

    public static function betAgentReportOtherData($startTime = '',$endTime = '', $types = []){
        $aSql = "SELECT 
                    LEFT(`capital`.`created_at`,10) AS `date`,
                    `users`.`agent` AS `agentId`,
                    SUM( CASE WHEN (`capital`.`type` IN('".implode("','", $types)."') OR ((`capital`.`type` = 't18') AND `capital`.`rechargesType` = 3 )) THEN `capital`.`money` ELSE 0 END  ) AS other_money,
                    COUNT(DISTINCT CASE WHEN (`capital`.`type` IN('".implode("','", $types)."') OR ((`capital`.`type` = 't18') AND `capital`.`rechargesType` = 3 )) THEN `capital`.`to_user` ELSE NULL END  ) AS other_count,
                    SUM( CASE WHEN `capital`.`type` = 't18' AND `capital`.`rechargesType` IN (1,3) THEN `capital`.`money` ELSE 0 END ) AS cai_money,
                    COUNT(DISTINCT CASE WHEN `capital`.`type` = 't18' AND `capital`.`rechargesType` IN (1,3) THEN `capital`.`to_user` ELSE NULL END ) AS cai_count
                  FROM `capital`
                  JOIN `users` ON `users`.`id` = `capital`.`to_user`
                  WHERE 1
                     AND `capital`.`type` IN('".implode("','", $types)."','t18')  
                     AND `users`.`testFlag` = 0 ";
        $aArray = [];
        if(!empty($startTime)){
            $aSql .= " AND `capital`.`created_at` >= :startTime ";
            $aArray['startTime'] = $startTime;
        }
        if(!empty($endTime)){
            $aSql .= " AND `capital`.`created_at` <= :endTime ";
            $aArray['endTime'] = $endTime;
        }
        $aSql .= " GROUP BY `agentId`,`date` ORDER BY `date` ASC";
        return DB::select($aSql,$aArray);
    }

    //红包金额--代理
    public static function betAgentReportHongBaoData($startTime = '',$endTime = ''){
        $aSql = "SELECT LEFT(`capital`.`created_at`,10) AS `date`,`users`.`agent` AS `agent`,SUM(`capital`.`money`) AS `amount`,COUNT(DISTINCT(`users`.`id`)) AS `userIdCount` 
                  FROM `capital`
                  JOIN `users` ON `users`.`id` = `capital`.`to_user`
                  WHERE `capital`.`type` = 't13' AND `users`.`testFlag` = 0 ";
        $aArray = [];
        if(!empty($startTime)){
            $aSql .= " AND `capital`.`created_at` >= :startTime ";
            $aArray['startTime'] = $startTime;
        }
        if(!empty($endTime)){
            $aSql .= " AND `capital`.`created_at` <= :endTime ";
            $aArray['endTime'] = $endTime;
        }
        $aSql .= " GROUP BY `agent`,`date` ORDER BY `date` ASC";
        return DB::select($aSql,$aArray);
    }

    //活动金额--总代理
    public static function betGeneralReportData($startTime = '',$endTime = ''){
        $aSql = "SELECT LEFT(`capital`.`created_at`,10) AS `date`,`agent`.`gagent_id` AS `generalId`,SUM(`capital`.`money`) AS `moneySum`,
                  COUNT(DISTINCT(`users`.`id`)) AS `userIdCount`,COUNT(DISTINCT(`agent`.`a_id`)) AS `agentIdCount`,
                  SUM(CASE WHEN `capital`.`type` = 't08' THEN `capital`.`money` ELSE 0 END ) AS `sumActivity`,
                  SUM(CASE WHEN `capital`.`type` = 't04' THEN `capital`.`money` ELSE 0 END ) AS `sumRecharge_fee`,
                  SUM(CASE WHEN `capital`.`type` = 't13' THEN `capital`.`money` ELSE 0 END ) AS `sumAmount`
                  FROM `capital`
                  JOIN `users` ON `users`.`id` = `capital`.`to_user`
                  JOIN `agent` ON `agent`.`a_id` = `users`.`agent`
                  WHERE `capital`.`type` IN('t08','t04','t13') AND `users`.`testFlag` = 0 ";
        $aArray = [];
        if(!empty($startTime)){
            $aSql .= " AND `capital`.`created_at` >= :startTime ";
            $aArray['startTime'] = $startTime;
        }
        if(!empty($endTime)){
            $aSql .= " AND `capital`.`created_at` <= :endTime ";
            $aArray['endTime'] = $endTime;
        }
        $aSql .= " GROUP BY `generalId`,`date` ORDER BY `date` ASC";
        return DB::select($aSql,$aArray);
    }

    //红包金额--总代理
    public static function betGeneralReportHongBaoData($startTime = '',$endTime = ''){
        $aSql = "SELECT LEFT(`capital`.`created_at`,10) AS `date`,`agent`.`gagent_id` AS `gagent_id`,SUM(`capital`.`money`) AS `amount`,
                  COUNT(DISTINCT(`users`.`id`)) AS `userIdCount`,COUNT(DISTINCT(`agent`.`a_id`)) AS `agentIdCount`
                  FROM `capital`
                  JOIN `users` ON `users`.`id` = `capital`.`to_user`
                  JOIN `agent` ON `agent`.`a_id` = `users`.`agent`
                  WHERE `capital`.`type` = 't13' AND `users`.`testFlag` = 0 ";
        $aArray = [];
        if(!empty($startTime)){
            $aSql .= " AND `capital`.`created_at` >= :startTime ";
            $aArray['startTime'] = $startTime;
        }
        if(!empty($endTime)){
            $aSql .= " AND `capital`.`created_at` <= :endTime ";
            $aArray['endTime'] = $endTime;
        }
        $aSql .= " GROUP BY `gagent_id`,`date` ORDER BY `date` ASC";
        return DB::select($aSql,$aArray);
    }
    public static function betGeneralReportOtherData($startTime = '',$endTime = '', $types = [])
    {
        $aSql = "SELECT 
                  LEFT(`capital`.`created_at`,10) AS `date`,
                  `agent`.`gagent_id` AS `generalId`,
                  SUM( CASE WHEN (`capital`.`type` IN('".implode("','", $types)."') OR ((`capital`.`type` = 't18') AND `capital`.`rechargesType` = 3 )) THEN `capital`.`money` ELSE 0 END  ) AS other_money,
                  COUNT(DISTINCT CASE WHEN (`capital`.`type` IN('".implode("','", $types)."') OR ((`capital`.`type` = 't18') AND `capital`.`rechargesType` = 3 )) THEN `capital`.`to_user` ELSE NULL END  ) AS other_count,
                  COUNT(DISTINCT CASE WHEN (`capital`.`type` IN('".implode("','", $types)."') OR ((`capital`.`type` = 't18') AND `capital`.`rechargesType` = 3 )) THEN `agent`.`a_id` ELSE NULL END  ) AS other_agent_count,
                  SUM( CASE WHEN `capital`.`type` = 't18' AND `capital`.`rechargesType` IN (1,3) THEN `capital`.`money` ELSE 0 END ) AS cai_money,
                  COUNT(DISTINCT CASE WHEN `capital`.`type` = 't18' AND `capital`.`rechargesType` IN (1,3) THEN `capital`.`to_user` ELSE NULL END ) AS cai_count,
                  COUNT(DISTINCT CASE WHEN `capital`.`type` = 't18' AND `capital`.`rechargesType` IN (1,3) THEN `agent`.`a_id` ELSE NULL END ) AS cai_agent_count
                  FROM `capital`
                  JOIN `users` ON `users`.`id` = `capital`.`to_user`
                  JOIN `agent` ON `agent`.`a_id` = `users`.`agent`
                  WHERE `users`.`testFlag` = 0 
                  AND `capital`.`type` IN('".implode("','", $types)."','t18') 
                  ";
        $aArray = [];
        if (!empty($startTime)) {
            $aSql .= " AND `capital`.`created_at` >= :startTime ";
            $aArray['startTime'] = $startTime;
        }
        if (!empty($endTime)) {
            $aSql .= " AND `capital`.`created_at` <= :endTime ";
            $aArray['endTime'] = $endTime;
        }
        $aSql .= " GROUP BY `generalId`,`date` ORDER BY `date` ASC";
        return DB::select($aSql, $aArray);
    }
    public static function capitalNew($iStartTime,$iEndTime){
        $aSql = "SELECT 
                        `ca`.capital23,`ca`.capital24,`ca`.capital30,`ca`.capital31,`ca`.capital32,
                        `ca`.capital35,`ca`.capital36,`ca`.capital33,`ca`.capital34,`ca`.capital02,
                        `ca`.capital16,`ca`.capital08,`ca`.capital13,`ca`.capital28,`ca`.capital04,
                        `ca`.capital03,`ca`.capital14,`bet`.betMoney,`bet`.betBunko,
                        `re`.onPay,`re`.offPay,`re`.adPay,`dr`.suDraw,`dr`.adDraw
                    FROM (
                        SELECT 
                            SUM(CASE WHEN `type` = 't23' THEN `money` ELSE 0 END) AS `capital23`,
                            SUM(CASE WHEN `type` = 't24' THEN `money` ELSE 0 END) AS `capital24`,
                            SUM(CASE WHEN `type` = 't30' THEN `money` ELSE 0 END) AS `capital30`,
                            SUM(CASE WHEN `type` = 't31' THEN `money` ELSE 0 END) AS `capital31`,
                            SUM(CASE WHEN `type` = 't32' THEN `money` ELSE 0 END) AS `capital32`,
                            SUM(CASE WHEN `type` = 't35' THEN `money` ELSE 0 END) AS `capital35`,
                            SUM(CASE WHEN `type` = 't36' THEN `money` ELSE 0 END) AS `capital36`,
                            SUM(CASE WHEN `type` = 't33' THEN `money` ELSE 0 END) AS `capital33`,
                            SUM(CASE WHEN `type` = 't34' THEN `money` ELSE 0 END) AS `capital34`,
                            SUM(CASE WHEN `type` = 't02' THEN `money` ELSE 0 END) AS `capital02`,
                            SUM(CASE WHEN `type` = 't03' THEN `money` ELSE 0 END) AS `capital03`,
                            SUM(CASE WHEN `type` = 't16' THEN `money` ELSE 0 END) AS `capital16`,
                            SUM(CASE WHEN `type` = 't08' THEN `money` ELSE 0 END) AS `capital08`,
                            SUM(CASE WHEN `type` = 't13' THEN `money` ELSE 0 END) AS `capital13`,
                            SUM(CASE WHEN `type` = 't28' THEN `money` ELSE 0 END) AS `capital28`,
                            SUM(CASE WHEN `type` = 't04' THEN `money` ELSE 0 END) AS `capital04`,
                            SUM(CASE WHEN `type` = 't14' THEN `money` ELSE 0 END) AS `capital14`,
                            LEFT(`created_at`,10) AS `date` 
                        FROM `capital` WHERE `testFlag` = 0 AND `created_at` >= '".$iStartTime."' AND `created_at` <= '".$iEndTime."' GROUP BY `date`
                    ) AS `ca`
                    LEFT JOIN (
                        SELECT 
                            SUM(CASE WHEN `payType` = 'onlinePayment' THEN `amount` ELSE 0 END) AS `onPay`,
                            SUM(CASE WHEN `payType` IN('bankTransfer','alipaySm','weixinSm','ysf','alipay','weixin','cft') THEN `amount` ELSE 0 END) AS `offPay`,
                            SUM(CASE WHEN `payType` = 'adminAddMoney' THEN `amount` ELSE 0 END) AS `adPay`,
                            LEFT(`updated_at`,10) AS `date`
                        FROM `recharges` WHERE `testFlag` = 0 AND `status` = 2 AND `updated_at` >= '".$iStartTime."' AND `updated_at` <= '".$iEndTime."' GROUP BY `date`
                    ) AS `re` ON `re`.date = `ca`.date
                    LEFT JOIN (
                        SELECT 
                            SUM(CASE WHEN `draw_type` IN(0,1) AND `status` = 2 THEN `amount` ELSE 0 END) AS `suDraw`,
                            SUM(CASE WHEN `draw_type` = 2 THEN `amount` ELSE 0 END) AS `adDraw`,
                            LEFT(`updated_at`,10) AS `date`
                        FROM `drawing` WHERE `testFlag` = 0 AND `updated_at` >= '".$iStartTime."' AND `updated_at` <= '".$iEndTime."' GROUP BY `date` 
                    ) AS `dr` ON `dr`.date = `ca`.date
                    LEFT JOIN (
                        SELECT 
                            SUM(`bet_money`) AS `betMoney`,
                            SUM(CASE WHEN bet_his.`game_id` IN(90,91) THEN bet_his.`nn_view_money` ELSE (CASE WHEN bet_his.`bunko` >0 THEN bet_his.`bunko` - bet_his.`bet_money` ELSE bet_his.`bunko` END) END) AS `betBunko`,
                            LEFT(`updated_at`,10) AS `date`
                        FROM `bet_his` WHERE `testFlag` = 0 AND `status` = 1 AND `updated_at` >= '".$iStartTime."' AND `updated_at` <= '".$iEndTime."' GROUP BY `date`
                    ) AS `bet` ON `bet`.date = `ca`.date";
        return DB::select($aSql);
    }
}
