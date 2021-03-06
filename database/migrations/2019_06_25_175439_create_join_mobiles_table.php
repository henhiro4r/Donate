<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJoinMobilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('join_mobiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('jadwal_mobile_id');
            $table->bigInteger('utd_id');
            $table->enum('status',['0','1']);
            $table->text('keterangan')->nullable();
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
        Schema::dropIfExists('join_mobiles');
    }
}
