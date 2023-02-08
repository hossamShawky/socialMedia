<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    
    protected $table='posts';

    protected $fillable = [ 
        'user_id', 'media', 'content','privacy', 'created_at','updated_at'

    ];
 


public function user(){
    return $this->belongsTo("App\Models\User");
}
public function comments(){
    return $this->hasMany("App\Models\Comment");
}

public function replies(){
    return $this->hasMany("App\Models\Reply");
}
public function loves(){
    return $this->hasMany("App\Models\Love",'post_id','id');
}

}
