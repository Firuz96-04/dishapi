<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ingredient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use function PHPUnit\Framework\isNull;

class DishController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */

    public function index()
    {
        $ingredient = Ingredient::query()->get();
        if (count($ingredient) > 0) {
            return response()->json([
                "ingredient" => $ingredient,
                "status" => "OK",
                "count" => count($ingredient)
            ], 200);
        } else {
            return response()->json([

                "status" => "error",
                "count" => count($ingredient)
            ], 400);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {

        $data_now = date('Y-m-d');
        if ($request->hasFile('icon') ) {
            $image = $request->file('icon')->store($data_now, "public");
        } else {
            $image = null;

        }
        $ingredient = Ingredient::query()->create([
            "name" => $request->name,
            "unit" => $request->unit,
            "icon" => $image
        ]);

        return response()->json([
            "ingredient" => $ingredient,
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
    }
    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id): \Illuminate\Http\JsonResponse
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
        $dish = Ingredient::query()->find($id);
        $image = $dish["icon"];
        Storage::delete('public/' . $image);
        $dish->delete();

        return response()->json([
            "status" => "Ok",
            "dish" => $dish
        ], 201);
    }

    public function ingredient_update(Request $request,$id)
    {

        $data_now = date('Y-m-d');
        $ingredient = Ingredient::query()->find($id);
        $image_old = $ingredient["icon"];

        if ($request->hasFile('icon')) {
            $image = $request->file('icon')->store($data_now,'public');

        }
        else {
            $image = $image_old;
        }

        $ingredient->update([
            'name' => $request->name,
            'unit' => $request->unit,
            'icon' => $image
        ]);

       // Storage::delete('public/'.$image_old);
        return response()->json([
            "status" => "OK",
        ], 201);
    }

}
