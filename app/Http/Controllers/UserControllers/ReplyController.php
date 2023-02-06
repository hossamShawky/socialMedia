<?php

namespace App\Http\Controllers\UserControllers;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\Reply;
class ReplyController extends Controller
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
        
        
//    dd($request->hasFile("media"));
    try{$validator = Validator::make($request->all(),[
            'content'=>'string|required',
            'user_id'=>'required|exists:users,id',
            'post_id'=>'required|exists:posts,id',
            'reply_id'=>'exists:replies,id',
            'comment_id'=>'required|exists:comments,id',
            'media'=>'mimes:jpg,jpeg,png|max:25555',
        ]
        );
        

         if($validator->fails())
        return  back()->with('errors', $validator->errors());
 
        DB::beginTransaction();

        $reply = Reply::create([
            'user_id'=>$request->user_id,
            'post_id'=>$request->post_id,
            'comment_id'=>$request->comment_id,
            'content'=>$request->content,
        ]);

        $reply->reply_id= ($request->reply_id)? $request->reply_id:"";


        if($request->hasFile('media')) {
            $image=$request->media;
        $filename='replies/'.$image->hashName();
        $image->move(public_path("/media/replies"),$filename);
      $reply->media=$filename; 
                    }

                    $reply->save();
 DB::commit();
if($reply) {
    return redirect()->back()->with("message","Reply Added.");
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
            $reply= Reply::find($id);
             return view("reply.edit",compact('reply'));
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
            'reply_id'=>'required|exists:replies,id',
            'media'=>'mimes:jpg,jpeg,png|max:25555',
        ]
        );
       

    try{

         if($validator->fails())
        return  back()->with('errors', $validator->errors());
                DB::beginTransaction();

         $reply = Reply::find($request->reply_id);
        $reply->content=$request->content;
         

        if($request->hasFile('media')) {
($reply->media)? unlink(public_path("media/".$reply->media)):"";

            $image=$request->media;
        $filename='replies/'.$image->hashName();
        $image->move(public_path("/media/replies"),$filename);
      $reply->media=$filename;
               
                    }
                    $reply->save();
 DB::commit();
if($reply) {
    return redirect()->route('post.view',[$reply->post_id])->with("message","Reply Edited.");
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
            $reply=Reply::find($id);
            $reply->delete();
              ($reply->media)? unlink(public_path("media/".$reply->media)):"";
  
              return redirect()->back();
          }
          catch(\Exception $ex){
            //   return $ex;
             return  redirect()->back()->with('error'," There Is Some Problems.");
     
         } 
    }
}
