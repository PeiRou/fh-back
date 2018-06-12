<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlatcfgsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('platcfgs', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('is_open')->comment('是否开启聊天室');
            $table->string('schedule_type')->comment('计划发布方式');
            $table->string('schedule_games')->comment('计划推送游戏');
            $table->string('schedule_msg')->nullable()->comment('计划底部信息');
            $table->string('start_time')->comment('发言起始时间');
            $table->string('end_time')->comment('发言结束时间');
            $table->boolean('is_auto')->comment('是否展开聊天室');
            $table->tinyInteger('min_money')->comment('下注最低推送额');
            $table->string('ip_black')->comment('IP黑名单');
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
        Schema::dropIfExists('platcfgs');
    }
}
