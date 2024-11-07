<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    //Contact Page
    public function ContactPage() {
        return view('User.Contact.ContactPage');
    }

    //Contact Admin
    public function ContactAdmin(Request $request) {
        $this->ContactValidationCheck($request);
        $data = $this->ContactDataStore($request);
        Contact::create($data);
        return back()->with(['Success' => 'Message Sent!'] );
    }

    //Contact Validation Check
    private function ContactValidationCheck($request) {
        Validator::make($request->all(),[
            'contactName'    => 'required',
            'contactEmail'   => 'required',
            'contactMessage' => 'required'
        ],[
            'contactName.required'      => 'You need to fill your name!',
            'contactEmail.required'     => 'You need to fill your email!',
            'contactMessage.required'   => 'You need to fill your message!',
        ])->validate();
    }

    // Contact Data Store
    private function ContactDataStore($request) {
        return [
            'name'    => $request->contactName,
            'email'   => $request->contactEmail,
            'message' => $request->contactMessage
        ];
    }
}
