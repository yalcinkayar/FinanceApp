@extends('layouts.app')
@section('content')
    <div class="row page-title clearfix">
        <div class="page-title-left">
            <h6 class="page-title-heading mr-0 mr-r-5">Customer Extra</h6>
        </div>
        <!-- /.page-title-left -->
        <div class="page-title-right d-none d-sm-inline-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Panel</a>
                </li>
                <li class="breadcrumb-item active">Customer Extra</li>
            </ol>
            <div class="d-none d-md-inline-flex justify-center align-items-center"><a href="javascript: void(0);" class="btn btn-color-scheme btn-sm fs-11 fw-400 mr-l-40 pd-lr-10 mr-l-0-rtl mr-r-40-rtl hidden-xs hidden-sm ripple" target="_blank">{{ \App\Customers::getPublicName($data[0]['id']) }}</a>
            </div>
        </div>
        <!-- /.page-title-right -->
    </div>

    <div class="widget-list">
        <div class="row">
            <!-- User Summary -->
            <div class="col-12 col-md-12 widget-holder widget-full-content">
                <div class="widget-bg">
                    <div class="widget-body clearfix">
                        <div class="widget-user-profile">
                            <figure class="profile-wall-img">
                                <img src="{{ asset('assets/demo/user-widget-bg.jpeg') }}" alt="User Wall">
                            </figure>
                            <div class="profile-body">
                                <figure class="profile-user-avatar thumb-md">
                                    <img src="{{ asset(\App\Customers::getPhoto($data[0]['id'])) }}" alt="User Wall">
                                </figure>
                                <h6 class="h3 profile-user-name">{{\App\Customers::getPublicName($data[0]['id'])}}</h6>
                                <small class="profile-user-address">@if($data[0]['customerType'] == 0) Individual @else Corporate @endif</small>

                                <hr class="profile-seperator">

                                <!-- /.profile-user-description -->
                                <div class="mb-5">
                                    <a href="{{ route('customers.edit',['id'=>$data[0]['id']]) }}" class="btn btn-outline-color-scheme btn-rounded btn-lg px-5 border-thick text-uppercase mr-2 mr-0-rtl ml-2-rtl fw-700 fs-11 heading-font-family">Update Customer</a>

                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th>Operation</th>
                                                <th>Price</th>
                                                <th>Date</th>
                                            </tr>
                                            </thead>
                                            <body>
                                            @foreach($viewData as $k => $v)
                                                <tr>
                                                    <td>
                                                        @if($v['uType'] == "billing")
                                                            @if($v['type'] == BILLING_INCOMING)
                                                                Incoming Billing
                                                            @else
                                                                Outgoing Billing
                                                            @endif
                                                        @else
                                                            @if($v['type'] == TRANSACTION_PAYMENT)
                                                                Payment
                                                            @else
                                                                Collection
                                                            @endif
                                                        @endif

                                                    </td>
                                                    <td>{{ $v['price'] }}</td>
                                                    <td>{{ $v['date'] }}</td>
                                                </tr>



                                            @endforeach
                                            </body>
                                        </table>
                                    </div>
                                </div>
                            </div>






                        </div>
                        <!-- /.widget-user-profile -->
                    </div>
                    <!-- /.widget-body -->
                </div>
                <!-- /.widget-bg -->
            </div>
        </div>
    </div>
@endsection
