<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChatRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chat_roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('角色名');
            $table->string('type')->comment('角色类型');
            $table->string('level')->default('')->comment('会员等级');
            $table->string('bg_color1')->comment('聊天信息效果1');
            $table->string('bg_color2')->comment('聊天信息效果2');
            $table->string('font_color')->comment('字体颜色');
            $table->string('length',20)->comment('消息最大长度');
            $table->string('permission')->default('')->comment('权限');
            $table->mediumText('description')->comment('描述');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chat_roles');
    }
}
