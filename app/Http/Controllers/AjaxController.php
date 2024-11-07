<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderLists;
use App\Models\User;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    public function AjaxProductsList(Request $request) {

            if($request->status == 'desc'){
                $data = Product::orderBy('created_at','desc')->get();
            } else{
                $data = Product::orderBy('created_at','asc')->get();
            }

            logger($data);

            return response()->json($data,200);

    }

    public function AddToCart(Request $request) {
            $data =  $this->GetOrderData($request);

        Cart::create($data);
        $response = [
            'message' => 'Add to cart completed',
            'status' => 'success'
        ];
        return response()->json($response,200);
    }



    //Order
        public function Order(Request $request) {
            logger($request->all());
            $total = 0;
            foreach($request->all() as $item) {
                  $data =   OrderLists::create([
                    'user_id' =>    $item['user_id'],
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'total' => $item['total'],
                    'order_code' => $item['order_code']
                  ]);

                  $total += $data->total;

                }

                Order::create([
                    'user_id' => Auth::user()->id,
                    'order_code' => $data->order_code,
                    'total_price' => $total + 3000
                    ]);




                Cart::where('user_id',Auth::user()->id)->delete();

                return response()->json([
                    'status' => 'true',
                'message' => 'order completed'
                 ],200);
        }

//         //public function Order(Request $request) {
//     logger($request->all());

//     foreach($request->all() as $item) {
//         $data = OrderLists::create([
//             'user_id' => $item['user_id'],
//             'product_id' => $item['product_id'],
//             'quantity' => $item['quantity'],
//             'total' => $item['total'],
//             'order_code' => $item['order_code']
//         ]);

//         Order::create([
//             'user_id' => Auth::user()->id,
//             'order_code' => $data->order_code,
//             'total_price' => $data->total
//         ]);
//     }

//     // Clear the cart after processing all items
//     Cart::where('user_id', Auth::user()->id)->delete();

//     return response()->json([
//         'status' => 'true',
//         'message' => 'order completed'
//     ], 200);
// }

    //ClearCart

    public function ClearCart() {
        Cart::where('user_id',Auth::user()->id)->delete();
    }

    //Current Clear Cart
    public function CurrentClearCart(Request $request) {
        Cart::where('user_id',Auth::user()->id)
            ->where('product_id',$request->productId)
            ->where('id',$request->uniqueId)
            ->delete();
    }

  //AdminRoleChange
  public function AdminRoleChange(Request $request) {
    logger($request->all());

    // Retrieve the user instance
    $user = User::find($request->userID);

    // Toggle user role
    if ($user->role == 'Admin') {
        $user->role = 'User';
    } elseif ($user->role == 'User') {
        $user->role = 'Admin';
    }

    // Log the updated user data
    logger($user);

    // Save the updated user
    $user->save();

    return response()->json([
        'success' => 'User role updated successfully', 200
    ]);
}

//AjaxViewCount
public function AjaxViewCount(Request $request) {
 logger($request->all());
 $product = Product::where('id',$request->ProductId)->first();

 $viewCount = [
    'view_count' => $product->view_count+1
 ];

 Product::where('id',$request->ProductId)->update($viewCount);

}







    //Get Order Data
    private function GetOrderData($request) {
        return [
            'user_id' => $request->UserId,
            'product_id' => $request->ProductId,
            'quantity'  =>  $request->CartQty
        ];
    }


}
