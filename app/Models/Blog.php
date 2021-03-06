<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Blog extends Model {
    use HasFactory;
    protected $appends = ['autor', 'categorie',];
    protected $hidden = ['category_id', 'user_id'];
    protected $fillable = [
        'title',
        'picture',
        'content',
        'user_id',
        'created_at',
        'updated_at',
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
    public function getCategorieAttribute(){
        return DB::table('blogs_categories')->find($this->category_id)->title;
    }
}
