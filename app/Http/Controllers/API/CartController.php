<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Pos;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function alltToCart(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $check = Pos::where('product_id', $id)->first();

        if($check){
            DB::table('pos')->where('product_id', $id)->increment('product_quantity');
            $product = Pos::where('product_id',$id)->first();
            $subtotal = $product->product_quantity*$product->product_price;
            $product->update([
                'sub_total' => $subtotal,
            ]);
        }else{
            Pos::insert([
                'product_id' => $product->id,
                'product_name' => $product->product_name,
                'product_quantity' => 1,
                'product_price' => $product->selling_price,
                'sub_total' => $product->selling_price,
            ]);
        }
        return response()->json([
            'type' => 'success',
            'message' => 'Product Added to Cart'
        ],200);
    }

    public function allCartProduct()
    {
        $cart_products = Pos::all();
        return response()->json($cart_products);
    }

    public function removeFromCart($id)
    {
        $pos = Pos::findOrFail($id);
        $pos->delete();
        return response()->json([
            'type' => 'success',
            'message' => 'Product removed from Cart'
        ],200);
    }

    public function incrementCart($id)
    {
        $quantity = DB::table('pos')->where('id', $id)->increment('product_quantity');
        $product = Pos::findOrFail($id);
        
        $subtotal = $product->product_quantity*$product->product_price;
        $product->update([
            'sub_total' => $subtotal,
        ]);
        return response()->json([
            'type' => 'success',
            'id' => $id,
            'message' => 'Product added to Cart'
        ],200);
    }

    public function decrementCart($id)
    {
        $quantity = DB::table('pos')->where('id', $id)->decrement('product_quantity');
        $product = Pos::findOrFail($id);
        
        $subtotal = $product->product_quantity*$product->product_price;
        $product->update([
            'sub_total' => $subtotal,
        ]);
        return response()->json([
            'type' => 'success',
            'id' => $id,
            'message' => 'Product reduced from Cart'
        ],200);
    }
}
