<?php

namespace App\Http\Controllers;
use App\Http\Resources\PostResource;
use App\User;
use App\Post;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
class APIController extends Controller
{
   
     public function getAllUsers(){
        $allUsers = User::all();
        if(! is_null($allUsers))
       return response(["reponse"=>"All Users => ".count($allUsers),"Data"=>$allUsers,"status"=>"OK"],200);
       else
       return response(["reponse"=>"No Users."],404);
    }


    public function getAllPosts(){
        $allPosts = Post::all();
        if(! is_null($allPosts))
       return response(["reponse"=>"All Posts => ".count($allPosts),"Data"=>$allPosts],200);
       else
       return response(["reponse"=>"No Users."],404);
    }
    
    public function getPost($id){
       $post = Post::find($id);
        if(! is_null($post)){ 
           $mypost= new PostResource($post);
            return response(["reponse"=>"Found Post","Data"=>$mypost,"status"=>"OK"],200);
        }
       else
       return response(["reponse"=>"No Post Found.","Data"=>null,"Status"=>404],404);
    }
public  function getUserPosts($id)
{
    $user = User::find($id);
    if(! is_null ($user))
    {
        $posts =PostResource::collection( $user->posts);
        return response(["reponse"=>"All ".$user->fname." Posts => ".count($posts),"Data"=>$posts,"status"=>"OK"],200);
    }
    else
    return response(["reponse"=>"No User Found.","Data"=>null],404);
  }



  
  public  function addPost(Request $r)
  {
      $validator=Validator::make($r->all(),[
        'user_id'=>"required",
        'description'=>"string|min:6",
      ],[
          "user_id.required"=>"You Must be Log in"
      ],[]);
      if($validator->fails())
      return response($validator->errors(),404);

    try{
        $newPostID = Post::insertGetId([
            "user_id" => 1,
            "description" =>$r->description,
            "path" => $r['path'],
        ]);
    
        if(! is_null($newPostID)){
    return response(["reponse"=>"Post Added.","Data"=>$newPostID,"status"=>"OK"],200);
    
        }
        else{
            return response(["reponse"=>" Post Not Added.","Data"=>null],404);
      
        }
    }
    catch (\Exception $ex) {
         return response(["reponse"=>" Post Not Added.","Data"=>null,"status"=>"404"],404);
    }

  }

public function updatePost($id,Request $r){

    $validator=Validator::make($r->all(),[
        'description'=>"string|min:6",
      ],[
          "description.string"=>"من فضلك تأكد من التعديل"
      ],[]);

      if($validator->fails())
      return response($validator->errors(),404);
      
    try{
        $newPost = Post::find($id);
        if(! $newPost)  
    return response(["reponse"=>" Post Not Found.","Data"=>null],404);

        $newPost->update([
             "description" =>$r->description,
            "path" => $r['path'],
        ]);
    
        if(! is_null($newPost)){
    return response(["reponse"=>"Post Updated.","Data"=>new PostResource($newPost),"status"=>"OK"],200);
    
        }
        else{
            return response(["reponse"=>" Post Not Updated.","Data"=>null],404);
      
        }
    }
    catch (\Exception $ex) {
         return response(["reponse"=>" Post Not Updated.","Data"=>null,"status"=>"404"],404);
    }


}

public function destroyPost($id){
    $post = Post::find($id);
    if(is_null($post))
    return response(["reponse"=>" Post Not Found.","status"=>"404"],404);
else{
$post->delete();
return response(["reponse"=>" Post Deleted.","status"=>"200"],200);


}
}
}
