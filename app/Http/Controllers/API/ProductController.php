<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $products = DB::table('products')
        //                 ->join('categories', 'products.category_id', 'categories.id')
        //                 ->join('suppliers', 'products.supplier_id', 'suppliers.id')
        //                 ->select('categories.categoryname', 'suppliers.name', 'products.*')
        //                 ->orderBy('products.id', 'DESC')
        //                 ->get();
        $products = Product::with('category', 'supplier')->get();
        return response()->json($products);
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
    public function store(ProductRequest $request)
    {
        $product_id =  Product::insertGetId([
            'category_id' => $request->input('category_id'),
            'supplier_id' => $request->input('supplier_id'),
            'product_name' => $request->input('product_name'),
            'product_code' => $request->input('product_code'),
            'product_description' => $request->input('product_description'),
            'product_root' => $request->input('product_root'),
            'buying_price' => $request->input('buying_price'),
            'selling_price' => $request->input('selling_price'),
            'product_quantity' => $request->input('product_quantity'),
            'alert_quantity' => $request->input('alert_quantity'),
            'buying_date' => $request->input('buying_date'),
            'created_at' => Carbon::now(),
        ]);

            $file_name = $request->product_image;

        if($file_name){
            $position = strpos($file_name, ';');
            $sub = substr($file_name, 0, $position);
            $file_extension = explode('/', $sub)[1];
            $name = time().".".$file_extension;
            $img = Image::make($file_name)->resize(480,400);
            $upload_path = 'photos/product/';
            $image_url = $upload_path.$name;
            $img->save($image_url);
            $product =  Product::find($product_id);
            $product->update([
                'product_image' => $image_url,
            ]);
        }
        
        return response()->json([
            'type' => 'success',
            'message' => "data inserted",
            'request' => $request->all(),
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return response()->json($product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product)
    {
        $product->update([
            'category_id' => $request->input('category_id'),
            'supplier_id' => $request->input('supplier_id'),
            'product_name' => $request->input('product_name'),
            'product_code' => $request->input('product_code'),
            'product_description' => $request->input('product_description'),
            'product_root' => $request->input('product_root'),
            'buying_price' => $request->input('buying_price'),
            'selling_price' => $request->input('selling_price'),
            'product_quantity' => $request->input('product_quantity'),
            'alert_quantity' => $request->input('alert_quantity'),
            'buying_date' => $request->input('buying_date'),
        ]);

            $file_name = $request->new_image;

        if($file_name){
            if($product->product_image){
                unlink($product->product_image);
            }
            $position = strpos($file_name, ';');
            $sub = substr($file_name, 0, $position);
            $file_extension = explode('/', $sub)[1];
            $name = time().".".$file_extension;
            $img = Image::make($file_name)->resize(480,400);
            $upload_path = 'photos/product/';
            $image_url = $upload_path.$name;
            $img->save($image_url);
            $product->update([
                'product_image' => $image_url,
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
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if($product->product_image){
            unlink($product->product_image); 
        }
        
        $product->delete();
        
        return response()->json([
            'type' => 'success',
            'message' => "data deleted",
        ],200);
    }
}
