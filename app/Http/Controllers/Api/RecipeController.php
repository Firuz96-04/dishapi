<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Recipe;
use App\Models\RecipeIngredient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $recipe = Recipe::query()->with(['ingredient','recipeStep','category'])->get();
        return response()->json([
            "recipe" => $recipe,
            "status" => "Ok"
        ], 200);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $date_now = date('Y-m-d');
        if ($request->hasFile('recipe_image')) {

            $image = $request->file('recipe_image')->store($date_now, 'public');
        } else {
            $image = null;
        }

        $recipe = Recipe::query()->create([
            "name" => trim($request->name),
            "kkal" => trim($request->kkal),
            "description" => trim($request->description),
            "count_people" => trim($request->count_people),
            "recipe_image" => $image,
            "category_id" => $request->category_id
        ]);
        return response()->json([
            'recipe' => $recipe,
            'status' => "OK"
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $recipe = Recipe::query()->find($id);
        $image = $recipe['recipe_image'];
        $image_path = strpos($image, '/');
        //folder path
        $image_folder = substr($image, 0, $image_path);
        //count foto as massiv
        $delete = $recipe->delete();
        if ($delete) {
            Storage::delete("public/" . $image);
            $folder = Storage::files('public/' . $image_folder);
            if (count($folder) == 0) {
                Storage::deleteDirectory('public/' . $image_folder);
            }
            return response()->json([
                "recipe" => $recipe,
                "count" => count($folder)
            ], 200);

        } else {
            return response()->json([
                "status" => "error delete"
            ]);
        }
    }

    public function recipe_update(Request $request, $id)
    {
        $recipe = Recipe::query()->find($id);
        $date_now = date("Y-m-d");
        $image_old = $recipe['recipe_image'];
        if ($request->hasFile('recipe_image')) {
            $image = $request->file('recipe_image')->store($date_now, "public");
            Storage::delete("public/" . $image_old);
        } else {
            $image = $image_old;
        }
        $recipe->update([
            "name" => $request->name,
            "kkal" => $request->kkal,
            "description" => $request->description,
            "count_people" => $request->count_people,
            "recipe_image" => $image,
            "category_id" => $request->category_id
        ]);
        return response()->json([
            "recipe" => $recipe,
            "status" => "OK"
        ], 200);
    }

    public function recipe_to_ingredient(Request $request)
    {
        $recipe_to_ing = RecipeIngredient::query()->create([
            "ingredient_id" => $request->ingredient_id,
            "recipe_id" => $request->recipe_id,
            "count" => $request->count
        ]);

        return response()->json([
            "recipe_to_ing" => $recipe_to_ing,
            "status" => "OK"
        ], 200);

    }

    public function recipe_ingredient_delete($id)
    {
        $recipe_to_ing = RecipeIngredient::query()->find($id);
        $recipe_to_ing->delete();
        return response([
            "recipe_to_ing" => $recipe_to_ing
        ], 201);
    }
}
