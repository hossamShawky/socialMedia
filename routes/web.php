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
    Route::post("/user/updateAvtar",'UserController@updateAvtar')
                    ->name("user.update.avatar");

                    
    Route::get("/user/editProfile/{id}",'UserController@edit')
    ->name("user.edit");


    
    Route::post("/user/updateProfile",'UserController@update')
    ->name("user.update");


    

    
    Route::get("/profile/{nid}/{id}",'UserController@notificationProfile')->name("notification.profile");
    Route::get("/profile/{id}",'UserController@show')->name("profile");

    Route::get("/user/follow/{id}",'FollowController@follow')->name("user.follow");
    Route::get("/user/unfollow/{id}",'FollowController@unfollow')->name("user.unfollow");


    
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








Route::get('/notification/readAll',"NotificationController@readAll")->name("notification.readAll");
Route::get('/notification/read/{nid}/{pid}',"NotificationController@readNotification")->name("notification.read");


Route::get('/account/review','UserMailsController@reviewAccount')->name("account.review");




Route::post("/search",'UserController@searchContent')->name("content.search");



});









Route::get("testSub/{id}",function($id){
return Reply::find($id)->subReplies;

});


























 Route::get("test",function(){
    // foreach(auth()->user()->unreadNotifications as $n)

    // return App\Models\User::find(1)->Notifications;

    // return $user= App\Models\User::find(Auth::id())->getChanges();
    /*
    count($user->followers);
    */
    $user = Auth::user();
    $fo  = App\Models\Follow::where("followed_id",$user->id)->get();
    return $fo;

 });