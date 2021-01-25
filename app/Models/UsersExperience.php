<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersExperience extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'title',
        'pictures',
        'categorie',
        'style',
    ];
}
