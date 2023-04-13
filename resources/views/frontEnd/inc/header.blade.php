
<body>


<!-- Header Starts -->
<div class="navbar-wrapper">

        <div class="navbar-inverse" role="navigation" id="myHeader">
          <div class="container">
            <div class="navbar-header">


              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>

            </div>


            <!-- Nav Starts -->
            <div class="navbar-collapse collapse">
              <ul class="nav navbar-nav navbar-right">
                <li class="{{Request::is('/')? 'active':''}}" ><a href="{{ route('home_page') }}">Home</a></li>

                <li class="{{Request::is('user/post/create')? 'active':''}}" ><a href="{{ route('user.post.create') }}">Rent House</a></li>
            
                {{--<li><a href="about.php">About</a></li>--}}
                {{--<li><a href="contact.php">Contact</a></li>--}}

                @guest
                  <li class="{{Request::is('login')? 'active':''}}" ><a href="{{ route('login') }}">Login</a></li>
                  <li class="{{Request::is('register')? 'active':''}}" ><a href="{{ route('register') }}">Sign Up</a></li>
                @endguest
                
                @auth
                <li class="{{Request::is('user/dashboard')? 'active':''}}" ><a href="{{ route('admin.dashboard') }}"> {{ Auth::user()->name }} </a></li>
                  <li>
                    <a href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}</a>

                    <form id="logout-form" action="{{ route('logout')}}" method="POST" style="display: none;">
                    @csrf
                    </form>
                  </li>

                @endauth

              </ul>
            </div>
            <!-- #Nav Ends -->

          </div>
        </div>

    </div>
<!-- #Header Starts -->





<div class="container">

<!-- Header Starts -->
<div class="header">
<a href="{{ route('home_page') }}"><img src="{{asset('frontEnd/images')}}/logo.png" alt="House Rent"></a>

              {{--<ul class="pull-right">--}}
                {{--<li><a href="buysalerent.php">Buy</a></li>--}}
                {{--<li><a href="buysalerent.php">Sale</a></li>         --}}
                {{--<li><a href="buysalerent.php">Rent</a></li>--}}
              {{--</ul>--}}
</div>
<!-- #Header Starts -->
</div>



