<?php

namespace App\Http\Controllers\API;

use App\Expense;
use App\Http\Controllers\Controller;
use App\Http\Requests\ExpenseRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expenses = Expense::all();
        return response()->json($expenses);
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
    public function store(ExpenseRequest $request)
    {
        $expense_id = Expense::insertGetId([
            'details' => $request->input('details'),
            'amount' => $request->input('amount'),
            'expense_date' => $request->input('expense_date'),
            'created_at' => Carbon::now(),
        ]);

        return response()->json([
            'type' => 'success',
            'message' => 'data inserted',
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function show(Expense $expense)
    {
        return response()->json($expense);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function edit(Expense $expense)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Expense $expense)
    {
        
        $expense->update([
            'details' => $request->input('details'),
            'amount' => $request->input('amount'),
            'expense_date' => $request->input('expense_date'),
        ]);

        return response()->json([
            'type' => 'success',
            'message' => 'data udapted',
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expense $expense)
    {
        $expense->delete();
        return response()->json([
            'type' => 'succes',
            'message' => 'data deleted!!!',
        ],200);
    }
}
