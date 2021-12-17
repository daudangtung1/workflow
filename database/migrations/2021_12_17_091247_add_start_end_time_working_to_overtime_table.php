<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStartEndTimeWorkingToOvertimeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('overtime_registers', function (Blueprint $table) {
            $table->time('start_time_working');
            $table->time('end_time_working');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('overtime_registers', function (Blueprint $table) {
            $table->dropColumn('start_time_working');
            $table->dropColumn('end_time_working');
        });
    }
}
