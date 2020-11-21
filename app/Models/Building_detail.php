<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Building_detail extends Model{
    public $table = "building_details";

    protected $fillable = ['name'];
}