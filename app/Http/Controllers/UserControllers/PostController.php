<?php

namespace App\Http\Controllers\UserControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Validator;
use App\Helpers\General;
use App\Models\{Post,Love};

use Auth;  
use Illuminate\Support\Facades\DB;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
 * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("post.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        $validator = Validator::make($request->all(),[
            'content'=>'string|required',
            'user_id'=>'required|exists:users,id',
            'media'=>'mimes:jpg,jpeg,png|max:25555',
        ]
        );
       

    try{

         if($validator->fails())
        return  back()->with('errors', $validator->errors());
                DB::beginTransaction();

        $post = Post::create([
            'user_id'=>$request->user_id,
            'content'=>$request->content,
            'privacy'=>$request->privacy,
        ]);

        if($request->hasFile('media')) {

            $image=$request->media;
        $filename='posts/'.$image->hashName();
        $image->move(public_path("/media/posts"),$filename);
      $post->media=$filename;
               
                    }
                    $post->save();
 DB::commit();
if($post) {
    return redirect("index")->with("message","Post Added.");
}
 else{
    return view("user.index")->with('error'," There Is Some Problems.");

 }      
    }

    catch(\Exception $ex){
        // return $ex;
        DB::rollback();
        return  redirect()->back()->with('error'," There Is Some Problems.");

    }
     }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
  $post = Post::find($id);
if(! is_null($post)){

     $comments=$post->comments;
     $replies=$post->replies;
 
     return view("post.viewPost",compact(['post','comments','replies']));

}
else
return  redirect()->back()->with('error'," This Post Not Found.");

        }
        catch(\Exception $ex){
             return $ex;
            return  redirect()->back()->with('error'," There Is Some Problems.");
    
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */ 
    public function edit($id)
    {
        try{
           $post= Post::find($id);
            return view("post.edit",compact('post'));
        }
        catch(\Exception $ex){
            // return $ex;
           return  redirect()->back()->with('error'," There Is Some Problems.");
   
       }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
 
        
        $validator = Validator::make($request->all(),[
            'content'=>'string|required',
            'post_id'=>'required|exists:posts,id',
            'media'=>'mimes:jpg,jpeg,png|max:25555',
        ]
        );
       

    try{

         if($validator->fails())
        return  back()->with('errors', $validator->errors());
                DB::beginTransaction();

         $post = Post::find($request->post_id);
        $post->content=$request->content;
        $post->privacy=$request->privacy;
        

        if($request->hasFile('media')) {
($post->media)? unlink(public_path("media/".$post->media)):"";

            $image=$request->media;
        $filename='posts/'.$image->hashName();
        $image->move(public_path("/media/posts"),$filename);
      $post->media=$filename;
               
                    }
                    $post->save();
 DB::commit();
if($post) {
    return redirect()->route('post.view',[$post->id])->with("message","Post Edited.");
}
 else{
    return view("user.index")->with('error'," There Is Some Problems.");

 }      
    }

    catch(\Exception $ex){
        // return $ex;
        DB::rollback();
        return  redirect()->back()->with('error'," There Is Some Problems.");

    }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $post=Post::find($id);
           if(is_null($post))
           return redirect()->route("index")->with('error',"No Post Founded.");;

           $post->delete();
           ($post->media)? unlink(public_path("media/".$post->media)):"";

           return redirect()->route("index")->with('message'," Post Deleted Succssfully.");;
      
        
        }
        catch(\Exception $ex){
            // return $ex;
           return  redirect()->back()->with('error'," There Is Some Problems.");
   
       }
    }



    public function love($id)
    {

        try{
            $post = Post::find($id);
                
          if(! is_null($post)){
            $status=0;
            $loveId=0;
$loves=Love::all();
            foreach($loves as $love)
            {
            if($love->user_id == Auth::id() && $love->post_id == $id)
                {  $status=1; $loveId=$love->id; break;}  #Already User Loved It.
            
            }

             if($status== 1){
 Love::findorfail($loveId)->delete();
return redirect()->back();
            }

            else{
                $love=new love();
                $love->user_id=Auth::id();
                $love->post_id=$id;
  $love->save();
  return  redirect()->back();
                
            }
          }
          else
          return  redirect()->back()->with('error'," This Post Not Found.");
          
                  }
                  catch(\Exception $ex){
                       return $ex;
                      return  redirect()->back()->with('error'," There Is Some Problems.");
              
                  }
                  }

}
