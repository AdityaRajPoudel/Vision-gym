@extends('backend.layouts.master')
@section('stylesheet')
@endsection
@section('content')
<div class="col-12 ">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Product Create</h4>
            <form action="{{ route('product.update',$product->id) }}" id="product_form" class="forms-sample" method="post">
                @csrf
                @method('Put')
                <div class="row">
                    <div class="card col-md-12">
                        <div class="card-header">
                            <label for="">Product Detail</label>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-2">
                                    <label for="">Code <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-sm border-dark" readonly id="" name="product_code" value="{{ $product->product_code }}" placeholder="">
                                </div>
                                <div class="form-group col-4">
                                    <label for="">Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-sm border-dark" id="" name="name" value="{{ $product->name }}" placeholder="">
                                </div>
                                <div class="form-group col-2">
                                    <label for="">Brand <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-sm border-dark" id="" name="brand" value="{{ $product->brand }}" placeholder="">
                                </div>
                                <div class="form-group col-2">
                                    <label for="">Cost Price<span class="text-danger">*</span></label>
                                    <input type="number" class="form-control form-control-sm border-dark" id="cost_per_item" name="cost_price" value="{{ $product->cost_price }}" placeholder="">
                                </div>
                                <div class="form-group col-2">
                                    <label for="">Selling Price</label>
                                    <input type="text"  class="form-control form-control-sm border-dark" id="selling_price" name="selling_price" value="{{ $product->selling_price }}" placeholder="">
                                </div>
                                <div class="form-group col-4">
                                    <label for="">Vendor <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-sm border-dark" id="" name="vendor_name" value="{{ $product->vendor_name }}" placeholder="">
                                </div>
                                <div class="form-group col-4">
                                    <label for="">Vendor Address </label>
                                    <input type="text" class="form-control form-control-sm border-dark" id="" name="vendor_address" value="{{ $product->vendor_address }}" placeholder="">
                                </div>
                                <div class="form-group col-12">
                                    <label for="exampleTextarea1">Product Description </label>
                                    <textarea class="form-control border-dark" name="description" id="exampleTextarea1" rows="4">{{ $product->description }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="justify-content-around">
                                <button type="submit" class="btn btn-primary me-2">Update</button>
                                <a href="{{ route('product.index') }}" class="btn btn-danger ">Cancel</a>
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
                }
                , brand: {
                    required: true
                }
                , purchase_date: {
                    required: true
                }
                , purchase_qty: {
                    required: true
                    , number: true
                }
                , cost_per_item: {
                    required: true
                    , number: true
                }

                , vendor_name: {
                    required: true
                }

            }

            , messages: {
                name: {
                    required: "Please enter a name"
                }
                , brand: {
                    required: "Please enter a brand"
                }
                , purchase_date: {
                    required: "Please select a purchase date"
                }
                , purchase_qty: {
                    required: "Please enter purchase quantity"
                    , number: "Please enter a valid number"
                }
                , cost_per_item: {
                    required: "Please enter cost per item"
                    , number: "Please enter a valid number"
                }

                , vendor_name: {
                    required: "Please enter vendor name"
                }

            }
            , errorElement: 'span'
            , errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            }
            , highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            }
            , unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });

        function calculateTotal() {
            var purchaseQty = $('#purchase_qty').val();
            var costPerItem = $('#cost_per_item').val();
            var total = purchaseQty * costPerItem;
            // Display the calculated total
            $('#total').val(total.toFixed(2));
        }

        // Call calculateTotal function when inputs change
        $('#purchase_qty, #cost_per_item').on('input', calculateTotal);
    });

</script>

@endsection
