<?php
namespace App\Http\Controllers\UserControllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
 
class NotificationController extends Controller
{

    public function readAll(){
    
auth()->user()->unreadNotifications->toQuery()->update([
    'read_at'=>Carbon::now()
]);
return redirect()->back();


}

public function readNotification( $nid,$pid){
    

        foreach(auth()->user()->Notifications as $n){

            if($n->id == $nid){
                $n->markAsRead();
            
        }
    }

return redirect()->route("post.view",$pid);

}



}