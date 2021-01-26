<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    public $table = "projects";

    protected $fillable = [
        'user_id', 'category_id', 'price', 'show_price', 'rooms', 'bath', 'parking_spots',
        'area', 'description', 'country', 'city', 'postal_code', 'lat', 'lon', 'tour',
        'name',    'email', 'phone', 'photos', 'videos'
    ];


    public function details(){
        return $this->belongsToMany('App\Models\Project_details_name', 'project_details', 'project_id', 'project_details_name_id')->withTimestamps();
    }

    public function propertys(){
        return $this->hasMany('App\Models\Property');
    }

    public function reference_point(){
        return $this->hasMany('App\Models\Reference_point');
    }
    public function professional_groups(){
        return $this->hasMany('App\Models\Project_professional_group');
    }

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function contacted(){
        return $this->hasMany('App\Models\Mail');
    }
    public function favorite(){
        return $this->hasMany('App\Models\favorite');
    }
    public function viewed(){
        return $this->hasMany('App\Models\Viewed');
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
