<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reference_point extends Model{
    public $table = "reference_points";

    protected $fillable = ['product_id', 'name','point'];
}