<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shared_office_place_equipment extends Model{
    public $table = "shared_office_place_equipment";

    protected $fillable = ['name'];

    public function shared_space(){
        return $this->belongsToMany('App\Models\shared_space', 'shared_spaces_place_equipment', 'shared_office_place_equipment_id', 'shared_space_id')->withTimestamps();
    }
}