<?php
namespace Facebook\Http\Controllers;

Use Auth;
Use Facebook\Models\User;
Use Facebook\Models\Status;
Use Illuminate\Http\Request;


 class StatusController extends Controller
 {
   public function postStatus(request $request) {
     $this->validate($request, [
       'status' => 'max:1000|required|min:3',
     ]);

     Auth::user()->statuses()->create([
       'body' => $request->input('status'),
     ]);

     return redirect()
          ->route('home')
          ->with('info', 'Your status posted successfully.');

   }


   public function postReply(request $request, $statusId) {
      $this->validate($request, [
        "reply-{$statusId}" => 'required|max:1000',
      ], [
        'required' => 'The reply body is required',
      ]);

      $status = Status::notReply()->find($statusId);

      if(!$status) {
        return redirect()->route('home')->with('danger', 'Unable to reply this status.');
      }

      if(!Auth::user()->isFriendWith($status->user) && Auth::user()->id !== $status->user->id) {
        return redirect()->route('home')->with('danger', 'You can not reply to status posted by other then your friends.');

      }

      $reply = Status::create([
        "body" => $request->input("reply-{$statusId}"),
        "user_id" => Auth::user()->id,
      ])->user()->associate(Auth::user());

      $status->replies()->save($reply);
      return redirect()->back();

   }

   public function getLike($statusId) {

     $status = Status::find($statusId);

     if(!$status) {
       return redirect()->route('home')->with('danger', 'You can not like status which does not exist.');
     }

     if($status->user->id === Auth::user()->id) {
      return redirect()->route('home')->with('danger', 'You can not like your own status.');
    }

     if(!Auth::user()->isFriendWith($status->user)) {
       return redirect()->route('home')->with('danger', 'You can not like the status of user who is not your friend.');
     }

     if(Auth::user()->hasLikedStatus($status)) {
       return redirect()->back()->with('danger', 'You already liked this status.');
     }

     $like = $status->likes()->create(["user_id" => Auth::user()->id,]);
     Auth::user()->likes()->save($like);

     return redirect()->back()->with('info', 'You liked this status successfully, thanks.');

   }
 }
