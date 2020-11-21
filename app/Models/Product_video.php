<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product_video extends Model{
    public $table = "product_videos";

    protected $fillable = ['product_id', 'shared_space_id', 'type', 'url',];
}