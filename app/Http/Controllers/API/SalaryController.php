<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Salary;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $salaries = Salary::all();
        $salaries = DB::table('salaries')->select('salary_month')->groupBy('salary_month')->get();
        return response()->json($salaries);
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
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'salary_month' => 'required'
        ]);
        
        $month = $request->input('salary_month');
        $check = Salary::where('employee_id', $request->input('id'))->where('salary_month', $month)->first();
        
        if($check){
            return response()->json([
                'type' => 'danger',
                'message' => 'Salary Already Paid',
            ],200);
        }else{
            Salary::insert([
                'employee_id' => $request->input('id'),
                'amount' => $request->input('salary'),
                'salary_date' => Carbon::now()->format('d/m/y'),
                'salary_month' => $request->input('salary_month'),
                'salary_year' => Carbon::now()->format('Y'),
                'created_at' => Carbon::now(),
            ]);

            return response()->json([
                'type' => 'success',
                'message' => 'data inserted!!',
            ],200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function showSalary($id)
    {
        $month = $id;
        $view = DB::table('salaries')->join('employees','salaries.employee_id', 'employees.id')
                        ->select('employees.name','salaries.*')
                        ->where('salaries.salary_month', $month)
                        ->get();
        return response()->json($view);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function edit(Salary $salary)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Salary $salary)
    {
        $validateData = $request->validate([
            'employee_id' => 'numeric',
            'amount' => 'numeric',
        ]);

       $salary->update([
            'employee_id' => $request->input('employee_id'),
            'amount' => $request->input('amount'),
            'salary_date' => $request->input('salary_date'),
            'salary_month' => $request->input('salary_month'),
            'salary_year' => $request->input('salary_year'),
        ]);

        return response()->json([
            'type' => 'success',
            'message' => 'data updated!!',
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function destroy(Salary $salary)
    {
        $salary->delete();
        return response()->json([
            'type' => 'success',
            'message' => 'data deleted!!!',
        ],200);
    }
}
