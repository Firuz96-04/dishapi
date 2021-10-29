<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\RecipeStep;
use Illuminate\Http\Request;

class RecipeStepController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): \Illuminate\Http\Response
    {
        $recipe_step = RecipeStep::query()->with("recipe")->get();
        //       dd($recipe_step);
        return response([
            "recipe_step" => $recipe_step,
            "status" => "OK"
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $recipe_step = RecipeStep::query()->create([
            "recipe_id" => $request->recipe_id,
            "ingredient_id" => $request->ingredient_id,
            "step_number" => $request->step_number,
            "time_step" => $request->time_step,
            "description" => $request->description
        ]);
        return response()->json(
            [
                "recipe_step" => $recipe_step,
                "status" => "OK"
            ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $recipe_step = RecipeStep::query()->where("recipe_id", "=", $id)->with("recipe")->orderBy("step_number")->get();
        //       dd($recipe_step);
        return response([
            "recipe_step" => $recipe_step,
            "status" => "OK"
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $my_arr = [];
        $get_recipe = RecipeStep::query()->find($id);
        $old_id_key = $get_recipe->id;
        $old_step_value = $get_recipe->step_number;
        $recipeStep = RecipeStep::query()->where("recipe_id",  $request->recipe_id)->get();
        foreach ($recipeStep as $key => $value) {
            $my_arr[$value->id] = $value->step_number;
        }
        $new_step_value = $request->step_number;
        $new_id_key = null;

        $key = array_search($request->step_number, $my_arr);
                if ($key) {
            $new_id_key = $key;
            RecipeStep::query()->find($key)->update([
                "step_number" => $old_step_value,
            ]);

            RecipeStep::query()->find($old_id_key)->update([
                "step_number" => $new_step_value,
                "time_step" => $request->time_step,
                "ingredient_id" => $request->ingredient_id,
                "description" => $request->description
                ]);

        }
        return response()->json([
            "statusMessage" => "OK"
        ], 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */

    public function destroy($id)
    {
        $recipeStepDel = RecipeStep::query()->find($id);
        $delRecipe = $recipeStepDel->delete();
        if ($delRecipe) {
            return response()->json([
                "recipeStepDel" => $recipeStepDel,
                "status" => "OK"
            ], 200);
        }

    }

}
