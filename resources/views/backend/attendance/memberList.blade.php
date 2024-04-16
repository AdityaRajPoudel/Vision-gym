@extends('backend.layouts.master')
@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <p>Member Attendance</p>
            <div class="table-responsive table-sm">
                <table id="DataTable" class="table table-striped table-bordered table-sm">
                    <thead>
                        <tr>
                            <th class="col-1">Member Code</th>
                            <th class="col-2">Name</th>
                            <th class="col-1">Gender</th>
                            <th class="col-1">Plan</th>
                            <th class="col-2">Attendance Days</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($members as $member)
                        <tr>
                            <td>{{ $member->member_code }}</td>
                            <td>{{ $member->name }}</td>
                            <td>{{ $member->gender == 1 ? 'Male':'Female' }}</td>
                            <td>{{ $member->plan }} Months</td>
                            <td>{{ $member->attendance_count }}</td>
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
            var memberId = $(this).data('member-id');
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            var checkInButton = $(this);
            $.ajax({
                url: 'attendance/check-in'
                , method: 'POST'
                , headers: {
                    'X-CSRF-TOKEN': csrfToken
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
                url: 'attendance/check-out'
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
