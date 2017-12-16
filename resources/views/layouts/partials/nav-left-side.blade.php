
<nav class="navbar navbar-inverse navbar-fixed-left">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Project name</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li><a href="{{url('/profile')}}"><i class="fa fa-user fa-fw"></i> Profile</a></li>
                <li>
                    <a href="{{url('/deliveries')}}"><i class="fa fa-truck fa-fw"></i> Deliveries</a>
                </li>
                <li>
                    <a href="{{url('/configs')}}"><i class="fa fa-gear fa-fw"></i> Config/Defaults</a>
                </li>
                <li>
                    <a href="{{url('/merchants')}}"><i class="fa fa-users fa-fw"></i> Merchants</a>
                </li>
                <li>
                    <a href="{{url('/configurator')}}"><i class="fa fa-gear fa-fw"></i> Configurator</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

