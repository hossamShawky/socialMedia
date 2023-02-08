@extends("layouts.app")
@section("title","Edit Profile")
@section("content")
 
    @if($errors->any())
    <br>
<div class=" container alert alert-danger inline-block"> 
<ul>
@foreach($errors->all() as $error)
<li>{{$error}}</li>
@endforeach
</ul>
</div>
    @endif

    

    <div class="col-lg-12 col-md-12 col-sm-12 text-center">
        @if(Session::has('error'))
            <b class="alert alert-danger">{{Session('error')}}</b>
        @endif
        @if(Session::has('message'))
            <b class="alert alert-success">{{Session('message')}}</b>
        @endif
    </div>

 <center>
            <img src="/media/{{$user->avatar}} "
	style="width: 11%;height: 5%;
    border-radius:40%;">
    
        </center>
    <div id="edituser">
       
        <div class="modal-dialog">
            <div class="modal-content">
    
                <div class="modal-header">
                    <h4 class="modal-title">Edit Profile</h4>
                 </div>
             <div class="modal-body">
    <form method="post" action="{{route('user.update')}}" enctype="multipart/form-data">
        {{csrf_field()}}
                <div class="row">
            <div class="col-lg-12 col-md-12">
             <input type="file" name="avatar" class="form-control" >
  <br>
            <input old="name" name="name"
             class="form-control" value="{{$user->name}}" >
            
            <br>
            <input old="bio" name="bio"
             class="form-control" value="{{$user->bio}}" style="height: 25%;">
            
            <br>

            <select class="form-control" name="privacy"> 
                <option value="public">Public</option>
                <option value="private">Private</option>
            </select>
        </div>
    
            
      


            </div>
    
             <div class="modal-footer">
                </div>
            <a class="btn btn-danger"
             href="{{route('myprofile')}}">Cancel</a>
           <button type="submit" class="btn btn-primary">Edit Profile</button>  </div>
    
               </div> </form>
        </div>
    
    
    </div>
    
    
    
    

    
 
@endsection