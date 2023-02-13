@extends("layouts.app")
@section("title","Home Page")
@section("content")
<link href="{{ asset('css/user.css') }}" rel="stylesheet">

<div class="container">
  
<section id="loading">
  <i class="fas spinner fa-spinner fa-3x fa-spin text-center "></i>
</section>
  

          
@include("includes.sessions") 




@include("includes.postbody")

</div>

@endsection
 

 



<script>

 

</script>