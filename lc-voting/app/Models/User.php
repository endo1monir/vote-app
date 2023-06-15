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
    ];

    public function ideas()
    {
        return $this->hasMany(Idea::class);
    }

    public function votes()
    {
        return $this->belongsToMany(Idea::class,'votes');
    }

    public function getAvatar()
    {
        $firstChar = $this->email[0];
        if (is_numeric($firstChar)):
            $picNumber = ord(strtolower($firstChar)) - 21;
        else:
            $picNumber = ord(strtolower($firstChar)) - 96;
        endif;
        $randomInt = rand(1, 36);
//        return "https://gravatar.com/avatar/".md5($this->email)."?d=mp&s=200";
        return "https://gravatar.com/avatar/" . md5($this->email) .
            "?d=https://i0.wp.com/s3.amazonaws.com/laracasts/images/forum/avatars/default-avatar-{$picNumber}.png"
            . "&s=200";
    }
}
