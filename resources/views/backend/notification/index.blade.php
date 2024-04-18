@extends('backend.layouts.master')
@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-header">
            <div class="float-right">
                <a href="{{ route('announcement.create') }}" class="btn btn-info btn-rounded btn-fw">Add New</a>
            </div>
        </div>
        <div class="card-body">
            <p>Announcements</p>
            <div class="table-responsive table-sm">
                <table id="DataTable" class="table table-striped table-bordered table-sm">
                    <thead>
                        <tr>
                            <th class="col-1">Sn</th>
                            <th class="col-4">Title</th>
                            <th class="col-5">Description</th>
                            <th class="col-1">Publish Date</th>
                            <th class="col-1">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($announcements as $announcement)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td class="py-1">{{ $announcement->title }}</td>
                            <td>{!! Str::limit(($announcement->description), 50) !!}</td>
                            <td>{{ $announcement->is_published == 0 ? 'Not Published' : $announcement->publish_date }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a href="{{ route('announcement.edit',$announcement->id) }}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
                                    @if ($announcement->is_published == 0)

                                    <a href="#" class="btn btn-warning btn-sm publish-announcement" data-id="{{ $announcement->id }}">
                                        <i class="fas fa-check-circle text-red"></i> <!-- Publish Icon -->
                                    </a>
                                    @endif

                                    <form class="form-inline" method="post" action="{{ route('announcement.destroy',$announcement->id) }}" onsubmit="return confirm('Are you sure you want to delete this?')">
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
