@extends('backend.layouts.master')
@section('stylesheet')
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<style>
    .card-header {
        background-color: #f2f3f4;
        border-bottom: 1px solid #ccc;
        padding: 10px 20px;
        border-radius: 8px 8px 0 0;
    }

    .form-control {
        border-radius: 4px;
    }

    .input-container {
        border: 0px solid #ccc;
        border-radius: 4px;

    }

    .input-container input.form-control {
        border: none;
        outline: none;
    }

    .custom-table {
        /* border: 1.5px solid #333; */
    }

    .custom-table th {
        text-align: center;
        height: 15px;
        color: #fbfcfc;
        background-color: #dc7633;
    }

    .custom-table td {
        vertical-align: middle;
        height: 30px;
    }

    .custom-table input {
        height: 30px;
        border: none;
    }

    .product {
        height: 20px !important;
    }

    .custom-table select {
        border: none;
        text-align: center;
    }

    .custom-buttons {
        display: flex;
        justify-content: space-between;
    }

    .table.custom-table th,
    .table.custom-table td {
        padding: 1px;
    }

    .form-control {
        padding: 10px !important;
    }

    .custom-modal {
        max-width: 1000px;
        /* Adjust this value to your desired width */
        margin-left: 400px;
        background-color: #dc7633;
    }

    .vertical-line {
        border-left: 1px solid black;
        height: 100px;
        margin: 0 auto;
    }

    .custom-modal .modal-content {
        background-color: #F8F9F9;
    }

    #PayDetail th {
        background-color: rgb(255, 128, 128);
        color: white;
        text-align: center;
    }

    #PayDetail tr:nth-child(odd) td {
        background-color: #ECECC2;
        color: #333;
    }

    #PayDetail tr:nth-child(even) td {
        background-color: #FFFFFF;
        color: #333;
    }

    .table-container {
        height: 270px;
        overflow-y: auto;
    }

    .table-body {
        width: 100%;
    }

    .right-aligned {
        display: flex;
        justify-content: space-between;
        color: rgb(255, 128, 128);
    }

    .Pay_total {
        color: rgb(255, 128, 128) !important;
        font-size: 18px !important;
        font-weight: bold !important;
    }

    .amount-cal {
        color: rgb(255, 128, 128) !important;
        font-size: 14px !important;
    }

    .input-names {
        color: blue !important;
    }

    .btn-cart {
        border-radius: 0;
    }

</style>
@endsection
@section('content')

<div class="col-12 ">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Purchase Create</h4>
            <form id="bill_create" action="{{ route('purchase.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card ">
                    <input type="hidden" name="date" value="{{ date('Y-m-d') }}" id="datepicker" class="form-control input-container">

                    <div class="row ">
                        <div class="col-md-8">
                            <label for="product_name ">Product Name/Code</label>
                            <div class="input-group">
                                <input type="text" name="product_name" id="product_name" data-id="" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4 ">
                            <label for="cart_qty">Quantity</label>
                            <div class="input-group">
                                <input type="text" name="quantity" id="cart_qty" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="">
                        <table class="table table-bordered custom-table">
                            <thead>
                                <tr class="text-center">
                                    <th class="col-xs-1">
                                        SN
                                    </th>
                                    <th class="col-3">
                                        Product
                                    </th>
                                    <th class="col-2">
                                        Quantity
                                    </th>
                                    <th class="col-xs-2">
                                        Price
                                    </th>
                                    <th class="col-xs-3">
                                        Total
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="append_here" id="purchase_list">
                            </tbody>
                            <tbody id="purchaseRows">
                                <tr>
                                    <td colspan="4">
                                        <div style="text-align: right; padding-right: 20px;"><strong>SubTotal</strong></div>
                                    </td>
                                    <td colspan="1" style="text-align: right;">
                                        <input type="text" id="sub_total" name="subtotal" value="00.0" class="form-control" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3">
                                        <div style="text-align: right; padding-right: 20px;"><strong>Discount</strong></div>
                                    </td>
                                    <td colspan="1" style="text-align: right;">
                                        <div class="input-group rounded">
                                            <input type="text" class="form-control rounded discount" name="discountPer" value="0" id="discountPer" placeholder="Discount Percentage" aria-label="Search" aria-describedby="search-addon" />
                                            <span class="input-group-text primary-text border-0" id="search-addon">
                                                %
                                            </span>
                                        </div>
                                    </td>
                                    <td colspan="1" style="text-align: right;">
                                        <div class="input-group rounded">
                                            <span class="input-group-text primary-text border-0" id="search-addon">
                                                NRS
                                            </span>
                                            <input type="text" class="form-control rounded discount" id="discountAmount" value="0" name="discountAmount" placeholder="Amount" aria-label="Search" aria-describedby="search-addon" />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4">
                                        <div style="text-align: right; padding-right: 20px;"><strong>Discount Amount</strong></div>
                                    </td>
                                    <td colspan="1">
                                        <input type="text" name="discount_amt" id="discount_amt" value="00.0" class="form-control" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4">
                                        <div style="text-align: right; padding-right: 20px;">
                                            <h4>Total</h4>
                                        </div>
                                    </td>
                                    <td colspan="1">
                                        <input type="text" id="total" name="total" value="00.0" class="form-control" readonly>
                                    </td>
                                    <input type="hidden" id="actual_amt" name="actual_amt" class="form-control">
                                </tr>
                                <tr>
                                    <td colspan="4">
                                        <div style="text-align: right; padding-right: 20px;">
                                            <h4>Grand Total</h4>
                                        </div>
                                    </td>
                                    <td colspan="1">
                                        <input type="text" id="grandTotal" name="grandTotal" value="00.0" class="form-control" readonly>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-2 col-md-12 mb-3">
                        <textarea name="remarks" id="remark" cols="30" rows="4" class="form-control" placeholder="Remarks"></textarea>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary font-weight-bolder">Save</button>
                        <a href="{{ route('purchase.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script src="{{ asset('assets/backend/js/purchase.js') }}"></script>

@endsection
