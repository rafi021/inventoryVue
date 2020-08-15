<?php

namespace App\Http\Controllers\API;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Image;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return response()->json($categories);
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
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $category_id =  Category::insertGetId([
            'categoryname' => $request->input('categoryname'),
            'categorydescription' => $request->input('categorydescription'),
            'created_at' => Carbon::now(),
        ]);

        if($request->photo){
            $position = strpos($request->photo, ';');
            $sub = substr($request->photo, 0, $position);
            $file_extension = explode('/', $sub)[1];
            $name = time().".".$file_extension;
            $img = Image::make($request->photo)->resize(240,200);
            $upload_path = 'photos/category/';
            $image_url = $upload_path.$name;
            $img->save($image_url);
            $category =  Category::find($category_id);
            $category->update([
                'categoryphoto' => $image_url,
            ]);
        }
        
        return response()->json([
            'type' => 'success',
            'message' => "data inserted",
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return response()->json($category);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $category->update([
            'categoryname' => $request->input('categoryname'),
            'categorydescription' => $request->input('categorydescription'),
        ]);
        
        if($request->new_photo){
            if($category->categoryphoto){
                unlink($category->categoryphoto);
            }
            $position = strpos($request->new_photo, ';');
            $sub = substr($request->new_photo, 0, $position);
            $file_extension = explode('/', $sub)[1];
            $name = time().".".$file_extension;
            $img = Image::make($request->new_photo)->resize(240,200);
            $upload_path = 'photos/category/';
            $image_url = $upload_path.$name;
            $img->save($image_url);
            $category->update([
                'categoryphoto' => $image_url,
            ]);
        }

        return response()->json([
            'type' => 'success',
            'message' => "data updated",
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if($category->photo){
            unlink($category->photo); 
        }
        
        $category->delete();
        
        return response()->json([
            'type' => 'success',
            'message' => "data deleted",
        ],200);
    }
}
