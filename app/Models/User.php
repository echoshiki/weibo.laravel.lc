<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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
        'password' => 'hashed',
    ];

    public static function boot() {
        parent::boot();
        static::creating(function($user) {
            $user->activation_token = Str::random(10);
        });
    }
    
    public function gravatar($size = '100')
    {
        $hash = md5(strtolower(trim($this->attributes['email'])));
        return "https://cdn.v2ex.com/gravatar/$hash?s=$size";
    }

    # 以一对多的形式关联 Status 模型
    public function statuses() {
        return $this->hasMany(Status::class);
    }

    # 取出用户所有的微博动态
    public function feed() {    
        return $this->statuses()->orderBy('created_at', 'desc');
    }

    # 获取粉丝 被关注者视角
    public function followers() {
        return $this->belongsToMany(User::class, 'followers', 'user_id', 'follower_id');
    }

    # 获取关注 粉丝模型视角 
    public function followings() {
        return $this->belongsToMany(User::class, 'followers', 'follower_id', 'user_id');
    }

    # 关注用户
    public function follow($user_ids) {
        if (!is_array($user_ids)) {
            $user_ids = compact('user_ids');
        }
        $this->followings()->sync($user_ids, false);
    }

    # 取消关注
    public function unfollow($user_ids) {
        if (!is_array($user_ids)) {
            $user_ids = compact('user_ids');
        }
        $this->followings()->detach($user_ids);
    }

    # 判断是否关注
    public function isFollowing($user_id) {
        return $this->followings->contains($user_id);
    }
}
