@extends("layouts.app")
@section("title","User Profile")
@section("content")

<div class="container-fluid">



@include("includes.sessions") 

<div class="row">

<div class="col-md-8 col-md-offset-1" style="float: left;">
	<a href="/viewPic/{{$user->avatar}}">
	<img src="/media/{{$user->avatar}} "
	style="width: 150px;height: 150px;float: left;
    border-radius: 50%;margin-right: 10%; margin-left: 2%;"> </a>

 	<p>

   

<h3><a href="{{route('myprofile')}}" >
  {{$user->name}}</a></h3>
 <b>{{"BIO : ".$user->bio}}</b><br>
 <b>{{"Status : ".$user->getStatus()}}</b><br>
 <b>{{"Joined : " .$user->created_at->format('M') ." - ".$user->created_at->year}}</b><br>
    </p>




<form   enctype="multipart/form-data" 
action="{{route('user.update.avatar')}}" method="post">

		<!-- <label class="label" >Update Image <i class="fa fa-cogs"></i></label> -->
		<input class="form-control" type="file" name="avatar" required style="width: 35%;display: inline-block;">
		<input type="hidden" name="_token" value="{{csrf_token()}}">
		<input type="hidden" name="user_id" value="{{$user->id}}">
		<input
		type="submit" value="Update Image" class="pull-right btn  btn-primary">


</form>

</div>
<p class="actions">
  
 
<a data-toggle="modal" data-target="#deleteprofile" class="btn btn-danger pull-right" href="#">Delete Account</a>
<a class="btn btn-primary pull-right  " href="" >Settings</a>
<a class="btn btn-primary pull-right  " href="{{route('user.edit',$user->id)}}" >Edit Profile</a>
<br><br>
 
<a data-toggle="modal" data-target="#followingList"  class='followUsers' href="">{{count($following)}}  Following </a>
<a  data-toggle="modal" data-target="#followersList"  class='followUsers' href="">{{count($followers)}}  Followers </a>



<!-- Follows List -->
@include('includes.follows')


</p>

	</div>
<hr>

@include("includes.postbody")

</div>

@endsection








<link href="{{ asset('css/user.css') }}" rel="stylesheet">
