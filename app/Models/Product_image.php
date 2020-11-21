<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product_image extends Model{
    public $table = "product_images";

    protected $fillable = ['product_id', 'shared_space_id', 'url',];
}