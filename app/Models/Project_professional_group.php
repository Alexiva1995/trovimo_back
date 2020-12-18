<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project_professional_group extends Model{
    public $table = "project_professional_group";

    protected $fillable = ['project_id', 'name',];
}