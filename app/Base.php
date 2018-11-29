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

}
