<?php

namespace App\Http\Controllers\UserControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{User,Follow};
use Auth;


class FollowController extends Controller
{
    public function follow($id)
    {
        try{
        
        $status=count(Follow::where('user_id' ,"=", Auth::id())
        ->where('followed_id' , "=",$id)->get());

$followdUser=User::find($id);
         if(! $followdUser || Auth::id() == $id || $status)
        return  back()->with('error', "There Is Some Problems.");
             
 $currentUser = Auth::user();
        $follow = Follow::create([
            'followed_id'=>$id,
            'user_id'=>$currentUser->id
        ]);

                    $follow->save();
  if($follow) {
    $details = [
        'body' => $currentUser->name.' Followed you',
        'userId'=>$currentUser->id, 
        'followedId'=>$id, 
       ];
    $followdUser->notify(new \App\Notifications\FollowNotification ($details));

    
    return redirect()->back()->with("message","You Follow Now.");
}
 else{
    return redirect()->back()->with('error'," There Is Some Problems.");

 }      
    }

    catch(\Exception $ex){
         return $ex;
         return  redirect()->back()->with('error'," There Is Some Problems.");

    }
        
    }


    public function unfollow($id){
      
       try{
          $follow=Follow::where('user_id' ,"=", Auth::id())
        ->where('followed_id' , "=",$id)->get();
       $follow[0]->delete();
       return  redirect()->back()->with('message'," You Un Follow.");

       }
       catch(\Exception $ex){
        return $ex;
       return  redirect()->back()->with('error'," There Is Some Problems.");

   }


    }
}
