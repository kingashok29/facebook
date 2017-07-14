<?php
namespace Facebook\Models;

Use Illuminate\Database\Eloquent\Model;

class Status extends Model {

  protected $table = 'statuses';
  protected $fillable = [
    'body', 'user_id',
  ];

  public function user() {
    return $this->belongsTo('Facebook\Models\User', 'user_id');
  }

  public function scopeNotReply($query) {
    return $query->whereNull('parent_id');
  }

  public function replies() {
    return $this->hasMany('Facebook\Models\Status', 'parent_id');
  }

  public function likes() {
    return $this->morphMany('Facebook\Models\Like','likeable');
  }

}
