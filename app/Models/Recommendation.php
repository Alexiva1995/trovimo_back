<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recommendation extends Model{
    public $table = "recommendations";

    protected $fillable = ['user_id', 'recommendation'];
}