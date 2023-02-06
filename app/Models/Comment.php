<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    
    protected $table='comments';

    protected $fillable = [ 
        'user_id','post_id', 'media', 'content',        'created_at','updated_at'

    ];


    public function user(){
        return $this->belongsTo("App\Models\User");
    }
    public function post(){
        return $this->belongsTo("App\Models\Post");
    } 
    public function loves(){
     
        return $this->hasMany("App\Models\Love",'comment_id','id');
    }
    
    public function replies(){
        return $this->hasMany("App\Models\Reply");
    }


    
   
    
}
