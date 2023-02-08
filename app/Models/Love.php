<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Love extends Model
{
    protected $table='loves';

    protected $fillable = [ 
        'user_id', 'post_id', 'comment_id',        'created_at','updated_at'

    ];





public function user(){
    return $this->belongsTo("App\Models\User");
}
}
