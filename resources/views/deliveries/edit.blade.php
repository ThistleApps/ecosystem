@extends('layouts.default')
@section('title',  'Deliveries' )
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('/vendor/bootstrap-daterangepicker-master/daterangepicker.css') }}" />
    <style>
        hr {
            -moz-border-bottom-colors: none;
            -moz-border-image: none;
            -moz-border-left-colors: none;
            -moz-border-right-colors: none;
            -moz-border-top-colors: none;
            border-color: #EEEEEE -moz-use-text-color #FFFFFF;
            border-style: solid none;
            border-width: 1px 0;
            margin: 18px 0;
        },

    </style>
@endsection

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading text-center">
            <span class="fa fa-truck"></span> Edit Delivery {{$delivery->order_number}}
        </div>

        <div class="panel-body">
            <form method="post" action="{{route('deliveries.update', $delivery->id)}}">
                {{csrf_field()}}
                <input type="hidden" name="_method" value="PUT">
                <h3>Person Information</h3>
                <hr>
                <div class="from-group">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input class="form-control" id="name" name="ship_to_name" value="{{$delivery->ship_to_name}}">
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input class="form-control" type="text" id="phone" name="phone_no" value="{{$delivery->phone_no}}">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input class="form-control" type="email" id="email" name="ship_to_email_address" value="{{$delivery->ship_to_email_address}}">
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="ship_to_addr_1">Address Line 1</label>
                            <input class="form-control" id="ship_to_addr_1" name="ship_to_addr_1" value="{{$delivery->ship_to_addr_1}}">
                        </div>
                        <div class="form-group">
                            <label for="ship_to_addr_2">Address Line 2</label>
                            <input class="form-control" type="text" id="ship_to_addr_2" name="ship_to_addr_2" value="{{$delivery->ship_to_addr_2}}">
                        </div>
                        <div class="form-group">
                            <label for="ship_to_addr_3">Address Line 3</label>
                            <input class="form-control" type="text" id="ship_to_addr_3" name="ship_to_addr_3" value="{{$delivery->ship_to_addr_3}}">
                        </div>
                    </div>
                </div>

                <h3>General Delivery Information</h3><hr>
                <div class="from-group col-lg-12">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="delivery_instruction">Delivery Instruction</label>
                            <textarea class="form-control" id="delivery_instruction" name="delivery_instruction">{{$delivery->delivery_instruction}}</textarea>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="creation_date">Order Date</label>
                            <input type="date" class="form-control" name="creation_date" value="{{$delivery->creation_date}}">
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <button class="btn btn-primary pull-right" type="submit">Update</button>
                </div>
            </form>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-body">
            <div class="col-lg-12">
                <h3>Items</h3>
                <hr>
                <button type="button" onclick="Add()" disabled="disabled">New Item</button>
                <table id="tblData" class="table">
                    <thead>
                    <tr>
                        <th>SKU</th>
                        <th>Quantity</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($delivery->orderDetails as $item)
                        <tr data-id="{{$item->id}}">
                            <td><input class='form-control item-input' name='sku' type='text' value="{{$item->sku_number}}"></td>
                            <td><input class='form-control item-input' name='quantity' type='text' value="{{$item->qty_selling_units}}"/></td>
                            <td><input class='form-control item-input' name='description' type='text' value="{{$item->description}}"> </td>
                            <td><input class='form-control item-input' name='price' type='number' value="{{$item->cust_price}}"></td>
                            <td><a href='javascript:void(0)' class="btnDelete"><span class='fa fa-trash'></span></a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        function Add(){

            $("#tblData tbody").append(
                "<tr>"+ "<td><input class='form-control' name='sku' type='text'/></td>"+
                "<td><input class='form-control' name='quantity' type='text'/></td>"+
                "<td><input class='form-control' name='description' type='text'/></td>"+
                "<td><input class='form-control' name='price' type='number'/></td>"+
                "<td><a href='javascript:void(0)' class='btnDelete'><span class='fa fa-trash'/></a></td>"+
                "</tr>"
            );
            $(".btnDelete").bind("click", Delete);
        };

//        function Save(){
//            var par = $(this).parent().parent();
//        //tr
//            var tdName = par.children("td:nth-child(1)");
//            var tdPhone = par.children("td:nth-child(2)");
//            var tdEmail = par.children("td:nth-child(3)");
//            var tdButtons = par.children("td:nth-child(4)");
//            tdName.html(tdName.children("input[type=text]").val());
//            tdPhone.html(tdPhone.children("input[type=text]").val());
//            tdEmail.html(tdEmail.children("input[type=text]").val());
//            tdButtons.html("<img src='images/delete.png' class='btnDelete'/><img src='images/pencil.png' class='btnEdit'/>");
//            $(".btnEdit").bind("click", Edit);
//            $(".btnDelete").bind("click", Delete);
//        }
//
        function Edit(){
            var par = $(this).parent().parent();
            //tr
            var tdName = par.children("td:nth-child(1)");
            var tdPhone = par.children("td:nth-child(2)");
            var tdEmail = par.children("td:nth-child(3)");
            var tdButtons = par.children("td:nth-child(4)");
            tdName.html("<input type='text' id='txtName' value='"+tdName.html()+"'/>");
            tdPhone.html("<input type='text' id='txtPhone' value='"+tdPhone.html()+"'/>");
            tdEmail.html("<input type='text' id='txtEmail' value='"+tdEmail.html()+"'/>");
            tdButtons.html("<img src='images/disk.png' class='btnSave'/>");
            $(".btnSave").bind("click", Save);
            $(".btnEdit").bind("click", Edit);
            $(".btnDelete").bind("click", Delete);
        }

        function Delete(){
            var par = $(this).parent().parent();
            //tr
            $item_id = par.attr('data-id');
            $.ajax({
                url: '{{route('deliveries.item.remove')}}',
                data: {'id': $item_id},
                headers: { 'X-XSRF-TOKEN' : '{{\Illuminate\Support\Facades\Crypt::encrypt(csrf_token())}}' },
                error: function() {

                },
                success: function(data) {
                    console.log(data);
                },
                type: 'POST'
            });

            par.remove();
        }

        function itemUpdate() {
            var par = $(this);
            var field_name = par.attr('name');
            var field_value = par.attr('value');
            var item_id = $(this).parent().parent().attr('data-id');

            $.ajax({
                url: '{{route('deliveries.item.update')}}',
                data: {'id': item_id, field_name  : field_name , field_value : field_value},
                headers: { 'X-XSRF-TOKEN' : '{{\Illuminate\Support\Facades\Crypt::encrypt(csrf_token())}}' },
                error: function() {

                },
                success: function(data) {
                    console.log(data);
                },
                type: 'POST'
            });
        }

        $(function(){
            //Add, Save, Edit and Delete functions code
            $(".btnEdit").bind("click", Edit);
            $(".btnDelete").bind("click", Delete);
//            $("#btnAdd").bind("click", Add);

            $('.item-input').bind('change', itemUpdate())
        });





    </script>

@endsection