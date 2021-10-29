<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DishController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\RecipeController;
use App\Http\Controllers\Api\RecipeStepController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//ingredient
Route::apiResource("ingredient",DishController::class);
Route::post('ingredient_update/{id}',[DishController::class,"ingredient_update"]);


//category
Route::apiResource("category",CategoryController::class);
Route::post("category_update/{id}",[CategoryController::class,"category_update"]);

//recipe
Route::apiResource("recipe",RecipeController::class);
Route::post("recipe_update/{id}",[RecipeController::class,"recipe_update"]);


//recipe_to_Ingredient
Route::post("recipe_to_ingredient",[RecipeController::class,"recipe_to_ingredient"]);
Route::delete("recipe_ingredient_delete/{id}",[RecipeController::class,"recipe_ingredient_delete"]);


Route::apiResource("recipe_step",RecipeStepController::class);

