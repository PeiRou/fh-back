<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DomainAccess extends Model
{
    protected $table = 'domain_access';
    public function domainInfo(){
        return $this->belongsTo('App\DomainInfo','domain_info_id','id');
    }
}
