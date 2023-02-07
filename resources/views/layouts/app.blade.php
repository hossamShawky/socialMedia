<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>  @yield('title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link rel = "icon" href = 
"https://media.geeksforgeeks.org/wp-content/cdn-uploads/gfg_200X200.png" 
        type = "image/x-icon">
    <!-- Fonts -->
    <link rel="stylesheet" href=
"https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.css">
</link>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">


<style>
    #Llinks li>button,#Llinks li>a{
  text-decoration: none;
   margin-left: 12px;
   margin-top: 2px;
}
</style>


</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm " >
            <div class="container">
                <!-- <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a> -->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                @guest

                <ul class="navbar-nav mr-auto" id="Llinks">

                </ul>
                @else
                <ul class="navbar-nav mr-auto" id="Llinks">


<li style="margin-top: 2px;"><a style="color: white;" href="{{route('index')}}">

<button type="button" class="btn btn-primary">Home Page</button></a></li>

<li><a href="{{route('post.create')}}" class="btn btn-primary" >Upload Post </a></li>


<li><a href="{{route('account.review')}}" class="btn btn-success" >Review Account</a></li>




 


 













<li class="nav-item dropdown">
                            <a id="navbarDropdown"
 class="nav-link dropdown-toggle" 
 href="#" role="button" data-toggle="dropdown" 
 aria-haspopup="true" aria-expanded="false" v-pre>
                                
 
 <i class="fa fa-bell fa-md"></i>
       <label class="badge fa-md">
 <?php
$c=0;
 foreach(auth()->user()->unreadNotifications as $n)
 {
$c+=$n->type=="App\Notifications\CommentNotification"?1:0;
 }
 echo  $c;
?>
    </label>
                                 <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                               
                            





<a class="dropdown-item text-center" style="color: blue;font-weight: bold; "
href="{{route('notification.readAll')}}"> Make All As Read</a>

@foreach(auth()->user()->Notifications as $notification)

@if($notification->unread() && 
$notification->type=="App\Notifications\CommentNotifcation")
<a class="dropdown-item"
 

href="{{route('notification.read',[$notification->id,
    $notification->data['postId']])}}"
style="background-color: black;color: white">
{{ $notification->created_at->diffForHumans() }}
{{ $notification->data['body'] }}</a>

@elseif($notification->read() && 
$notification->type=="App\Notifications\CommentNotifcation")
<a class="dropdown-item" 
href="{{route('notification.read',[$notification->id,
    $notification->data['postId']])}}">
{{ $notification->created_at->diffForHumans() }}
{{ $notification->data['body'] }}
</a>
@endif


@endforeach


                                 

                                 
                            </div>
                        </li>







           </ul>
                @endguest


                   <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                        <li>
                        <img src="/media/{{Auth::user()->avatar}} "
  style="width: 55px;height: 48px; border-radius: 50%" >
  
</li>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown"
 class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}

                                 <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                <a class="dropdown-item" href="{{route('myprofile')}}">
                                    {{ __('Profile') }}
                                </a>

                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
            <router-view></router-view>
        </main>
    </div>
</body>
</html>
