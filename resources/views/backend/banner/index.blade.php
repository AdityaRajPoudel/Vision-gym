@extends('backend.layouts.master')
@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-header">
            <div class="float-right">
                <a href="{{ route('banners.create') }}" class="btn btn-info btn-rounded btn-fw">Add New</a>
            </div>
        </div>
        <div class="card-body">
            <p>Banners</p>
            <div class="table-responsive table-sm">
                <table id="DataTable" class="table table-striped table-bordered table-sm">
                    <thead>
                        <tr>
                            <th scope="col-1">S.N</th>
                            <th scope="col-4">Title</th>
                            <th scope="col-3">Image</th>
                            <th scope="col-2">Order</th>
                            <th scope="col-2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($banners as $key => $value)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td style="max-width:100px;word-wrap:break-word;">{{$value->banner_title}}</td>
                            <td  style="max-width:100px;word-wrap:break-word;"><img src="/storage/banner-image/{{ $value->banner_image }}" width="100" height="50"></td>
                            <td>{{ $value->banner_order }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a href="{{ route('banners.edit',$value->id) }}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
                                    <form class="form-inline" method="post" action="{{ route('banners.destroy', $value->id) }}" onsubmit="return confirm('Are you sure you want to delete this?')">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="id" value="">
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

    });

</script>


@endsection
