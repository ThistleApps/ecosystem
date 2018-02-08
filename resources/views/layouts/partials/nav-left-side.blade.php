
{{--<nav class="navbar navbar-inverse navbar-fixed-left">--}}
    {{--<div class="container">--}}
        {{--<div class="navbar-header">--}}
            {{--<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">--}}
                {{--<span class="sr-only">Toggle navigation</span>--}}
                {{--<span class="icon-bar"></span>--}}
                {{--<span class="icon-bar"></span>--}}
                {{--<span class="icon-bar"></span>--}}
            {{--</button>--}}
            {{--<a class="navbar-brand" href="#">Project name</a>--}}
        {{--</div>--}}
        {{--<div id="navbar" class="navbar-collapse collapse">--}}
            {{--<ul class="nav navbar-nav">--}}
                {{--<li><a href="{{url('/profile')}}"><i class="fa fa-user fa-fw"></i> Profile</a></li>--}}
                {{--<li>--}}
                    {{--<a href="{{url('/deliveries')}}"><i class="fa fa-truck fa-fw"></i> Deliveries</a>--}}
                {{--</li>--}}
                {{--<li>--}}
                    {{--<a href="{{url('/configs')}}"><i class="fa fa-gear fa-fw"></i> Config/Defaults</a>--}}
                {{--</li>--}}
                {{--<li>--}}
                    {{--<a href="{{url('/merchants')}}"><i class="fa fa-users fa-fw"></i> Merchants</a>--}}
                {{--</li>--}}
                {{--<li>--}}
                    {{--<a href="{{url('/configurator')}}"><i class="fa fa-gear fa-fw"></i> Configurator</a>--}}
                {{--</li>--}}
            {{--</ul>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</nav>--}}

<div class="panel panel-default panel-flush">
    <div class="panel-heading">
        Settings
    </div>
    <div class="panel-body">
        <div class="spark-settings-tabs">
            <ul class="nav spark-settings-stacked-tabs" role="tablist">
                <!-- Profile Link -->
                <li @if(request()->is('settings')) class="active" @endif role="presentation">
                    <a href="{{ url('/settings') }}" aria-controls="profile">
                        <i class="fa fa-fw fa-btn fa-user"></i>Profile
                    </a>
                </li>

                <!-- Deliveries Link -->
                <li @if(request()->is('deliveries')) class="active" @endif role="presentation">
                    <a href="{{ url('/deliveries') }}" aria-controls="deliveries">
                        <i class="fa fa-fw fa-btn fa-truck"></i>Deliveries
                    </a>
                </li>

                {{--<!-- Configs Link -->--}}
                {{--<li @if(request()->is('config-default')) class="active" @endif role="presentation">--}}
                    {{--<a href="{{ route('admin.config-default.index') }}" aria-controls="configs">--}}
                        {{--<i class="fa fa-fw fa-btn fa-gear"></i>Config/Defaults--}}
                    {{--</a>--}}
                {{--</li>--}}

                {{--<!-- Merchants Link -->--}}
                {{--<li @if(request()->is('merchants')) class="active" @endif role="presentation">--}}
                    {{--<a href="{{ route('admin.merchants') }}" aria-controls="merchants">--}}
                        {{--<i class="fa fa-fw fa-btn fa-users"></i>Merchants--}}
                    {{--</a>--}}
                {{--</li>--}}

                <!-- Configurator Link -->
                <li @if(request()->is('configurator')) class="active" @endif role="presentation">
                    <a href="{{ url('/configurator') }}" aria-controls="configurator">
                        <i class="fa fa-fw fa-btn fa-gear"></i>Configurator
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>