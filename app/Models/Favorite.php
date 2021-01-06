<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model{
    public $table = "favorite";

    protected $fillable = ['user_id', 'product_id', 'shared_space_id', 'project_id'];

}