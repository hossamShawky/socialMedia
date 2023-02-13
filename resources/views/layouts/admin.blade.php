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


		<script src="https://code.jquery.com/jquery-3.6.3.js" 
		integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
		



    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/adminBladeStyle.css') }}" rel="stylesheet">


<style>
</style>


</head>
<body class="scrollbar-warning">
    

<div id="app">
 <nav class="navbar  navbar-expand-md navbar-light bg-white shadow-sm " >
            <div class="container">
                <a class="navbar-brand" href="{{ route('admin.index') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                @guest

                <ul class="navbar-nav mr-auto" id="Llinks">

                </ul>
                @endguest
                @auth("admin")
                <ul class="navbar-nav mr-auto" id="Llinks">

 <li> <a class="btn btn-info" href="{{route('admin.add')}}">Add New Admin 
 <!-- <span id="flash" class="btn btn-warning" style="border-radius:50%"></span> -->
               </a>   </li> 

                <li>
                    <a href="{{route('admin.admins')}}" class="btn btn-info">Admins</a>
                    
                                            </li>

<!-- search about user or post -->

                        <li>

                       
 <form action="{{route('admin.content.search')}}" method="POST">
                   {{csrf_field()}}
             <input type="text" name="searchTxt" 
             class=" form-control input-md"
           placeholder="Search about you want">  
                        
      </form></li>



           </ul>
                @endauth


                   <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.login') }}">{{ __('Login') }}</a>
                            </li>
                        @endguest 
                        
                        @auth('admin')
                        <li>
                        <img src="/admin/media/{{Auth::user()->avatar}} "
  style="width: 55px;height: 48px; border-radius: 50%" >
  
</li>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown"
 class="nav-link dropdown-toggle" href="#"  role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::guard("admin")->user()->name }}

                                 <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                <a class="dropdown-item" href="/adminprof">
                                    {{ __('Profile') }}
                                </a>

                                <a class="dropdown-item" href="{{ route('admin.logout') }}">
                                    {{ __('Logout') }}
                                </a>

                                
                            </div>
                        </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
            <router-view></router-view>
<button  id="btn-top" class="btn btn-info" title="Go To Top"> 
    <i class="fa fa-arrow-up fa-lg"></i>
</button>
        </main>
    </div>

    <script src="{{ asset('js/admin.js') }}" defer></script>
</body>
</html>
