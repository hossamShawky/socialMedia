<img class="rounded-circle shadow-1-strong me-3"
        src="media/{{$post->user->avatar}}" alt="avatar" width="60"
        height="60" />
      <div>
        <h4 class="fw-bold text-primary mb-1"><a href="{{route('profile',$post->user_id)}}">{{$post->user->name}}</a></h4>
        <p class="text-muted small mb-0">
         @if($post->privacy == "Me")
         <i class="fa fa-lock"  ></i>  
@else
<i class="fa fa-home"  ></i>  

@endif
           - {{$post->created_at->diffForHumans()}}
        </p>
      </div>
    </div>

    <p class="mt-3 mb-4 pb-2">
{{$post->content}}    </p>

    <div class="small d-flex justify-content-start">
      
      
      
      <a href="{{route('post.love',$post->id)}}" class="d-flex align-items-center me-3">
        <b style="font-size: 20px;margin: 0 5px 0 5px ;"> {{count($post->loves)}} <i class="far fa-heart me-2"></i></b>
        </a>


      <a href="{{route('post.view',$post->id)}}" class="d-flex align-items-center me-3">
       <b style="font-size: 20px;margin: 0 5px 0 5px ;"> {{count($post->comments)+count($post->replies)}} <i class="far fa-comment-dots me-2"></i></b>
       </a>


      <a href="#!" class="d-flex align-items-center me-3">
        <b style="font-size: 20px;margin: 0 5px 0 5px ;"> <i class="fas fa-share me-2"></i></b>
       </a>



    </div>
  </div>
  <div class="card-footer py-3 border-0" style="background-color: #f8f9fa;">
    <div class="d-flex flex-start w-100">
 
      <img class="rounded-circle shadow-1-strong me-3"
        src="media/{{$post->user->avatar}}" alt="avatar" width="40"
        height="40" />
      <form class="form-outline w-100" method="post"
      action="{{route('comment.store')}}" enctype="multipart/form-data">
        {{csrf_field()}}
        <input type="hidden" name="user_id" value="{{Auth::id()}}">
        <input type="hidden" name="post_id" value="{{$post->id}}">
        <textarea name="content" class="form-control" id="textAreaExample" rows="1"
          style="background: #fff;" placeholder="Leave Your Comment"></textarea>

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
          
          <div class="float-end mt-2 pt-1 text-center">
            <input type="submit" class="btn btn-primary btn-sm" value="Comment">
            <button type="button" class="btn btn-outline-primary btn-sm">Cancel</button>
          </div>

        </form>
    </div>
    
  </div>
</div>
<br>



@endforeach

@endisset

