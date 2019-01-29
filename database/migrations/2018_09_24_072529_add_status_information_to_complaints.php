<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStatusInformationToComplaints extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('complaint_entries', function (Blueprint $table) {
            $table->enum('status_changed', [
                'submitted', 'in_progress', 'completed'
            ])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('complaint_entries', function (Blueprint $table) {
            $table->dropColumn('status_changed');
        });
    }
}
