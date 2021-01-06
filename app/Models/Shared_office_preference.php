<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shared_office_preference extends Model{
    public $table = "shared_office_preferences";

    protected $fillable = ['name'];

    public function shared_space(){
        return $this->belongsToMany('App\Models\shared_office_preference', 'shared_spaces_preferences', 'shared_office_preference_id', 'shared_space_id')->withTimestamps();
    }
}