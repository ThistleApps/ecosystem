@extends('layouts.default')
@section('title',  'Profile' )

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header text-center"><span class="fa fa-user"></span> Profile</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">

        <div class="col-sm-8 col-md-offset-2">

            <form action="#" class="form-horizontal">
                <div class="form-group">
                    <label class="control-label col-sm-4" for="first_name">First Name</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Jane">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-4" for="last_name">Last Name</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Doe">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-4" for="username">Username</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="username" name="username" placeholder="Username">
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
                        <input type="text" class="form-control" id="business_name" name="business_name" placeholder="Business Name">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-4" for="primary_affiliate">Primary Affiliate</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="primary_affiliate" name="primary_affiliate" placeholder="Primary Affiliate">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-4" for="affiliate_number">Primary Affiliate Number</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="affiliate_number" name="affiliate_number" placeholder="Affiliate No.">
                    </div>
                </div>


                <div class="form-group">
                    <label class="control-label col-sm-4" for="pos_type">POS Type</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="pos_type" name="pos_type" placeholder="POS">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-4" for="pos_wan_address">POS WAN Address</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="pos_wan_address" name="pos_wan_address" placeholder="10.0.0.10">
                    </div>
                    <div class="col-sm-2">
                        <button type="submit" class="btn btn-default">Test Connection</button>
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
                    <label class="control-label col-sm-4" for="plan">Plan</label>
                    <div class="col-sm-4">
                        <select id="plan" class="form-control" name="plan">
                            <option value="basic_free">Basic Free</option>
                            <option value="intermediate">Intermediate ($49)</option>
                            <option value="advanced">Advanced ($99)</option>
                        </select>
                    </div>

                    <div class="col-sm-4">
                        <div class="input-group">
                            <input type="text" class="form-control" id="pay_info" name="pay_info" placeholder="Pay Info">
                            <span class="input-group-addon"><i class="fa fa-credit-card-alt"></i></span>
                        </div>
                    </div>
                </div>

            </form>
        </div>

    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $('[data-toggle="popover"]').popover();
        });
    </script>
@endsection