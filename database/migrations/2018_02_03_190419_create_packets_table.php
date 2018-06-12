<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePacketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type')->comment('房间');
            $table->decimal('money',10,2)->comment('红包总金额');
            $table->decimal('sel_money',10,2)->comment('红包剩余金额');
            $table->tinyInteger('count')->comment('红包总数');
            $table->tinyInteger('sel_count')->comment('红包已抽个数');
            $table->integer('recharge')->comment('最低充值金额');
            $table->integer('chip')->comment('最低打码金额');
            $table->string('status')->comment('红包状态');
            $table->string('created_hand')->comment('操作人');
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
        Schema::dropIfExists('packets');
    }
}
