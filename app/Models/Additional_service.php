<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Additional_service extends Model{
    public $table = "additional_services";

    protected $fillable = ['product_id', 'service', 'price'];

    public function product(){
        return $this->belongsTo('App\Models\Product');
    }
}