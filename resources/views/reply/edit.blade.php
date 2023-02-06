@extends("layouts.app")
@section("title","Rrply Comment")
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


    <div id="uploadpost">
        <div class="modal-dialog">
            <div class="modal-content">
    
                <div class="modal-header">
                    <h4 class="modal-title">Edit Reply </h4>
                 </div>
             <div class="modal-body">
    <form method="post" action="{{route('reply.update')}}" enctype="multipart/form-data">
        {{csrf_field()}}
                <div class="row">
            <div class="col-lg-12 col-md-12">
             <input type="file" name="media" class="form-control" >
            <input type="hidden" value="{{$reply->id}}" name="reply_id">
            <br>
            <input old="content" name="content" class="form-control" value="{{$reply->content}}" style="height: 25%;">
            
            <br>
             
        </div>
    
            
      


            </div>
    
             <div class="modal-footer">
                </div>
            <a class="btn btn-danger" href="{{route('post.view',$reply->post_id)}}">Cancel</a>
           <button type="submit" class="btn btn-primary">Edit Reply</button>  </div>
    
               </div> </form>
        </div>
    
    
    </div>
    
    
    
    

    
 
@endsection