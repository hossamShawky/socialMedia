@extends("layouts.app")
@section("title",$post->user->name." `s post")
@section("content")

<div class=" container-fluid">
  
 
         <!-- @if(Session::has('error'))
        <div class="container alert alert-danger alert-block">
<button type="button" class="close" data-dismiss="alert">×</button>
                 <strong>    {{Session('error')}}                </strong>
        </div>
        @endif
        @if(Session::has('message'))
        <div class="container alert alert-success alert-block">
<button type="button" class="close" data-dismiss="alert">×</button>
                 <strong>    {{Session('message')}}                </strong>
        </div>
        @endif -->

        
<!-- get all posts -->
 


          
<div class="col-lg-12 col-md-12 col-sm-12  text-center">
  @if(Session::has('error'))
      <b class="alert alert-danger">{{Session('error')}}</b>
  @endif
  @if(Session::has('message'))
      <b class="alert alert-success">{{Session('message')}}</b>
  @endif
</div>
 
<!-- Comments  -->
<div class="bootstrap snippets bootdey">
    <div class="row">
		<div class="col-lg-12">
		    <div class="blog-comment">
             
				<ul class="comments">

<li class="clearfix">
<img src="/media/{{$post->user->avatar}}" class="avatar" alt="">
				  <div class="post-comments">
				      <p class="meta">   @if($post->privacy == "Me")
         <i class="fa fa-lock"  ></i>  
@else
<i class="fa fa-home"  ></i>  

@endif{{$post->created_at->diffForHumans()}} 
<b>   <a href="{{route('profile',$post->user_id)}}">{{$post->user->name}}</a></b>   


@if($post->user_id == Auth::id())
<a class="text-danger" href="{{route('post.delete',$post->id)}}"><i class="fa fa-trash fa-xl"  ></i>  </a>
<a class="text-info" href="{{route('post.edit',$post->id)}}"><i class="fa fa-pen-to-square fa-xl"  ></i> </a>
@endif


</p>
 <p>
<b style="width: 50%;">{{$post->content}}</b>				  
@if($post->media)<img src="/media/{{$post->media}}" 
class="avatr" alt="image not found" style="width:50%;height: 10%;margin-left: 25%;">
@endif

</p>


<form class="form-outline w-100" method="post"
action="{{route('comment.store')}}" enctype="multipart/form-data">
  {{csrf_field()}}
  <input type="hidden" name="user_id" value="{{Auth::id()}}">
  <input type="hidden" name="post_id" value="{{$post->id}}">
  <input type="text" name="content" class="form-control" id="textAreaExample"
   placeholder="Leave Your Comment" style="width: 70% ;display: inline;" >
 <label   for="myfile"><e>Image</e><i class="far fa-image me-2"></i></label>
  <input type="file" id="myfile" name="media" style="display: none;">
  <button class="btn btn-primary" type="submit"><i class="far fa-paper-plane me-2"></i></button>
    
  
  </form>


<div class="small d-flex justify-content-start" style="margin-bottom: -1%;" >

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

@isset($comments)
@foreach($comments as $comment)
				<li class="clearfix">
				  <img src="/media/{{$comment->user->avatar}}" class="avatar" alt="">
				  <div class="post-comments">
				      
          

<p class="meta">{{$comment->created_at->diffForHumans()}}
<b>   <a href="{{route('profile',$comment->user_id)}}">{{$comment->user->name}}</a></b>

@if($comment->user_id == Auth::id())
<a class="text-danger" href="{{route('comment.delete',$comment->id)}}"><i class="fa fa-trash fa-xl"  ></i>  </a>
<a class="text-info" href="{{route('comment.edit',$comment->id)}}"><i class="fa fa-pen-to-square fa-xl"  ></i> </a>
@endif

 </p>
<p>
<b style="width: 50%;">{{$comment->content}}
<a href="{{route('profile',$post->user_id)}}">{{"@".$post->user->name}}</a>
</b>				  
@if($comment->media)<img src="/media/{{$comment->media}}" 
class="avatr" alt="image not found" style="width:50%;height: 10%;margin-left: 25%;">
@endif







<form class="form-outline w-100" method="post"
action="{{route('reply.store')}}" enctype="multipart/form-data">
  {{csrf_field()}}
  <input type="hidden" name="user_id" value="{{Auth::id()}}">
  <input type="hidden" name="post_id" value="{{$post->id}}">
  <input type="hidden" name="comment_id" value="{{$comment->id}}">
  <input type="text" name="content" class="form-control" id="textAreaExample"
   placeholder="Leave Your Reply" style="width: 70% ;display: inline;" >
 <label   for="myfile2"><e>Image</e><i class="far fa-image me-2"></i></label>
  <input type="file" id="myfile2" name="media" style="display: none;">
  <button class="btn btn-primary" type="submit"><i class="far fa-reply me-2"></i></button>
    
   
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

  </form>


<div class="small d-flex justify-content-start" style="margin-bottom: -2%;" >

  
  <a href="{{route('comment.love',$comment->id)}}" class="d-flex align-items-center me-3">
    <b style="font-size: 15px;margin: 0 3px 0 3px ;">  
         {{count($comment->loves)}}
      <i class="far fa-heart me-2"></i></b>
    </a>

  <a href="{{route('post.view',$post->id)}}" class="d-flex align-items-center me-3">
   <b style="font-size: 15px;margin: 0 3px 0 3px ;"> 
    {{count($comment->replies)}}
    
    <i class="far fa-share me-2"></i></b>
   </a>

      </div>





</p>
				  </div>
				



          <ul class="comments" style="background-color: orange;">
				    @isset($replies)
@foreach($replies as $reply)
 
@if($reply->comment_id == $comment->id)



@if(is_null($reply->reply_id))
<li class="clearfix">
  <img src="/media/{{$reply->user->avatar}}" class="avatar" alt="">
                    <div class="post-comments">
  <p class="meta">{{$reply->created_at->diffForHumans()}}
  <b>   <a href="{{route('profile',$reply->user_id)}}">{{$reply->user->name}}
    

   {{count($reply->subReplies)}} <i class="fa fa-share fa-xl"  ></i>
  </a></b>
   
  
  @if($reply->user_id == Auth::id())
<a class="text-danger" href="{{route('reply.delete',$reply->id)}}"><i class="fa fa-trash fa-xl"  ></i>  </a>
<a class="text-info" href="{{route('reply.edit',$reply->id)}}"><i class="fa fa-pen-to-square fa-xl"  ></i> </a>
@endif

</p>  
  <p>
  <b style="width: 50%;">{{$reply->content}}
    <a href="{{route('profile',$comment->user_id)}}">{{"@".$comment->user->name}}</a>
  </b>			  
  @if($reply->media)<img src="/media/{{$reply->media}}" 
  class="avatr" alt="image not found" style="width:50%;height: 10%;margin-left: 25%;">@endif
  
  </p>




  <form class="form-outline w-100" method="post"
  action="{{route('reply.store')}}" enctype="multipart/form-data">
    {{csrf_field()}}
    <input type="hidden" name="user_id" value="{{Auth::id()}}">
    <input type="hidden" name="post_id" value="{{$post->id}}">
    <input type="hidden" name="comment_id" value="{{$comment->id}}">
    <input type="hidden" name="reply_id" value="{{$reply->id}}">
    <input type="text" name="content" class="form-control" id="textAreaExample"
     placeholder="Leave Your Reply" style="width: 70%;display: inline;" >
   <label   for="myfile"><e>Image</e><i class="far fa-image me-2"></i></label>
    <input type="file" id="myfile" name="media" style="display: none;">
    <button class="btn btn-primary" type="submit"><i class="far fa-paper-plane me-2"></i></button>
      
  
    </form>
  

</div>    







@isset($reply->subReplies)
@foreach($reply->subReplies as $sr)

@if($sr->reply_id)


<ul class="comments" style="background-color: yellowgreen;">
  <li class="clearfix">
      
    

    <img src="/media/{{$sr->user->avatar}}" class="avatar" alt="">
    <div class="post-comments">
        <p class="meta"> 

{{$sr->created_at->diffForHumans()}} 
<b>   <a href="{{route('profile',$sr->user_id)}}">{{$sr->user->name}}</a></b>   


@if($sr->user_id == Auth::id())
<a class="text-danger" href="{{route('reply.delete',$sr->id)}}"><i class="fa fa-trash fa-xl"  ></i>  </a>
<a class="text-info" href="{{route('reply.edit',$sr->id)}}"><i class="fa fa-pen-to-square fa-xl"  ></i> </a>
@endif
</p>
        <p>
<b style="width: 50%;">{{$sr->content}}
  <a href="{{route('profile',$reply->user_id)}}">{{"@".$reply->user->name}}</a>
</b>		  
@if($sr->media)<img src="/media/{{$sr->media}}" class="avatr" alt="image not found" 
style="width:50%;height: 10%;margin-left: 25%;">@endif

</p> 






          </p>
      </div>
  </li>
</ul>


@endif
@endforeach
@endisset











                </li>
@endif

@endif

@endforeach
            @endisset
				  </ul>
		


				</li>
        @endforeach

        @endisset

				</ul>
			</div>
		</div>
	</div>
</div>

@endsection
 

<link href="{{ asset('css/post_comment_reply.css') }}" rel="stylesheet">
