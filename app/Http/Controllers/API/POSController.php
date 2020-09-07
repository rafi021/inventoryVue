<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Order;
use App\OrderDetail;
use App\Pos;
use App\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class POSController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
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
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getProduct($id)
    {
        $products = Product::where('category_id', $id)->get();
        return response()->json($products);
    }

    public function orderStore(Request $request)
    {
        $validateData = $request->validate([
            'customer_id' => 'required',
            'payment_method' => 'required'
        ]);

        $order_id = Order::insertGetId([
            'customer_id' => $request->input('customer_id'),
            'quantity' => $request->input('qty'),
            'pay_amount' => $request->input('pay_amount'),
            'due_amount' => $request->input('due_amount'),
            'subtotal' => $request->input('subtotal'),
            'total' => $request->input('total'),
            'payment_method' => $request->input('payment_method'),
            'created_at' => Carbon::now()
        ]);

        $pos_data = Pos::all();

        foreach ($pos_data as $item) {
            OrderDetail::insert([
                'order_id' => $order_id,
                'product_id' => $item->product_id,
                'product_quantity' => $item->product_quantity,
                'product_price' => $item->product_price,
                'sub_total' => $item->sub_total,
                'created_at' => Carbon::now(),
            ]);
            Product::findOrFail($item->product_id)->decrement('product_quantity', $item->product_quantity);
            // forceDelete from pos cart table
            $item->delete();
        }

        return response()->json([
            'type' => 'success',
            'message' => "Order Placed Successfully!!!",
            'request' => $request->all(),
        ],200);
    }
}
