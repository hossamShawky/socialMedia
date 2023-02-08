@extends("layouts.app")
@section("title", $user->name."`s Profile")
@section("content")

<div class="container-fluid">


<div class="row">

<div class="col-md-8 col-md-offset-1" style="float: left;">
	<a href="/viewPic/{{$user->avatar}}">
	<img src="/media/{{$user->avatar}} "
	style="width: 150px;height: 150px;float: left;
    border-radius: 50%;margin-right: 10%; margin-left: 2%;"> </a>

 	<p>

   

<h3><a href="{{route('profile',$user->id)}}" >
  {{$user->name}}</a></h3>
 <b>{{"BIO : ".$user->bio}}</b><br>
 <b>{{"Status : ".$user->getStatus()}}</b><br>
 <b>{{"Joined : " .$user->created_at->format('M') ." - ".$user->created_at->year}}</b><br>
    </p>






</div>
<p class="actions">
<a class="btn btn-danger pull-right   " href="#">Report </a>
<a class="btn btn-primary pull-right  " href="#" >Star</a>
<a class="btn btn-primary pull-right  " href="#" >Follow </a>
 </p>

	</div>
<hr>


</div>

<div class="bootstrap snippets bootdey container-fluid">
    <div class="row">
		<div class="col-lg-12">
		    <div class="blog-comment">
             
				<ul class="comments">


          @isset($posts)
          @foreach($posts as $post)
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
<b style="width: 50%;">{{$post->content}}</b>				  
@if($post->media)<img src="/media/{{$post->media}}" class="avatr" alt="image not found" style="width:50%;height: 10%;margin-left: 25%;;">@endif

</p> 




<form class="form-outline w-100" method="post"
action="{{route('comment.store')}}" enctype="multipart/form-data">
  {{csrf_field()}}
  <input type="hidden" name="user_id" value="{{Auth::id()}}">
  <input type="hidden" name="post_id" value="{{$post->id}}">
  <input type="text" name="content" class="form-control" id="textAreaExample"
   placeholder="Leave Your Comment" style="width: 70%; height: 1.5% ;display: inline;" >
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








<link href="{{ asset('css/post_comment_reply.css') }}" rel="stylesheet">
 