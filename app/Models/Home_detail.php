<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Home_detail extends Model{
    public $table = "Home_details";

    protected $fillable = ['name'];

    public function product(){
        return $this->belongsToMany('App\Models\Product', 'product_home_details', 'home_detail_id', 'product_id')->withTimestamps();
    }
}