<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Models\{User,Post,Comment,Reply,Follow};

Route::get("v0/admin/users",function(){

try{
        $users = User::all();
        if(! is_null($users)){
            return response(
                ["Total Records"=>count($users),"users"=>$users,"status"=>"OK"]
                ,200);
        }
}
catch(\Exception $ex){
    return response(["users"=>"NO Data","error"=>$ex],404);
}

});




Route::get("v0/admin/users/{id}",function($id){

    try{
            $user = User::where("id",$id)->first();
            if($user){
                return response(
                    ["user"=>$user,"status"=>"OK"]
                    ,200);
            }
            else
            return response(["user"=>"User Not Found","status"=>"404"],404);


    }
    catch(\Exception $ex){
        return response(["users"=>"NO Data","error"=>$ex,"status"=>"404"],404);
    }
    
    });
    