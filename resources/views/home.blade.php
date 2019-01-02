@extends('layouts.default')
@section('title',  'Home' )

@section('content')



<div class="row">
    <div class="col-lg-12">
    <div class="panel panel-default panel-flush">
        <div class="panel-heading">
            Dashboard
        </div>
    </div>
    </div>
    <!-- /.col-lg-12 -->
</div>

<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-shopping-cart fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">{{$ordercount}}</div>
                        <div><a href="/deliveries">Active Orders</a> </div>
                    </div>
                </div>
            </div>
            <a href="/deliveries">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-truck fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">{{$deliveriesToday}} Deliveries Today</div>

                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">{{$deliveryOrders}} next 5 days</div>

                    </div>
                </div>
            </div>
            <a href="/deliveries">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>

    <div class="col-lg-9 col-md-6" id="app">
        {!! $chart->container() !!}
        <br>
    </div>

</div>

<!-- /.row -->
<div class="row">

    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-support fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">{{$ticketcount}}</div>
                        <div><a href="/tickets">Support Tickets</a> </div>
                    </div>
                </div>
            </div>
            <a href="/tickets">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-9 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <a class="twitter-timeline" data-theme="light" href="https://twitter.com/spyglassretail">Spyglass Retail Tweets</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>

                </div>
            </div>
            <a href="https://twitter.com/spyglassretail">
                <div class="panel-footer">
                    <span class="pull-left">See more on Twitter</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>


</div>
@endsection

<script src="https://cdnjs.cloudflare.com/ajax/libs/highcharts/6.0.6/highcharts.js" charset="utf-8"></script>
{!! $chart->script() !!}
