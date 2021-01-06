<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Building_detail extends Model{
    public $table = "building_details";

    protected $fillable = ['name'];

    public function product(){
        return $this->belongsToMany('App\Models\Product', 'product_building_details', 'building_detail_id', 'product_id')->withTimestamps();
    }
}