<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVacationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vacations', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->date('start_date');
            $table->date('end_date');
            $table->text('reason');
            $table->text('type')->nullable();
            $table->dateTime('approval_date')->nullable();
            $table->integer('approver')->nullable();
            $table->integer('manager_confirm')->nullable();
            $table->time('start_time_1')->nullable();
            $table->time('end_time_1')->nullable();
            $table->time('start_time_2')->nullable();
            $table->time('end_time_2')->nullable();
            $table->string('total_time')->nullable();
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
        Schema::dropIfExists('vacations');
    }
}
