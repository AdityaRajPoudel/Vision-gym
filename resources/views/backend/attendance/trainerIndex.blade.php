@extends('backend.layouts.master')
@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <p>Trainer Attendance</p>
            <div class="table-responsive table-sm">
                <table id="DataTable" class="table table-striped table-bordered table-sm">
                    <thead>
                        <tr>
                            <th class="col-1">Trainer Code</th>
                            <th class="col-2">Name</th>
                            <th class="col-1">Gender</th>
                            <th class="col-1">Check In Time</th>
                            <th class="col-1">Check Out Time</th>
                            <th class="col-2">Attendance</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($attendances as $attendance)
                        <tr>
                            <td>{{ $attendance->trainer->trainer_code }}</td>
                            <td>{{ $attendance->trainer->user->name }}</td>
                            <td>{{ $attendance->trainer->gender == 1 ? 'Male':'Female' }}</td>
                            <td> @if ($attendance->check_in_time !=null )
                                {{ \Carbon\Carbon::createFromTimeString($attendance->check_in_time)->format('h:i:s A') }}
                                @else
                                Not Checked In
                                @endif</td>
                            <td> @if ($attendance->check_out_time !=null )
                                {{ \Carbon\Carbon::createFromTimeString($attendance->check_in_time)->format('h:i:s A') }}
                                @else
                                Not Checked Out
                                @endif</td>
                            <td>
                                @if ($attendance->check_in_time == null )
                                <button class="btn btn-primary btn-check-in" data-member-id="{{ $attendance->id }}">Check In <i class="fas fa-check-circle text-white"></i></button>
                                @elseif ($attendance->check_out_time==null)
                                <button class="btn btn-danger btn-check-out" data-member-id="{{ $attendance->id }}">Check Out <i class="fas fa-times-circle text-white"></i></button>
                                @else
                                <button class="btn btn-success" data-member-id="">Completed <i class="fas fa-check-circle text-white"></i></button>
                                @endif
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
<script>
    $(document).ready(function() {
        $('.btn-check-in').click(function() {
            var trainerId = $(this).data('member-id');
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            var checkInButton = $(this);
            $.ajax({
                url: '{{ route("trainer.attendance.check-in") }}', // Wrap route() function in quotes
                method: 'POST', // Add a comma to separate attributes
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
                , data: {
                    trainerId: trainerId
                }
                , success: function(response) {
                    if (response.success) {
                        toastr.success(response.message); // Display success message
                        setTimeout(function() {
                            window.location.reload();
                        }, 1000);
                    } else {
                        toastr.error(response.message); // Display error message
                    }
                }
                , error: function(xhr, status, error) {
                    if (xhr.status === 404) {
                        toastr.error('Member not found.'); // Display 404 message
                    } else if (xhr.status === 400) {
                        toastr.error('Attendance already exists for today.'); // Display 400 message
                    } else {
                        console.error(error);
                        toastr.error('An error occurred while processing the request.'); // Display generic error message
                    }
                }
            });

        });

        $('.btn-check-out').click(function() {
            var memberId = $(this).data('member-id');
            // Obtain CSRF token value from meta tag
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            // AJAX request to check-out
            $.ajax({
                url: '{{ route('trainer.attendance.check-out') }}'
                , method: 'POST'
                , headers: {
                    'X-CSRF-TOKEN': csrfToken // Include CSRF token in headers
                }
                , data: {
                    memberId: memberId
                }
                , success: function(response) {
                    if (response.success) {
                        toastr.success(response.message); // Display success message
                        setTimeout(function() {
                            window.location.reload();
                        }, 1000);
                    } else {
                        toastr.error(response.message); // Display error message
                    }
                }
                , error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });
    });

</script>
@endsection
