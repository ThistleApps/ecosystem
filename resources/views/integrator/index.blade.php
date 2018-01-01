@extends('layouts.layout_guest')
@section('title',  'Blend Retail' )

@section('content')
<div class="container">

    <div class="page-header text-center">
        <h1>Blend Retail</h1>
    </div>

       <!-- Call to Action Well -->
    <div class="row">
        <div class="col-lg-12">
            <div class="well text-center">
                <h2>Connect and Conquer Retail</h2>
                <img class="img-responsive" src = "/img/POS_Chalkboard.jpg">
            </div>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-sm-7">
            <div class="jumbotron">
                <h2>Connect and Conquer Retail</h2>
                <p>Mixing the in-store experience with online tools that make your life easier.</p>
            </div>
        </div>

        <div class="col-sm-5">
            <div class="embed-responsive embed-responsive-16by9">
                <iframe class="embed-responsive-item" src="//www.youtube.com/embed/cWNEZLbP9Lk"></iframe>
            </div>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-md-4">
            <h2>Heading 1</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe rem nisi accusamus error velit animi non ipsa placeat. Recusandae, suscipit, soluta quibusdam accusamus a veniam quaerat eveniet eligendi dolor consectetur.</p>
            <a class="btn btn-default" href="#">More Info</a>
        </div>

        <div class="col-md-4">
            <h2>Heading 2</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe rem nisi accusamus error velit animi non ipsa placeat. Recusandae, suscipit, soluta quibusdam accusamus a veniam quaerat eveniet eligendi dolor consectetur.</p>
            <a class="btn btn-default" href="#">More Info</a>
        </div>

        <div class="col-md-4">
            <h2>Heading 3</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe rem nisi accusamus error velit animi non ipsa placeat. Recusandae, suscipit, soluta quibusdam accusamus a veniam quaerat eveniet eligendi dolor consectetur.</p>
            <a class="btn btn-default" href="#">More Info</a>
        </div>
    </div>

</div><!--/.container-->
@endsection