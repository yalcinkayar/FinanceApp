@extends('layouts.app')
@section('content')
    <div class="row page-title clearfix">
        <div class="page-title-left">
            <h6 class="page-title-heading mr-0 mr-r-5">Customers</h6>
        </div>
        <!-- /.page-title-left -->
        <div class="page-title-right d-none d-sm-inline-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Panel</a>
                </li>
                <li class="breadcrumb-item active">Customers</li>
            </ol>
            <div class="d-none d-md-inline-flex justify-center align-items-center"><a href="javascript: void(0);" class="btn btn-color-scheme btn-sm fs-11 fw-400 mr-l-40 pd-lr-10 mr-l-0-rtl mr-r-40-rtl hidden-xs hidden-sm ripple" target="_blank">Add New Customer</a>
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
                        <form action="{{ route('customers.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label class=" col-form-label">Customer Photo</label>
                                    <input  class="control-panel" name="photo" type="file">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="" class="col-form-label">Customer Type</label>
                                    <div>
                                        <input type="radio" class="change-customerType" checked name="customerType" value="0"> Individual
                                    </div>
                                    <div>
                                        <input type="radio"  class="change-customerType" name="customerType" value="1"> Corporate
                                    </div>
                                </div>
                            </div>


                            <div class="form-group row company--area" style="display: none;">
                                <div class="col-md-4">
                                    <label class="col-form-label" for="l0">Company Name</label>
                                    <input class="form-control" name="companyName"  type="text">
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label" for="l0">Tax Number</label>
                                    <input class="form-control" name="taxNumber"  type="text">
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label" for="l0">Tax Administration</label>
                                    <input class="form-control" name="taxAdministration"  type="text">
                                </div>
                            </div>



                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label class="col-form-label" for="l0">First Name</label>
                                    <input class="form-control" name="firstname"  type="text">
                                </div>
                                <div class="col-md-6">
                                    <label class="col-form-label" for="l0">Last Name</label>
                                    <input class="form-control" name="lastname"  type="text">
                                </div>
                            </div>


                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label class="col-form-label" for="l0">Birth Date</label>
                                    <input class="form-control" name="birthDate"  type="date">
                                </div>
                                <div class="col-md-6">
                                    <label class="col-form-label" for="l0">TC</label>
                                    <input class="form-control" name="tc"  type="text">
                                </div>
                            </div>



                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label class="col-form-label" for="l0">Address</label>
                                    <input class="form-control" name="address"  type="text">
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label" for="l0">Phone</label>
                                    <input class="form-control" name="phone"  type="text">
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label" for="l0">E-mail</label>
                                    <input class="form-control" name="email"  type="text">
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
    <script>
        $(".change-customerType").click(function () {
            var value = $(this).val();
            if(value == 1)
            {
                $(".company--area").show();
            }
            else
            {
                $(".company--area").hide();
            }
        });

    </script>

@endsection