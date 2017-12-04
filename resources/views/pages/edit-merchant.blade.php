@extends('layouts.default')
@section('title',  'Edit Merchant' )

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header text-center"><span class="fa fa-users "></span> Edit Merchant</h1>
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
                        <input type="password" class="form-control" id="password" name="password"
                               placeholder="Password">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-4" for="business_name">Business Name</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="business_name" name="business_name"
                               placeholder="Business Name">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-4" for="primary_affiliate">Primary Affiliate</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="primary_affiliate" name="primary_affiliate"
                               placeholder="Primary Affiliate">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-4" for="affiliate_number">Primary Affiliate Number</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="affiliate_number" name="affiliate_number"
                               placeholder="Affiliate No.">
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
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="pos_wan_address" name="pos_wan_address"
                               placeholder="10.0.0.10">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-4" for="pos_mysql_un">POS MySQL UN</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="pos_mysql_un" name="pos_mysql_un"
                               placeholder="Default Value">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-4" for="pos_mysql_pw">POS MySQL Password</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="pos_mysql_pw" name="pos_mysql_pw"
                               placeholder="Default Value">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-4 col-sm-8">
                        <button class="btn btn-default" type="button">Test Connection</button>
                        <button class="btn btn-default" type="button">Update Merchant</button>
                        <button class="btn btn-default" type="button">Reset Merch Password</button>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-4 col-sm-8">
                        <div class="text-center"><strong>Last Updated 7/25/17</strong></div>
                    </div>
                </div>

            </form>
        </div>

    </div>
@endsection