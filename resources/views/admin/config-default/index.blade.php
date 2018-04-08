@extends('spark::layouts.app')

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mousetrap/1.4.6/mousetrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
@endsection

@section('content')
        <div class="container-fluid">
            <div class="row">
                <!-- Tabs -->
            @include('vendor.spark.kiosk-partials.left-options-links')

            <!-- Tab Panels -->
                <div class="col-md-8">
                    <div class="panel panel-default">
                        <div class="panel-heading text-center"><span class="fa fa-cog"></span> Configs/Defaults</div>
                        <div class="panel-body">
                            <div class="row">

                                <div class="col-lg-12">
                                    <table width="100%" class="table table-striped table-bordered nowrap" id="table">
                                        <thead>
                                        <tr>
                                            <th>Settings Type</th>
                                            <th>Scope</th>
                                            <th>Value</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                    <!-- /.panel -->
                                </div>
                                <!-- /.col-lg-12 -->
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="edit-settings-modal" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                                    <h4 class="modal-title">
                                        Edit Default Config
                                    </h4>
                                </div>
                                <div class="modal-body" id="def-conf-modal-body">

                                </div>
                                <div class="modal-footer">
                                    <button type="submit" form="def-conf-form" class="btn btn-success">Update</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
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
                ajax: '{!! route('admin.config-default.datatable-data') !!}',
                columns: [
                    { data: 'key', name: 'key' },
                    { data: 'scope', name: 'scope' },
                    { data: 'value', name: 'value'},
                    { data: 'action', name: 'action'}
                ]
            });
        });

        $(document).on('click' , '.setting-editor' , function () {
            setting_id = $(this).attr('data-val');
            console.log(setting_id);
            url = "{{url('spark/kiosk/config-default/get/')}}"+"/"+setting_id;
            $.ajax({
                url: url,
                error: function() {
                },
                success: function(data) {
                    var data = { target:data };
//                        console.log(data);
                    var template = _.template( $("#order-detail-temp").text() );
                    $("#def-conf-modal-body").html( template(data) );
                    $("#edit-settings-modal").modal('show');

                },
                type: 'GET'
            });
        });

    </script>

    <script type="text/template" id="order-detail-temp">
        <form action="{{url('spark/kiosk/config-default/update')}}/<%= target.id %>" class="form-horizontal" id="def-conf-form" method="post">
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="_token" value="<%= $('meta[name="csrf-token"]').attr('content') %>">
            <div class="form-group">
                <label class="control-label col-sm-4" for="settings_type">Settings Type</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="settings_type" value="<%= target.key %>" readonly>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-4" for="scope">Scope</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="scope" value="<%= target.scope %>" readonly>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-4" for="settings-value">Value</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="settings-value" name="value" value="<%= target.value %>" autofocus>
                </div>
            </div>
        </form>
    </script>


@endsection()
