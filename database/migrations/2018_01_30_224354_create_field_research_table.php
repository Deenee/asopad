<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFieldResearchTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Pivot table for field of interests and research
        Schema::create('field_research', function (Blueprint $table) {
            $table->integer('field_id');
            $table->integer('research_id');
            $table->integer('user_id')->nullable();
            $table->primary(['field_id', 'research_id']);
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
        Schema::dropIfExists('field_research');
    }
}
