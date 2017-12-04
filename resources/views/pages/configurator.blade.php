@extends('layouts.default')

@section('style')
<style>
    .ingredients {
        position:relative;
        width: 250px;
        height: 200px;
        border-style: outset;
        border-radius: 1px;
    }
    .card-img-top {
        position:relative;
        margin-top: 6%;
        background-color: #f2f2f2;
        width: 90%;
    }
    .coming-soon {
        position:absolute;
        background-color: rgba(0, 0, 0, 0.8);
        color: white;
        width: 100%;
        margin-top:-50px;

    }

</style>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header text-center"><span class="fa fa-gear  "></span> Configurator</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="col-lg-3" >
                <div class="ingredients">
                    <div class="text-center">
                        <img class="card-img-top" src="{{asset('/img/getswift.png')}}" alt="Card image cap">
                    </div>
                    <div class="text-center">
                        <h3>Getswift</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">

                <div class="ingredients">
                    <div class="text-center">
                        <img class="card-img-top" src="{{asset('/img/MailChimp.png')}}" alt="Card image cap">
                    </div>
                    <div class="coming-soon text-center">
                        <h3>Coming Soon</h3>
                    </div>
                    <div class="text-center">
                        <h3>MailChimp</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="ingredients">
                    <div class="text-center">
                        <img class="card-img-top" src="{{asset('/img/getswift.png')}}" alt="Card image cap">
                    </div>
                    <div class="coming-soon text-center">
                        <h3>Coming Soon</h3>
                    </div>
                    <div class="text-center">
                        <h3>CRM</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="ingredients">
                    <div class="text-center">
                        <img class="card-img-top" src="{{asset('/img/getswift.png')}}" alt="Card image cap">
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

@endsection