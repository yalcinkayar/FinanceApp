@extends('layouts.app')
@section('content')
    <div class="row page-title clearfix">
        <div class="page-title-left">
            <h6 class="page-title-heading mr-0 mr-r-5">Update Item</h6>
        </div>
        <!-- /.page-title-left -->
        <div class="page-title-right d-none d-sm-inline-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Panel</a>
                </li>
                <li class="breadcrumb-item active">Item</li>
            </ol>
            <div class="d-none d-md-inline-flex justify-center align-items-center"><a href="javascript: void(0);" class="btn btn-color-scheme btn-sm fs-11 fw-400 mr-l-40 pd-lr-10 mr-l-0-rtl mr-r-40-rtl hidden-xs hidden-sm ripple" target="_blank">Update Item</a>
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
                        <form action="{{ route('item.update',['id'=>$data[0]['id']]) }}" method="POST" enctype="multipart/form-data">
                            @csrf


                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="" class="col-form-label">Item Type</label>
                                    <div>
                                        <input type="radio" class="change-itemType" @if($data[0]['itemtype'] == 0) checked @endif name="itemtype" value="0"> Incoming
                                    </div>
                                    <div>
                                        <input type="radio" class="change-itemType" @if($data[0]['itemtype'] == 1) checked @endif name="itemtype" value="1"> Outgoing
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row firma--area">
                                <div class="col-md-6">
                                    <label class="col-form-label" for="l0">Item Name</label>
                                    <input class="form-control" required name="name"  type="text" value="{{ $data[0]['name'] }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="col-form-label" for="l0">Tax</label>
                                    <input class="form-control" required name="tax"  value="{{ $data[0]['tax'] }}" type="text">
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

@endsection