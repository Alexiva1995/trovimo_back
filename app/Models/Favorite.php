<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model{
    public $table = "favorite";

    protected $fillable = ['user_id', 'product_id', 'shared_space_id', 'project_id', 'expert_profile_id'];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
    public function product(){
        return $this->belongsTo('App\Models\Product');
    }
    public function shared_space(){
        return $this->belongsTo('App\Models\Shared_space');
    }
    public function project(){
        return $this->belongsTo('App\Models\Project');
    }
    public function expert_profile(){
        return $this->belongsTo('App\Models\Expert_profile');
    }
}