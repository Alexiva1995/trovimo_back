<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model{
    public $table = "products";

    protected $fillable = ['user_id', 'option_id', 'category_id', 'price', 'rooms', 'bath', 'parking_spots',
                           'n_pieces', 'area', 'year_built', 'year_remodeled', 'description', 'country', 'city',
                           'postal_code', 'lat', 'lon',	'tour',	'name',	'email', 'phone', 'condition', 'furnished'];
}