@extends('layouts.app')
@section('content')
    <div class="row page-title clearfix">
        <div class="page-title-left">
            <h6 class="page-title-heading mr-0 mr-r-5">Payment Operation</h6>
        </div>
        <!-- /.page-title-left -->
        <div class="page-title-right d-none d-sm-inline-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Panel</a>
                </li>
                <li class="breadcrumb-item active">Payment Operation</li>
            </ol>
            <div class="d-none d-md-inline-flex justify-center align-items-center"><a href="javascript: void(0);" class="btn btn-color-scheme btn-sm fs-11 fw-400 mr-l-40 pd-lr-10 mr-l-0-rtl mr-r-40-rtl hidden-xs hidden-sm ripple" target="_blank">Update Payment Operation</a>
            </div>
        </div>
        <!-- /.page-title-right -->
    </div>

    @if(session("status"))
        <div class="row" style="margin-top: 10px;">
            <div class="col-md-12">
                <div class="alert alert-success">{{ session("status") }}</div>
            </div>
        </div>

    @endif

    <div class="widget-list">
        <div class="row">
            <div class="col-md-12 widget-holder">
                <div class="widget-bg">
                    <div class="widget-body clearfix">
                        <form action="{{ route('operations.update',['id'=>$data[0]['id']]) }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row ">

                                <div class="form-group">
                                    <label class="col-form-label" for="l0">Select Billing</label>
                                    <select name="billingid" class="m-b-10 form-control billing" data-placeholder="Select Billing" data-toggle="select2">
                                        <option value="">Select Billing</option>
                                        @foreach(\App\billing::getList(BILLING_OUTGOING) as $k => $v)
                                            <option data-customerid = "{{ $v['customerid'] }}" @if($v['id'] == $data[0]['billingid']) selected @endif  value="{{$v['id']}}">{{ $v['billingno'] }} / {{ \App\Customers::getPublicName($v['customerid']) }} / {{ \App\billing::getTotal($v['id']) }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-form-label" for="l0">Select Customer</label>
                                    <select name="customerid" class="m-b-10 form-control customer" data-placeholder="Select Customer" data-toggle="select2">
                                        <option value="">Select Customer</option>
                                        @foreach(\App\Customers::all() as $k => $v)
                                            <option @if($v['id'] == $data[0]['customerid']) selected @endif value="{{$v['id']}}">{{ \App\Customers::getPublicName($v['id']) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">


                                <div class="col-md-4">
                                    <label class="col-form-label" for="l0">Operation Date</label>
                                    <input class="form-control" required name="date"  value="{{ $data[0]['date'] }}" type="date">
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-form-label" for="l0">Account</label>
                                        <select name="account" class="m-b-10 form-control" data-placeholder="Select Account" data-toggle="select2">
                                            <option @if($data[0]['account'] == 0) selected @endif value="0">Cash</option>
                                            @foreach(\App\Banks::all() as $k => $v)
                                                <option  @if($v['id'] == $data[0]['account']) selected @endif  value="{{$v['id']}}">{{ $v['name'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-form-label" for="l0">Payment Method</label>
                                        <select name="paymentmethod" class="m-b-10 form-control" data-placeholder="Select Account" data-toggle="select2">
                                            <option @if($data[0]['paymentmethod'] == 0) selected @endif value="0">Cash</option>
                                            <option @if($data[0]['paymentmethod'] == 1) selected @endif value="1">Bank</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-form-label" for="l0">Price</label>
                                        <input type="text" name="price" class="form-control" value="{{ $data[0]['price'] }}">
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-form-label" for="l0">Description</label>
                                    <textarea name="text" class="form-control" id="" cols="30" rows="10">{{ $data[0]['text'] }}</textarea>
                                </div>
                            </div>




                            <div class="form-actions">
                                <div class="form-group row">
                                    <div class="col-md-12 ml-md-auto btn-list">
                                        <button class="btn btn-primary btn-rounded" type="submit">Update</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.widget-body -->
                </div>
                <!-- /.widget-bg -->
            </div>
        </div>
    </div>

@endsection
@section('footer')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/multi-select/0.9.12/js/jquery.multi-select.min.js"></script>
    <script>
        $(document).ready(function () {
            $(".billing").change(function () {
                var price = $(this).find(":selected").attr('data-price');
                var customerid = $(this).find(":selected").attr('data-customerid');
                $(".customer").val(customerid).trigger('change');
                $("input[name=price]").val(price);
            })
        });
    </script>
@endsection