<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    public $table = "projects";

    protected $fillable = [
        'user_id', 'category_id', 'price', 'show_price', 'rooms', 'bath', 'parking_spots',
        'area', 'description', 'country', 'city', 'postal_code', 'lat', 'lon', 'tour',
        'name',    'email', 'phone'
    ];

    public function scopeAddress($query, $address)
    {
        if ($address != "") {
            $query->where('country', 'LIKE', '%' . $address . '%')->orWhere('city', 'LIKE', '%' . $address . '%');
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
        if (($pricemin != "") && ($pricemax != "")) {
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
    public function scopeParking($query, $parking)
    {
        if ($parking != "") {
            $query->where('parking_spots', '=', $parking);
        }
    }
}
