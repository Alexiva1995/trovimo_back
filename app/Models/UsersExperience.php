<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersExperience extends Model
{
    use HasFactory;
    protected $fillable = [
        'tags',
        'style',
        'categorie',
        'pictures',
        'user_id',
    ];






    public function search($term){
        $this->where(function($query){
            // $query->
        });


    }



}
