<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'name',
        'email',
        'password',
        'bio',
        'profile_image',
    ];
    

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Postingan model
    public function posts()
    {
        return $this->hasMany(Postingan::class, 'user_id', 'id');
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class);
    }

    public function bookmarkedPosts()
    {
        return $this->belongsToMany(Postingan::class, 'bookmarks', 'user_id', 'post_id');
    }


    public function follows()
    {
        return $this->hasMany(Follow::class, 'follower_id');
    }

    public function followBy(User $user)
    {
        return $this->follows()->where('followed_id', $user->id)->exists();
    }
    public function FollowUser()
    {
        return $this->belongsToMany(User::class, 'follows', 'follower_id', 'followed_id');
    }

    // Relasi untuk pengguna yang diikuti (following)
    public function following()
    {
        return $this->belongsToMany(User::class, 'follows', 'follower_id', 'followed_id');
    }

    // Relasi untuk pengguna yang mengikuti (followers)
    public function followers()
    {
        return $this->belongsToMany(User::class, 'follows', 'followed_id', 'follower_id');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // public function follows(User $user)
    // {
    //     return $this->hasMany(Follow::class);
    // }

    // public function followBy(User $user)
    // {
    //     return $this->follows()->where('user_id', $user->id)->exists();
    // }

    // Relasi untuk pengguna yang diikuti (following)
    

    // Relasi untuk pengguna yang mengikuti (followers)
    // public function followers()
    // {
    //     return $this->belongsToMany(User::class, 'follows', 'followed_id', 'follower_id');
    // }
}


