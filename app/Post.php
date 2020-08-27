<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function likes(): BelongsToMany
    {
        return $this->belongsToMany('App\User', 'likes')->withTimestamps();
    }

    public function isLikedBy(?User $user): bool
    {
        return $user
            ? (bool)$this->likes->where('id', $user->id)->count()
            : false;
    }

    public function getCountLikesAttribute(): int
    {
        return $this->likes->count();
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany('App\Tag')->withTimestamps();
    }
}
