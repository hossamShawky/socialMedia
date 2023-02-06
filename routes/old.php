<?php
// Main Routes
Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    $posts = App\Post::all();
    return view('home',compact('posts')) ;
})->name("home");

Route::get("test",function(){
    return Hash::make("12345678");
});

// Auth Routes

//Social Login 

Route::get('/auth/redirect/{provider}', 'SocialController@redirect');
Route::get('/callback/{provider}', 'SocialController@callback');

// User Routes
Route::get("profile/{id}","UserController@profile")->name("user.profile");
Route::post("updateProfile","UserController@updateProfile")->name("user.update");
Route::post("updateProfileImg","UserController@updateProfileImg")->name("user.updateImg");

Route::get("viewPost/{id}","PostController@show")->name("post.view");

Route::get("newPost","PostController@create")->name("post.add");
Route::post("post/store","PostController@store")->name("post.store");
Route::get("/lovePost/{id}","PostController@lovePost")->name("post.love");


Route::post("/comment/store","CommentController@store")->name("comment.store");
Route::get("/comment/delete/{id}","CommentController@destroy")->name("comment.store");


