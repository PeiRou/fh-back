<?php

namespace App;

class SportsGames extends Base
{
    protected $table = 'sports_game';
    protected $primaryKey = 'id';

    public function getSelfRes($param = []){
        if(is_null($this->selfRes))
            $this->selfRes = $this->where(function($aSql) use($param){
                if(isset($param['issue'])){
                    $aSql->where('issue', $param['issue']);
                }
            })->get();
        return $this->selfRes;
    }
    public function checkInsertId($param){
        $this->getSelfRes();
        $first = $this->selfRes->last(function($v, $k) use ($param){
            return ($param['event'] == $v->event && $param['home'] == $v->home && $param['away'] == $v->away && $param['issue'] == $v->issue);
        });
        if($first)
            return $first->id;
        $this->selfRes->push((object)$param); //保存到资源里
        return $this->insertGetId($param);
    }

}
