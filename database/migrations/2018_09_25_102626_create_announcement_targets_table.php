<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnnouncementTargetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('announcement_targets', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('announcement_id')->nullable()->unsigned();
            $table->foreign('announcement_id')->references('id')->on('announcements');

            $table->integer('home_id')->nullable()->unsigned();
            $table->foreign('home_id')->references('id')->on('homes');

            $table->integer('area_id')->nullable()->unsigned();
            $table->foreign('area_id')->references('id')->on('areas');

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
        Schema::dropIfExists('announcement_targets');
    }
}
