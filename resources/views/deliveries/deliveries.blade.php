@extends('layouts.default')
@section('title',  'Deliveries' )
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('/vendor/datatables/css/dataTables.bootstrap.css') }}" />
{{--    <link href="{{ asset('assets/css/pages/tables.css') }}" rel="stylesheet" type="text/css" />--}}
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header text-center"><span class="fa fa-truck"></span> Deliveries</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">

    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                deliveries
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">

                <div class="row">
                    <div class="" style="margin-bottom: 50px">
                        <div class="form-inline">
                            <div class="col-lg-2 col-sm-12">
                                <div class="form-group">
                                    <select class="form-control" name="status">
                                        <option value="">status</option>
                                        <option value="active">Active</option>
                                        <option value="successful">Successful</option>
                                        <option value="canceled">Canceled</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-3 col-sm-12">
                                <div class="form-group">
                                    <label for="start_date">Order Due From</label>
                                    <input type="date" id="start_date" class="form-control" name="start_date">
                                    <span class="fa fa-calendar fa-2x"></span>
                                </div>
                            </div>

                            <div class="col-lg-3 col-sm-12">
                                <div class="form-group">
                                    <label for="end_date">Order Due To</label>
                                    <input type="date" id="end_date" class="form-control" name="end_date">
                                    <span class="fa fa-calendar fa-2x"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                <table width="100%" class="table table-striped table-responsive table-bordered table-hover" id="table">
                    <thead>
                    <tr>
                        <th>Order Number</th>
                        {{--<th>Trans Ty</th>--}}
                        <th>Cust Number</th>
                        <th>Order Date</th>
                        <th>Order Due Date</th>
                        <th>Ship To</th>
                        <th>Address 1</th>
                        <th>Address 2</th>
                        <th>Address 3</th>
                        <th>Email</th>
                        {{--<th>Status</th>--}}
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
                <!-- /.table-responsive -->
                {{--<div class="well">--}}
                {{--</div>--}}
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>
@endsection
{{-- page level scripts --}}
@section('script')
    <script type="text/javascript" src="{{ asset('/vendor/datatables/js/jquery.dataTables.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('/vendor/datatables/js/dataTables.bootstrap.js') }}" ></script>


    <script>
        $(function() {
            var table = $('#table').DataTable({
                processing: true,
                serverSide: true,
                iDisplayLength: 100,
                "order": [[ 0, "desc" ]],
                ajax: '{!! route('deliveries.datatable') !!}',
                columns: [
                    { data: 'order_number', name: 'order_number' },
//                    { data: 'customer_number', name: 'customer_number' },
                    { data: 'customer_number', name: 'customer_number' },
                    { data: 'creation_date', name: 'creation_date'},
                    { data: 'expiration_date', name: 'expiration_date'},
                    { data: 'ship_to_name', name:'ship_to_name'},
                    { data: 'ship_to_addr_1', name:'ship_to_addr_1'},
                    { data: 'ship_to_addr_2', name:'ship_to_addr_2'},
                    { data: 'ship_to_addr_3', name:'ship_to_addr_3'},
                    { data: 'ship_to_email_address', name: 'ship_to_email_address'}
                ]
            });
        });

    </script>
@endsection()
