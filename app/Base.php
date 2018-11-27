<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SportsEvent extends Model
{
    protected $table = 'sports_event';
    protected $primaryKey = 'id';
    public $selfArr = null;

    public function getSelfArr(){
        if(is_null($this->selfArr))
            $this->selfArr = $this->get();
        return $this->selfArr;
    }


}
