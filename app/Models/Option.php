<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Option extends Model{
    public $table = "options";

    protected $fillable = ['name'];

    public function categories(){
        return $this->hasMany('App\Models\Category');
    }
}