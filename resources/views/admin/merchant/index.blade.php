@extends('layouts.default')
@section('title',  'Merchants' )

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading text-center"><span class="fa fa-users"></span> Merchants</div>
        <div class="panel-body">
            <div class="row">
                <div class="col-lg-12">
                    <table width="100%" class="table table-striped table-responsive table-bordered table-hover" id="table">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Active</th>
                            <th>Subscription Plan</th>
                            {{--<th>Affiliate</th>--}}
                            {{--<th>Affiliate#</th>--}}
                            <th>POS Type</th>
                            <th>action</th>

                        </tr>
                        </thead>
                        <tbody>
                        <tr class="odd gradeX">


                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    {{--<script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.js" ></script>--}}
    <script type="text/javascript" src="{{ asset('/vendor/datatables/js/jquery.dataTables.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('/vendor/datatables/js/dataTables.bootstrap.js') }}" ></script>
    <script>
        $(function() {



            var table = $('#table').DataTable({
                processing: true,
                serverSide: true,
                iDisplayLength: 100,
                ajax: '{!! route('admin.merchants.datatable') !!}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'email', name: 'email'},
                    { data: 'active', name: 'active'},
                    { data: 'subscription_plan', name: 'subscription_plan'},
//                    { data: 'affiliate', name: 'affiliate'},
//                    { data: 'affiliate_num', name: 'affiliate_num'},
                    { data: 'posType', name: 'posType'},
                    { data: 'action', name: 'action'}
                ]
            });

            console.log(table);
        });

    </script>

@endsection()