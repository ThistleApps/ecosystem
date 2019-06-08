@extends('spark::layouts.app')

@section('title',  'Edit Merchant' )

@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- Tabs -->
        @include('vendor.spark.kiosk-partials.left-options-links')

        <!-- Tab Panels -->
            <div class="col-md-8">

                <div class="panel panel-default">
                    <div class="panel-heading text-center"><span class="fa fa-users"></span> Edit Merchant</div>
                    <div class="panel-body">
                        <div class="row">

                            <div class="col-sm-8 col-md-offset-2">
                                <form method="post" action="{{route('admin.merchants.update' , $merchant->id)}}" class="form-horizontal" id="merchant-update-form">
                                    {{csrf_field()}}
                                    <input type="hidden" name="_method" value="put">
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <div class="form-group">
                                        <label class="control-label col-sm-4" for="first_name">First Name</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="first_name" name="first_name" value="{{$merchant->first_name}}" placeholder="Jane">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-4" for="last_name">Last Name</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="last_name" name="last_name" value="{{$merchant->last_name}}" placeholder="Doe">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-sm-4" for="username">Username</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="username" name="email" value="{{$merchant->email}}" placeholder="Username">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-sm-4" for="password">Password</label>
                                        <div class="col-sm-8">
                                            <input type="password" class="form-control" id="password" value="" name="password"
                                                   placeholder="Password">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-sm-4" for="business_name">Business Name</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="business_name" name="business_name" value="{{$merchant->business_name}}"
                                                   placeholder="Business Name">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-sm-4" for="primary_affiliate">Primary Affiliate</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="primary_affiliate" value="{{$merchant->primary_affiliate}}" name="primary_affiliate"
                                                   placeholder="Primary Affiliate">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-sm-4" for="affiliate_number">Primary Affiliate Number</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="affiliate_number" value="{{$merchant->primary_affiliate_number}}" name="primary_affiliate_number"
                                                   placeholder="Affiliate No.">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-sm-4" for="pos_type">POS Type</label>
                                        <div class="col-sm-8">
                                            <select name="pos_type" class="form-control">
                                                @foreach($pos_types as $pos_type)
                                                    <option {{$merchant->pos_type == $pos_type->id ?"selected":''}} value="{{$pos_type->id}}">{{$pos_type->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-sm-4" for="pos_wan_address">POS WAN Address</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="pos_wan_address" value="{{$merchant->pos_wan_address}}" name="pos_wan_address"
                                                   placeholder="10.0.0.10">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-sm-4" for="pos_mysql_un">POS MySQL UN</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="pos_mysql_un" value="{{$merchant->pos_mysql_un}}" name="pos_mysql_un"
                                                   placeholder="Default Value">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-sm-4" for="pos_mysql_pw">POS MySQL Password</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="pos_mysql_pw" value="{{$merchant->pos_mysql_pw}}" name="pos_mysql_pw"
                                                   placeholder="Default Value">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-sm-4" for="pos_mysql_un">POS MySQL DB Name</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="db_name" value="{{$merchant->db_name}}" name="db_name">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-offset-4 col-sm-8">
                                            <button class="btn btn-default" type="button" id="mr-test-connection"><span class="fa fa-spinner hide" id=""></span> Test Connection</button>
                                            <button class="btn btn-default" type="submit">Update Merchant</button>
                                            <a class="btn btn-default" id="reset-pass" href="javascript:void(0)" data-url="{{route('admin.merchants.password-reset' , ['email' => $merchant->email])}}"><span class="fa fa-spinner hide"></span>Send Reset Password Email</a>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-offset-4 col-sm-8">
                                            <div class="text-center"><strong>Last Updated {{\Carbon\Carbon::parse($merchant->updated_at)->format('m/d/y')}}</strong></div>
                                        </div>
                                    </div>

                                </form>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
@section('script')
    <script>
        $(function() {
            $('#mr-test-connection').on('click' , function () {
                var connection_btn = $(this);
                connection_btn.children('span').removeClass('hide');
                connection_btn.children('span').addClass('fa-spin');
                connection_btn.attr('disabled' , 'disabled');

                var van = $('#pos_wan_address');
                ip = van.val();
                db_name = $('#db_name').val();
                pos_mysql_un = $('#pos_mysql_un').val();
                pos_mysql_pw = $('#pos_mysql_pw').val();
                data = {'pos_wan_address' : ip , 'pos_mysql_un': pos_mysql_un , 'pos_mysql_pw':pos_mysql_pw , 'db_name':db_name};

                $.ajax({
                    url: "{!! route('admin.merchants.test-connection') !!}",
                    data: data,
                    headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' },
                    error: function() {

                    },
                    success: function(data) {

                        connection_btn.children('span').addClass('hide');

                        if (data.alert_type)
                            toastr["success"](data.message);
                        else
                            toastr["error"](data.message);

                        connection_btn.removeAttr('disabled');
                    },
                    type: 'POST'
                });

            });

            $('#reset-pass').on('click' , function (e) {

                var reset_email_btn = $(this);

                reset_email_btn.children('span').removeClass('hide');
                reset_email_btn.children('span').addClass('fa-spin');

                merchant_email = "{{$merchant->email}}";
                var action = $(this).attr('data-url');
                $.ajax({
                    url: action,
                    data: {'email': merchant_email},
                    success: function(data) {
                        reset_email_btn.children('span').addClass('hide');
                        reset_email_btn.children('span').removeClass('fa-spin');
                        if (data.alert_type == 'success')
                            toastr.success(data.message , 'Message');
                        else
                            toastr.error(data.message , 'Message');

                    },
                    type: 'get'
                });
            })
        });

    </script>

@endsection()