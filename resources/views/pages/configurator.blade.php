@extends('layouts.default')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header text-center"><span class="fa fa-gear  "></span> Configurator</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="card">
        <img class="card-img-top" src="{{asset('/img/getswift.png')}}" height="180" width="318" alt="Card image cap">
        <div class="card-block">
            <p class="card-text">Some quick </p>
        </div>
    </div>

        <div class="col-lg-12">
            <div class="card" style="width: 20rem;">
                <img class="card-img-top" src="{{asset('/img/getswift.png')}}" height="180" width="318" alt="Card image cap">
                <div class="card-block">
                    <h4 class="card-title">Card title</h4>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
        </div>
        <!-- /.col-lg-12 -->
    </div>
@endsection