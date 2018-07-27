<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActivityPrize extends Model
{
    protected $table = 'activity_prize';
    protected $primaryKey = 'id';

    public static $prizeType = [
        '1' => '实物',
        '2' => '金额',
    ];

    public static $role = [
        'name' => 'required|max:100|string',
        'type' => 'required|max:3|integer',
        'quantity' => 'required|integer',
    ];

}
