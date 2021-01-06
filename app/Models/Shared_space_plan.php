<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shared_space_plan extends Model
{
    public $table = "shared_space_plans";

    protected $fillable = ['shared_space_id', 'name', 'price', 'description'];


    public function shared_space()
    {
        return $this->belongsTo('App\Models\Shared_space');
    }
}
