<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shared_office_preference extends Model{
    public $table = "shared_office_preferences";

    protected $fillable = ['name'];
}