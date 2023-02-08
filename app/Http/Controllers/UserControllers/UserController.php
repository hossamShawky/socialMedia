<?php
namespace App\Http\Controllers\UserControllers;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Auth;
use App\Models\{User,Post,Comment};
use DB;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
$posts= Post::orderBy("created_at","DESC")
// ->where("privacy","All")
            ->get(['id','user_id','content','media','created_at'])
            ;

            return view("user.index",compact('posts'));
        }
        catch(\Exception $ex){
            // return $ex;
            return  redirect()->back()->with('error'," There Is Some Problems.");
    
        }
    }

public function searchContent(Request $r){

try{    $query = $r->searchTxt;
    // $user  = Auth::user();
     // will used in search table to know user`s interest

     if(! is_null($query)){
// return str_word_count($query);
$users = User::where("name","LIKE",'%'.$query.'%')->get();
$posts = Post::where("content","LIKE",'%'.$query.'%')->get();
$comments = Comment::where("content","LIKE",'%'.$query.'%')->get();

if(count($users) > 0 || count($posts)>0 || count($comments)>0) 
   return view("user.search",compact(['query','users','posts','comments']));


   $message = "There Is No Content";
   return view("user.search",compact(["query","message"]));

     }
else{
 return redirect()->back()->
 with("error","Your Query Is Empty.");
      

} 
}
catch(\Exception $ex){
//  return $ex;
    return redirect()->back()
    ->with("error","There Are Some Problems,Please Try Again.");
}

}
    public function myProfile(){

        try{
            $user = Auth::user();
            $posts= $user->posts;//->get(['id','user_id','content','media','created_at']);
            
             return view('user.myProfile',compact(['user','posts']));

        }
        catch(\Exception $ex)
        {
    //  return $ex;
            return redirect()->back()->with("error","There Are Some Problems,Please Try Again.");
        }
    }

    
    public function updateAvtar(Request $r){


        try{

  $user=User::find($r->user_id);
           if($r->hasFile('avatar')) {
   ($user->avatar)? unlink(public_path("media/".$user->avatar)):"";
   
               $image=$r->avatar;
           $filename='avatars/'.$image->hashName();
           $image->move(public_path("/media/avatars"),$filename);
         $user->avatar=$filename;
                  
                       }
                       $user->save();
    DB::commit();
   if($user) {
       return redirect()->back()->with("message","Avatar Edited.");
   }
    else{
       return redirect()->back()->with('error'," There Is Some Problems.");
   
    }      
       }
   
       catch(\Exception $ex){
        //    return $ex;
           DB::rollback();
           return  redirect()->back()->with('error'," There Is Some Problems.");
   
       }


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
        //
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

            $user = User::find($id);
            if(! is_null($user) && $user->status ==1){


if (Auth::id()==$user->id) return redirect()->route("myprofile");

$posts= $user->posts;

return view('user.profile',compact(['user','posts']));

            }
            else{
               return redirect()->back()->with("error","User Not Found Or Profile Is In-active.");

            }
       }
       catch(\Exception $ex)
       {
           // return $ex;  
           return redirect()->back()->with("error","There Are Some Problems,Please Try Again.");
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
        $user=User::find($id);
        try{
            if($user)
             return view("user.edit",compact('user'));
          return  redirect()->back()
          ->with('error'," There Is Some Problems.");

         }
         catch(\Exception $ex){
               return $ex;
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
            'name'=>'string|required',
            'bio'=>'string|min:5',
            'avatar'=>'mimes:jpg,jpeg,png|max:25555',
        ]
        );
       

    try{

         if($validator->fails())
        return  back()->with('errors', $validator->errors());
                DB::beginTransaction();

         $user = User::find(Auth::id());
        $user->name=$request->name;
        $user->bio=$request->bio;
        $user->privacy=$request->privacy;
        

        if($request->hasFile('avatar')) {
($user->avatar)? unlink(public_path("media/".$user->avatar)):"";

            $image=$request->avatar;
        $filename='avatars/'.$image->hashName();
        $image->move(public_path("/media/avatars"),$filename);
      $user->avatar=$filename;
               
                    }
                    $user->save();
 DB::commit();
if($user) {
    return redirect()->route('myprofile')->with("message","Profile Edited.");
}
 else{
    return view("myprofile")->with('error'," There Is Some Problems.");

 }      
    }

    catch(\Exception $ex){
        return $ex;
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
        //
    }
}
