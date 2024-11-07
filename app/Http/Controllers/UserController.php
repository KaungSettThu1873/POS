<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function UserHome() {
        $Products = Product::get();
        $Categories = Category::get();
        $Cart = Cart::where('user_id',Auth::user()->id)->get();
        $OrderList = Order::where('user_id',Auth::user()->id)->get();
        $User = User::where('id',Auth::user()->id)->first();


        return view('User.UserHome',compact('Products','Categories','Cart','OrderList','User'));
    }

    public function UserOrderList($id) {
        $OrderList = Order::where('user_id',$id)->orderBy('created_at','desc')->paginate(4);
        return view('User.Cart.OrderList',compact('OrderList'));
    }

    public function CategoryFilter($id) {


        $Products = Product::where('category_id',$id)->orderBy('created_at','desc')->get();
        $Categories = Category::get();
        $Cart = Cart::where('user_id',Auth::user()->id)->get();
        $OrderList = Order::where('user_id',Auth::user()->id)->get();
        $User = User::where('id',Auth::user()->id)->first();


        return view('User.UserHome',compact('Products','Categories','Cart','OrderList','User'));

    }

    //User Account Password Page
    public function UserAccountPasswordPage() {
        return view('User.UserAccount.UserPasswordChangePage');
    }

    //User Password Change
    public function UserPasswordChange(Request $request) {
        $this->AdminPasswordValidationCheck($request);
        $data =User::select('password')->where('id',Auth::user()->id)->first();
        $oldPassword = $data->password;


        if(Hash::check($request->currentPassword,$oldPassword)) {
            $password = [
                'password' => Hash::make($request->newPassword)
            ];
            User::where('id',Auth::user()->id)->update($password);
            Auth::logout();
            return redirect()->route('Login#Page');

        };

        return back()->with(['NotSame' => 'Your current password is wrong! TryAgain! '] );

    }

    //User Products Detail
    public function UserProductsDetail($id) {
        $Products = Product::select('products.*','categories.name as category_name')
                            ->leftjoin('categories','products.category_id','categories.id')
                            ->where('products.id',$id)->first();
        $AllPizza = Product::select('products.*','categories.name as category_name')
        ->leftjoin('categories','products.category_id','categories.id')->get();

  ;

        return view('User.Products.ProductsDetail',compact('Products','AllPizza'));
    }

    // //User Account Detail
    // public function UserAccountDetail() {
    //     return view('User.UserAccount.UserAccountDetail');
    // }

     //User Account Edit
    public function UserAccountEdit() {
        return view('User.UserAccount.UserAccountEdit');
    }

    //User Account Update
    public function UserAccountUpdate($id,Request $request) {
        $this->UserAccountUpdateValidationCheck($request);
        $data = $this->UserAccountData($request);

        $DBImage = User::where('id',$id)->first();
           if($request->hasFile('image')) {
               $DBImage = $DBImage->image;
               if($DBImage != null ) {
                   Storage::delete('public/'.$DBImage);
               }
               $fileName = uniqid() .$request->file('image')->getClientOriginalName();
               $request->file('image')->storeAs('public',$fileName);
               $data['image'] = $fileName;
           } else {
               $data['image'] =$DBImage->image;
           }
           User::where('id',$id)->update($data);
           return redirect()->route('User#Home');
    }

     //User Account Update Validation Check
     private function UserAccountUpdateValidationCheck($request) {
        Validator::make($request->all(),[
            'name' => 'required',
            'phone_number' => 'required',
            'address' => 'required',
        ])->validate();
}

// User Account Data Take
private function UserAccountData($request) {
    return [
        'name' => $request->name,
        'phone_number' => $request->phone_number,
        'address'   => $request->address,
        'image'     => $request->image
    ];
}



     //Admin Password Validation Check
     private function AdminPasswordValidationCheck($request) {

        Validator::make($request->all(),[
            'currentPassword'           => 'required|min:6,',
            'newPassword'               => 'required|min:6,',
            'newConfirmationPassword'   => 'required|min:6,same:newPassword'
        ])->validate();
    }
}
