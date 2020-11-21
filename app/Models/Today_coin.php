<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Today_coin extends Model{

    public $table = "today_coins";

    protected $fillable = ['chf', 'eur', 'cop'];
}