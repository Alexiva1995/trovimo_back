<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expert_profile extends Model
{
    public $table = "expert_profiles";

    protected $fillable = [
        'user_id','company_id', 'company_name', 'areas', 'picture_profile', 'cover_picture', 'about_us', 'url', 'emails',
        'phones', 'address', 'networks', '24/7', 'verified'
    ];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function scopeAreas($query, $areas)
    {
        if ($areas != "") {
            $query->where('areas', 'LIKE', '%' . $areas . '%');
        }
    }

    public function scopeAddress($query, $address)
    {
        if ($address != "") {
            $query->where('address', 'LIKE', '%' . $address . '%');
        }
    }

    public function scopeverified($query, $verified)
    {
        if ($verified != "") {
            $query->where('verified', '=', $verified);
        }
    }

    public function scopeType_Expert($query, $type)
    {
        if ($type != "") {
            if ($type == 1) {//experto
            $query->where('company_name', '==', NULL);
            }elseif($type != 2) {//compañia
            $query->where('company_name', '<>', NULL);
            }
        }
    }

    public function scopeAvailability($query, $Availability)
    {
        if ($Availability != "") {
            $query->where('24/7', '=', $Availability);
        }
    }
}
