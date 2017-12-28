@extends('layouts.default')
@section('title',  'Profile' )

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading text-center"><span class="fa fa-user"></span> Profile</div>

        <div class="panel-body">
            <!-- Success Message -->
            {{--<div class="alert alert-success">--}}
                {{--Your contact information has been updated!--}}
            {{--</div>--}}

            <form action="{{route('user.profile.update')}}" method="post" class="form-horizontal">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <label class="control-label col-sm-4" for="first_name">First Name</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="first_name" name="first_name" value="{{$user->first_name}}" placeholder="Jane" autofocus>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-4" for="last_name">Last Name</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="last_name" name="last_name" value="{{$user->last_name}}" placeholder="Doe">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-4" for="username">Username</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="username" name="email" value="{{$user->email}}" placeholder="Username">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-4" for="password">Password</label>
                    <div class="col-sm-8">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-4" for="business_name">Business Name</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="business_name" name="business_name" value="{{$user->business_name}}" placeholder="Business Name">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-4" for="primary_affiliate">Primary Affiliate</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="primary_affiliate" name="primary_affiliate" value="{{$user->primary_affiliate}}" placeholder="Primary Affiliate">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-4" for="affiliate_number">Primary Affiliate Number</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="affiliate_number" name="primary_affiliate_number" value="{{$user->primary_affiliate_number}}" placeholder="Affiliate No.">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-4" for="pos_type">POS Type</label>
                    <div class="col-sm-8">
                        {{--<input type="text" class="form-control" id="pos_type" name="pos_type" value="{{$user->pos_type}}" placeholder="POS">--}}
                        <select id="pos_type" class="form-control" name="pos_type">
                            <option value="">Select Type</option>
                            @foreach($pos_types as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-4" for="pos_wan_address">POS WAN Address</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="pos_wan_address" name="pos_wan_address" value="{{$user->pos_wan_address}}" placeholder="10.0.0.10">
                    </div>
                    <div class="col-sm-2">
                        <button type="button" id="test_con" class="btn btn-default">Test Connection</button>
                    </div>
                    <div class="col-sm-1">
                        <a data-toggle="popover" data-trigger="hover" data-content="Getting test info.">
                            <i aria-hidden="true" class="fa fa-info-circle"></i>
                        </a>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-4 col-sm-8">
                        <button type="submit" class="btn btn-default">Update Profile</button>
                    </div>
                </div>


                <hr style="border: none; height: 1px; color: #333; background-color: #333;">
                <strong>$ Billing:</strong>
                <div class="form-group">
                    <label class="control-label col-sm-4" for="plan"> Select Plan</label>
                    <div class="col-sm-2">
                        <a href="{{url('/settings#/subscription')}}" type="button" class="btn btn-default">Click here</a>
                    </div>
                    {{--<div class="col-sm-4">--}}
                    {{--<select id="plan" class="form-control">--}}
                    {{--<option value="basic_free">Basic Free</option>--}}
                    {{--<option value="intermediate">Intermediate ($49)</option>--}}
                    {{--<option value="advanced">Advanced ($99)</option>--}}
                    {{--</select>--}}
                    {{--</div>--}}

                    {{--<div class="col-sm-4">--}}
                    {{--<div class="input-group">--}}
                    {{--<input type="text" class="form-control" id="pay_info" name="pay_info" placeholder="Pay Info">--}}
                    {{--<span class="input-group-addon"><i class="fa fa-credit-card-alt"></i></span>--}}
                    {{--</div>--}}
                    {{--</div>--}}
                </div>

            </form>
        </div>
    </div>

@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $('[data-toggle="popover"]').popover();

            toastr.options = {
                "closeButton": false,
                "debug": false,
                "newestOnTop": false,
                "progressBar": false,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            };


            $('#test_con').on('click' , function () {
                var van = $('#pos_wan_address');

                ip = van.val();
                if (ip === '')
                    van.focusin();
                else {
                    $.ajax({
                        url: "{{route('user.profile.test.connection')}}",
                        data: {'pos_wan_address' : ip},
                        headers: { 'X-XSRF-TOKEN' : '{{\Illuminate\Support\Facades\Crypt::encrypt(csrf_token())}}' },
                        error: function() {

                        },
                        success: function(data) {
                            $('#test_con').attr('disabled' , 'disabled');
                            if (data.alert_type)
                                toastr["success"](data.message);
                            else
                                toastr["error"](data.message);

                            $('#test_con').removeAttr('disabled');
                        },
                        type: 'POST'
                    });
                }
            })


        });


    </script>
@endsection