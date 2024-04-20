@extends('backend.layouts.master')
@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-header">
            <div class="float-right">
                <a href="{{ route('sales.create') }}" class="btn btn-info btn-rounded btn-fw">Add Sales</a>
            </div>
        </div>
        <div class="card-body">
            <p>Sales</p>
            <div class="table-responsive table-sm">
                <table id="DataTable" class="table table-striped table-bordered table-sm">
                    <thead>
                        <tr>
                            <th>Bill Number</th>
                            <th>Sales Date</th>
                            <th>Subtotal</th>
                            <th>Discount Percentage</th>
                            <th>Discount Amount</th>
                            <th>Total</th>
                            <th>Grand Total</th>
                            <th>Remarks</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sales as $sale)
                        <tr>
                            <td>{{ $sale->bill_no }}</td>
                            <td>{{ $sale->sales_date }}</td>
                            <td>{{ $sale->subtotal }}</td>
                            <td>{{ $sale->discount_percentage }}</td>
                            <td>{{ $sale->discount_amount }}</td>
                            <td>{{ $sale->total }}</td>
                            <td>{{ $sale->grand_total }}</td>
                            <td>{{ $sale->remarks }}</td>
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
