@extends('layouts.app')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" type="text/css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css" rel="stylesheet" type="text/css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/multi-select/0.9.12/css/multi-select.min.css" rel="stylesheet" type="text/css">

@section('content')
    <div class="row page-title clearfix">
        <div class="page-title-left">
            <h6 class="page-title-heading mr-0 mr-r-5">Billing</h6>
        </div>
        <!-- /.page-title-left -->
        <div class="page-title-right d-none d-sm-inline-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Panel</a>
                </li>
                <li class="breadcrumb-item active">Billing</li>
            </ol>
            <div class="d-none d-md-inline-flex justify-center align-items-center"><a href="javascript: void(0);" class="btn btn-color-scheme btn-sm fs-11 fw-400 mr-l-40 pd-lr-10 mr-l-0-rtl mr-r-40-rtl hidden-xs hidden-sm ripple" target="_blank">Add New Billing</a>
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
                        <form action="{{ route('billing.store',['type'=>0]) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row firma--area">
                                <div class="col-md-4">
                                    <label class="col-form-label" for="l0">Billing No</label>
                                    <input value="{{\App\billing::getMaxNo()}}" class="form-control" required name="billingno"  type="text">
                                </div>
                                <div class="col-md-4">
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
                                <div class="col-md-4">
                                    <label class="col-form-label" for="l0">Billing Date</label>
                                    <input class="form-control" required name="billingdate"  value="{{ date("Y-m-d") }}" type="date">
                                </div>

                            </div>


                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table id="billingData" class="table">
                                            <thead>
                                            <tr>
                                                <th>Item</th>
                                                <th>Product</th>
                                                <th>Quantity / Day</th>
                                                <th>Price</th>
                                                <th>Total Price</th>
                                                <th>Tax</th>
                                                <th>Tax Total</th>
                                                <th>General Total</th>
                                                <th>Description</th>
                                                <th>Remove</th>
                                            </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <button type="button" id="addRowBtn" class="btn-rounded btn btn-primary"> + </button>

                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table">
                                        <tr>
                                            <td align="left">Subtotal:</td>
                                            <td align="right" class="subtotal">0.00</td>
                                        </tr>
                                        <tr>
                                            <td align="left">Tax Total:</td>
                                            <td align="right" class="total_taxed">0.00</td>
                                        </tr>
                                        <tr>
                                            <td align="left">Overall Total:</td>
                                            <td align="right" class="overalltotal">0.00</td>
                                        </tr>
                                    </table>
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
        var i = $(".operation_field").length;
        $("#addRowBtn").click(function () {
            var newRow =
                '<tr class="operation_field">'+
                '<td style="width: 150px;"><select class="form-control item" name="operation['+i+'][itemid]">'+
                '<option value="0">Select Item</option>';
            @foreach(\App\Item::getList(0) as $key => $value)
                newRow+='<option data-k ="{{$value['tax']}}" value="{{ $value['id'] }}">{{ $value['name'] }}</option>';
            @endforeach
                newRow+='</select></td>'+
                '<td style="width: 180px;"><select class="form-control product" name="operation['+i+'][productid]">'+
                '<option value="0">Select Product</option>';
            @foreach(\App\Products::all() as $key => $value)
                newRow+='<option data-saleprice ="{{$value['salePrice']}}" value="{{ $value['id'] }}">{{ $value['productName'] }}</option>';
            @endforeach
                newRow+='</select></td>'+
                '<td><input type="text" class="form-control" id="day_quantity" name="operation['+i+'][day_quantity]"></td>'+
                '<td><input type="text" class="form-control" id="price" name="operation['+i+'][price]"></td>'+
                '<td><input type="text" class="form-control" id="subtotal" name="operation['+i+'][subtotal]"></td>'+
                '<td><input type="text" class="form-control" id="tax" name="operation['+i+'][tax]"></td>'+
                '<td><input type="text" class="form-control" id="total_taxed" name="operation['+i+'][total_taxed]"></td>'+
                '<td><input type="text" class="form-control" id="overalltotal" name="operation['+i+'][overalltotal]"></td>'+
                '<td><input type="text" class="form-control" id="text" name="operation['+i+'][text]"></td>'+
                '<td><button id="removeButton" type="button" class="btn btn-danger">X</button></td>'+
                '</tr>';
            $("#billingData").append(newRow);
            i++;
        });
        $("body").on("change",".item",function () {
            var tax = $(this).find(":selected").data("k");
            $(this).closest(".operation_field").find("#tax").val(tax);
        });
        $("body").on("change",".product",function () {
            var saleprice = $(this).find(":selected").data("saleprice");
            $(this).closest(".operation_field").find("#price").val(saleprice);
        });
        $("body").on("click","#removeButton",function () {
            $(this).closest(".operation_field").remove();
            calc();
        });
        $("body").on("change","#billingData input",function () {
            var $this = $(this);
            if($this.is("#price, #day_quantity , #subtotal , #overalltotal, #tax"))
            {
                var quantity = $this.closest("tr").find("#day_quantity").val();
                var price = $this.closest("tr").find("#price").val();
                var tax = $this.closest("tr").find("#tax").val();
                var subtotal;
                var overalltotal;
                var total_taxed;
                if(quantity=="" && price == "")
                {
                    subtotal = $this.closest("tr").find("#subtotal").val();
                    if(subtotal == "")
                    {
                        overalltotal = parseFloat($this.closest("tr").find("#overalltotal").val());
                        total_taxed = overalltotal/(1 + tax/100);
                        subtotal = overalltotal - total_taxed;
                    }
                    else
                    {
                        subtotal = parseFloat($this.closest("tr").find("#subtotal").val());
                        total_taxed = subtotal*tax/100;
                        overalltotal = total_taxed + subtotal;
                    }
                }
                else
                {
                    subtotal = quantity * price;
                    total_taxed = subtotal*tax/100;
                    overalltotal = subtotal+total_taxed;
                }
                total_taxed = total_taxed.toFixed(2);
                subtotal = subtotal.toFixed(2);
                overalltotal = overalltotal.toFixed(2);
                $this.closest("tr").find("#subtotal").val(subtotal);
                $this.closest("tr").find("#total_taxed").val(total_taxed);
                $this.closest("tr").find("#overalltotal").val(overalltotal);
            }
            calc();
        });
        function  calc() {
            var total_taxed = 0;
            var subtotal = 0;
            var overalltotal = 0;
            $("[id=total_taxed]").each(function () {
                total_taxed = parseFloat(total_taxed) + parseFloat($(this).val());
            });
            $("[id=subtotal]").each(function () {
                subtotal = parseFloat(subtotal) + parseFloat($(this).val());
            });
            $("[id=overalltotal]").each(function () {
                overalltotal = parseFloat(overalltotal) + parseFloat($(this).val());
            });
            $(".total_taxed").html(total_taxed);
            $(".subtotal").html(subtotal);
            $(".overalltotal").html(overalltotal);
        }
    </script>
@endsection