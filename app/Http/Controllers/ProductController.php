<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    // Products Lists
    public function AdminProductsLists() {
        $Products = Product::select('products.*','categories.name as category_name')
                        ->when(request('key'),function($query){
                        $query->where('products.name','like','%'.request('key').'%');
                        })
                        ->leftjoin('categories','products.category_id','categories.id')
                        ->orderBy('products.created_at','desc')
                        ->paginate('5');


        return view('Admin.Products.ProductLists',compact('Products'));
    }

    //Admin Products Create Page
    public function AdminProductsCreatePage() {
        $categories = Category::get();

        return view('Admin.Products.ProductsCreatePage',compact('categories'));
    }

    // Admin Products Create
    public function AdminProductsCreate(Request $request) {
        $this->AdminProductsCreateValidationCheck($request,'Create');
        $data = $this->AdminProductsCreateDataTake($request);

        $fileName = uniqid() .$request->file('pizzaImage')->getClientOriginalName();
        $request->file('pizzaImage')->storeAs('public',$fileName);
        $data['image'] = $fileName;

        Product::create($data);
        return redirect()->route('Admin#ProductsLists');
    }

    //AdminProductDelete

    public function AdminProductDelete($id) {
        Product::where('id',$id)->delete();
        return back()->with(['DeleteSuccess' => 'Delete Success!']);
    }

    //Admin Products Detail
    public function AdminProductDetail($id) {
        $Products = Product::select('products.*','categories.name as category_name')
                            ->leftjoin('categories','products.category_id','categories.id')
                            ->where('products.id',$id)->first();
        return view('Admin.Products.ProductDetail',compact('Products'));
    }

    //Admin Product Edit Page
    public function AdminProductEditPage($id) {
        $Products = Product::where('products.id',$id)->first();
        $Categories = Category::get();
        return view('Admin.Products.ProductsEdit',compact('Products','Categories'));
    }

    //Admin Product Edit
    public function AdminProductEdit($id,Request $request) {
            $this->AdminProductsCreateValidationCheck($request,'Update');
            $data = $this->AdminProductsCreateDataTake($request);
            $oldImage = Product::where('id',$id)->first();
                if($request->hasFile('pizzaImage')) {
                    $oldImage = $oldImage->image;
                    if($oldImage != null) {
                        Storage::delete('public/'.$oldImage);
                    }
                    $fileName = uniqid() .$request->file('pizzaImage')->getClientOriginalName();
                    $request->file('pizzaImage')->storeAs('public',$fileName);
                    $data['image']  = $fileName;
                } else {
                    $data['image'] = $oldImage->image;
                }
            Product::where('id',$id)->update($data);
            return redirect()->route('Admin#ProductsLists');
    }

    //Admin Products Create ValidationCheck
    private function AdminProductsCreateValidationCheck($request,$action) {
            $validationRule = [
            'pizzaName'         => 'required',
            'pizzaCategory'     => 'required',
            'pizzaDescription'  => 'required',
            'pizzaWaitingTime'  => 'required',
            'pizzaPrice'        => 'required'
            ];

            if($action == 'Create') {
                $validationRule['pizzaImage'] = 'required' ;
            } else {
                $validationRule['pizzaImage'] = 'mimes:jpg,webp,jpeg' ;
            };

            $validationMessage = [
                'pizzaName.required'            => "You need to fill!",
                'pizzaCategory.required'        => "You need to fill!",
                'pizzaDescription.required'     => "You need to fill!",
                'pizzaImage.required'            => "You need to fill!",
                'pizzaWaitingTime.required'     => "You need to fill!",
                'pizzaPrice.required'           => "You need to fill!",
            ];

        Validator::make($request->all(),$validationRule,$validationMessage)->validate(); }


    private function AdminProductsCreateDataTake($request) {
        return [
                'category_id' =>    $request->pizzaCategory,
                'name'        =>    $request->pizzaName,
                'description' =>    $request->pizzaDescription,
                'image'       =>    $request->pizzaImage,
                'waiting_time'=>    $request->pizzaWaitingTime,
                'price'       =>    $request->pizzaPrice
        ];
    }
}
