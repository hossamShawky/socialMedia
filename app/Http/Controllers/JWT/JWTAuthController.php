<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Contracts\JWTSubject;

class JWTAuthController extends Controller
{
     public function __construct(){

       $this->middleware('auth:api',['except'=>['register','login']]);
     }



     public function register(Request $r){
          
         $validator=Validator::make($r->all(),[
            "fname"=>"string|required",
            "lname"=>"string|required",
            "password"=>"string|requiredmin:6",
            "email"=>"email|required|unique:users",
         ]);


         if($validator->fails())
         return response($validator->errors(),404);

         $user =User::create(array_merge(
             $validator->validated(),
             ["password"=>bcrypt($r->password)]
         ));
         return response(["reponse"=>"User Registered.","Data"=>$user->email,"status"=>"OK"],200);

        
     }






     public function login(Request $request)
     {
     $input = $request->only('email', 'password');
     $jwt_token = null;
     if (!$jwt_token = JWTAuth::attempt($input)) {
return response()->json(['response' => false,'Data' => 'Invalid Email or Password',"status"=>"error "],404 );
     }
     return response()->json([
     'success' => true,
     "Data"=>"Logged in",
     'token' => $jwt_token,
     ]);
     }
     public function logout(Request $request)
     {
     $this->validate($request, [
     'token' => 'required'
     ]);
     try {
     JWTAuth::invalidate($request->token);
     return response()->json([
     'response' => "logged out",
     'Data' => 'User logged out successfully'
     ]);
     } catch (JWTException $exception) {
     return response()->json([
     'response' => false,
     'message' => 'Sorry, the user cannot be logged out'
     ], 404);
     }
     }
     public function getUser(Request $request)
     {
     $this->validate($request, [
     'token' => 'required'
     ]);
     $user = JWTAuth::authenticate($request->token);
     return response()->json(['user' => $user]);
     }


    }
