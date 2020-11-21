<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model{
    public $table = "categories";

    protected $fillable = ['name', 'option_id',];

    public function option(){
        return $this->belongsTo('App\Models\Option');
    }

}