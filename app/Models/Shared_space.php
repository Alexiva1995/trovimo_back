<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shared_space extends Model{
    public $table = "shared_spaces";

    protected $fillable = ['user_id','option_id','category_id','price','bathroom','furnished','pets','avaliable_date',
                           'description','country','city','postal_code','lat','lon','tour','name','email','phone'];
}