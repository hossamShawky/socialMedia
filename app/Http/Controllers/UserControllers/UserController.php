<?php

namespace App\Http\Controllers\UserControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Auth;
use App\Models\User;
use App\Models\Post;

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
            ->get(['id','user_id','content','media','created_at']);

            return view("user.index",compact('posts'));
        }
        catch(\Exception $ex){
            // return $ex;
            return  redirect()->back()->with('error'," There Is Some Problems.");
    
        }
    }


    public function myProfile(){

        try{
            Session::flash("message","all is done.");
            return redirect()->back();

        }
        catch(\Exception $ex)
        {
// return $ex;
            return redirect()->back()->with("error","There Are Some Problems,Please Try Again.");
        }
    }

    
    public function profile($id){
        try{

             $user = User::find($id);
             if(! is_null($user)){


if (Auth::id()==$user->id) return redirect()->route("myprofile");


                return $user;
             }
             else{
                return redirect()->back()->with("error","User Not Found.");

             }
        }
        catch(\Exception $ex)
        {

            return redirect()->back()->with("error","There Are Some Problems,Please Try Again.");
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
