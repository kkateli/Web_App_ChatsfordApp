<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CascadeAnnouncementTargets extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('announcement_targets', function (Blueprint $table) {
            $table->dropForeign(['announcement_id']);
            $table->foreign('announcement_id')
                ->references('id')->on('announcements')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('announcement_targets', function (Blueprint $table) {
            //
        });
    }
}
