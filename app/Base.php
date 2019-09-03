<?php

namespace App;

use App\Http\Services\Cache;
use Illuminate\Database\Eloquent\Model;
use SebastianBergmann\CodeCoverage\Report\PHP;

class Base extends Model
{
    use Cache;

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
                $list[$value['game_id']] = $value;
                unset($array[$key]);
                static::getTreeGroup($array, $list[$value['game_id']]['child'], $value['game_id'], $level+1);
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
                static::getTree($array, $value['game_id'], $level+1);
            }
        }
        return $list;
    }

}
