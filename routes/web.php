<?php
 use Illuminate\Support\Facades\Route;


// User Auth
Auth::routes();

// main page
Route::get("/welcome","HomeController@welcome")->name("welcome");



Route::get("/","HomeController@welcome")->name("welcome");
Route::get("/home","HomeController@welcome")->name("welcome");



//User Routes


Route::group(['namespace'=>'UserControllers','middleware'=>'auth'],function (){
    
    Route::get("/index",'UserController@index')->name("index");
    Route::get("/myprofile",'UserController@myProfile')->name("myprofile");
    Route::get("/profile/{id}",'UserController@profile')->name("profile");


    
    Route::get("/addpost",'PostController@create')->name("post.create");
    Route::post("/addpost",'PostController@store')->name("post.store");


    
    Route::get("/deletepost/{id}",'PostController@destroy')->name("post.delete");
    Route::get("/editpost/{id}",'PostController@edit')->name("post.edit");;
    Route::post("/updatepost",'PostController@update')->name("post.update");


    Route::get("/post/view/{id}",'PostController@show')->name("post.view");
    Route::get("/post/love/{id}",'PostController@love')->name("post.love");




    
Route::post("/storecomment",'CommentController@store')->name("comment.store");

Route::get("/deletecomment/{id}",'CommentController@destroy')->name("comment.delete");
Route::get("/editcomment/{id}",'CommentController@edit')->name("comment.edit");;
Route::post("/updatecomment",'CommentController@update')->name("comment.update");
Route::get("/comment/love/{id}",'CommentController@love')->name("comment.love");


Route::post("/storereply",'ReplyController@store')->name("reply.store");

Route::get("/deletereply/{id}",'ReplyController@destroy')->name("reply.delete");
Route::get("/editreply/{id}",'ReplyController@edit')->name("reply.edit");;
Route::post("/updatereply",'ReplyController@update')->name("reply.update");








Route::get('/notification/readAll',function(){return "read all";})->name("notification.readAll");
Route::get('/notification/read/{nid}/{pid}',function($nid,$pid){
    


    foreach(auth()->user()->Notifications as $n){

        if($n->id == $nid){
              $n->markAsRead();
         
    }
}

return redirect()->route("post.view",$pid);

})->name("notification.read");


Route::get('/account/review','UserMailsController@reviewAccount')->name("account.review");



});









Route::get("testSub/{id}",function($id){
return Reply::find($id)->subReplies;

});


























 Route::get("test",function(){
    // foreach(auth()->user()->unreadNotifications as $n)

    return App\Models\User::find(1)->Notifications;
 });