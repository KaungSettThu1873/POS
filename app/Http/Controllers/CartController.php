<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function CartPage($id) {
        $Cart = Cart::select('carts.*','products.name as product_name','products.price as product_price')
        ->leftjoin('products','carts.product_id','products.id')
        ->where('carts.user_id',$id)->get();
        $TotalPrice = 0;
        foreach($Cart as $item) {
            $TotalPrice += $item->product_price*$item->quantity;
        };



        return view('User.Cart.CartPage',compact('Cart','TotalPrice'));
    }

}
