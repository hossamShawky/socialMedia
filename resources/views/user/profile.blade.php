@extends("layouts.app")
@section("title", $user->name."`s Profile")
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

   

<h3><a href="{{route('profile',$user->id)}}" >
  {{$user->name}}</a>
     
   </h3>
 <b>{{"BIO : ".$user->bio}}</b><br>
 <b>{{"Status : ".$user->getStatus()}}</b><br>
 <b>{{"Joined : " .$user->created_at->format('M') ." - ".$user->created_at->year}}</b><br>
    </p>






</div>
<p class="actions">
<a class="btn btn-danger pull-right   " href="#">Report </a>
<a class="btn btn-primary pull-right  " href="#" >Star</a>


@if($status == true )

 <a class="btn btn-primary pull-right  " title="UN Follow {{$user->name}} then you can`t see more posts"
 href="{{route('user.unfollow',$user->id)}}" >Un Follow </a>
 
 @else
 
<a class="btn btn-primary pull-right  " title="Follow {{$user->name}} to see more posts"
 href="{{route('user.follow',$user->id)}}" >Follow </a>

 @endif
 


 <br><br>
 
<a data-toggle="modal" data-target="#followingList"  class='followUsers' href="">{{count($following)}}  Following </a>
<a  data-toggle="modal" data-target="#followersList"  class='followUsers' href="">{{count($followers)}}  Followers </a>



<!-- Follows List -->
@include('includes.follows')


</p>

	</div>
  <hr>
  
<!-- post body -->
@include("includes.postbody")
  </div>



@endsection








<link href="{{ asset('css/user.css') }}" rel="stylesheet">
 