 <nav  class=" navbar fixed-top navbar-expand-lg navbar-dark scrolling-navbar navbar-section">
            <div class="container-fluid " >
                <!-- Brand -->
                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-2">
                    <a class="navbar-brand" href="/">
                        <strong>Newsplug</strong>
                    </a>
                </div>
                <!-- Links -->
                <div class="col-xl-10 col-lg-10 col-md-10 col-sm-10 col-10 navbar-collapse"  id="navbarSupportedContent">
                    <!-- Left -->
                    <ul class="navbar-nav mr-auto">
                    </ul>
                    <!-- Right -->
                    <ul class="navbar-nav nav-flex-icons">
                        @guest
                        <li class="nav-item">
                            <a href="{{ url('/') }}" class="nav-link">
                                News
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/') }}" class="nav-link">
                                Business
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/') }}" class="nav-link">
                                Politics
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/') }}" class="nav-link">
                                Entertainment
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/transaction') }}" class="nav-link">
                                Sports
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/transaction') }}" class="nav-link">
                                Tv
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/transaction') }}" class="nav-link">
                                Technology
                            </a>
                        </li>
                        @else
                        <li class="nav-item">
                            <a href="{{ url('/') }}" class="nav-link">
                                News
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/') }}" class="nav-link">
                                Business
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/') }}" class="nav-link">
                                Entertainment
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/transaction') }}" class="nav-link">
                                Sports
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/transaction') }}" class="nav-link">
                                Technology
                            </a>
                        </li>
                        @endguest
                    </ul>

                    <!--            {{-- menu icon for search, user, and mobile menu(Hamburger) --}} -->
                    <div class="row" style="float: right">
                        <i class="fas fa-search" onclick="searchBar()" id="search-icon"></i>

                        <ul id="demo" class="menu">
                            <li>
                                <a onclick="menu1()">
                                    <i class="fas fa-user" id="m1"></i>
                                </a> @guest
                                <ul>
                                    <li><a data-toggle="modal" data-target="#login"><i class="fas fa-right-from-bracket"></i> Login</a></li>
                                    <li><a href="{{ url('/register') }}"><i class="fas fa-user-plus"></i> Register</a></li>
                                    <li class="menu-separator"></li>
                                    <li><a href="#"><i class="fas fa-globe"></i> Language</a></li>
                                    <li><a href="#"><i class="fas fa-circle-info"></i> Help</a></li>
                                </ul>
                                @else
                                <ul>
                                    <a href="{{route ('profile')}}">
                                        <div class="container nav-profile-picture-container">
                                            <img id="small-profile-picture" src="../images/{{Auth::user()->picture}}" alt="{{Auth::user()->first_name}}"/>
                                            <h5>{{Auth::user()->first_name}} - {{Auth::user()->last_name}}</h5>
                                        </div>
                                    </a>
                                    <li class="menu-separator"></li>

                                    <li><a href="{{ url('/favorite-post') }}" id="nav-count-saved-post"></a></li>
                                    <li><a href="#"><i class="fas fa-globe"></i> Language</a></li>
                                    <li><a href="#"><i class="fas fa-circle-info"></i> Help</a></li>
                                    <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <i class="fas fa-right-from-bracket"></i>
                                            Log Out
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                                @endguest
                            </li>
                        </ul>
                        <ul id="demo1" class="menu">
                            <li>
                                <a onclick="menu2()">
                                    <i class="fas fa-bars" id="m2"></i>
                                </a>
                                <ul>
                                    <li><a href="#">News</a></li>
                                    <li><a href="#">Business</a></li>
                                    <li><a href="#">Entertainment</a></li>
                                    <li><a href="#">Sports</a></li>
                                    <li><a href="#">Technology</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>

                </div>   
            </div>
        </nav>

        <!--search box area-->
        <div class="container-fluid search-box" id="search">
            <div class="col-lg-6 p-2" style="margin: auto;">
                <form method="get" action="{{url('search_post')}}">
                    <div>
                        <input style="padding-right: 55px;" type="text" name="query" value="{{ Request('query')}}" autocomplete="off" class="form-control" placeholder="Search Blog.." required/>
                    </div>
                    <div class="" style="text-align: right">
                        <button class="btn btn-success" style="margin-top: -67px; height: 38px;">
                            <i class="fas fa-search" ></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>