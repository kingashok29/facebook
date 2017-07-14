<?php

namespace Facebook\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    protected $table = 'categories';
    protected $fillable = [
        'category_name','category_details','category_image','status',
    ];
    protected $hidden = [
        'category_id','total_posts',
    ];

    /* Relationship between this User model and Status model, as in Users table and Status table their is
    one common id known as user_id, as same user may have more then one status so we have to
    relate this with user model.
    */

    public function categories() {
      return $this->hasMany('Facebook\Models\Article', 'category_id');
    }

}
