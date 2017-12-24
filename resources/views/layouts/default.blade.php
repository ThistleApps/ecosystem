<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta Information -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', config('app.name'))</title>

    <!-- Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,600' rel='stylesheet' type='text/css'>
    <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css' rel='stylesheet' type='text/css'>

    <!-- CSS -->
    <link href="/css/sweetalert.css" rel="stylesheet">
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="css/navbar-left.min.css">


    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('/vendor/toastr-master/build/toastr.min.css') }}">

    <style>
        #page-wrapper {
            padding: 0 15px;
            min-height: 568px;
            background-color: white;
        }
        @media (min-width: 768px) {
            #page-wrapper {
                position: inherit;
                /*margin: 0 0 0 250px;*/
                padding: 0 20px;
                border-left: 1px solid #e7e7e7;
            }
        }
        .modal {
            text-align: center;
        }

        @media screen and (min-width: 768px) {
            .modal:before {
                display: inline-block;
                vertical-align: middle;
                content: " ";
                height: 100%;
            }
        }

        .modal-dialog {
            display: inline-block;
            text-align: left;
            vertical-align: middle;
        }
    </style>
@yield('style')
    <!-- Scripts -->
@yield('scripts', '')

<!-- Global Spark Object -->
    <script>
        window.Spark = <?php echo json_encode(array_merge(
            Spark::scriptVariables(), []
        )); ?>;
    </script>
</head>
<body class="with-navbar">

<div id="spark-app" v-cloak>
<!-- Navigation -->
@if (Auth::check())
    @include("layouts.partials.nav-left-side")
    @include('spark::nav.user')
@else
    @include('spark::nav.guest')
@endif

<!-- Main Content -->
<div id="page-wrapper">
@yield('content')
</div>
<!-- Application Level Modals -->
    @if (Auth::check())
        @include('spark::modals.notifications')
        @include('spark::modals.support')
        @include('spark::modals.session-expired')
    @endif
</div>

<!-- JavaScript -->
<script src="{{ mix('js/app.js') }}"></script>
<script src="/js/sweetalert.min.js"></script>

{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>--}}

<script src="{{ asset('/vendor/toastr-master/build/toastr.min.js') }}"></script>


<script async defer src="https://buttons.github.io/buttons.js"></script>

<script>
            @if(Session::has('message'))
    var type = "{{ Session::get('alert-type', 'info') }}";
    switch(type){
        case 'info':
            toastr.info("{{ Session::get('message') }}");
            break;

        case 'warning':
            toastr.warning("{{ Session::get('message') }}");
            break;

        case 'success':
            toastr.success("{{ Session::get('message') }}");
            break;

        case 'error':
            toastr.error("{{ Session::get('message') }}");
            break;
    }
    @endif
</script>

@yield('script')
</body>
</html>
