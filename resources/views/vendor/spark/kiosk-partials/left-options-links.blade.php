<div class="col-md-4">
    <div class="panel panel-default panel-flush">
        <div class="panel-heading">
            Kiosk
        </div>

        <div class="panel-body">
            <div class="spark-settings-tabs">
                <ul class="nav spark-settings-stacked-tabs" role="tablist">
                    <!-- Announcements Link -->
                    <li role="presentation" >
                        <a href="/spark/kiosk/#/announcements">
                            <i class="fa fa-fw fa-btn fa-bullhorn"></i>Announcements
                        </a>
                    </li>

                    <!-- Metrics Link -->
                    <li role="presentation">
                        <a href="/spark/kiosk/#/metrics">
                            <i class="fa fa-fw fa-btn fa-bar-chart"></i>Metrics
                        </a>
                    </li>

                    <!-- Users Link -->
                    <li role="presentation">
                        <a href="/spark/kiosk/#/users">
                            <i class="fa fa-fw fa-btn fa-user"></i>Users
                        </a>
                    </li>

                </ul>
            </div>
        </div>
    </div>

    <div class="panel panel-default panel-flush">
        <div class="panel-heading">
            Configurations
        </div>

        <div class="panel-body">
            <div class="spark-settings-tabs">
                <ul class="nav spark-settings-stacked-tabs" role="tablist">

                    <!-- Default Configurations Link -->
                    <li @if(request()->is('spark/kiosk/config-default')) class="active" @endif role="presentation">
                        <a href="/spark/kiosk/config-default" >
                            <i class="fa fa-fw fa-btn fa-credit-card"></i>Default Configurations
                        </a>
                    </li>

                    <!-- Merchants Link -->
                    <li @if(request()->is('spark/kiosk/merchants')) class="active" @endif role="presentation">
                        <a href="/spark/kiosk/merchants">
                            <i class="fa fa-fw fa-btn fa-credit-card"></i>Merchants
                        </a>
                    </li>

                </ul>
            </div>
        </div>
    </div>

</div>