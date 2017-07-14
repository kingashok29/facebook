<?php

namespace Facebook\Http\Controllers;

Use Auth;
Use Facebook\Models\User;
Use Illuminate\Http\Request;


 class FriendController extends Controller
 {
   public function getIndex() {

     $friends = Auth::user()->friends();
     $requests = Auth::user()->friendRequests();
     return view('friends.index')
          ->with('friends', $friends)
          ->with('requests', $requests);
   }

   public function getAdd($username) {

     $user = User::where('username', $username)->first();

     if(!$user) {
       return redirect()
              ->route('home')
              ->with('danger', 'Sorry but this user does not exist.');
     }

     if(Auth::user()->id === $user->id) {
       return redirect()->route('home');
     }

     if(Auth::user()->hasFriendRequestPending($user) || $user->hasFriendRequestPending(Auth::user())) {
       return redirect()
              ->route('profile.index', ['username' => $user->username] )
              ->with('danger', 'Friend request already sent!');
     }

     if (Auth::user()->isFriendWith($user)) {
       return redirect()
              ->route('profile.index', ['username' => $user->username])
              ->with('info', 'You both are already friends.');
     }

     Auth::user()->addFriend($user);
     return redirect()
              ->route('profile.index', ['username' => $user->username ])
              ->with('info', 'Friend request successfully sent.');

   }

   public function getAccept($username) {
     $user = User::where('username', $username)->first();

     if(!$user) {
       return redirect()
              ->route('home')
              ->with('danger', 'Sorry but this user does not exist.');
     }

     if(!Auth::user()->hasFriendRequestReceived($user)) {
       return redirect()->route('home');
     }

     Auth::user()->acceptFriendRequest($user);
     return redirect()
              ->route('profile.index', ['username' => $username])
              ->with('info', 'Friend request accepted successfully.');
   }

   public function postDelete($username) {

     $user = User::where('username', $username)->first();

     if(!Auth::user()->isFriendWith($user)) {
       return redirect()->back();
     }

     Auth::user()->deleteFriend($user);

     return redirect()->back()->with('info',' Unfriended successfully.');
   }

 }
