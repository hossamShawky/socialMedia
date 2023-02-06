<?php

namespace App\Http\Controllers\UserControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\registerMailable;
class UserMailsController extends Controller
{
    public function reviewAccount(){


        $connected = @fsockopen("www.google.com", 80); 
       
if(!$connected) return redirect()->back()->with("error","No Internet Connection")    ;
    
        $user = Auth::user();
       Mail::to(Auth::user()->email)->send(new registerMailable($user));	
       return redirect()->back()->with("message","Email Was Sent Successfully.")    ;
    
        } 
}
