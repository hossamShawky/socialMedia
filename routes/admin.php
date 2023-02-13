<?php
 use Illuminate\Support\Facades\Route;
 



 Route::group(['namespace'=>'AdminControllers','prefix'=>"/admin","middleware"=>"guest:admin"],function (){

   Route::get("/login","AuthAdminController@adminLogin")->name("admin.login");
   Route::post("/login","AuthAdminController@adminLoginCheck")->name("admin.loginMethod");

 });
 Route::group(['namespace'=>'AdminControllers','prefix'=>"/admin","middleware"=>"auth:admin"],
 
 function (){

  // Admin

  Route::get("/admins","AdminController@admins")->name("admin.admins");
  Route::get("/add","AuthAdminController@adminAdd")->name("admin.add");
  Route::post("/store","AuthAdminController@adminStore")->name("admin.store");
  Route::get("/logout",'AuthAdminController@logout')->name("admin.logout");
  Route::get("/index",'AdminController@index')->name("admin.index"); 
  
  // User
  Route::get("/changestatus/{id}/user","AdminController@changeUserStatus")->name("admin.changeStatus");


  Route::post("/search",function( ){
    return "content search";
  })
  ->name("admin.content.search");

});




Route::get("/admin/test",function(){
  $users = App\Models\User::all();
  return view("test")->with("users",$users);});