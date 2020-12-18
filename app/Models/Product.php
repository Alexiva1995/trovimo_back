<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $table = "products";

    protected $fillable = [
        'user_id', 'option_id', 'category_id', 'price', 'show_price', 'rooms', 'bath', 'parking_spots',
        'n_pieces', 'area', 'year_built', 'year_remodeled', 'description', 'country', 'city',
        'postal_code', 'lat', 'lon',    'tour',    'name',    'email', 'phone', 'condition', 'furnished'
    ];

    public function scopeAddress($query, $address)
    {
        if ($address != "") {
            $query->where('country', 'LIKE', '%'.$address.'%')->orWhere('city', 'LIKE', '%'.$address.'%');
        }
    }

    public function scopeType($query, $type)
    {
        if ($type != "") {
            $query->where('category_id', '=', $type);
        }
    }

    public function scopePrice($query, $pricemin, $pricemax)
    {
        if (($pricemin != "") &&($pricemax != "")) {
            $query->where('price', '>=', $pricemin)->where('price', '<=', $pricemax);
        }
    }
    public function scopeArea($query, $areamin, $areamax)
    {
        if (($areamin != "") && ($areamax != "")) {
            $query->where('area', '>=', $areamin)->where('area', '<=', $areamax);
        }
    }
    public function scopeRoom($query, $room)
    {
        if ($room != "") {
            $query->where('room', '=', $room);
        }
    }
    public function scopeBath($query, $bath)
    {
        if ($bath != "") {
            $query->where('bath', '=', $bath);
        }
    }
}
