@extends('layouts.default')
@section('title',  'Merchants' )

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading text-center"><span class="fa fa-users"></span> Merchants</div>
        <div class="panel-body">
            <div class="row">
                <div class="col-lg-12">
                    <table width="100%" class="table table-striped table-responsive table-bordered table-hover" id="dataTables-example">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Active</th>
                            <th>Subscription Plan</th>
                            <th>Affiliate</th>
                            <th>Affiliate#</th>
                            <th>POS Type</th>
                            <th></th>

                        </tr>
                        </thead>
                        <tbody>
                        <tr class="odd gradeX">
                            <td>1</td>
                            <td>Jone joe</td>
                            <td>yes</td>
                            <td>Basic</td>
                            <td>supplier 1</td>
                            <td>99999</td>
                            <td>POS1</td>
                            <td><a href="{{url('/merchants/edit')}}"><span class="fa fa-pencil-square-o"></span></a></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection