@extends('layouts.app')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" type="text/css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css" rel="stylesheet" type="text/css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/multi-select/0.9.12/css/multi-select.min.css" rel="stylesheet" type="text/css">

@section('content')
    <div class="row page-title clearfix">
        <div class="page-title-left">
            <h6 class="page-title-heading mr-0 mr-r-5">Offer</h6>
        </div>
        <!-- /.page-title-left -->
        <div class="page-title-right d-none d-sm-inline-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Panel</a>
                </li>
                <li class="breadcrumb-item active">Offer</li>
            </ol>
            <div class="d-none d-md-inline-flex justify-center align-items-center"><a href="javascript: void(0);" class="btn btn-color-scheme btn-sm fs-11 fw-400 mr-l-40 pd-lr-10 mr-l-0-rtl mr-r-40-rtl hidden-xs hidden-sm ripple" target="_blank">Add New Offer</a>
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
                        <form action="{{ route('offers.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row offer--area">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="col-form-label" for="l0">Select Customer</label>
                                        <select name="customerid" class="m-b-10 form-control" data-placeholder="Select Customer" data-toggle="select2">
                                            <option value="">Select Customer</option>
                                            @foreach(\App\Customers::all() as $k => $v)
                                                <option value="{{$v['id']}}">{{ \App\Customers::getPublicName($v['id']) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label class="col-form-label" for="l0">Offer Price</label>
                                    <input class="form-control" name="price" type="text">
                                </div>
                                <div class="col-md-12">
                                    <label class="col-form-label" for="l0">Description</label>
                                    <textarea name="description" class="form-control" cols="30" rows="10"></textarea>
                                </div>
                                <div class="col-md-12">
                                    <label class="col-form-label" for="l0">Status</label>
                                    <select name="status" class="form-control">
                                        <option value="0">Waiting</option>
                                        <option value="1">Accepted</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <button id="add-product" class="btn btn-primary" type="button">Add Product</button>
                                <div style="margin-top:10px;" id="product-list">

                                </div>
                            </div>

                            <div class="form-actions">
                                <div class="form-group row">
                                    <div class="col-md-12 ml-md-auto btn-list">
                                        <button class="btn btn-primary btn-rounded" type="submit">Save</button>
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
    let i = $('.list-item').length;
    $('#add-product').click(function(){
    let html = '<div style="margin-bottom:5px;" class="row list-item">' +
        '<div class="col-md-5">' +
        '<select name="products['+i+'][productid]" class="form-control">';
    @foreach(\App\Products::all() as $k => $v)
        html += '<option value = "{{$v['id']}}">{{$v['productName']}}</option>';
    @endforeach
        html += '</select></div>' +
        '<div class="col-md-5">' +
        '<input name="products['+i+'][quantity]" class="form-control" placeholder="Quantity">' +
        '</div>';

    html += '<div class="col-md-2">' +
    '<button type="button" class="btn btn-danger remove">x</button>'+
    '</div>';
    $('#product-list').append(html);
    i++;
    });
    $('body').on('click','.remove',function(){
        $(this).closest('.list-item').remove();
    });
</script>
@endsection