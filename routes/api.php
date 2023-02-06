<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get("/v0/allusers",'APIController@getAllUsers');
Route::get("/v0/allposts",'APIController@getAllPosts');
Route::get("/v0/getPost/{post_id}",'APIController@getPost');
Route::get("/v0/getUserPosts/{user_id}",'APIController@getUserPosts');

 
Route::post("/v0/addpost","APIController@addPost");
Route::post("/v0/updatepost/{post_id}","APIController@updatePost");
Route::get("/v0/deletepost/{post_id}","APIController@destroyPost");



Route::post('register', 'JwtAuthController@register');


Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('register', 'JWTAuthController@register');
    Route::post('login', 'JWTAuthController@login');
    Route::post('logout', 'JWTAuthController@logout');
    Route::post('refresh', 'JWTAuthController@refresh');
    Route::post('profile', 'JWTAuthController@getUser');
});