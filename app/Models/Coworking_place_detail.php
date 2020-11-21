<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coworking_place_detail extends Model{
    public $table = "coworking_place_details";

    protected $fillable = ['name'];
}