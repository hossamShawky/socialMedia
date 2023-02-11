<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    public $table ="follows";
    protected $fillable=["id","user_id","followed_id",'created_at','updated_at'];

    // each follow record belong to user

    public function user(){
        return $this->belongsTo("App\Models\User");
    }

// relation to get user of following record
    public function FUser(){
        return $this->belongsTo("App\Models\User",'followed_id');
    }


}
