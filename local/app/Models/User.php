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
    'first_name',
    'last_name',
    'email',
    'phone',
    'date_birthday',
    'address',
    'neighborhood',
    'location',
    'city',   
    'role',
    'user_image',
    'identificacion',
    'confirm'
    ];
    protected $guarded=[];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function orders()
    {
        return $this->hasMany('App\Models\Orders');
    }

    /**
     * Get all of the guests for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function guests(): HasMany
    {
        return $this->hasMany(Guests::class, 'foreign_key', 'local_key');
    }
}
