<?php

namespace App;

class SportsEvent extends Base
{
    protected $table = 'sports_event';
    protected $primaryKey = 'id';

    public function checkInsertId($value){
        $this->getSelfRes();
        $first = $this->selfRes->last(function($v, $k) use ($value){
            return $v->name == $value;
        });
        if($first)
            return $first->id;
        $data = [
            'name' => $value,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        $this->selfRes->push((object)$data); //保存到资源里
        return $this->insertGetId($data);
    }

}
