<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

        'name', 'show_name', 'username', 'email', 
        'password', 'role', 'phone', 'country',
        'city', 'address', 'postal_code', 'linkedin', 
        'facebook', 'youtube', 'twitter', 'instagram', 
        'notifications', 'register_type',
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

    public function expert_profile(){
        return $this->hasOne('App\Models\Expert_profile');
    }

    public function products(){
        return $this->hasMany('App\Models\Product');
    }
    public function projects(){
        return $this->hasMany('App\Models\Project');
    }
    public function shared_spaces(){
        return $this->hasMany('App\Models\shared_space');
    }

    public function contacted_products(){
        return $this->hasMany('App\Models\Mail');
    }

    public function favorite_products(){
        return $this->hasMany('App\Models\Favorite');
    }

    public function viewed_products(){
        return $this->hasMany('App\Models\Viewed');
    }
}
