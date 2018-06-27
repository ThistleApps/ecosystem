@extends('layouts.default')
@section('title',  'Deliveries' )
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('/vendor/datatables/css/dataTables.bootstrap.css') }}" />
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
            <a href="{{route('deliveries.fetch-new-orders')}}" class="btn btn-primary pull-right">Fetch Orders Now</a>
        </div>

        <div class="panel-body">

            <div class="table-responsive">
                <div class="" style="margin-bottom: 5%">
                    <div class="form-inline">
                        <form class="form-inline" action="/" method="get" id="order-header-form">
                            <div class="col-md-3 col-lg-3 col-sm-12">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label" for="status">Status:</label>
                                    <div class="col-sm-8">
                                        <select id="status" class="input-sm form-control" name="status">
                                            <option value="">Status</option>
                                            <option value="active">Active</option>
                                            <option value="successful">Successful</option>
                                            <option value="canceled">Canceled</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-9 col-md-9 pull-right">
                            <div class="col-md-3 col-lg-3 col-sm-12">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label" for="status">Filter On:</label>
                                    <div class="col-sm-5">
                                        <select id="status" class="input-sm form-control" name="filter_on">
                                            <option value="order_date">Order Date</option>
                                            <option value="order_due_date">Order Due Date</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-6 col-sm-12">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label" for="start_date">Date Range:</label>
                                    <div class="col-sm-8">
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-addon">
                                                <span class="fa fa-calendar"></span>
                                            </span>
                                            <input type="text" id="date_range" class="input-sm form-control" name="date_range">
                                        </div>
                                    </div>
                                </div>
                            </div>

                                {{--<div class="col-md-6 col-lg-3 col-sm-12">--}}
                                    {{--<div class="form-group row">--}}
                                        {{--<label class="col-sm-1 col-form-label" for="end_date">To:</label>--}}
                                        {{--<div class="col-sm-9">--}}
                                            {{--<div class="input-group input-group-sm">--}}
                                                {{--<span class="input-group-addon">--}}
                                                    {{--<span class="fa fa-calendar"></span>--}}
                                                {{--</span>--}}
                                                {{--<input type="date" id="end_date" class="input-sm form-control" name="end_date">--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            <div class="col-md-3 col-lg-3 col-sm-12 ">
                                <div class="form-group row">
                                    <button type="button" id="filters-btn" class="btn btn-sm form-inline">filter</button>
                                </div>
                            </div>

                                {{--<div class="col-md-3 col-lg-3 col-sm-12 ">--}}

                                {{--</div>--}}

                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table width="100%" class="table table-striped table-bordered nowrap" id="table">
                    <thead>
                    <tr>
                        <th>Order No</th>
                        {{--<th>Trans Ty</th>--}}
                        <th>Cust No</th>
                        <th>Order Date</th>
                        <th>Due Date</th>
                        <th>Status</th>
                        <th>Ship To</th>
                        <th>Address 1</th>
                        <th>Address 2</th>
                        <th>Address 3</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody class="fbody">

                    </tbody>
                </table>
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
                        Order Header
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
                columnDefs: [ {
                    className: 'control',
                    orderable: false,
                    targets:   0
                } ],
                processing: true,
                serverSide: true,
                iDisplayLength: 10,
                "order": [[ 0, "desc" ]],
                ajax: '{!! route('deliveries.datatable') !!}',
                columns: [
                    { data: 'order_number', name: 'order_number' },
                    { data: 'customer_number', name: 'customer_number' },
                    { data: 'delivery_date', name: 'delivery_date'},
                    { data: 'expiration_date', name: 'expiration_date'},
                    { data: 'getswift_status', name: 'getswift_status' },
                    { data: 'ship_to_name', name:'ship_to_name'},
                    { data: 'ship_to_addr_1', name:'ship_to_addr_1'},
                    { data: 'ship_to_addr_2', name:'ship_to_addr_2'},
                    { data: 'ship_to_addr_3', name:'ship_to_addr_3'},
                    { data: 'ship_to_email_address', name: 'ship_to_email_address'},
                    { data: 'action', name: 'action'}
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
