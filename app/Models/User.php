<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Mail\NewUserWelcomeEmail;
use Mail;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

//event triger to create a profile when a new user is registered
    protected static function boot()
    {
        parent::boot();

        static::created(function ($user){
            $user->profiles()->create([
                'title' => $user->username,
                'status'=> 1,
                'verifybadge' => 0,
            ]); 



            // send a welcome mail when a new user is registered
           // Mail::to($user->email)->send(new NewUserWelcomeEmail());
        });
    }

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function profiles()
    {
        return $this->hasOne(Profile::class);
    }

    //many to many relation with the profiles
    public function following()
    {
        return $this->belongsToMany(Profile::class);
    }

    //many to many relation with the post
    public function liked()
    {
        return $this->belongsToMany(Post::class);
    }
    

    public function posts()
    {
        return $this->hasMany(Post::class)->orderBy('created_at', 'DESC');
    }
}
