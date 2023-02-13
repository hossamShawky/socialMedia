

<!-- Form Errors  -->
   @if($errors->any())
    <br>
<div class=" container alert alert-danger inline-block"> 
<ul>
<button type="button" class="close btn-danger" data-dismiss="alert">×</button>

@foreach($errors->all() as $error)
<li> {{$error}}</li>
@endforeach
</ul>
</div>
    @endif

    <!-- Genearl Messages -->
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
