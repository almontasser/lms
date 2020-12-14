<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

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
        'id_number',
        'position',
        'type',
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

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isInactive()
    {
        return $this->type == 0;
    }

    public function isBanned()
    {
        return $this->type == 1;
    }

    public function isUser()
    {
        return $this->type == 2;
    }

    public function isAdmin()
    {
        return $this->type == 3;
    }

    public function getPicture()
    {
        return $this->profile_picture ? '/uploads/' . $this->profile_picture : '/media/avatars/avatar10.jpg';
    }
}
