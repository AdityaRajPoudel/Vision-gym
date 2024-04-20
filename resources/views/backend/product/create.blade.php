@extends('backend.layouts.master')

@section('content')
<div class="col-12 ">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Product Create</h4>
            <form action="{{ route('product.store') }}" id="product_form" class="forms-sample" method="post">
                @csrf
                <div class="row">
                    <div class="card col-md-12">
                        <div class="card-header">
                            <label for="">Product Detail</label>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-2">
                                    <label for="">Code <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-sm border-dark" readonly id="" name="product_code" value="{{ $productCode }}" placeholder="">
                                </div>
                                <div class="form-group col-4">
                                    <label for="">Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-sm border-dark" id="" name="name" value="" placeholder="">
                                </div>
                                <div class="form-group col-2">
                                    <label for="">Brand <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-sm border-dark" id="" name="brand" value="" placeholder="">
                                </div>
                                <div class="form-group col-2">
                                    <label for="">Cost Price<span class="text-danger">*</span></label>
                                    <input type="number" class="form-control form-control-sm border-dark" id="cost_per_item" name="cost_price" value="" placeholder="">
                                </div>
                                <div class="form-group col-2">
                                    <label for="">Selling Price</label>
                                    <input type="text"  class="form-control form-control-sm border-dark" id="selling_price" name="selling_price" value="" placeholder="">
                                </div>
                                <div class="form-group col-4">
                                    <label for="">Vendor <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-sm border-dark" id="" name="vendor_name" value="" placeholder="">
                                </div>
                                <div class="form-group col-4">
                                    <label for="">Vendor Address </label>
                                    <input type="text" class="form-control form-control-sm border-dark" id="" name="vendor_address" value="" placeholder="">
                                </div>
                                <div class="form-group col-12">
                                    <label for="exampleTextarea1">Product Description </label>
                                    <textarea class="form-control border-dark" name="description" id="exampleTextarea1" rows="4"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="justify-content-around">
                                <button type="submit" class="btn btn-primary me-2">Save</button>
                                <a href="{{ route('announcement.index') }}" class="btn btn-danger ">Cancel</a>
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
<script>
    $(document).ready(function() {
        $('#product_form').validate({
            rules: {
                name: {
                    required: true
                },
                brand: {
                    required: true
                },
                cost_price: {
                    required: true,
                    number: true
                },
                vendor_name: {
                    required: true
                }
            },
            messages: {
                name: {
                    required: "Please enter a name"
                },
                brand: {
                    required: "Please enter a brand"
                },
                cost_price: {
                    required: "Please enter cost price",
                    number: "Please enter a valid number"
                },
                vendor_name: {
                    required: "Please enter vendor name"
                }
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    });
</script>
@endsection
