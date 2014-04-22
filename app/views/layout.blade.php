<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../assets/ico/favicon.ico">

    <title>eMix</title>
    <!-- Bootstrap core CSS -->
    <link href="{{ asset('components/bootstrap/dist/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('components/font-awesome/css/font-awesome.css') }}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <style>
        body {
            padding-top: 70px;
        }
    </style>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
@section('header')
<!-- Fixed navbar -->
<div class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">eMiX</a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="/">Home</a></li>
                <li><a href="/servers">Servers</a></li>
                <li><a href="/reports">Reports</a></li>
                <li class=""><a href="/admin">Admin</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="logout">Log out</a></li>
            </ul>
        </div>
        <!--/.nav-collapse -->
    </div>
</div>
@show

<div class="container">

    @yield('content')

</div>
<!-- /container -->

<script src="{{ asset('components/jquery/dist/jquery.js') }}"></script>
<script src="{{ asset('components/bootstrap/dist/js/bootstrap.js') }}"></script>
</body>
</html>
