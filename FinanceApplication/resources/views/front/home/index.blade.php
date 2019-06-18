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
        <!-- /.widget-holder -->
        <div class="widget-holder widget-sm widget-border-radius col-md-3">
            <div class="widget-bg">
                <div class="widget-heading bg-purple"><span class="widget-title my-0 color-white fs-12 fw-600">Incoming Billing</span>
                </div>
                <!-- /.widget-heading -->
                <div class="widget-body">
                    <div class="counter-w-info">
                        <div class="counter-title color-color-scheme"><span class="counter">{{ \App\billing::getIncomingCount() }}</span> Quantity</div>
                    </div>
                    <!-- /.counter-w-info -->
                </div>
                <!-- /.widget-body -->
            </div>
            <!-- /.widget-bg -->
        </div>
        <div class="widget-holder widget-sm widget-border-radius col-md-3">
            <div class="widget-bg">
                <div class="widget-heading bg-purple"><span class="widget-title my-0 color-white fs-12 fw-600">Outgoing Billing</span>
                </div>
                <!-- /.widget-heading -->
                <div class="widget-body">
                    <div class="counter-w-info">
                        <div class="counter-title color-color-scheme"><span class="counter">{{ \App\billing::getOutgoingCount() }}</span> Quantity</div>
                    </div>
                    <!-- /.counter-w-info -->
                </div>
                <!-- /.widget-body -->
            </div>
            <!-- /.widget-bg -->
        </div>
        <div class="widget-holder widget-sm widget-border-radius col-md-3">
            <div class="widget-bg">
                <div class="widget-heading bg-purple"><span class="widget-title my-0 color-white fs-12 fw-600">Total Payment</span>
                </div>
                <!-- /.widget-heading -->
                <div class="widget-body">
                    <div class="counter-w-info">
                        <div class="counter-title color-color-scheme"><span class="counter">{{ \App\Reports::getPayment() }}</span> TL</div>
                    </div>
                    <!-- /.counter-w-info -->
                </div>
                <!-- /.widget-body -->
            </div>
            <!-- /.widget-bg -->
        </div>
        <div class="widget-holder widget-sm widget-border-radius col-md-3">
            <div class="widget-bg">
                <div class="widget-heading bg-purple"><span class="widget-title my-0 color-white fs-12 fw-600">Total Collection</span>
                </div>
                <!-- /.widget-heading -->
                <div class="widget-body">
                    <div class="counter-w-info">
                        <div class="counter-title color-color-scheme"><span class="counter">{{ \App\Reports::getCollection() }}</span> TL</div>
                    </div>
                    <!-- /.counter-w-info -->
                </div>
                <!-- /.widget-body -->
            </div>
            <!-- /.widget-bg -->
        </div>
    </div>
    <!-- /.widget-list -->
    <hr>
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
                    </table>
                    <!-- /.widget-latest-transactions -->
                </div>
                <!-- /.widget-body -->
            </div>
            <!-- /.widget-bg -->
        </div>
    </div>
    <!-- /.widget-list -->

@endsection
