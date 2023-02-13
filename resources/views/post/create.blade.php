@extends("layouts.app")
@section("title","Add Post")
@section("content")
 
 

    
@include("includes.sessions") 



    <div id="uploadpost">
        <div class="modal-dialog">
            <div class="modal-content">
    
                <div class="modal-header">
                    <h4 class="modal-title">Add New Post</h4>
                 </div>
             <div class="modal-body">
    <form method="post" action="{{route('post.store')}}" enctype="multipart/form-data">
        {{csrf_field()}}
                <div class="row">
            <div class="col-lg-12 col-md-12">
             <input type="file" name="media" class="form-control" >
            <input type="hidden" value="{{Auth::id()}}" name="user_id">
            <br>
            <textarea old="content" name="content" class="form-control" placeholder="add your post content"></textarea>
            
            <br>
            <select class="form-control" name="privacy"> 
                <option value="All">All</option>
                <option value="Me">Only Me</option>
            </select>
        </div>
    
            
      


            </div>
    
             <div class="modal-footer">
                </div>
            <a class="btn btn-danger" href="/home">Cancel</a>
           <button type="submit" class="btn btn-primary">Upload Post</button>  </div>
    
               </div> </form>
        </div>
    
    
    </div>
    
    
    
    

    
 
@endsection