<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Postingan extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'caption',
        'image'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class, 'post_id');
    }

    public function likedBy(User $user)
    {
        return $this->likes()->where('user_id', $user->id)->exists();
    }

    public function bookmarks()
    {
        // return $this->hasMany(Like::class, 'post_id');
        return $this->hasMany(Bookmark::class, 'post_id');
    }

    public function bookmarkBy(User $user)
    {
        // return $this->likes()->where('user_id', $user->id)->exists();
        return $this->bookmarks()->where('user_id', $user->id)->exists();
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id');
    }

    public function likescomment()
    {
        return $this->hasMany(LikeComent::class);
    }
    

}
