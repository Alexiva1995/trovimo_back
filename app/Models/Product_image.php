<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product_image extends Model{
    public $table = "product_images";

    protected $fillable = ['product_id', 'shared_space_id', 'project_id', 'url',];

    public function product(){
        return $this->belongsTo('App\Models\Product');
    }
    public function shared_space(){
        return $this->belongsTo('App\Models\Shared_space');
    }
    public function project(){
        return $this->belongsTo('App\Models\Project');
    }

}