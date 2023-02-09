<?php

namespace App\Http\Controllers\UserControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
 
 

use App\Models\{User,Post,Comment,Love};
use DB;
use Auth;
use Illuminate\Support\Facades\Validator;
class CommentController extends Controller
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
        //
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
            'post_id'=>'required|exists:posts,id',
            'media'=>'mimes:jpg,jpeg,png|max:25555',
        ]
        );


    try{

         if($validator->fails())
        return  back()->with('errors', $validator->errors());
                DB::beginTransaction();

        $comment = Comment::create([
            'user_id'=>$request->user_id,
            'post_id'=>$request->post_id,
            'content'=>$request->content,
        ]);

        if($request->hasFile('media')) {

            $image=$request->media;
        $filename='comments/'.$image->hashName();
        $image->move(public_path("/media/comments"),$filename);
      $comment->media=$filename;
               
                    }
                    $comment->save();
 DB::commit();
if($comment) {

 $post = Post::find($request->post_id);
 $user=$post->user;
 
 if($post->user != $comment->user){
    $details = [
        'body' => $comment->user->name.' commented on your post',
        'postId'=>$post->id,
       ];
        $user->notify(new \App\Notifications\CommentNotification ($details));
    
 }


    return redirect()->back()->with("message","Comment Added.");
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
        //
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
            $comment= Comment::find($id);
if(Auth::id()==$comment->user->id)
            return view("comment.edit",compact('comment'));
             return  redirect()->back()->with('error'," You Have`t The Right To Access This Page.");

         }
         catch(\Exception $ex){
            //   return $ex;
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
            'comment_id'=>'required|exists:comments,id',
            'media'=>'mimes:jpg,jpeg,png|max:25555',
        ]
        );
       

    try{

         if($validator->fails())
        return  back()->with('errors', $validator->errors());
                DB::beginTransaction();

         $comment = Comment::find($request->comment_id);
        $comment->content=$request->content;
         

        if($request->hasFile('media')) {
($comment->media)? unlink(public_path("media/".$comment->media)):"";

            $image=$request->media;
        $filename='comments/'.$image->hashName();
        $image->move(public_path("/media/comments"),$filename);
      $comment->media=$filename;
               
                    }
                    $comment->save();
 DB::commit();
if($comment) {
    return redirect()->route('post.view',[$comment->post->id])->with("message","Comment Edited.");
}
 else{
    return view("user.index")->with('error'," There Is Some Problems.");

 }      
    }

    catch(\Exception $ex){
    //    return $ex;
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
          $comment=Comment::find($id);
          $comment->delete();
            ($comment->media)? unlink(public_path("media/".$comment->media)):"";

            return redirect()->back();
        }
        catch(\Exception $ex){
            return $ex;
           return  redirect()->back()->with('error'," There Is Some Problems.");
   
       }   
     }


    
    public function love($id)
    {

        try{
            $comment = Comment::find($id);
                
          if(! is_null($comment)){
            $status=0;
            $loveId=0;
$loves=Love::all();
            foreach($loves as $love)
            {
            if($love->user_id == Auth::id() && $love->comment_id == $id)
                {  $status=1; $loveId=$love->id; break;}  #Already User Loved It.
            
            }

             if($status== 1){
 Love::findorfail($loveId)->delete();
return redirect()->back();
            }

            else{
                $love=new love();
                $love->user_id=Auth::id();
                $love->comment_id=$id;
  $love->save();
  return  redirect()->back();
                
            }
          }
          else
          return  redirect()->back()->with('error'," This Comment Not Found.");
          
                  }
                  catch(\Exception $ex){
                       return $ex;
                      return  redirect()->back()->with('error'," There Is Some Problems.");
              
                  }
                  }

}
