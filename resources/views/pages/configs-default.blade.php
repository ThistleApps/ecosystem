@extends('layouts.default')
@section('title',  'Configs/Defaults' )

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header text-center"><span class="fa fa-cog"></span> Configs/Defaults</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">

        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Configs/Defaults
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">

                    <table width="100%" class="table table-striped table-responsive table-bordered table-hover" id="dataTables-example">
                        <thead>
                        <tr>
                            <th>Settings Type</th>
                            <th>Scope</th>
                            <th>Value</th>

                        </tr>
                        </thead>
                        <tbody>
                            <tr class="odd gradeX">
                                <td>Default MySQL UN</td>
                                <td>Merchant DB</td>
                                <td>value</td>
                            </tr>
                            <tr class="odd gradeX">
                                <td>Default MySQL PW</td>
                                <td>Merchant DB</td>
                                <td>value</td>
                            </tr>
                            <tr class="odd gradeX">
                                <td>Stripe Test</td>
                                <td>Test api key</td>
                                <td>value</td>
                            </tr>
                            <tr class="odd gradeX">
                                <td>Stripe Live</td>
                                <td>Live api key</td>
                                <td>value</td>
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