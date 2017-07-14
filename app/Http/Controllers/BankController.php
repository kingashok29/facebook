<?php

namespace Facebook\Http\Controllers;
use Illuminate\Http\Request;
use Facebook\Http\Requests;
Use Auth;
Use Facebook\Models\User;

class BankController extends Controller
{
    public function showBank($username) {
			$user = User::where('username', $username)->first();

			if(!$user) {
				return redirect()->back()->with('danger', 'No bank exist with this username.');
			}

			return view('bank.index')->with('user', $user);
		}
}
