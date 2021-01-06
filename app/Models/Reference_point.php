<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reference_point extends Model{
    public $table = "reference_points";

    protected $fillable = ['product_id', 'project_id', 'name','point'];

    public function product(){
        return $this->belongsTo('App\Models\Product');
    }
    public function project(){
        return $this->belongsTo('App\Models\Project');
    }
}