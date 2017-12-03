@extends('layouts.default')
@section('style')
    <style>
        label{
            display: inline-block;
            float: left;
            clear: left;
            width: 250px;
            text-align: right;
        }
        .form-control {
            display: inline-block;
            /*float: left;*/
            margin-left: 20px;
        }
    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header text-center"><span class="fa fa-users "></span> Edit Merchiant</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">

        <div class="col-sm-8 col-lg-offset-2 ">
            {{--<div class="col-lg-8">--}}
                <form action="#" class="form-group">
                    <div class="form-group form-inline ">
                        <label for="first_name">First Name</label>
                        <input type="text"  class="form-control" id="first_name" name="first_name" placeholder="Jone">
                    </div>

                    <div class="form-group form-inline">
                        <label for="last_name">Last Name</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" placeholder="doe">
                    </div>


                    <div class="form-group form-inline">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="JoneDoe">
                    </div>

                    <div class="form-group form-inline">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="JoneDoe">
                    </div>

                    <div class="form-group form-inline">
                        <label for="business_name">Business Name</label>
                        <input type="text" class="form-control" id="business_name" name="business_name" placeholder="">
                    </div>

                    <div class="form-group form-inline">
                        <label for="primary_affiliate">Primary Affiliate</label>
                        <input type="text" class="form-control" id="primary_affiliate" name="primary_affiliate" placeholder="">
                    </div>

                    <div class="form-group form-inline">
                        <label for="primary_affiliate_number">Primary Affiliate Number</label>
                        <input type="text" class="form-control" id="primary_affiliate_number" name="primary_affiliate_number" placeholder="">
                    </div>

                    <div class="form-group form-inline">
                        <label for="pos_type">POS Type</label>
                        <input type="text" class="form-control" id="pos_type" name="pos_type" placeholder="">
                    </div>

                    <div class="form-group form-inline">
                        <label for="pos_wan_address">POS WAN Address</label>
                        <input type="text" class="form-control" id="pos_wan_address" name="pos_wan_address" placeholder="10.0.0.10">
                    </div>

                    <div class="form-group form-inline">
                        <label for="pos_mysql_un">POS MySQL UN</label>
                        <input type="text" class="form-control" id="pos_mysql_un" name="pos_mysql_un" placeholder="Default Value">
                    </div>


                    <div class="form-group form-inline">
                        <label for="pos_mysql_pw">POS MySQL Password</label>
                        <input type="text" class="form-control" id="pos_mysql_pw" name="pos_mysql_pw" placeholder="Default Value">
                    </div>

                    <div class="form-group">
                        <button class="btn btn-default" type="button">Test Connection</button>
                        <button class="btn btn-default" type="button">Update Merchant</button>
                        <button class="btn btn-default" type="button">Reset Merch Password</button>

                    </div>

                    <div class="text-center"><strong>Last Updated 7/25/17</strong></div>

                </form>
            {{--</div>--}}

        </div>

    </div>
@endsection