<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActivityStatistics extends Model
{
    protected $table = 'activity_statistics';
    protected $primaryKey = 'id';

    public function batchInsert($data,$day){
        $this->where('day',$day)->delete();
        return $this->insert($data);
    }
}
