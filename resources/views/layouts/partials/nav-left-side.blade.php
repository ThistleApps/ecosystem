<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li class="sidebar-search">
                <div class="input-group custom-search-form">
                    <input type="text" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                </div>
                <!-- /input-group -->
            </li>
            <li>
                <a href="{{url('/home')}}"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
            </li>
            <li>
                <a href="{{url('/deliveries')}}"><i class="fa fa-truck fa-fw"></i> Deliveries</a>
            </li>
            <li>
                <a href="{{url('/configs')}}"><i class="fa fa-gear fa-fw"></i> Config/Defaults</a>
            </li>
            <li>
                <a href="{{url('/merchants')}}"><i class="fa fa-users fa-fw"></i> Merchants</a>
            </li>
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>
<!-- /.navbar-static-side -->