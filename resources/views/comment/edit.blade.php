@extends("layouts.app")
@section("title","Edit Comment")
@section("content")
 
 

    
@include("includes.sessions")



    <div id="uploadpost">
        <div class="modal-dialog">
            <div class="modal-content">
    
                <div class="modal-header">
                    <h4 class="modal-title">Edit Comment</h4>
                 </div>
             <div class="modal-body">
    <form method="post" action="{{route('comment.update')}}" enctype="multipart/form-data">
        {{csrf_field()}}
                <div class="row">
            <div class="col-lg-12 col-md-12">
             <input type="file" name="media" class="form-control" >
            <input type="hidden" value="{{$comment->id}}" name="comment_id">
            <br>
            <input old="content" name="content" class="form-control" value="{{$comment->content}}" style="height: 25%;">
            
            <br>
             
        </div>
    
            
      


            </div>
    
             <div class="modal-footer">
                </div>
            <a class="btn btn-danger" href="{{route('post.view',$comment->post->id)}}">Cancel</a>
           <button type="submit" class="btn btn-primary">Edit Comment</button>  </div>
    
               </div> </form>
        </div>
    
    
    </div>
    
    
    
    

    
 
@endsection