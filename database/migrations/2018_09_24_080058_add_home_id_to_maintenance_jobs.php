<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddHomeIdToMaintenanceJobs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('maintenance_jobs', function (Blueprint $table) {
            $table->integer('home_id')->unsigned()->nullable();
            $table->foreign('home_id')->references('id')->on('homes')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('maintenance_jobs', function (Blueprint $table) {
            $table->dropColumn(['home_id']);
        });
    }
}
