@extends('backend.layouts.master')
@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-header">
            <div class="float-right">
                <a href="{{ route('product.create') }}" class="btn btn-info btn-rounded btn-fw">Add New</a>
            </div>
        </div>
        <div class="card-body">
            <p>Products</p>
            <div class="table-responsive table-sm">
                <table id="DataTable" class="table table-striped table-bordered table-sm">
                    <thead>
                        <tr>
                            <th class="col-1">Sn</th>
                            <th class="col-2">Name</th>
                            <th class="col-1">Brand</th>
                            <th class="col-2">Vendor</th>
                            {{-- <th class="col-1">Quantity</th>
                            <th class="col-1">Purchase Date</th>
                            <th class="col-1">Cost Per Item</th>
                            <th class="col-1">Total</th> --}}
                            <th class="col-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td class="py-1">{{ $product->name }}</td>
                            <td>{{ $product->brand }}</td>
                            <td>{{ $product->vendor_name }}</td>
                            {{-- <td>{{ $product->purchase_qty }}</td>
                            <td>{{ $product->purchase_date }}</td>
                            <td>{{ $product->cost_per_item }}</td>
                            <td>{{ $product->total }}</td> --}}
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a href="{{ route('product.edit',$product->id) }}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
                                    <form class="form-inline" method="post" action="{{ route('product.destroy',$product->id) }}" onsubmit="return confirm('Are you sure you want to delete this?')">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="id" value="{{ $product->id }}">
                                        <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash text-white"></i></button>
                                    </form>
                                </div>
                            </td>
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
    $(document).ready(function() {
        $('.publish-announcement').on('click', function(e) {
            e.preventDefault();
            var announcementId = $(this).data('id');

            $.ajax({
                url: "{{ route('announcement.publish') }}"
                , type: 'POST'
                , data: {
                    id: announcementId
                    , _token: "{{ csrf_token() }}"
                }
                , success: function(response) {
                    // Display toastr success message
                    toastr.success('Announcement published successfully.');

                    // Reload the page after 1 second
                    setTimeout(function() {
                        window.location.reload();
                    }, 1000);
                }
                , error: function(xhr, status, error) {
                    // Handle error response
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>


@endsection
