<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Base extends Model
{
    public $selfRes = null;

    public function getSelfRes(){
        if(is_null($this->selfRes))
            $this->selfRes = $this->get();
        return $this->selfRes;
    }
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
        $this->selfRes->push($data); //保存到资源里
        return $this->insertGetId($data);
    }

}
