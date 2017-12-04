@if (Auth::check())
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container" v-if="user">
            <div class="navbar-header">
                <!-- Collapsed Hamburger -->
                <div class="hamburger">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#spark-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/home') }}">
                    <img src="{{ asset('/img/mono-logo.png') }}" style="height: 32px;">
                </a>
            </div>

            <div class="collapse navbar-collapse" id="spark-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">

                    <!-- Notifications -->
                    <li class="dropdown">
                        <!-- User Photo / Name -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            <img src="{{ asset('/img/mono-logo.png') }}" class="spark-nav-profile-photo m-r-xs">
                            <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <!-- Logout -->
                            <li>
                                <a href="{{ route('logout') }}">
                                    <i class="fa fa-fw fa-btn fa-sign-out"></i>Logout
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
@else
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <!-- Collapsed Hamburger -->
                <div class="hamburger">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#spark-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/home') }}">
                    <img src="{{ asset('img/mono-logo.png') }}" style="height: 32px;">
                </a>
            </div>

            <div class="collapse navbar-collapse" id="spark-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    &nbsp;
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="{{ route('login') }}" class="navbar-link">Login</a></li>
                    <li><a href="{{ route('register') }}" class="navbar-link">Register</a></li>
                </ul>
            </div>
        </div>
    </nav>
@endif