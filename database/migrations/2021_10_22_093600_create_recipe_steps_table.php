<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecipeStepsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recipe_steps', function (Blueprint $table) {
            $table->increments("id");
            $table->bigInteger("recipe_id")->unsigned();
            $table->foreign("recipe_id")->references("id")->on("recipes");
            $table->bigInteger("ingredient_id")->unsigned();
            $table->foreign("ingredient_id")->references("id")->on("ingredients");
            $table->smallInteger("step_number")->default(0);
            $table->string("time_step",5)->nullable();
            $table->text("description")->nullable();
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
        Schema::dropIfExists('recipe_steps');
    }
}
