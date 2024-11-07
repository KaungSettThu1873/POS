<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //Register Page
    public function RegisterPageDirect() {

        return view('RegisterPage');
    }

    //Login Page
    public function LoginPageDirect() {
        return view('LoginPage');
    }



    //DashBoard
    public function dashboard() {
        if (Auth::user()->role == 'Admin') {
            return redirect()->route('Category#lists');
        } else {
            return redirect()->route('User#Home');
        }
    }

}
