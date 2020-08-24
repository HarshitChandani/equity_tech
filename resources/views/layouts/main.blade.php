<html lang="en">
   <head>
      <title>Laravel</title>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"/>
      <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"  crossorigin="anonymous"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" crossorigin="anonymous"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   </head>
   <body>
       <div class="container-fluid">
        <nav class="navbar navbar-expand-md navbar-light bg-light">
             <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
                aria-expanded="false" aria-label="Toggle navigation">
               <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavId">
               <ul class="navbar-nav mr-auto mt-2 mt-lg-0">

               </ul>
               <ul class="navbar-nav ml-auto">
                  <!--Authentication Link-->
                  @if(Auth::check())
                     <li class="nav-item">
                        <strong>{{ Auth::user()->name }}</strong>
                        <a href="{{ url('/logout') }}" type="button" class="navbar-brand text-muted navbar-text" style="text-decoration: none;font-size:20px">Logout</a>
                     </li>
                  @else
                     <li>
                        <a href="{{ route('user_login') }}" type="button" class="text-muted navbar-text mr-3" style="text-decoration: none;font-size:20px">Login</a>
                        <a href="{{ route('user_register') }}" type="button" class="text-muted navbar-text" style="text-decoration: none;font-size:20px">Register</a>   
                     </li>
                  @endif
               </ul>
            </div>
        </nav>
           <div class="container">
               @yield('content')
           </div>
       </div>
   </body>
</html>