<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coworking_place_detail extends Model{
    public $table = "coworking_place_details";

    protected $fillable = ['name'];

    public function shared_spaces(){
        return $this->belongsToMany('App\Models\Shared_space', 'shared_spaces_place_details', 'coworking_place_details_id', 'shared_space_id')->withTimestamps();
    }
}