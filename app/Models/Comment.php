<?php
namespace Facebook\Models;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    protected $table = 'comments';
    protected $fillable = [
        'body',
    ];
    protected $hidden = [];

    public function post() {
      return $this->belongsTo('Facebook\Models\Comment');
    }

}
