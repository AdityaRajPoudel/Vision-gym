@extends('backend.layouts.master')
@section('stylesheet')
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<style>
     .custom-modal {
        max-width: 1000px;
        /* Adjust this value to your desired width */
        margin-left: 200px;
        background-color: #dc7633;
    }
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
            <h4 class="card-title">Sales Create</h4>
            <form id="bill_create" action="{{ route('sales.store') }}" method="POST" enctype="multipart/form-data">
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
                        <button type="button" id="pay" class="btn btn-primary font-weight-bolder">Pay</button>
                        <a href="{{ route('sales.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </div>
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg custom-modal" role="document">
                        <div class="modal-content">
                            <!-- Modal Header -->
                            <div class="modal-header" style="background-color:rgb( 59, 169, 222);">
                                <label for="" class="">
                                    <h4 class="text-white text-center">Make Payment</h4>
                                </label>
                            </div>
                            <div class="modal-body">
                                <div class="col-md-12 row ">
                                    <div class="col-md-6">
                                        <div class="form-group row">

                                            <div class="col-md-12 mt-3">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <label for="" class="input-names">Pay Mode</label>
                                                        <select id="pay_mode" class="form-control border-dark" name="">
                                                            <option value="Cash">Cash</option>
                                                            <option value="esewa">E-sewa</option>
                                                            <option value="khalti">Khalti</option>
                                                            <option value="mbank">MBank</option>
                                                            <option value="credit">Credit</option>
                                                        </select>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-md-12 mt-3">
                                                <label for="" class="input-names">Amount</label>
                                                <input type="text" id="input_amount" style="border: none;" value="" name="amount" class="form-control">
                                                <hr style="border-top: 2px solid blue; margin-top: 5px;">
                                            </div>
                                            {{-- <div class="col-md-12 mt-3 cash" style="display: none;">
                                                    <label for="" class="input-names">Pay Via</label>
                                                    <input type="" id="input_pay_via" value=""
                                                        name="pay_via" class="form-control">
                                                </div> --}}
                                            <div class="col-md-12 mt-3">
                                                <a href="" class="btn btn-success " id="addPayment">Add</a>
                                            </div>
                                            <div class="col-md-12 mt-3">
                                                <hr style="border-top: 2px solid green;">
                                            </div>

                                            <div class="col-md-12 right-aligned">
                                                <label class="Pay_total" for="">SubTotal:</label>
                                                <span class="Pay_total" id="pay_mode_subtotal">00</span>
                                            </div>
                                            <div class="col-md-12 right-aligned">
                                                <label class="amount-cal" for="">Discount:</label>
                                                <span class="amount-cal" id="pay_mode_discount">00</span>
                                            </div>

                                            <div class="col-md-12 right-aligned">
                                                <label class="Pay_total" for="">Grand Total:</label>
                                                <span class="Pay_total" id="pay_mode_grandTotal"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 ">
                                        <div class="table-container">
                                            <table class="col-md-12 table-body" id="PayDetail">
                                                <thead class="voucher-head">
                                                    <tr class="table-head">
                                                        <th class="text-center">Pay Mode</th>
                                                        <th class="text-center">Amount</th>
                                                        <th class="text-center">Cancel</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="" id="pay_list">

                                                </tbody>
                                            </table>
                                        </div>
                                        <div class=" row">
                                            <div class="col-md-12 ">
                                                <label for="" class="input-names">Tender</label>
                                                <input type="text" class="form-control" id="tender" name="tender">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="" class="input-names">Return</label>
                                                <input type="text" class="form-control" id="return" name="return" readonly>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="" class="input-names">Due</label>
                                                <input type="text" class="form-control" id="due" name="due" readonly>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="" class="input-names">Approved By</label>
                                                <input type="text" class="form-control" id="" name="approver" value="{{ Auth::user()->name }}" readonly>
                                            </div>
                                            <div class="col-md-12">
                                                <label for="" class="input-names">Remarks</label>
                                                <input type="text" class="form-control" id="remark" name="remarks">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!-- Modal Footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" style="background-color:rgb( 255, 128, 128);" id="CancelForm" data-dismiss="modal">Cancel</button>
                                <button type="submit" id="saveOnly" style="background-color:#66ddaa;" class="btn btn-primary submitBtn">Save</button>
                                {{-- {# <button type="submit" id="submitForm"   class="btn primary-button ">Save & Print</button> #} --}}
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script src="{{ asset('assets/backend/js/sales.js') }}"></script>
@endsection
