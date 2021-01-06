<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mail extends Model{
    public $table = "mails";

    protected $fillable = ['user_id', 'product_id', 'name', 'phone', 'email', 'message'];

}