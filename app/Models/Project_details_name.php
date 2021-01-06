<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project_details_name extends Model{
    public $table = "project_details_names";

    protected $fillable = ['name'];

    public function details(){
        return $this->belongsToMany('App\Models\Project', 'project_details', 'project_details_name_id', 'project_id')->withTimestamps();
    }
}