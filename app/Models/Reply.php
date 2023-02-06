<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $table='replies';

    protected $fillable = [ 
        'user_id', 'media', 'comment_id','post_id','content',  'created_at','updated_at'

    ];


public function user(){
    return $this->belongsTo("App\Models\User");
}

public function loves(){
    return $this->hasMany("App\Models\Love");
}

public function subReplies(){
    return $this->hasMany("App\Models\Reply",'reply_id');
}


}
