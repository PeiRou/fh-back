<?php

namespace App\Models\Chat;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'chat_roles';
    protected $fillable = [
        'name', 'type','level','font_color','bg_color1','bg_color2','length','permission','description'
    ];
}
