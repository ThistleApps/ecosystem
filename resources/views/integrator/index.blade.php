<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('title', config('app.name'))</title>

    <!-- Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,600' rel='stylesheet' type='text/css'>
    <link href="{{asset('/vendor/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sticky-footer-navbar.css') }}" rel="stylesheet">
</head>

<body class="with-navbar">
<!-- Navigation -->
@if(auth()->check())
    @include("layouts.partials.nav-bar-top")
@else
    @include("vendor.spark.nav.guest")
@endif

<div class="container">

    <div class="page-header text-center">
        <h1>Integrator</h1>
    </div>
    <div class="row">
        <div class="col-sm-7">
            <div class="jumbotron">
                <h1>Hello, world!</h1>
                <p>This is an example to show the potential of an offcanvas layout pattern in Bootstrap. Try some responsive-range viewport sizes to see it in action.</p>
            </div>
        </div>

        <div class="col-sm-5">
            <div class="embed-responsive embed-responsive-16by9">
                <iframe class="embed-responsive-item" src="//www.youtube.com/embed/cWNEZLbP9Lk"></iframe>
            </div>
        </div>
    </div>

    <!-- Call to Action Well -->
    <div class="row">
        <div class="col-lg-12">
            <div class="well text-center">
                This is a well that is a great spot for a business tagline or phone number for easy access!
            </div>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

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

<hr>
@include("layouts.partials.nav-footer")

<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>