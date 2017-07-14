<?php
namespace Facebook\Http\Controllers;

use Facebook\Models\User;
use Illuminate\Http\Request;
use Auth;

 class AuthController extends Controller
 {
   public function getSignup()
   {
     return view('auth.signup');
   }

   public function postSignup(Request $request)
   {
     $this->validate($request, [
       'email' => 'required|unique:users|email|max:255',
       'username' => 'required|unique:users|alpha_dash|min:3|max:255',
       'password' => 'required|min:3|max:255',
       'agree' => 'required',
     ]);

     $verification_code = str_random(30);

     User::create([
       'email' => $request->input('email'),
       'username' => $request->input('username'),
       'password' => bcrypt($request->input('password')),
       'verification_code' => $verification_code,
     ]);

     return redirect()
        ->route('home')
        ->with('info', 'Your account created successfully, Please verify your email address thanks!');
   }

   public function confirm($verification_code) {

     if(! $verification_code) {
       return redirect()->route('home')->with('danger', 'No such verification code found.');
     }

     $user = User::where('verification_code', $verification_code)->first();

     if(! $user) {
       return redirect()->route('home')->with('danger', 'Sorry no user found with this verification code.');
     }

     $user->is_verified = 1;
     $user->verification_code = null;
     $user->save();

     return redirect()->route('auth.login')->with('info', 'Account verified successfully, now you may login into account.');

   }

   public function getSignin() {
     return view('auth.signin');
   }

   public function postSignin(Request $request) {
     $this->validate($request, [
       'email' => 'required|email',
       'password' => 'required',
     ]);

     if (!Auth::attempt($request->only(['email', 'password']), $request->has('remember'))) {
       return redirect()->back()->with('danger', 'Sorry, unable to log you in as given Email and Password is wrong.');
     }
     return redirect()->route('home')->with('info', 'You signed in successfully.');
   }

   public function getSignOut() {
     Auth::logout();
     return redirect()->route('home')->with('info', 'You logged out successfully from your account.');
   }
 }
