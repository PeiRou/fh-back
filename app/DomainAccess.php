<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DomainAccess extends Model
{
    protected $table = 'domain_access';
    public function domainInfo(){
        return $this->belongsTo('App\DomainInfo','domain_info_id','id');
    }
    public static function getData($day=[]){
        $timeArr = [];
        $arr = [];
        $arr1 = [];
        for ($i = 0; $i <= 23; $i++) {
            $timeArr[] =  $i < 10 ? '0' . $i . ':00:00' : $i . ':00:00';
        }
        $data = self::join('domain_info','domain_access.domain_info_id','=','domain_info.id')->whereBetween('day',$day)->orderByDesc('day')->get()->toArray();
        foreach ($data as $k=>$v){
            $tmp[$v['hours']] = $v['access_num'];
            $arr[$v['domain'].'|'.$v['day']][] = $tmp;
            unset($tmp);
        }
        foreach ($arr as $k=>$v){
            $tmpArr1 = explode('|',$k);
            $tmpArr2['domain'] = $tmpArr1[0];
            $tmpArr2['day'] = $tmpArr1[1];
            $tmpArr3 = array_collapse($v);
            $arr1[] =array_merge($tmpArr2,$tmpArr3);
        }
        foreach ($arr1 as $k => $v) {
            foreach ($timeArr as $k1=>$v1) {
                if (!array_key_exists($v1,$v)){
                    $arr1[$k][$v1] = 0;
                }
            }
        }
        foreach ($arr1 as $k=>$v){
            ksort($v);
            $arr1[$k] = $v;
        }
        return $arr1;
    }
}
