<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    protected $guarded = array('id');

    public static $rules = array(
        'title' => 'required|min:1|max:50',
        'body' => 'required|min:1|max:1000',
    );

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
