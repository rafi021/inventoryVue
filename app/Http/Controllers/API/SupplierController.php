<?php

namespace App\Http\Controllers\API;

use App\Supplier;
use App\Http\Controllers\Controller;
use App\Http\Requests\SupplierRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Image;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers = Supplier::all();
        return response()->json($suppliers); 
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
    public function store(SupplierRequest $request)
    {
        $employee_id = Supplier::insertGetId([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
            'created_at' => Carbon::now(),
        ]);

        if($request->photo){
            $position = strpos($request->photo, ';');
            $sub = substr($request->photo, 0, $position);
            $file_extension = explode('/', $sub)[1];
            $name = time().".".$file_extension;
            $img = Image::make($request->photo)->resize(240,200);
            $upload_path = 'photos/supplier/';
            $image_url = $upload_path.$name;
            $img->save($image_url);
            $employee =  Supplier::find($employee_id);
            $employee->update([
                'photo' => $image_url,
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
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        return response()->json($supplier);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(SupplierRequest $request, Supplier $supplier)
    {
        $supplier->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'shopname' => $request->input('shopname'),
            'address' => $request->input('address'),
        ]);
        
        if($request->new_photo){
            if($supplier->photo){
                unlink($supplier->photo);
            }
            $position = strpos($request->new_photo, ';');
            $sub = substr($request->new_photo, 0, $position);
            $file_extension = explode('/', $sub)[1];
            $name = time().".".$file_extension;
            $img = Image::make($request->new_photo)->resize(240,200);
            $upload_path = 'photos/supplier/';
            $image_url = $upload_path.$name;
            $img->save($image_url);
            $supplier->update([
                'photo' => $image_url,
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
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        if($supplier->photo){
            unlink($supplier->photo); 
        }
        
        $supplier->delete();
        
        return response()->json([
            'type' => 'success',
            'message' => "data deleted",
        ],200);
    }
}
