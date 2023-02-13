@extends('layouts.admin')
@section("title","Admin Panel")

@section('content')

<!--  -->
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
 

<!--  -->
<div class="container-fluid">

@include("includes.sessions") 

<section id="loading">
  <i class="fas spinner fa-spinner fa-3x fa-spin text-center "></i>
</section>
  
<!-- Index Body -->




<div class="container-fluid search-table table-responsive display  scroll-horizontal">
  <div class="search-box">
      <div class="row">
          <div class="col-md-3">
              <h3>All Site Users
               <i>{{count($users)}}</i>


              </h3>
          </div>
          <div class="col-md-9">
              <input type="text" id="myInput" onkeyup="myFunction()" class="form-control" placeholder="Search all fields e.g. user.name">
              <script>
                  $(document).ready(function () {
                      $("#myInput").on("keyup", function () {
                          var value = $(this).val().toLowerCase();
                          $("#myTable tr").filter(function () {
                              $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                          });
                      });
                  });
              </script>
          </div> 
      </div>
  </div>
  <div class="search-list">
      <table class="table table-bordered table-striped text-center" id="myTable" cellspacing="0" width="100%">
         
        <thead>
          <tr>
              <th class="th-sm">Name</th>
              <th class="th-sm">Email</th>
              <th class="th-sm">Avatar</th>
              <th class="th-sm">Bio</th>
              <th class="th-sm">Time Joined</th>
              <th class="th-sm">Posts</th>
              <th class="th-sm">Comments & Replies</th>
              <th class="th-sm">Followers</th>
              <th class="th-sm">Followeing</th>
              <th class="alert-danger">Reports</th>
              <th class="th-sm">Actions</th>
          </tr>
        </thead>
        <tbody > 
       @isset($users)
@foreach($users as $user)
<tr class="text-black-50">
<td><a href="{{route('profile',$user->id)}}" >{{$user->name}} {{$user->status}}</a></td>
<td>{{$user->email}}</td>
<td> <img src="/media/{{  $user->avatar  }}" width="50" height="50"> </td>
<td>{{$user->bio}}</td>
<td>{{$user->created_at->diffForHumans()}}</td>
<td>{{count($user->posts)}}    </td>
<td>{{count($user->comments)+count($user->replies)}}    </td>


<td> {{count(App\Models\Follow::where("followed_id",$user->id)->get())}}
</td>
<td>{{count($user->follows)}}    </td>

<td class="alert-danger">REPORST OF USER</td>

<!-- actions -->
<td width="35%">
    <a href="{{route('user.edit',$user->id)}}" class="btn-outline-accent-1 btn btn-primary">Edit</a>
    <a href="#"class="btn-outline-accent-1 btn btn-danger">Delete</a>
    @if($user->status==1)
        <a href="{{route('admin.changeStatus',$user->id)}}" class="btn-outline-accent-1 btn btn-warning">De-Active</a>
        @else
        <a  href="{{route('admin.changeStatus',$user->id)}}" class="btn-outline-accent-1 btn btn-warning">Active</a>
        @endif    </td>
      </tr>
@endforeach
@endisset
           </tbody>
   

      </table>

  </div>
</div>







@endsection

<style>
    .search-table{
    padding: 1%;
    margin-top: -1%;
}
.search-box{
    background: #dd5484;
    border: 1px solid red;
    padding: 1%; 
}
.search-box input:focus{
    box-shadow:none;
    border:2px solid #eeeeee;
}
.search-list{
    background: #fff;
    border: 1px solid #ababab;
    border-top: none;
}
.search-list h3{
    background: #eee;
    padding: 1%;
    margin-bottom: 0%;
    margin-right: 2%;
}
</style>