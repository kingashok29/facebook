<?php

namespace Facebook\Http\Controllers;

use Illuminate\Http\Request;
use Facebook\Mail\ContactEmail;
use Facebook\Http\Requests;
use Facebook\Models\Support;
use Mail;
use Auth;
use Facebook\Models\User;

class SupportController extends Controller
{
    public function getSupport() {
      return view('support.contact-us');
    }

    public function postSupport(request $request) {
      $this->validate($request, [
        'name' => 'required|min:3|max:255',
        'email' => 'required|email|min:3|max:255',
        'message' => 'required|min:10|max:1000',
      ]);

      Support::create([
        'name' => $request->name,
        'email' => $request->email,
        'message' => $request->message,
      ]);

      Mail::to('kingjorden99@gmail.com')->send(new ContactEmail($supportMessage));

      return redirect()->route('support.contact-us')->with('info','Your message sent successfully.')->with('data', $data);

    }
}
