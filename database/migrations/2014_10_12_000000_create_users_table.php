<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->date('join_date')->nullable();
            $table->date('off_date')->nullable();
            $table->integer('type')->nullable();
            $table->integer('branch_id')->nullable();
            $table->integer('working_part_id')->nullable();
            $table->integer('approver_first')->nullable();
            $table->integer('approver_second')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->time('start_time_working');
            $table->time('end_time_working');
            $table->integer('role');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
