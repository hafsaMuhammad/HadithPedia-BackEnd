<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
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
        'Fname',
        'Lname',
        'email',
        'password',
        'age',
        'image',
        'path',
    ];



    public function comments()
    {
        return $this->hasMany(Comment::class, 'user_id');
    }

    public function hadiths()
    {
        return $this->belongsToMany(Hadith::class, 'hadith_user')->withPivot('isFavorite');
    }

    public function levels()
    {
        return $this->belongsToMany(Level::class, 'level_user')->withPivot('grade');
    }

    public function  getPhotoAttribute($val){
        return ($val !== null) ? asset('assets/images/profileImages/' . $val) : "";
    }
}
