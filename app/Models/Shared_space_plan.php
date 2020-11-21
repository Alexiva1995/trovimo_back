<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shared_space_plan extends Model{
    public $table = "shared_space_plans";

    protected $fillable = ['share_space_id','name','price','description'];
}