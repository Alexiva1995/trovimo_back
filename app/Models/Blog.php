<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'picture',
        'content',
        'autor',
    ];

    public function getUserAttribute(){
        return User::find($this->user_id);
    }
    public function setUserAttribute($user){
        $this->update([
            'user_id'=>User::find($user)->id,
        ]);
        return $this->user;
    }

}
