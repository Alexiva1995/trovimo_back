<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Home_detail extends Model{
    public $table = "Home_details";

    protected $fillable = ['name'];
}