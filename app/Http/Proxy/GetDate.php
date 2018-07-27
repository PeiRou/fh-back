<?php
/**
 * Created by PhpStorm.
 * User: vincent
 * Date: 2018/1/24
 * Time: 下午9:00
 */

namespace App\Http\Proxy;


use Illuminate\Support\Carbon;

class GetDate
{
    //当前日期(天)
    private $defaultCurrentDay;

    //每周开始时间(表示每周星期一为开始日期 0表示每周日为开始日期)
    private $defaultWeekDate = 1;

    public function GetTheSpecifiedDate($date = "today")
    {
        $data = [];

        switch ($date) {
            case 'today' :
                $data = $this->todayDate();
                break;
            case 'yesterday' :
                $data = $this->yesterdayDate();
                break;
            case 'week' :
                $data = $this->currentWeekDate();
                break;
            case 'lastWeek' :
                $data = $this->lastWeekDate();
                break;
            case 'month' :
                $data = $this->currentMonthDate();
                break;
            case 'lastMonth' :
                $data = $this->lastMonthDate();
                break;
            case 'lastLastMonth' :
                $data = $this->lastLastMonthDate();
                break;
            case 'lastTwoMonth' :
                $data = $this->lastTwoMonthDate();
                break;
            case 'thisTwoMonth' :
                $data = $this->thisTwoMonthDate();
                break;
            case 'beforeTwoMonth' :
                $data = $this->beforeTwoMonthDate();
                break;
        }

        return $data;
    }

    //获取当前时间
    public function todayDate(){
        return [
            'start' => date('Y-m-d'),
            'end' => date('Y-m-d 23:59:59')
        ];
    }

    //获取昨天时间
    public function yesterdayDate(){
        return [
            'start' => date('Y-m-d',strtotime(date('Y-m-d').'- 1 day')),
            'end' => date('Y-m-d 23:59:59',strtotime(date('Y-m-d').'- 1 day'))
        ];
    }

    //获取本周时间
    public function currentWeekDate(){
        return [
            'start' => $this->getCurrentWeekStartDate(),
            'end' => $this->getCurrentWeekEndDate()
        ];
    }

    //获取上周时间
    public function lastWeekDate(){
        return [
            'start' => $this->getLastWeekStartDate(),
            'end' => $this->getLastWeekEndDate()
        ];
    }

    //获取本月时间
    public function currentMonthDate(){
        $date = $this->getPreviousYearMonth(0);
        return [
            'start'=> date('Y-m-d', mktime(0,0,0,$date['start']['month'],1,$date['start']['year'])),
            'end' => date('Y-m-d H:i:s', mktime(23,59,59,$date['end']['month'],$date['end']['day'],$date['end']['year']))
        ];
    }

    //获取上月时间
    public function lastMonthDate(){
        $date = $this->getPreviousYearMonth(1);
        return [
            'start'=> date('Y-m-d', mktime(0,0,0,$date['start']['month'],1,$date['start']['year'])),
            'end' => date('Y-m-d H:i:s', mktime(23,59,59,$date['end']['month'],$date['end']['day'],$date['end']['year']))
        ];
    }

    //获取上上月时间
    public function lastLastMonthDate(){
        $date = $this->getPreviousYearMonth(2);
        return [
            'start'=> date('Y-m-d', mktime(0,0,0,$date['start']['month'],1,$date['start']['year'])),
            'end' => date('Y-m-d H:i:s', mktime(23,59,59,$date['end']['month'],$date['end']['day'],$date['end']['year']))
        ];
    }

    //获取近上两个月时间
    public function lastTwoMonthDate(){
        $date = $this->getPreviousYearMonth(2,1);
        return [
            'start'=> date('Y-m-d', mktime(0,0,0,$date['start']['month'],1,$date['start']['year'])),
            'end' => date('Y-m-d H:i:s', mktime(23,59,59,$date['end']['month'],$date['end']['day'],$date['end']['year']))
        ];
    }

    //获取近两个月时间
    public function thisTwoMonthDate(){
        $date = $this->getPreviousYearMonth(1,1);
        return [
            'start'=> date('Y-m-d', mktime(0,0,0,$date['start']['month'],1,$date['start']['year'])),
            'end' => date('Y-m-d H:i:s', mktime(23,59,59,$date['end']['month'],$date['end']['day'],$date['end']['year']))
        ];
    }

    //获取前三个月开的两个月时间
    public function beforeTwoMonthDate(){
        $date = $this->getPreviousYearMonth(3,1);
        return [
            'start'=> date('Y-m-d', mktime(0,0,0,$date['start']['month'],1,$date['start']['year'])),
            'end' => date('Y-m-d H:i:s', mktime(23,59,59,$date['end']['month'],$date['end']['day'],$date['end']['year']))
        ];
    }

    //定义当前日期(天)
    public function defineCurrentDay(){
        //当前日期(天)
        $this->defaultCurrentDay = date("Y-m-d");
    }

    //获取本州开始时间
    public function getCurrentWeekStartDate(){
        $this->defineCurrentDay();
        //获取当前周的第几天 周日是 0 周一到周六是 1 - 6
        $week =date('w',strtotime($this->defaultCurrentDay));
        //获取本周开始日期，如果$w是0，则表示周日，减去 6 天
        return date('Y-m-d',strtotime("$this->defaultCurrentDay -".($week ? $week - $this->defaultWeekDate : 6).' day'));
    }

    //获取本周结束时间
    public function getCurrentWeekEndDate(){
        return date('Y-m-d 23:59:59',strtotime($this->getCurrentWeekStartDate()." + 6 day"));
    }

    //获取上周开始时间
    public function getLastWeekStartDate(){
        return date('Y-m-d',strtotime($this->getCurrentWeekStartDate()." - 7 day"));
    }

    //获取上周结束时间
    public function getLastWeekEndDate(){
        return date('Y-m-d 23:59:59',strtotime($this->getCurrentWeekStartDate()." - 1 day"));
    }

    //获取之前年月
    public function getPreviousYearMonth($months,$monthNum = 0){
        $month = date('m');
        $year = date('y');
        $data = [];
        if($monthNum === 0){
            $data['start'] = $data['end'] = $this->getYearMonthDayArray($month - $months,$year);
        }else{
            $data['start'] = $this->getYearMonthDayArray($month - $months,$year);
            $data['end'] = $this->getYearMonthDayArray($month - $months + $monthNum,$year);
        }
        return $data;
    }

    //获取获取具体年月日
    public function getYearMonthDayArray($factMonth,$year){
        if($factMonth > 0){
            return $this->getMonthDaysNum($factMonth,$year);
        }else{
            return $this->getMonthDaysNum(12 + $factMonth,$year - 1);
        }
    }

    //获取月天数
    public function getMonthDaysNum($month,$year){
        //这个月的开始日期
        $monthStartDate = date('Y-m-d', mktime(0,0,0,$month,1,$year));
        //这个月共多少天
        $day = date('t',strtotime($monthStartDate));
        return [
            'month' => $month,
            'year' => $year,
            'day' => $day
        ];
    }



}