@extends('layouts.default')
@section('title',  'Configurator' )

@section('style')
    <style>
        .ingredients {
            position:relative;
            width: auto;
            height: 175px;
            border-style: outset;
            border-radius: 1px;
            cursor: pointer;
            margin-bottom: 10px;
        }
        .card-img-top {
            position:relative;
            margin-top: 6%;
            background-color: #f2f2f2;
            width: 100%;
            height: 70px;
        }
        .coming-soon {
            position:absolute;
            background-color: rgba(0, 0, 0, 0.7);
            color: white;
            width: 100%;
            margin-top: -71px;
            height: 70px;
        }
    </style>
@endsection
@section('content')

    <div class="panel panel-default">
        <div class="panel-heading text-center"><span class="fa fa-gear"></span> Configurator</div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-12">

                    <div class="col-md-4" id="get-swift-config">
                        <div class="ingredients">
                            <div class="text-center">
                                <img class="card-img-top" src="{{asset('/img/getswift.png')}}" alt="Card image cap">
                            </div>
                            <div class="text-center">
                                <h3>Getswift</h3>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="ingredients">
                            <div class="text-center">
                                <img class="card-img-top" src="{{asset('/img/MailChimp.png')}}" alt="Card image cap">
                            </div>
                            {{-- <div class="coming-soon text-center">
                                <h3>Coming Soon</h3>
                            </div> --}}
                            <div class="text-center">
                                @unless($mc_valid)
                                {{ __('configurator.mailchimp.connect') }}<br>
                                <a href="{{ route('configurator.mailchimp.auth') }}" class="btn btn-primary">
                                    {{ __('configurator.authorize') }}
                                </a>
                                @else
                                    {{ __('configurator.mailchimp.connected') }}<br>
                                    <button id="mailchimp-config" class="btn btn-success">
                                        {{ __('configurator.conf') }}
                                    </button>
                                @endunless
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="ingredients">
                            <div class="text-center">
                                <img class="card-img-top" src="{{asset('/img/crm.svg')}}" alt="Card image cap">
                            </div>
                            <div class="coming-soon text-center">
                                <h3>Coming Soon</h3>
                            </div>
                            <div class="text-center">
                                <h3>CRM</h3>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="ingredients">
                            <div class="text-center">
                                <img class="card-img-top" src="{{asset('/img/cms.svg')}}" alt="Card image cap">
                            </div>
                            <div class="coming-soon text-center">
                                <h3>Coming Soon</h3>
                            </div>
                            <div class="text-center">
                                <h3>CMS</h3>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div id="getswift-conf-modal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Getswift Api Settings</h4>
                </div>
                <div class="modal-body">

                    <form class="form-horizontal" id="get-swif-form" method="post" action="{{route('configurator.getswift.save')}}" role="form">
                        {{ csrf_field() }}
                        <div class="form-group">

                            <label class="control-label col-md-3" for="get-swif-inp">API Key</label>

                            <div class="col-lg-9">
                                <input class="form-control" name="getswift_key" value="{{$getswift_key->key ?? ''}}" id="get-swif-inp">
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-lg-6">
                                <label class="control-label col-md-6" for="order-code">Order Code</label>

                                <div class="col-md-6">
                                    <select name="order_code" id="order-code" class="form-control">
                                        @foreach(order_codes() as $key => $value)
                                            <option {{isset($order_code)? $order_code->key == $key? 'selected' : '' : ''}} value="{{$key}}">{{$value}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <label class="control-label col-md-6" >Delivery Code</label>

                                <div class="col-md-6">
                                    <input class="form-control" value="{{$order_code->value ?? ''}}" name="delivery_code">
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" form="get-swif-form" class="btn btn-success">Update</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>

    <div id="mailchimp-conf-modal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">{{ __('configurator.mailchimp.modal-header') }}</h4>
                </div>
                <div class="modal-body">

                    <form class="form-horizontal" id="mailchimp-form" method="post" action="{{route('configurator.mailchimp.save')}}" role="form">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label class="control-label col-md-3" for="customers_list">
                                {{ __('configurator.mailchimp.customers') }}
                            </label>

                            <div class="col-lg-9">
                                    <select name="customers_list" class="form-control">
                                        @foreach($mc_lists as $key => $value)
                                            <option {{ isset($mc_customer) && $mc_customer->key == $key ? 'selected' : ''}} value="{{$key}}">
                                                {{$value}}
                                            </option>
                                        @endforeach
                                    </select>
                            </div>
                        </div>

                        <div class="form-group">

                            <label class="control-label col-md-3" for="transactions_list">
                                {{ __('configurator.mailchimp.transactions') }}
                            </label>

                            <div class="col-lg-9">
                                <select name="transactions_list" class="form-control">
                                        @foreach($mc_lists as $key => $value)
                                            <option {{ isset($mc_transaction) && $mc_transaction->key == $key ? 'selected' : ''}} value="{{$key}}">
                                                {{$value}}
                                            </option>
                                        @endforeach
                                    </select>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" form="mailchimp-form" class="btn btn-success">
                        {{ __('configurator.update') }}
                    </button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        {{ __('configurator.close') }}
                    </button>
                </div>
            </div>

        </div>
    </div>
@endsection
@section('script')
<script>
    $('document').ready(function () {
        $('#get-swift-config').on('click', function () {
            $('#getswift-conf-modal').modal('show');
        });

        $('#mailchimp-config').on('click', function() {
            $('#mailchimp-conf-modal').modal('show');
        });
    });
</script>
@endsection
