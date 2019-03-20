<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use SebastianBergmann\CodeCoverage\Report\PHP;

class Base extends Model
{
    public $selfRes = null;

    public function getSelfRes(){
        if(is_null($this->selfRes))
            $this->selfRes = $this->get();
        return $this->selfRes;
    }

    public static function getTreeGroup($array, &$list = [], $pid =0, $level = 0){
        $list = [];
        foreach ($array as $key => $value){
            if ($value['pid'] == $pid){
                $value['level'] = $level;
                $list[$value['id']] = $value;
                unset($array[$key]);
                static::getTreeGroup($array, $list[$value['id']]['child'], $value['id'], $level+1);
            }
        }
        return $list;
    }

    public static function getTree($array, $pid =0, $level = 0){
        static $list = [];
        foreach ($array as $key => $value){
            if ($value['pid'] == $pid){
                $value['level'] = $level;
                $list[] = $value;
                unset($array[$key]);
                static::getTree($array, $value['id'], $level+1);
            }
        }
        return $list;
    }

}
