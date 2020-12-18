<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Property extends Model{
    public $table = "properties";

    protected $fillable = ['project_id','area','especifications','price','rooms','bathrooms'];
}