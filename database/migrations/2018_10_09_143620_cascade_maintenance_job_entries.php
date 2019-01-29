<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CascadeMaintenanceJobEntries extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('maintenance_job_entries', function (Blueprint $table) {
            $table->dropForeign(['maintenance_job_id']);
            $table->foreign('maintenance_job_id')->references('id')->on('maintenance_jobs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('maintenance_job_entries', function (Blueprint $table) {
            //
        });
    }
}
