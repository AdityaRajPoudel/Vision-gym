@extends('backend.layouts.master')
@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-header">
            <div class="float-right">
                <a href="{{ route('purchase.create') }}" class="btn btn-info btn-rounded btn-fw">Add Purchase</a>
            </div>
        </div>
        <div class="card-body">
            <p>Purchase</p>
            <div class="table-responsive table-sm">
                <table id="DataTable" class="table table-striped table-bordered table-sm">
                    <thead>
                        <tr>
                            <th>Invoice Number</th>
                            <th>Purchase Date</th>
                            <th>Subtotal</th>
                            <th>Discount Percentage</th>
                            <th>Discount Amount</th>
                            <th>Total</th>
                            <th>Grand Total</th>
                            <th>Remarks</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($purchases as $purchase)
                        <tr>
                            <td>{{ $purchase->invoice_no }}</td>
                            <td>{{ $purchase->purchase_date }}</td>
                            <td>{{ $purchase->subtotal }}</td>
                            <td>{{ $purchase->discount_percentage }}</td>
                            <td>{{ $purchase->discount_amount }}</td>
                            <td>{{ $purchase->total }}</td>
                            <td>{{ $purchase->grand_total }}</td>
                            <td>{{ $purchase->remarks }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
</script>
@endsection
