$(document).ready(function () {
    $("#product_name").autocomplete({
        source: function (request, response) {
            $.getJSON("/product/autocomplete", {
                searchTerm: request.term
            }, function (data) {
                response($.map(data, function (pn) {
                    return {
                        value: pn.name,
                        id: pn.id,
                    };
                }));
            });
        },
        select: function (event, ui) {
            $('#product_name').data('id', ui.item.id);
            $(this).val(ui.item.value);
            $('#cart_qty').focus();
        }
    });

    $('#cart_qty').on('keypress', function (event) {
        if (event.which !== 13) return; // Check if the pressed key is Enter (key code 13)

        event.preventDefault();

        var cartQty = $(this).val().trim();
        var productId = $('#product_name').data('id');
        var productName = $('#product_name').val().trim();

        if (cartQty === '') {
            alert('Enter Qty');
            $('#cart_qty').focus();
            return;
        }

        if (productId === '') {
            alert('Enter Valid Product');
            $('#product_name').focus();
            return;
        }

        var url = "/sales/getProductDetail";
        $.get(url, { id: productId }, function (res) {
            var price = res['price'];
            var total = cartQty * price;

            var seq = $('.purchase-row').length + 1;
            var newRow = `<tr class="purchase-row text-center">
        <td>${seq}</td>
        <td>
            <input class="pid product" list="product-lists" value="${productName}" readonly />
            <input type="hidden" name="product_id[]" value="${productId}" class="p_id_value product">
        </td>
        <td>
            <input type="number" name="quantity[]" class="form-control qty" value="${cartQty}" min="1" required style="text-align: center;">
        </td>
        <td>
            <input class="c_price form-control" type="number" step="any" value="${price}" name="price[]" style="text-align: right" required/>
        </td>
        <td>
            <input class="total form-control" type="number" value=${total} name="item_total[]" style="text-align: right" readonly required />
        </td>
    </tr>`;
            $('#purchase_list').append(newRow);
            // vatCalc(newRow);
            sub_total();
            // tax_total();
            grand_total();
        });

        $('#cart_qty').val('');
        $('#product_name').val('');
        $('#product_name').focus();
    });
    function sub_total() {
        var total = 0;
        $('.total').each(function () {
            var sub_totalValue = parseFloat($(this).val());

            if (!isNaN(sub_totalValue)) {
                total += sub_totalValue;
            }
        });

        $('#sub_total').val(total.toFixed(2));
        $('#total').val(total.toFixed(2));
        // grand_total();
    }
    function grand_total() {
        var subTotal = parseFloat($('#sub_total').val());
        var grandTotal = subTotal;
        var fixedGrandTotal = grandTotal.toFixed(2);

        $('#grandTotal').val(fixedGrandTotal);
    }

    $('#pay').on('click', function (event) {
        event.preventDefault();
        var seq = $('.paymode-row').length;
        if(seq ===0 ){
            appendCash();
        }
        var subTotal = parseFloat($('#sub_total').val());
        var grandTotal = parseFloat($('#grandTotal').val());
        var discount = parseFloat($('#discount_amt').val());

        if (!grandTotal) {
            alert('There is no item in the list to perform this action');
            $('#myModal').modal('hide');
            $('#product_name').focus();
        } else {
            $('#myModal').modal('show');
            $('#pay_mode_subtotal').text(subTotal);
            $('#pay_mode_discount').text(discount);
            $('#pay_mode_grandTotal').text(grandTotal);

            var tr = $('#pay_list').children('tr:last');
            tr.find('.amount').text(grandTotal);
        }
    });

    function appendCash() {
        var payMode = 0; // Initialize payMode outside the loop
        $('#pay_mode option').each(function() {
            if ($(this).text() === 'Cash') {
                payMode = $(this).text(); // Update the outer payMode variable
            }
        });
        var grandTotal = $('#grandTotal').val();

        var newRow = `<tr class="paymode-row">
                        <td class="text-center"><input name="pay_modes[]" type="hidden" class="" value="${payMode}" />${payMode}</td>
                        <td class="text-center"><input name="pay_amount[]" type="hidden" class="paymodeAmt" value="${grandTotal}" />${grandTotal}</td>
                        <td class="text-center"><i class="fas fa-trash text-danger remove_item"></i></td>
                    </tr>`;

        $('#pay_list').append(newRow);
    }

    $('#myModal').on('shown.bs.modal', function () {
        let grandTotal = parseFloat($('#grandTotal').val());
        let $inputAmount = $('#input_amount');

        if ($inputAmount.length) {
            $inputAmount.val('0').focus().select();
        } else {
            console.error('Element with ID input_amount not found');
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
        var grandTotal = parseFloat($('#grandTotal').val());
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
    $('#pay_mode').on('change', function(event) {
        var payMode = $(this).find('option:selected').text();
        if (payMode != 'Cash') {
            $('#tender').prop('disabled', true);
            $('#return').prop('disabled', true);
            $('#due').prop('disabled', true);
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
    $('#pay_list').on('click', '.remove_item', function() {
        if (confirm('Are you sure you want to remove this item?')) {
            $(this).closest('tr').remove();

            var grandTotal =  parseFloat($('#grandTotal').val());
            var paidAmt = pay_total();
            $('#addPayment').show();
            $('input[name="amount"]').val(grandTotal - paidAmt);
            $('#pay_mode').prop('disabled', false);
            $('input[name="amount"]').prop('disabled', false);
        }
    });

   
    $('#tender').on('keyup change', function() {
        var tender = parseFloat($(this).val());
        var grandTotal = parseFloat($('#grandTotal').val());

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

    const subTotalInput = document.getElementById('sub_total');
    const discountPercentageInput = document.getElementById('discountPer');
    const discountAmountInput = document.getElementById('discountAmount');
    const discountAmountDisplay = document.getElementById('discount_amt');
    const totalInput = document.getElementById('total');
    const grandTotalInput = document.getElementById('grandTotal');

    // Calculate discount amount and update display
    function calculateDiscountAmount() {
        const subTotal = parseFloat(subTotalInput.value);
        const discountPercentage = parseFloat(discountPercentageInput.value);
        const discountAmount = parseFloat(discountAmountInput.value);

        // Calculate discount amount based on percentage or fixed amount
        let calculatedDiscountAmount = 0;
        if (!isNaN(discountPercentage)) {
            calculatedDiscountAmount = (subTotal * discountPercentage) / 100;
        } else if (!isNaN(discountAmount)) {
            calculatedDiscountAmount = discountAmount;
        }

        discountAmountDisplay.value = calculatedDiscountAmount.toFixed(2);
    }

    // Update total and grand total based on discount
    function updateTotals() {
        const subTotal = parseFloat(subTotalInput.value);
        const discountAmount = parseFloat(discountAmountDisplay.value);

        const total = subTotal - discountAmount;
        const grandTotal = total; // You may add tax or other charges here if needed

        totalInput.value = total.toFixed(2);
        grandTotalInput.value = grandTotal.toFixed(2);
    }

    // Event listeners for input changes
    discountPercentageInput.addEventListener('input', () => {
        calculateDiscountAmount();
        updateTotals();
    });

    discountAmountInput.addEventListener('input', () => {
        calculateDiscountAmount();
        updateTotals();
    });

    // Initial calculations
    calculateDiscountAmount();
    updateTotals();
});