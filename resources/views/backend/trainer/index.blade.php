@extends('backend.layouts.master')
@section('stylesheet')
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endsection
@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-header">
            <div class="float-right">
                <a href="{{ route('trainer.create') }}" class="btn btn-info btn-rounded btn-fw">Add New</a>
            </div>
        </div>
        <div class="card-body">
            <p>Trainers</p>
            <div class="table-responsive table-sm">
                <table id="DataTable" class="table table-striped table-bordered table-sm">
                    <thead>
                        <tr>
                            <th class="col-1">Trainer Code</th>
                            <th class="col-2">Name</th>
                            <th class="col-1">Gender</th>
                            <th class="col-2">Contact</th>
                            <th class="col-3">Address</th>
                            <th class="col-1">Join Date</th>
                            <th class="col-1">Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($trainers as $trainer)
                        <tr>
                            <td class="py-1">
                                {{ $trainer->trainer_code }}
                            </td>
                            <td>
                                {{$trainer->user->name ?? 'User Not Available' }}
                            </td>
                            <td>
                                {{ $trainer->gender == 1 ? 'Male':'Female' }}
                            </td>
                            <td>
                                {{ $trainer->contact }}
                            </td>
                            <td>
                                {{ $trainer->address }}
                            </td>
                            <td>
                                {{ $trainer->join_date }}
                            </td>
                            <td>
                                <input type="checkbox" id="status-toggle-{{ $trainer->id }}" class="status-toggle" {{ $trainer->status == 1 ? 'checked' : '' }} data-trainer-id="{{ $trainer->id }}" data-toggle="toggle" data-on="Active" data-off="Inactive" data-onstyle="success" data-offstyle="danger">
                            </td>                            
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a href="{{ route('trainer.edit',$trainer->id) }}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
                                    <form class="form-inline" method="post" action="{{ route('trainer.destroy',$trainer->id) }}" onsubmit="return confirm('Are you sure you want to delete this?')">
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
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script>
    $(document).ready(function() {
        $('.status-toggle').change(function() {
            var trainerId = $(this).data('trainer-id');
            var status = $(this).prop('checked') ? 1 : 0;

            $.ajax({
                url: '/trainer/stauts',
                type: 'POST',
                data: {
                    trainer_id: trainerId,
                    status: status,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    toastr.success(response.message);
                },
                error: function(xhr) {
                    // Handle error response
                    console.log(xhr.responseText);
                }
            });
        });
    });
</script>
@endsection
