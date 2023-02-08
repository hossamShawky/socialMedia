<?php

namespace App\Models;


use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table='users';

    protected $fillable = [
        'name', 'email', 'password','avatar',
        'status','provider', 'provider_id','privacy',
        'bio',
        'created_at','updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public  function  getStatus(){
        return $this->status==1?"Active":"In-Active";
    }


   


    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    
    public function posts(){
        return $this->hasMany("App\Models\Post");
    }
    
    public function comments(){
        return $this->hasMany("App\Models\Comment");
    }
    
    public function loves(){
        return $this->hasMany("App\Models\Love");
    }
    
    public function replies(){
        return $this->hasMany("App\Models\Reply");
    }



    public function follows(){
        return $this->hasMany("App\Models\Follow");
    }


    public function followers(){
        return $this->hasMany("App\Models\Follow",'followd_id');
    }




     





// JWT-Auth
    public function getJWTIdentifier(){
        return $this->getKey();
    }
    public function getJWTCustomClaims(){
        return [];
    }
}
