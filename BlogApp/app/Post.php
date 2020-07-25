<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    protected $guarded = ['id'];



    public static $rules = [
        'title' => 'required|min:1|max:50',
        'body' => 'required|min:1|max:1000',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function likes()
    {
        return $this->hasMany('App\Like');
    }
}
