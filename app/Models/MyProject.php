<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MyProject extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'country',
        'city',
        'pictures',
        'is_experience',
    ];



}
