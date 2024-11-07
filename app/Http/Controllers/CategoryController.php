<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class CategoryController extends Controller
{
    public function CategoryLists() {

        $categories = Category::when(request('key'),function($query){
            $query->where('name','like','%'.request('key').'%');
        })
        ->orderBy('created_at','desc')->paginate('10');

        return view('Admin.CatogeryList',compact('categories'));
    }

    //category Page
    public function CategoryCreatePage() {
        return view('Admin.CatogeryCreate');
    }

    //Category Create
    public function CategoryCreate(Request $request) {


        $this->CategoryCreateValidationCheck($request);
        $data = $this->RequestCategoryStoreData($request);
        Category::create($data);
        return redirect()->route('Category#lists');
    }

    //Category Delete
    public function CategoryDelete($id) {
        Category::where('id',$id)->delete();
        return redirect()->route('Category#lists')->with(['DeleteSuccess'=>'Delete Success!']);

    }

    //Edit Page
    public function CategoryEditPage($id) {
        $data = Category::where('id',$id)->first();

        return view('Admin.CatogeryEdit',compact('data'));
    }

    //Category update
    public function CategoryUpdate(Request $request) {

        $this->CategoryCreateValidationCheck($request);
        $data = $this->RequestCategoryStoreData($request);
        Category::where('id',$request->id)->update($data);
        return redirect()->route("Category#lists");
    }



    //Category Create Validation Check
    public function CategoryCreateValidationCheck($request) {
        Validator::make($request->all(),
        [
            'categories_name' => 'required|unique:categories,name,'.$request->id
        ],
        [
            'categories_name.required' => 'You need to fill Category Name...',
            'categories_name.unique'   => 'Your Category name is same in lists!'
        ])->validate();
    }

    //Category Store Data
    public function RequestCategoryStoreData($request) {
        return[
            'name' => $request->categories_name,
        ];
    }
}
