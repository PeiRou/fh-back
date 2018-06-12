<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBulletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bullets', function (Blueprint $table) {
            $table->increments('id');
            $table->text('content')->comment('公告内容');
            $table->string('type')->comment('房间');
            $table->string('created_hand')->comment('添加人');
            $table->string('updated_hand')->comment('修改人');
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
        Schema::dropIfExists('bullets');
    }
}
