<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/demo/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/pace.css') }}">

    <title>Default</title>

    <link href="https://fonts.googleapis.com/css?family=Montserrat:200,300,400,500,600|Roboto:400" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/vendors/material-icons/material-icons.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/vendors/mono-social-icons/monosocialiconsfont.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/vendors/feather-icons/feather.css')}}" rel="stylesheet" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/0.7.0/css/perfect-scrollbar.min.css" rel="stylesheet" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.min.css" rel="stylesheet" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick-theme.min.css" rel="stylesheet" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.css" rel="stylesheet" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/2.1.25/daterangepicker.min.css" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/style.css')}}" rel="stylesheet" type="text/css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
    <script data-pace-options='{ "ajax": false, "selectors": [ "img" ]}' src="https://cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js"></script>
    @yield('header')
</head>

<body class="header-dark sidebar-light sidebar-expand">
<div id="wrapper" class="wrapper">

    <nav class="navbar">

        <div class="navbar-header">
            <a href="/" class="navbar-brand">
                <img class="logo-expand" alt="" src="{{asset('assets/demo/logo-expand.png')}}">
                {!! Charts::assets() !!}

            </a>
        </div>

        <ul class="nav navbar-nav">
            <li class="sidebar-toggle"><a href="javascript:void(0)" class="ripple"><i class="feather feather-menu list-icon fs-20"></i></a>
            </li>
        </ul>

        <div class="spacer"></div>

        <div class="btn-list dropdown d-none d-md-flex mr-4 mr-0-rtl ml-4-rtl"><a href="javascript:void(0);" class="btn btn-primary dropdown-toggle ripple" data-toggle="dropdown"><i class="feather feather-plus list-icon"></i> Create</a>
            <div class="dropdown-menu dropdown-left animated flipInY"><span class="dropdown-header">New a...</span>
                <a class="dropdown-item" href="{{ route('billing.create',['type'=>BILLING_INCOMING]) }}">Incoming Billing</a>
                <a class="dropdown-item" href="{{ route('billing.create',['type'=>BILLING_OUTGOING]) }}">Outgoing Billing</a>
                <a class="dropdown-item" href="{{ route('operations.create',['type'=>TRANSACTION_PAYMENT]) }}">Make Payments</a>
                <a class="dropdown-item" href="{{ route('operations.create',['type'=>TRANSACTION_COLLECTION]) }}">Get Collections</a>

            </div>
        </div>

        <ul class="nav navbar-nav">
            <li class="dropdown"><a href="javascript:void(0);" class="dropdown-toggle ripple" data-toggle="dropdown"><span class="avatar thumb-xs2"><img src="" class="rounded-circle" alt=""> <i class="feather feather-chevron-down list-icon"></i></span></a>
                <div
                        class="dropdown-menu dropdown-left dropdown-card dropdown-card-profile animated flipInY">
                    <div class="card">
                        <header class="card-header d-flex mb-0"><a href="javascript:void(0);" class="col-md-4 text-center"><i class="feather feather-user-plus align-middle"></i> </a><a href="javascript:void(0);" class="col-md-4 text-center"><i class="feather feather-settings align-middle"></i> </a>
                            <a
                                    href="javascript:void(0);" class="col-md-4 text-center"><i class="feather feather-power align-middle"></i>
                            </a>
                        </header>
                        <ul class="list-unstyled card-body">
                            <li>
                                <a href="{{ route('profile.index') }}"><span><span class="align-middle">Edit Profile</span></span></a>
                            </li>

                            <li>
                                <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><span><span class="align-middle">Logout</span></span></a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"><input type="hidden" name="_token" value="{{csrf_token()}}"></form>
                            </li>
                        </ul>
                    </div>
                </div>
            </li>
        </ul>

        <ul class="nav navbar-nav d-none d-lg-flex ml-2 ml-0-rtl">
            <li class="dropdown"><a href="javascript:void(0);" class="dropdown-toggle ripple" data-toggle="dropdown"><i class="feather feather-hash list-icon"></i></a>
                <div class="dropdown-menu dropdown-left dropdown-card animated flipInY">
                    <div class="card">
                        <header class="card-header d-flex align-items-center mb-0">  <span class="heading-font-family flex-1 text-center fw-400">Notifications</span>
                        </header>
                        <ul class="card-body list-unstyled dropdown-list-group">
                            @if(count(\App\Reminder::BillingReminder())!=0)
                                @foreach(\App\Reminder::BillingReminder() as $k => $v)
                                    <li>
                                        <a href="{{$v['uri']}}" class="media">
                                            <span class="media-body">
                                                <span class="heading-font-family media-heading">{{$v['name']}}</span>
                                                <span class="media-content">{{\App\Customers::getPublicName($v['customerid'])}} - {{ $v['price'] }} TL</span>
                                                <span class="user--online float-right my-auto"></span>
                                            </span>
                                        </a>
                                    </li>
                                @endforeach
                            @else
                                <li>
                                    <a href="" class="media">
                                            <span class="media-body">
                                                There is no operation
                                            </span>
                                    </a>
                                </li>

                            @endif

                        </ul>

                    </div>

                </div>

            </li>

        </ul>

    </nav>

    <div class="content-wrapper">

        <aside class="site-sidebar scrollbar-enabled" data-suppress-scroll-x="true">

            @include("layouts.sidebar")

        </aside>

        <main class="main-wrapper clearfix">
            @yield('content')
        </main>



    </div>

    <footer class="footer"><span class="heading-font-family">Copyright @ {{ date("Y") }}</span>
    </footer>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.2/umd/popper.min.js"></script>
<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/metisMenu/2.7.0/metisMenu.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/0.7.0/js/perfect-scrollbar.jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/countup.js/1.9.2/countUp.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-circle-progress/1.2.2/circle-progress.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-sparklines/2.1.2/jquery.sparkline.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/2.1.25/daterangepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/mithril/1.1.1/mithril.js"></script>
<script src="{{asset('assets/vendors/theme-widgets/widgets.js')}}"></script>
<script src="{{asset('assets/js/theme.js')}}"></script>
<script src="{{asset('assets/js/custom.js')}}"></script>
@yield('footer')
</body>

</html>
