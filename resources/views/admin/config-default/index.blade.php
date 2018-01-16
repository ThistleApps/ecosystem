@extends('layouts.default')
@section('title',  'Configs/Defaults' )

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading text-center"><span class="fa fa-cog"></span> Configs/Defaults</div>
        <div class="panel-body">
            <div class="row">

                <div class="col-lg-12">
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
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
        </div>
    </div>
@endsection