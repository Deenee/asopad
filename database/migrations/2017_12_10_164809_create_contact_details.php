<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactDetails extends Migration
{
    /**
     * Run the migrations.
     *This migration holds all the possible contact details of the user.
     The type fields determines the type of contact. good idea?
     * @return void
     */
    public function up()
    {
        Schema::create('contact_details', function (Blueprint $table) {
            $table->integer('user_id')->unsigned()->index();
            $table->string('contact');
            $table->enum('type', ['phone_number', 'address', 'skype']);
            $table->timestamps();
            $table->primary(['user_id', 'contact']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contact_details');
    }
}
