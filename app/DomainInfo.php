<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DomainInfo extends Model
{
    protected $table = 'domain_info';
    public function domainAccess(){
        return $this->hasMany('App\DomainAccess','domain_info_id','id');
    }
}
