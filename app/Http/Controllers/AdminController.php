<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
      //Admin Password Page
      public function AdminPasswordPage() {

        return view('Admin.AdminPasswordPage');
    }

    //Admin Password Change
    public function AdminPasswordChange(Request $request) {

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

    //Admin Account Page
    public function AdminAccountPage() {
        return view('Admin.AdminAccountPage');
    }

    //Admin Account update Page
    public function AdminAccountUpdatePage() {
        return view('Admin.AdminAccountUpdatePage');
    }

    //Admin Account Update
    public function AdminAccountUpdate($id,Request $request) {
         $this->AdminAccountUpdateValidationCheck($request);
         $data = $this->AdminAccountData($request);

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
            return redirect()->route('Admin#AccountPage');
    }

    //Admin List Page
    public function AdminListPage() {
        $AdminDB = User::when(request('key'),function($query){
            $query->orwhere('name','like','%'.request('key').'%')
                  ->orwhere('email','like','%'.request('key').'%');
        })->where('role','Admin')->paginate('5');
        return view('Admin.AdminListPage',compact('AdminDB'));
    }

    // Admin List Edit Page
    public function AdminListEditPage($id) {
        $AdminEdit = User::when(request('key'),function($query){
            $query->where('name','like','%'.request('key').'%');
        })->where('id',$id)->first();
        return view('Admin.AdminListEditPage',compact('AdminEdit'));
    }

    //Admin List Edit
    public function AdminListEdit($id,Request $request) {
        $this->AdminAccountUpdateValidationCheck($request);
        $data = $this->AdminAccountData($request);
        User::where('id',$id)->update($data);
        return redirect()->route('Admin#ListPage');
    }


    //Admin Delete
    public function AdminDelete($id) {
        User::where('id',$id)->delete();
        return redirect()->route('Admin#ListPage')->with(['DeleteSuccess'=>'Admin Delete Success']);
    }


    //Customer Message Lists
    public function CustomerMessageLists() {
        $contact = Contact::orderBy('created_at','desc')->paginate('10');
        return view('Admin.CustomerMessageLists',compact('contact'));
    }

    //Customer Message Delete
    public function CustomerMessageDelete($id) {
        Contact::where('id',$id)->delete();
        return back()->with(['deleteSuccess'=>'Message Delete Success!']);

    }

    //Customer Message Detail
    public function CustomerMessageDetail($id) {
        $contact = Contact::where('id',$id)->first();
        return view('Admin.CustomerMessageDetail',compact('contact'));
    }

     //User List Page
     public function UserListPage() {
        $userData = User::when(request('key'),function($query){
            $query->orwhere('name','like','%'.request('key').'%')
                  ->orwhere('email','like','%'.request('key').'%');
        })->where('role','User')->paginate('5');
        return view('Admin.UserListPage',compact('userData'));
    }


    //UserListEditPage
    public function UserListEditPage($id) {
        $UserEdit = User::when(request('key'),function($query){
            $query->where('name','like','%'.request('key').'%');
        })->where('id',$id)->first();
        return view('Admin.UserListEditPage',compact('UserEdit'));
    }

    //User List Edit

       public function UserListEdit($id,Request $request) {
        $this->AdminAccountUpdateValidationCheck($request);
        $data = $this->AdminAccountData($request);
        User::where('id',$id)->update($data);
        return redirect()->route('User#ListPage');
    }





    //Admin Password Validation Check
    private function AdminPasswordValidationCheck($request) {

        Validator::make($request->all(),[
            'currentPassword'           => 'required|min:6,',
            'newPassword'               => 'required|min:6,',
            'newConfirmationPassword'   => 'required|min:6,same:newPassword'
        ])->validate();
    }

    //Admin Account Update Validation Check
    private function AdminAccountUpdateValidationCheck($request) {
            Validator::make($request->all(),[
                'name' => 'required',
                'phone_number' => 'required',
                'address' => 'required',
            ])->validate();
    }

    // Admin Account Data Take
    private function AdminAccountData($request) {
        return [
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'address'   => $request->address,
            'image'     => $request->image
        ];
    }
}
