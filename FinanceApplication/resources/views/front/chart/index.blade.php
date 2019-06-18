@extends('layouts.app')
@section('content')
    <!-- Page Title Area -->
    <div class="row page-title clearfix">
        <div class="page-title-left">
            <h6 class="page-title-heading mr-0 mr-r-5">Panel</h6>
        </div>
        <!-- /.page-title-left -->
        <div class="page-title-right d-none d-sm-inline-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Panel</a>
                </li>
                <li class="breadcrumb-item active">Home</li>
            </ol>
        </div>
        <!-- /.page-title-right -->
    </div>
    <!-- /.page-title -->
    <!-- =================================== -->
    <!-- Different data widgets ============ -->
    <!-- =================================== -->

    <div class="widget-list row">
        <div class="widget-holder widget-full-height col-md-12">
            <div class="widget-bg">
                <div class="widget-heading widget-heading-border">
                    <h5 class="widget-title">Recent Transaction</h5>
                    <div class="widget-actions">
                        <div class="predefinedRanges badge bg-success-contrast px-3 cursor-pointer heading-font-family" data-plugin-options='{
                    "locale": {
                      "format": "MMM YYYY"
                    }
                   }'><span></span>  <i class="feather feather-chevron-down ml-1"></i>
                        </div>
                    </div>
                    <!-- /.widget-actions -->
                </div>
                <!-- /.widget-heading -->
                <div class="widget-body">
                    <table class="widget-latest-transactions">
                        {!! $chart->html() !!}
                    </table>
                    <!-- /.widget-latest-transactions -->
                </div>
                <!-- /.widget-body -->
            </div>
            <!-- /.widget-bg -->
        </div>
    </div>
    <!-- /.widget-list -->
    {!! Charts::scripts() !!}
    {!! $chart->script() !!}
@endsection
