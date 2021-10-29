<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $category = Category::query()->get();
        return response()->json([
            "category" => $category,
            "status" => "Ok"
        ],200);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $date_now = date("Y-m-d");
        if ($request->hasFile('icon') ) {
            $image = $request->file('icon')->store($date_now,"public");
        }
        else {
            $image = null;
        }
        $category = Category::query()->create([
           "name"=> $request->name,
           "unit" => $request->unit,
           "icon" => $image
        ]);

        return  response()->json([
            "category" => $category,
            "status" => "Ok"
        ],201);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $category = Category::query()->find($id);
        $category->delete();
        return response()->json([
            "category" => $category,
            "status" => "Ok"
        ],201);
    }
    public function category_update(Request $request,$id)
    {
        $data_now = date("Y-m-d");
        $category = Category::query()->find($id);
        $image_old = $category["icon"];
        if ($request->hasFile('icon')) {
            $image = $request->file('icon')->store($data_now,'public');
        }
        else {
            $image = $image_old;
        }
        $category->update([
            "name" => $request->name,
            "unit" => $request->unit,
            "icon" => $image
        ]);

        return response()->json([
            "category" => $category,
            "status" => "OK"
        ],200);
    }
}
