<!-- Following List -->

<div id="followingList" class="modal fade">
  <div class="modal-dialog">
      <div class="modal-content">

          <div class="modal-header">
              <h3 class="modal-title">Following List </h3>
                 <button type="button" class="close btn btn-danger" data-dismiss="modal"><span>&times;</span><span class="sr-only">Close</span></button>
          </div>
       <div class="modal-body">   
@isset($following)
@foreach($following as $f)

<strong>
  <a href="{{route('profile',$f->FUser->id)}}"> 
    <img class="follow-img"  alt="{{$f->FUser->name}}" 
    src="/media/{{$f->FUser->avatar}}"> {{$f->FUser->name}}</a>
    

   
</strong>
<hr>
 @endforeach
@endisset

</div>
</div>
</div>
</div>
 


<!-- Follower List -->
<div id="followersList" class="modal fade">
  <div class="modal-dialog">
      <div class="modal-content">

          <div class="modal-header">
              <h3 class="modal-title">Followers List </h3>
                 <button type="button" class="close btn btn-danger" data-dismiss="modal"><span>&times;</span><span class="sr-only">Close</span></button>
          </div>
       <div class="modal-body">   
@isset($followers)
@foreach($followers as $f)

<strong>
  <a href="{{route('profile',$f->user->id)}}"> 
    <img class="follow-img"  alt="{{$f->user->name}}" 
    src="/media/{{$f->user->avatar}}"> {{$f->user->name}}</a>
    

   
</strong>
<hr>
@endforeach
@endisset

       </div>
      </div>
    </div>
