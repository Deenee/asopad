<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResearchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('researches', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('field_of_research')->default('*');
            $table->text('description');
            $table->timestamps();
        });

        Schema::create('research_user', function (Blueprint $table) {
            $table->integer('research_id')->unsigned()->index();
            $table->integer('user_id')->unsigned()->index(); 
            $table->enum('owner', ['guest', 'owner']); 
            $table->primary(['user_id', 'research_id']);
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
        Schema::dropIfExists('researches');
        Schema::dropIfExists('research_user');
    }
}
