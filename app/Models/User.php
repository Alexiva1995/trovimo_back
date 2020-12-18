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
        'id_company', 'register_type',
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

    public function expert_services(){
        return $this->belongsToMany('App\Models\Expert_service', 'expert_services_users', 'user_id', 'expert_service_id')->withTimestamps();
    }
}
