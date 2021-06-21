<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//imported
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $guard = 'admin';

        protected $fillable = [
            'name',
            'type',
            'email',
            'password',
            'image',
            'status',
            'created_at',
            'updated_at',
            
        ];

       protected $hidden = [
            'password',
            'remember_token',
        ];
}
