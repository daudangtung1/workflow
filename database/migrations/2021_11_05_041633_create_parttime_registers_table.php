<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParttimeRegistersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parttime_registers', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->date('date');
            $table->time('start_time_first')->nullable();
            $table->time('end_time_first')->nullable();
            $table->time('start_time_second')->nullable();
            $table->time('end_time_second')->nullable();
            $table->time('start_time_third')->nullable();
            $table->time('end_time_third')->nullable();
            $table->dateTime('approval_date')->nullable();
            $table->integer('approver')->nullable();
            $table->integer('manager_confirm')->nullable();
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
        Schema::dropIfExists('parttime_registers');
    }
}
