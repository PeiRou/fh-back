<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('房间名称');
            $table->string('type')->comment('房间类型');
            $table->tinyInteger('online')->comment('在线人数');
            $table->string('is_disable')->comment('是否禁言');
            $table->string('recharge')->comment('充值要求');
            $table->string('chip')->comment('打码要求');
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
        Schema::dropIfExists('rooms');
    }
}
