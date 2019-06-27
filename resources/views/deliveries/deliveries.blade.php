@extends('layouts.default')
@section('title',  'Deliveries' )
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('/vendor/datatables/css/dataTables.bootstrap.css') }}"
          xmlns:margin-bottom="http://www.w3.org/1999/xhtml"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('/vendor/bootstrap-daterangepicker-master/daterangepicker.css') }}" />

    <style>
        .background-col {
            background-color: #f9c3d073!important;
        }
    </style>
@endsection

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading text-center">
            <span class="fa fa-truck"></span> Deliveries
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Order Status <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{route('deliveries.fetch-new-orders')}}">Get Orders Now</a></li>
                            <li><a href="#">Another action</a></li>
                            <li><a href="#">Something else here</a></li>
                            <li role="separator" class="divider"></li>
                            <li class="dropdown-header">Nav header</li>
                            <li><a href="#">Separated link</a></li>
                            <li><a href="#">One more separated link</a></li>
                        </ul>
                    </li>
                </ul>
            </div><!--/.nav-collapse -->
        </div>

        <div class="panel-body">
            <div class="col-lg-12">
                <div class="row m-b-sm">
                    <div><label>Filter By:</label></div>

                    <div class="form-inline">
                        <form class="form-inline" action="/" method="get" id="order-header-form">

                            <div class="col-sm-2 col-md-2 m-b-sm">

                                        <select id="status" class="input-sm form-control" name="status">
                                            <option value="">Status</option>
                                            <option value="active">Active</option>
                                            <option value="successful">Successful</option>
                                            <option value="canceled">Canceled</option>
                                        </select>
                            </div>

                            <div class="col-sm-3 col-md-3 m-b-sm">
                                    <div class="col-sm">
                                        <input class="input-sm" type="text" placeholder="Store/Location ID" id="store_number" name="store_number" value="">
                                </div>
                            </div>

                            <div class="col-sm-2 col-md-2 pull-left m-b-sm">
                                    <select id="status" class="input-sm form-control" name="filter_on">
                                        <option value="order_date">Delivery Date</option>
                                        <option value="creation_date">Created Date</option>
                                    </select>
                            </div>

                            <div class="col-sm-2 col-md-2 pull-left m-b-sm">
                                    <div class="input-group input-group-sm">
                                                <span class="input-group-addon">
                                                    <span class="fa fa-calendar"></span>
                                                </span>
                                        <input type="text" placeholder="Date Range" id="date_range" class="input-sm form-control" name="date_range">
                                    </div>
                            </div>

                            <div class="col-sm-1 col-md-1 pull-left m-b-sm">
                                    <button type="button" id="filters-btn" class="btn btn-success btn-sm form-inline">filter</button>
                            </div>

                            <div class="col-sm-1 col-md-1 pull-left m-b-sm">
                                <button type="reset" id="clear-filters-btn" class="btn btn-info btn-sm form-inline">Clear</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row m-b-sm">

                    <div class="table-responsive">
                        <table width="100%" class="table table-striped table-bordered nowrap" id="table">
                            <thead>
                                <tr>
                                    <th>Action</th>
                                    <th>Store</th>
                                    <th>Order No</th>
                                    {{--<th>Trans Ty</th>--}}
                                    <th>Cust No</th>
                                    <th>Delivery Due</th>
                                    <th>Created</th>
                                    <th>Status</th>
                                    <th>Ship To</th>
                                    <th>Address 1</th>
                                    <th>Address 2</th>
                                    <th>Address 3</th>
                                    <th>Email</th>

                                </tr>
                            </thead>
                            <tbody class="fbody">
                                <tfoot>

                                </tfoot>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->


    <div class="modal fade" id="OD-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button " class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                    <h4 class="modal-title">
                        Order Details
                    </h4>
                </div>
                <div class="modal-body" id="OD-modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="OD-reset-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button " class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                    <h4 class="modal-title">
                        Reset Order Header
                    </h4>
                </div>
                <div class="modal-body" id="OD-reset-modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" id="reset-order-proceed" class="btn btn-danger" data-dismiss="modal">Proceed</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    {{--@include('deliveries.partials.order-details-modal')--}}
@endsection
{{-- page level scripts --}}
@section('script')
    {{--<script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.js" ></script>--}}
    <script type="text/javascript" src="{{ asset('/vendor/datatables/js/jquery.dataTables.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('/vendor/datatables/js/dataTables.bootstrap.js') }}" ></script>
    <script src="{{ asset('/vendor/bootstrap-daterangepicker-master/daterangepicker.js') }}" ></script>
    <script src="{{ asset('/vendor/bootstrap-daterangepicker-master/moment.js') }}" ></script>

    <script>
        $(function() {


            $('#date_range').daterangepicker({
                autoUpdateInput: false,
                locale: {
                    cancelLabel: 'Clear'
                }
            });

            $('#reset-order-proceed').on('click', function () {
                window.location.href = '{{route('deliveries.index')}}/'+$('#reset_od_id').val()+'/getswift-reset';
            });

            $(document).on('click', '.od-reset-btn' , function () {
                console.log('hello');
                var order_id = $(this).attr('data-id');
                $('#OD-reset-modal').modal().show();
                $('#OD-reset-modal-body').html('Are you sure to reset this '+order_id+' Getswfit order Status?');
                $('#OD-reset-modal-body').append("<input type='hidden' id='reset_od_id' name='reset_od_id' value='"+order_id+"'>")
            });

            $('#date_range').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
            });

            $('#date_range').on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
            });


            var table = $('#table').DataTable({
                details: {
                    type: 'column'
                },

                processing: true,
                serverSide: true,
                iDisplayLength: 11,
                "order": [[ 0, "desc" ]],
                ajax: '{!! route('deliveries.datatable') !!}',
                columns: [
                    { data: 'action', name: 'action'},
                    { data: 'store_number', name: 'store_number' },
                    { data: 'order_number', name: 'order_number' },
                    { data: 'customer_number', name: 'customer_number' },
                    { data: 'delivery_date', name: 'delivery_date'},
                    { data: 'creation_date', name: 'creation_date'},
                    { data: 'getswift_status', name: 'getswift_status' },
                    { data: 'ship_to_name', name:'ship_to_name'},
                    { data: 'ship_to_addr_1', name:'ship_to_addr_1'},
                    { data: 'ship_to_addr_2', name:'ship_to_addr_2'},
                    { data: 'ship_to_addr_3', name:'ship_to_addr_3'},
                    { data: 'ship_to_email_address', name: 'ship_to_email_address'}

                ]
            });

            $('#filters-btn').on('click' , function () {
                filt_val = $('#order-header-form').serialize();
                url = "{{url('deliveries/datatable')}}"+"?"+filt_val;
                table.ajax.url(url).load();
            });



            $('#table tbody').on('dblclick', 'td', function (t) {
                var data = table.row( this ).data();
                var order_number = data['order_number'];
                var url = "{{url('deliveries/order-details/')}}/"+order_number;
                $.ajax({
                    url: url,
                    data: {'order_number': order_number},
                    error: function() {

                    },
                    success: function(data) {
                        var data = { target:data };
//                        console.log(data);
                        var template = _.template( $("#order-detail-temp").text() );
                        $("#OD-modal-body").html( template(data) );
                        $("#OD-modal").modal('show');

                    },
                    type: 'GET'
                });
            } );


        });

    </script>

    <script type="text/template" id="order-detail-temp">
        <div class="well">
            <table class="table">
                <thead>
                <tr>
                    <th>SKU</th>
                    <th>Description</th>
                    <th>Qty</th>
                    <th>Price</th>
                </tr>
                </thead>
                <tbody>
                <% _.each( target, function(i) {%>
                <tr>
                    <td><%= i.sku_number %></td>
                        <td><%= i.description %></td>
                        <td><%= i.qty_selling_units %></td>
                        <td>$<%= Math.round(i.cust_price * 100) / 100 %></td>
                    </tr>
                <% }); %>
                </tbody>
            </table>
        </div>
    </script>

@endsection()
