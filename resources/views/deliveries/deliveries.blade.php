@extends('layouts.default')
@section('title',  'Deliveries' )
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('/vendor/datatables/css/dataTables.bootstrap.css') }}" />
{{--    <link href="{{ asset('assets/css/pages/tables.css') }}" rel="stylesheet" type="text/css" />--}}
@endsection

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading text-center"><span class="fa fa-truck"></span> Deliveries</div>

        <div class="panel-body">

            <div class="row">
                <div class="" style="margin-bottom: 50px">
                    <div class="form-inline">
                        <div class="col-md-4 col-sm-12">
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

                        <div class="col-md-4 col-sm-12">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="start_date">From:</label>
                                <div class="col-sm-8">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-addon">
                                            <span class="fa fa-calendar"></span>
                                        </span>
                                        <input type="date" id="start_date" class="input-sm form-control" name="start_date">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-12">
                            <div class="form-group row">
                                <label class="col-sm-1 col-form-label" for="end_date">To:</label>
                                <div class="col-sm-8">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-addon">
                                            <span class="fa fa-calendar"></span>
                                        </span>
                                        <input type="date" id="end_date" class="input-sm form-control" name="end_date">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table width="100%" class="table table-striped" id="table">
                    <thead>
                    <tr>
                        <th>Order Number</th>
                        {{--<th>Trans Ty</th>--}}
                        <th>Cust Number</th>
                        <th>Order Date</th>
                        <th>Order Due Date</th>
                        <th>Ship To</th>
                        <th>Address 1</th>
                        {{--<th>Address 2</th>--}}
                        {{--<th>Address 3</th>--}}
                        <th>Email</th>
                        {{--<th>Status</th>--}}
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>

        </div>
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
//                    { data: 'ship_to_addr_2', name:'ship_to_addr_2'},
//                    { data: 'ship_to_addr_3', name:'ship_to_addr_3'},
                    { data: 'ship_to_email_address', name: 'ship_to_email_address'}
                ]
            });
        });

    </script>
@endsection()
