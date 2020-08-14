<?php

namespace App\Http\Controllers\API;

use App\Employee;
use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Image;
class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employee = Employee::all();
        return response()->json($employee);
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
    public function store(EmployeeRequest $request)
    {
        $employee_id = Employee::insertGetId([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'salary' => $request->input('salary'),
            'address' => $request->input('address'),
            'nid' => $request->input('nid'),
            'joining_date' => $request->input('joining_date'),
            'created_at' => Carbon::now(),
        ]);

        if($request->photo){
            $position = strpos($request->photo, ';');
            $sub = substr($request->photo, 0, $position);
            $file_extension = explode('/', $sub)[1];
            $name = time().".".$file_extension;
            $img = Image::make($request->photo)->resize(240,200);
            $upload_path = 'photos/employee/';
            $image_url = $upload_path.$name;
            $img->save($image_url);
            $employee =  Employee::find($employee_id);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        return response()->json($employee);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeeRequest $request, Employee $employee)
    {
        $employee->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'salary' => $request->input('salary'),
            'address' => $request->input('address'),
            'nid' => $request->input('nid'),
            'joining_date' => $request->input('joining_date'),
        ]);
        
        if($request->new_photo){
            unlink($employee->photo);
            $position = strpos($request->new_photo, ';');
            $sub = substr($request->new_photo, 0, $position);
            $file_extension = explode('/', $sub)[1];
            $name = time().".".$file_extension;
            $img = Image::make($request->new_photo)->resize(240,200);
            $upload_path = 'photos/employee/';
            $image_url = $upload_path.$name;
            $img->save($image_url);
            $employee->update([
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        if($employee->photo){
            unlink($employee->photo); 
        }
        
        $employee->delete();
        
        return response()->json([
            'type' => 'success',
            'message' => "data deleted",
        ],200);
    }
}
