@extends('layouts.default')
@section('title',  'Deliveries' )

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

                <table width="100%" class="table table-striped table-responsive table-bordered table-hover" id="dataTables-example">
                    <thead>
                    <tr>
                        <th>Order Number</th>
                        <th>Trans Ty</th>
                        <th>Cust Number</th>
                        <th>Order Date</th>
                        <th>Order Due Date</th>
                        <th>Ship To</th>
                        <th>Address 1</th>
                        <th>Address 2</th>
                        <th>Address 3</th>
                        <th>Email</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="odd gradeX">
                        <td>78787</td>
                        <td>O</td>
                        <td>000150</td>
                        <td>2015-07-1</td>
                        <td>2015-07-25</td>
                        <td>ABC compus</td>
                        <td>1234 test Street</td>
                        <td>address</td>
                        <td>SomeCity</td>
                        <td>test@test.com</td>
                        <td>Active</td>
                    </tr>
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