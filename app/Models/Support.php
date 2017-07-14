<?php

namespace Facebook\Models;

use Illuminate\Database\Eloquent\Model;
use Facebook\Models\Support;

class Support extends Model
{
    protected $table = 'contact_messages';

    protected $fillable = [
      'name','email','message',
    ];
}
