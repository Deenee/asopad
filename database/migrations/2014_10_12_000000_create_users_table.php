<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('password')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('email_token')->nullable();
            $table->enum('email_status', ['unverified', 'verified']);
            $table->string('field_of_study')->nullable();
            $table->integer('institution_id')->nullable();
            $table->integer('department_id')->nullable();
            $table->string('provider')->nullable(); // Write a validation check if a provider and provider id are null, password is required
            $table->string('current_location')->nullable();
            $table->enum('type',['researcher', 'reviewer', 'mentor']);
            $table->string('provider_id')->nullable();
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
