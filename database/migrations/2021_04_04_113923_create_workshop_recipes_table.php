<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkshopRecipesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workshop_recipes', function (Blueprint $table) {
            $table->id();

            $table->integer('duration')->unsigned();

            $table->bigInteger('workshop_id')->unsigned();
            $table->foreign('workshop_id')
                ->references('id')
                ->on('workshops')
                ->onDelete('cascade');

            $table->bigInteger('recipe_id')->unsigned();
            $table->foreign('recipe_id')
                ->references('id')
                ->on('recipes')
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
        Schema::dropIfExists('workshop_recipes');
    }
}
