<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersExperience extends Model
{
    use HasFactory;
    protected $appends = ['autor', 'categorie',];
    protected $hidden = ['category_id', 'user_id'];
    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'pictures',
        'style',
    ];

    public function getAutorAttribute(){ return User::find($this->user_id); }
    public function setAutorAttribute($user){
        $user = User::find($user);
        $this->update([
            'user_id'=>$user->id,
        ]);
        return $user;
    }
    public function getCategorieAttribute(){
        return DB::table('users_experiences_categories')->find($this->category_id)->title;
    }



}
