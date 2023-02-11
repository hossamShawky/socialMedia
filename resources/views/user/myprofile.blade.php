@extends("layouts.app")
@section("title","User Profile")
@section("content")

<div class="container-fluid">

    @if(Session::has('message'))
    <div class="container alert alert-success alert-block">
<button type="button" class="close" data-dismiss="alert">×</button>
             <strong>    {{Session('message')}}                </strong>
    </div>
    @endif

    
    @if(Session::has('error'))
    <div class="container alert alert-danger alert-block">
<button type="button" class="close" data-dismiss="alert">×</button>
             <strong>    {{Session('error')}}                </strong>
    </div>
    @endif

    


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




 
<div id="deleteprofile" class="modal fade">
  <div class="modal-dialog">
      <div class="modal-content">

          <div class="modal-header">
              <h4 class="modal-title">Delete Profile</h4>
                 <button type="button" class="close btn btn-danger" data-dismiss="modal"><span>&times;</span><span class="sr-only">Close</span></button>
          </div>
       <div class="modal-body">   
<form method="post" class="text-center"  action="{{URL('/user/delete')}}" >

{{csrf_field() }}

<input type="hidden" name="userid" value="{{$user->id}}"> 
Are You Sure To Delete Your Profile<br>
<input type="radio" name="res" id="yes" value="Yes"><label for="yes">Yes</label>

<input type="radio" name="res" id="no" value="No"><label for="no">No</label>
<br>
<input class="btn btn-danger" type="submit" name="delete" value="Confirm">
</form>
      </div>
      
       <div class="modal-footer">  
      <a class="btn btn-danger" href="/profile/{{$user->id}}">Cancel</a>
       </div>
     

      </div>
  </div>
 
 

  </div>
</div>


</div>

</div>

<div class="bootstrap snippets bootdey container-fluid">
    <div class="row">
		<div class="col-lg-12">
		    <div class="blog-comment">
             
				<ul class="comments">


          @isset($posts)
          @foreach($posts as $post)
          
         @php
$postMediaType=false;
if(strpos($post->media,".mp4") ) 
$postMediaType = true;
          @endphp
<li class="clearfix">
<img src="/media/{{$post->user->avatar}}" class="avatar" alt="">
				  <div class="post-comments">
				      <p class="meta">   @if($post->privacy == "Me")
         <i class="fa fa-lock"  ></i>  
@else
<i class="fa fa-home"  ></i>  
<b>   <a href="{{route('profile',$post->user_id)}}">{{$post->user->name}}</a></b>

@endif


{{$post->created_at->diffForHumans()}} 


@if($post->user_id == Auth::id())
<a class="text-danger" href="{{route('post.delete',$post->id)}}"><i class="fa fa-trash fa-xl"  ></i>  </a>
<a class="text-info" href="{{route('post.edit',$post->id)}}"><i class="fa fa-pen-to-square fa-xl"  ></i> </a>
@endif
</p>
				      <p>
<b style="width: 40%; height:auto;  ">{{$post->content}}</b>				  
@if($post->media && !$postMediaType)<img src="/media/{{$post->media}}"
 class="avatr" alt="image not found" 
 style="width:60%;height: 8%;margin-left: 25%;">
@elseif($post->media && $postMediaType)
<video  style="width:60%;height: 8%;margin-left: 25%;" controls>
<source src="/media/{{$post->media}}">
</video>
@endif
 
</p> 




<form class="form-outline w-100" method="post"
action="{{route('comment.store')}}" enctype="multipart/form-data">
  {{csrf_field()}}
  <input type="hidden" name="user_id" value="{{Auth::id()}}">
  <input type="hidden" name="post_id" value="{{$post->id}}">
  <input type="text" name="content" class="form-control" id="textAreaExample"
   placeholder="Leave Your Comment" style="width: 70%; height: 1% ;display: inline;" >
 <label   for="myfile"><e>Image</e><i class="far fa-image me-2"></i></label>
  <input type="file" id="myfile" name="media" style="display: none;">
  <button class="btn btn-primary" type="submit"><i class="far fa-paper-plane me-2"></i></button>
    

  </form>


<div class="small d-flex justify-content-start" style="margin-bottom: -2%;" >

  
  <a href="{{route('post.love',$post->id)}}" class="d-flex align-items-center me-3">
    <b style="font-size: 15px;margin: 0 3px 0 3px ;"> {{count($post->loves)}} <i class="far fa-heart me-2"></i></b>
    </a>

  <a href="{{route('post.view',$post->id)}}" class="d-flex align-items-center me-3">
   <b style="font-size: 15px;margin: 0 3px 0 3px ;"> {{count($post->comments)+count($post->replies)}} <i class="far fa-comment-dots me-2"></i></b>
   </a>

  <a href="#!" class="d-flex align-items-center me-3">
    <b style="font-size: 15px;margin: 0 3px 0 3px ;"> <i class="fas fa-share me-2"></i></b>
   </a>

     </div>
				  </div>
				</li>
        <hr/>
 @endforeach

        @endisset


				</ul>
			</div>
		</div>
	</div>
</div>

@endsection








<link href="{{ asset('css/user.css') }}" rel="stylesheet">
