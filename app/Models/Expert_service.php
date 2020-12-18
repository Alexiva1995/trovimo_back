<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expert_service extends Model{
    public $table = "expert_services";

    protected $fillable = ['type', 'name'];

    public function users(){
        return $this->belongsToMany('App\Models\Expert_service', 'expert_services_users', 'expert_service_id', 'user_id')->withTimestamps();
    }
}