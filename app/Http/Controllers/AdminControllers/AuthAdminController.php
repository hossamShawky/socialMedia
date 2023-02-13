<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
 use Auth;

use App\Models\{Admin};

use Illuminate\Support\Facades\Hash;

class AuthAdminController extends Controller
{


    public function adminAdd(){

        return view("admin.add");
    }

    public function adminStore(Request $r){

        try{
    //         $validator = Validator::make($r->all(),[
    //             'name'=>'string|required',
    //             'email'=>'required|unique:admins',
    //             'phone'=>'required|min:8',
    //             'address'=>'string|required|min:10',
    //             'role'=>'required|on:admin,superadmin',
    //             'password'=>'required|min:4|confirmed',
    //             'bio'=>'string|min:4',
    //         ]
    //         );
    // return $validator->errors();
    // if($validator->fails())
    //     return  redirect()->back()->with('errors', $validator->errors());

$newAdmin = Admin::create([
    'name' => $r['name'],
    'role' => $r['role'],
     'bio' => $r['bio'],
     'phone' => $r['phone'],
     'email' => $r['email'],
     'address' => $r['address'],
    'password' => Hash::make($r['password']),
]);

return redirect()->route("admin.index");
        }
        catch(\Exception $ex){
return $ex;
        }
    }

    
    public function adminLogin(){
return view("admin.login");
    }
    
    public function adminLoginCheck(Request $r){
 

        if(Auth::guard('admin')->attempt(['email'=>$r->input('email'),
        'password'=>$r->input('password')] ))
        {
           return  redirect()->route('admin.index');
        }
        else
        {
            return 'Error Email Or Password';
        }
       
           }
       
       
       
           public  function logout(){

                  auth()->guard("admin")->logout();
                 return redirect()->route('admin.login');


           }
       
}