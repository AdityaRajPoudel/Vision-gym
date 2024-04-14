@extends('backend.layouts.master')
@section('stylesheet')
<style>
    .custom-modal {
        max-width: 1000px;
        /* Adjust this value to your desired width */
        margin-left: 200px;
        background-color: #dc7633;
    }

    .vertical-line {
        border-left: 1px solid black;
        height: 100px;
        /* Set the height as per your requirement */
        margin: 0 auto;
        /* Centers the line */
    }

    .custom-modal .modal-content {
        background-color: #F8F9F9;
        /* Your desired background color */
    }

    #PayDetail th {
        background-color: rgb(255, 128, 128);
        /* Table header background color */
        color: white;
        /* Table header text color */
        text-align: center;
        /* Align text in headers to the center */
        /* Add any other styles you want for the table header */
    }

    #PayDetail tr:nth-child(odd) td {
        background-color: #ECECC2;
        /* Set background color for odd rows */
        color: #333;
        /* Set text color for odd rows */
    }

    #PayDetail tr:nth-child(even) td {
        background-color: #FFFFFF;
        /* Set background color for even rows */
        color: #333;
        /* Set text color for even rows */
    }

    .table-container {
        height: 270px;
        overflow-y: auto;
        /* This enables vertical scrolling */
    }

    .table-body {
        width: 100%;
        /* Ensure the table takes up the entire width */
        /* Other styles for table appearance */
    }

    .right-aligned {
        display: flex;
        justify-content: space-between;
        color: rgb(255, 128, 128);
    }

    .Pay_total {
        color: rgb(255, 128, 128) !important;
        font-size: 18px !important;
        /* You can adjust the font size as needed */
        font-weight: bold !important;
    }

    .amount-cal {
        color: rgb(255, 128, 128) !important;
        font-size: 14px !important;
        /* You can adjust the font size as needed */
    }

    .input-names {
        color: blue !important;
    }

    /* Example custom styles */
    .btn-cart {
        border-radius: 0;
        /* Remove button border-radius if needed */
    }

</style>
@endsection
@section('content')
<div class="col-12 ">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Member Create</h4>
            <form action="{{ route('member.store') }}" id="member_form" class="forms-sample" method="post">
                @csrf
                <div class="row">
                    <div class="card col-md-6">
                        <div class="card-header">
                            <label for="">Member Personal Detail</label>
                        </div>
                        <div class="card-body">
                            <div class="row">

                                <div class="form-group col-12">
                                    <label for="">Member Code</label>
                                    <input type="text" class="form-control form-control-sm border-dark" id="" name="member_code" value="{{ $memberCode }}" readonly placeholder="">
                                </div>
                                <div class="form-group col-12">
                                    <label for="">Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-sm border-dark" id="" name="name" placeholder="Name">
                                </div>
                                <div class="form-group col-12">
                                    <label for="">Email address <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control form-control-sm border-dark" id="" name="email" placeholder="Email">
                                </div>
                                <div class="form-group col-6">
                                    <label for="">Password <span class="text-danger">*</span></label>
                                    <input type="password" class="form-control form-control-sm border-dark" id="" name="password" placeholder="Password">
                                </div>
                                <div class="form-group col-6">
                                    <label>Gender <span class="text-danger">*</span></label>
                                    <div class="rounded ">
                                        <div class="d-flex row ml-1 mt-1">
                                            <div class="col">
                                                <input type="radio" id="male" name="gender" checked value="1">
                                                <label for="single">Male</label>
                                            </div>
                                            <div class="col">
                                                <input type="radio" id="female" name="gender" value="0">
                                                <label for="gender">Female</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="">Contact <span class="text-danger">*</span></label>
                                    <input type="text" name="contact" class="form-control form-control-sm border-dark" id="" placeholder="Mobile Number">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="">Address <span class="text-danger">*</span></label>
                                    <input type="text" name="address" class="form-control form-control-sm border-dark" id="" placeholder="Location">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="">Age (min 15 yrs) <span class="text-danger">*</span></label>
                                    <input type="number" name="age" class="form-control form-control-sm border-dark" value="15" min="15" id="nepali-datepier" placeholder="">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="">Current Weight (kg) </label>
                                    <div class="input-group">
                                        <input type="number" name="current_weight" id="" class="form-control form-control-sm border-dark" value="0" min="0">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="card col-md-6">
                        <div class="card-header">
                            <label for="">Package Detail</label>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-8">
                                    <label for="">Gym Time (6:00 am to 8:00 pm) <span class="text-danger">*</span></label>
                                    <input type="time" name="gym_time" class="form-control form-control-sm" min="06:00" max="20:00">
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="">Plans <span class="text-danger">*</span></label>
                                    <select name="plan_id" id="plan" class="form-control form-control-sm border-dark">
                                        <option value="">--Select Plan--</option>
                                        <option value="3">3 Months</option>
                                        <option value="6">6 Months</option>
                                        <option value="12">1 year</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="">Date Of Registration <span class="text-danger">*</span></label>
                                    <input type="date" name="date_of_register" id="date_of_register" value="{{ date('Y-m-d') }}" class="form-control form-control-sm border-dark" placeholder="">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="">Expire Date</label>
                                    <input type="date" name="expire_date" id="expire_date" class="form-control form-control-sm border-dark" placeholder="" readonly>
                                </div>


                                <div class="form-group col-md-8 text-center">
                                    <label for="" class="text-primary">Services <span class="text-danger">*</span></label>
                                    @foreach ($fitness_categories as $category)
                                    <div class="d-flex justify-content-around">
                                        <label for="{{ $category->id }}" class="text-primary">{{ $category->name }}</label>
                                        <input type="radio" name="selected_category" id="{{ $category->id }}" value="{{ $category->id }}" data-price="{{ $category->price }}">
                                        <label for="{{ $category->id }}" class="text-primary">Nrs
                                            {{ $category->price }}/ Per Month</label>
                                    </div>
                                    @endforeach
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="">Discount </label>
                                    <div class="input-group">
                                        <input type="number" name="discount" id="discount" class="form-control border-dark form-control-sm" value="0" min="0" aria-label="Amount (to the nearest dollar)">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text text-primary">%</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="">Total </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text text-primary">Rs</span>
                                        </div>
                                        <input type="text" name="total" id="total" value="00.00" class="form-control border-dark form-control-sm" readonly aria-label="Amount (to the nearest dollar)">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="form-group">
                        <label for="exampleTextarea1">Discription</label>
                        <textarea class="form-control border-dark" name="description" id="exampleTextarea1" rows="4"></textarea>
                    </div>
                    {{-- <button type="submit" class="btn btn-primary me-2">Pay</button> --}}
                    <a href="#" class="btn btn-primary font-weight-bolder" id="pay">
                        <i class="fas fa-money-bill"></i>Pay
                    </a>
                    <button class="btn btn-light">Cancel</button>
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
<script>

    function calculateTotal() {
        var plan = parseFloat(document.getElementById('plan').value);
        var servicePrice = 0;
        var radios = document.getElementsByName('selected_category');

        for (var i = 0; i < radios.length; i++) {
            if (radios[i].checked) {
                servicePrice = parseFloat(radios[i].getAttribute('data-price'));
                break;
            }
        }

        var discount = parseFloat(document.getElementById('discount').value);
        var total = (plan * servicePrice) - (plan * servicePrice * (discount / 100));
        document.getElementById('total').value = total.toFixed(2);
    }

    function calculateSubTotal() {
        var plan = parseFloat(document.getElementById('plan').value);
        var servicePrice = 0;
        var radios = document.getElementsByName('selected_category');
        for (var i = 0; i < radios.length; i++) {
            if (radios[i].checked) {
                servicePrice = parseFloat(radios[i].getAttribute('data-price'));
                break;
            }
        }
        var discount = parseFloat(document.getElementById('discount').value);
        var subTotal = (plan * servicePrice);
        var grandTotal = (plan * servicePrice) - (plan * servicePrice * (discount / 100));

        $('#pay_mode_subtotal').text(subTotal);
        $('#pay_mode_discount').text(discount);
        $('#pay_mode_grandTotal').text(grandTotal);
    }

    function calculateGrandTotal() {
        var GrandTotal = 0;
        var plan = parseFloat(document.getElementById('plan').value);
        var servicePrice = 0;
        var radios = document.getElementsByName('selected_category');
        for (var i = 0; i < radios.length; i++) {
            if (radios[i].checked) {
                servicePrice = parseFloat(radios[i].getAttribute('data-price'));
                break;
            }
        }
        var discount = parseFloat(document.getElementById('discount').value);
        var GrandTotal = (plan * servicePrice) - (plan * servicePrice * (discount / 100));
        return GrandTotal;
    }

    document.getElementById('plan').addEventListener('change', calculateTotal);
    var radios = document.getElementsByName('selected_category');
    for (var i = 0; i < radios.length; i++) {
        radios[i].addEventListener('change', calculateTotal);
    }
    document.getElementById('discount').addEventListener('input', calculateTotal);
    calculateTotal();

    $('#myModal').on('shown.bs.modal', function() {
        let grandTotal = parseFloat($('#grandTotal').val());
        let $inputAmount = $('#input_amount');

        if ($inputAmount.length) {
            $inputAmount.val('0').focus().select();
        } else {
            console.error('Element with ID input_amount not found');
        }
    });


    function appendCash() {
        var payMode = 0; // Initialize payMode outside the loop
        $('#pay_mode option').each(function() {
            if ($(this).text() === 'Cash') {
                payMode = $(this).text(); // Update the outer payMode variable
            }
        });
        var grandTotal = calculateGrandTotal();

        var newRow = `<tr class="paymode-row">
                        <td class="text-center"><input name="pay_modes[]" type="hidden" class="" value="${payMode}" />${payMode}</td>
                        <td class="text-center"><input name="pay_amount[]" type="hidden" class="paymodeAmt" value="${grandTotal}" />${grandTotal}</td>
                        <td class="text-center"><i class="fas fa-trash text-danger remove_item"></i></td>
                    </tr>`;

        $('#pay_list').append(newRow);
    }

    $('#pay').on('click', function(event) {
        event.preventDefault();

        if ($("#member_form").valid()) {

            // If form is valid, open the modal
            $("#myModal").modal("show");

            var seq = $('.paymode-row').length;
            if (seq === 0) {
                appendCash();
            }
            grandTotal = 100;
            $('#addPayment').hide();

        }
    });

    $('#CancelForm').on('click', function(event) {
        event.preventDefault();
        $('input[name="amount"]').val('');
        $('.paymode-row:last').remove();
        $('#myModal').modal('hide');

    });

    $('#addPayment').on('click', function(event) {
        event.preventDefault();

        var payMode = $('#pay_mode option:selected').text();
        var grandTotal = calculateGrandTotal();
        var amount = parseFloat($('input[name="amount"]').val()).toFixed(2);

        // Append a new row with selected pay mode and amount
        var newRow = `<tr class="paymode-row">
                    <td class="text-center"><input name="pay_modes[]" type="hidden" class="" value="${payMode} "/>${payMode} </td>
                    <td class="text-center"><input name="pay_amount[]" type="hidden" class="paymodeAmt" value="${amount} "/>${amount} </td>
                    <td class="text-center "><i class="fas fa-trash text-danger remove_item"></i></td>
                    </tr>`;
        $('#pay_list').append(newRow);

        var paidAmt = pay_total();

        if (grandTotal === paidAmt) {
            $('input[name="amount"]').val(grandTotal - paidAmt);
            $('#pay_mode').prop('disabled', true);
            $('input[name="amount"]').prop('disabled', true);
            $('#addPayment').hide();
        } else {
            $('input[name="amount"]').val(grandTotal - paidAmt);
            $('#pay_mode').val('');

        }
    });
    $('#pay_list').on('click', '.remove_item', function() {
        if (confirm('Are you sure you want to remove this item?')) {
            $(this).closest('tr').remove();

            var grandTotal = calculateGrandTotal();
            var paidAmt = pay_total();
            $('#addPayment').show();
            $('input[name="amount"]').val(grandTotal - paidAmt);
            $('#pay_mode').prop('disabled', false);
            $('input[name="amount"]').prop('disabled', false);
        }
    });

    $('#tender').on('keyup change', function() {
        var tender = parseFloat($(this).val());
        var grandTotal = calculateGrandTotal();

        if (isNaN(tender)) {
            alert('Please enter a numeric value for tender.');
            $(this).val('');
            return;
        } else {
            if (tender > grandTotal) {
                $('#return').val(tender - grandTotal);
                $('#due').val('00');
            } else {
                $('#due').val(grandTotal - tender);
                $('#return').val('00');

            }
        }
    });

    function pay_total() {
        var total = 0;
        $('.paymodeAmt').each(function() {
            var sub_totalValue = parseFloat($(this).val());

            if (!isNaN(sub_totalValue)) {
                total += sub_totalValue;
            }
        });
        return total;
    }
    $('#pay_mode').on('change', function(event) {
        var payMode = $(this).find('option:selected').text();
        if (payMode != 'Cash') {
            $('#tender').prop('disabled', true);
            $('#return').prop('disabled', true);
            $('#due').prop('disabled', true);
        }
    });

    $(document).ready(function() {
        $('#plan, #date_of_register').change(function() {
            var plan = $('#plan').val();
            var dateOfRegister = $('#date_of_register').val();
            if (plan && dateOfRegister) {
                var registrationDate = new Date(dateOfRegister);
                var expireDate = new Date(registrationDate);
                if (plan == '3') {
                    expireDate.setMonth(expireDate.getMonth() + 3);
                } else if (plan == '6') {
                    expireDate.setMonth(expireDate.getMonth() + 6);
                } else if (plan == '12') {
                    expireDate.setFullYear(expireDate.getFullYear() + 1);
                }
                $('#expire_date').val(expireDate.toISOString().substr(0, 10));
            }
        });
    });

</script>
<script>
    $(document).ready(function() {
        // Add form validation rules
        $("#member_form").validate({
            rules: {
                name: "required"
                , email: {
                    required: true
                    , email: true
                }
                , password: "required"
                , gender: "required"
                , contact: "required"
                , address: "required"
                , age: {
                    required: true
                    , min: 15
                }
                , plan_id: "required"
                , gym_time: "required"
                , date_of_register: "required"
                , selected_category: "required"
                , discount: {
                    required: true
                    , min: 0
                }
            }
            , messages: {
                name: "Please enter your name"
                , email: {
                    required: "Please enter your email address"
                    , email: "Please enter a valid email address"
                }
                , password: "Please enter a password"
                , gender: "Please select your gender"
                , contact: "Please enter your contact number"
                , address: "Please enter your address"
                , age: {
                    required: "Please enter your age"
                    , min: "Minimum age must be 15"
                }
                , plan_id: "Please select a plan"
                , gym_time: "Please select gym time"
                , date_of_register: "Please select date of registration"
                , selected_category: "Please select a service"
                , discount: {
                    required: "Please enter discount"
                    , min: "Discount cannot be negative"
                }
            }
            , errorElement: "span"
            , errorPlacement: function(error, element) {
                error.addClass("invalid-feedback");
                element.closest(".form-group").append(error);
            }
            , highlight: function(element, errorClass, validClass) {
                $(element).addClass("is-invalid").removeClass("is-valid");
            }
            , unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass("is-invalid").addClass("is-valid");
            }
        });
    });

</script>
@endsection
