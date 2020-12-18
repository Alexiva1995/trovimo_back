<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shared_space extends Model
{
    public $table = "shared_spaces";

    protected $fillable = [
        'user_id', 'category_id', 'price', 'show_price', 'bathroom', 'furnished', 'pets', 'avaliable_date',
        'description', 'country', 'city', 'postal_code', 'lat', 'lon', 'tour', 'name', 'email', 'phone'
    ];

    public function amenities(){
        return $this->belongsToMany('App\Models\Coworking_place_detail', 'shared_spaces_place_details', 'shared_space_id', 'coworking_place_details_id')->withTimestamps();
    }

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
    public function scopeFurnished($query, $furnished)
    {
        if ($furnished != "") {
            $query->where('furnished', '>=', $furnished);
        }
    }
    public function scopePets($query, $pets)
    {
        if ($pets != "") {
            $query->where('pets', '=', $pets);
        }
    }
    public function scopeBathrooms($query, $bathroom)
    {
        if ($bathroom != "") {
            $query->where('bathroom', '=', $bathroom);
        }
    }

    public function scopeAmenities($query, $amenities){
        if ($amenities != "") {
            $query->where('bathroom', '=', $amenities);
        }
    }
}
