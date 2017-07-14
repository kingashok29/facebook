<?php
namespace Facebook\Http\Controllers;
Use Illuminate\Http\Request;
Use Facebook\Models\User;
Use Auth;
Use Image;

 class ProfileController extends Controller
 {
   public function getProfile($username)
   {
      $user = User::where('username', $username)->first();
      $statuses = $user->statuses()->notReply()->paginate(5);

      if (!$user) {
        abort(404);
      }

      return view('profile.index')
          ->with('user', $user)
          ->with('statuses', $statuses)
          ->with('authUserIsFriend', Auth::user()->isFriendWith($user));

   }

   public function getEditBasic() {
     return view('edit.basic');
   }

   public function getEditEmail() {
     return view('edit.email-info');
   }

   public function getEditPayment() {
     return view('edit.payment-info');
   }

   public function getEditProfile() {
     return view('edit.profile-info');
   }

   public function postEditBasic(Request $request) {
     $this->validate($request, [
       'first_name' => 'alpha|max:50',
       'last_name' => 'alpha|max:50',
       'about' => 'min:2|max:255',
       'location' => 'max:20',
     ]);

     Auth::user()->update([
       'first_name' => $request->input('first_name'),
       'last_name' => $request->input('last_name'),
       'about' => $request->input('about'),
       'location' => $request->input('location'),
     ]);

     return redirect()->route('edit.basic')->with('info', 'Your profile updated successfully.');

   }

   public function postEditEmail(Request $request) {
     $this->validate($request, [
       'email' => 'email|max:255',
       'password' => 'min:3|max:255',
     ]);

     Auth::user()->update([
       'email' => $request->input('email'),
       'password' => bcrypt($request->input('password')),
     ]);

     return redirect()->route('edit.email-info')->with('info', 'Your Email & Password updated successfully.');

   }

   public function postEditPayment(Request $request) {

     $this->validate($request, [
       'paypal-email' => 'email|min:3|max:255',
       'paytm-email' => 'email|min:3|max:255',
     ]);

     Auth::user()->update([
       'paypal_email' => $request->input('paypal-email'),
       'paytm_email' => $request->input('paytm-email'),
     ]);

     return redirect()->route('edit.payment-info')->with('info', 'Your Payment Information updated successfully.');

   }

   public function postEditProfile(Request $request) {

      $this->validate($request, [
        'profile_pic' => 'file|image|between:50,2000',
        'cover_pic' => 'file|image|between:50,2000',
      ]);

      if($request->hasFile('profile_pic')) {
        $profile_pic = $request->file('profile_pic');
        $file_name = time(). '.' . $profile_pic->getClientOriginalExtension();
        Image::make($profile_pic)->resize(150, 150)->save( public_path('/images/profile-images/'.$file_name));

        Auth::user()->update([
          'profile_pic' => $file_name,
        ]);

      }


      if($request->hasFile('cover_pic')) {
        $cover_pic = $request->file('cover_pic');
        $file_name = time(). '.' . $cover_pic->getClientOriginalExtension();
        Image::make($cover_pic)->resize(800, 200)->save( public_path('/images/cover-images/'.$file_name));

        Auth::user()->update([
          'cover_pic' => $file_name,
        ]);

      }

      return redirect()->route('edit.profile-info')
                 ->with('info', 'Your information saved successfully!');
   }

 }
