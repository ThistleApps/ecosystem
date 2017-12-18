@extends('layouts.default')
@section('title',  'Create Account' )

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header text-center"><span class="fa fa-plug"></span> Create Account</h1>
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
                    <label class="control-label col-sm-4" for="primary_affiliate">Primary Supplier/CoOp/Brand Affiliate</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="primary_affiliate" name="primary_affiliate" placeholder="Primary Affiliate">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-4" for="affiliate_number">Affiliate Number</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="affiliate_number" name="affiliate_number" placeholder="Affiliate No.">
                    </div>
                </div>


                <div class="form-group">
                    <label class="control-label col-sm-4" for="pos_type">Target Platform/POS</label>
                    <div class="col-sm-8">
                        <select id="pos_type" class="form-control" name="pos_type">
                            <option value="">Custom/Other</option>
                            @foreach($pos_types  as $id => $pos_type_name)
                                <option value="{{$id}}">{{$pos_type_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-4 col-sm-8">
                        <button type="submit" class="btn btn-default">Create Account</button>
                    </div>
                </div>
            </form>
        </div>

    </div>
@endsection