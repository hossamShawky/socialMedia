<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

use App\Models\{Admin,User};
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{


    public function admins(){
        return response(["Admins"=>Admin::all(),]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admin = auth::guard("admin")->user();
        $users = User::all();
    
        return  view("admin.index",compact(["admin",'users']))
                    ->with("message","you are welcome");
        

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
public function changeUserStatus($id){

    try{
        $user=User::find($id);
        if(!$user)
            return  redirect()->route('admin.index')->with('error',"User Not Found.");
        else{
            if($user->status=='0')
            { $user->update(['status'=>'1']);
                return  redirect()->route('admin.index')->with('message',"User : ".$user->name." Was Actived.");
            }
            else { 
                
                $user->update(['status'=>'0']);
                
                if(auth::guard("web")->id() == $id) {auth::guard("web")->logout();}
                
                return  redirect()->route('admin.index')->with('message',"User : ".$user->name." Was De-Actived.");

            }


            }
    }
    catch (\Exception $ex){
        // return $ex;
        return redirect()->route('admin.index')->with('error','There Are Some Problems Try Again.');
    }
}

}
