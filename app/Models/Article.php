<?php

namespace Facebook\Models;
use Illuminate\Database\Eloquent\Model;
use Facebook\Models\Comment;

class Article extends Model
{
    protected $table = 'posts';
    protected $fillable = [
      'status','title','summery','status_reason','body','image','category_id','posted_by','image_credit','slug',
    ];
    protected $hidden = [
      'id',
    ];

    public function comment() {
      return $this->hasMany('Facebook\Models\Comment');
    }

}
