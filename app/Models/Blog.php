<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $appends = ['autor'];
    protected $hiddens = ['user_id'];
    protected $fillable = [
        'title',
        'picture',
        'content',
        'user_id',
    ];

    public function getAutorAttribute(){
        return User::find($this->user_id);
    }
    public function setAutorAttribute($user){
        $user = User::find($user);
        $this->update([
            'user_id'=>$user->id,
        ]);
        return $user;
    }

}
