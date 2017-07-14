<?php

namespace Facebook\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract
{
    use Authenticatable, CanResetPassword;

    protected $table = 'users';
    protected $fillable = [
        'username', 'email', 'password', 'first_name', 'last_name', 'location', 'about',
        'paytm_email', 'paypal_email', 'profile_pic', 'cover_pic', 'verification_code',
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getName() {
      if ($this->first_name && $this->last_name) {
        return "{$this->first_name} {$this->last_name}";
      }

      if ($this->first_name) {
        return $this->first_name;
      }

      return null;
    }

    public function getAvatarUrl() {

    }

    public function getNameOrUsername() {
      return $this->getName() ?: $this->username;
      }

    public function getFirstNameOrUsername() {
      return $this->first_name ?: $this->username;
    }

    /* Relationship between this User model and Status model, as in Users table and Status table their is
    one common id known as user_id, as same user may have more then one status so we have to
    relate this with user model.
    */

    public function statuses() {
      return $this->hasMany('Facebook\Models\Status', 'user_id');
    }

    public function likes() {
      return $this->hasMany('Facebook\Models\Like', 'user_id');
    }

    public function posts() {
      return $this->hasMany('Facebook\Models\Article', 'user_id');
    }

    public function friendsOfMine() {
      return $this->belongsToMany('Facebook\Models\User','friends','user_id','friend_id');
    }

    public function friendsOf() {
      return $this->belongsToMany('Facebook\Models\User', 'friends', 'friend_id', 'user_id');
    }

    public function friends() {
      return $this->friendsOfMine()->wherePivot('accepted', true)->get()
        ->merge($this->friendsOf()->wherePivot('accepted', true)->get());
    }

    public function friendRequests() {
      return $this->friendsOfMine()->wherePivot('accepted', false)->get();
    }

    public function friendRequestPending() {
      return $this->friendsOf()->wherePivot('accepted', false)->get();
    }

    public function hasFriendRequestPending(User $user) {
      return (bool) $this->friendRequestPending()->where('id', $user->id)->count();
    }

    public function hasFriendRequestReceived(User $user) {
      return (bool) $this->friendRequests()->where('id', $user->id)->count();
    }

    public function addFriend(User $user) {
      $this->friendsOf()->attach($user->id);
    }

    public function deleteFriend(User $user) {
      $this->friendsOf()->detach($user->id);
      $this->friendsOfMine()->detach($user->id);
    }

    public function acceptFriendRequest(User $user) {
      $this->friendRequests()->where('id', $user->id)->first()->pivot->
          update([
            'accepted' => true,
          ]);
    }

    public function isFriendWith(User $user) {
      return (bool) $this->friends()->where('id', $user->id)->count();
    }

    public function hasLikedStatus(Status $status) {
      return (bool) $status->likes->where('user_id', $this->id )->count();
    }

}
