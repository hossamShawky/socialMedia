<?php
namespace App\Http\Controllers\UserControllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
 
class NotificationController extends Controller
{

    public function readAll(){
    
try{
    auth()->user()->unreadNotifications->toQuery()->update([
        'read_at'=>Carbon::now()
    ]);
    return redirect()->back();
    
}
catch(\Exception $ex){
    return $ex;
   return  redirect()->back()->with('error'," There Is Some Problems.");

}



}

public function readNotification( $nid,$pid){
    

        foreach(auth()->user()->unreadNotifications as $n){

            if($n->id == $nid){
                $n->markAsRead();
            
        }
    }

return redirect()->route("post.view",$pid);

}



}