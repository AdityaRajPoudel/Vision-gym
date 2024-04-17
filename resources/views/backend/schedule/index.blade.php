@extends('backend.layouts.master')
@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-header">
            <div class="float-right">
                <a href="{{ route('schedule.create') }}" class="btn btn-info btn-rounded btn-fw">Add New</a>
            </div>
        </div>
        <div class="card-body">
            <p>Schedule</p>
            <div class="table-responsive table-sm">
                <table id="DataTable" class="table table-striped table-bordered table-sm">
                    <thead>
                        <tr>
                            <th class="col-1">Sn</th>
                            <th class="col-2">Category</th>
                            <th class="col-2">Trainer</th>
                            <th class="col-2">Day</th>
                            <th class="col-1">Time Slot</th>
                            {{-- <th class="col-1">End Time</th> --}}
                            <th class="col-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($schedules as $schedule)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $schedule->category->name}}</td>
                            <td>{{ $schedule->trainer->user->name }}</td>
                            <td>{{ $schedule->day_of_week }}</td>
                            <td>{{ date('h:i a', strtotime($schedule->slot->start_time)).' - '. date('h:i a', strtotime($schedule->slot->end_time)) }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a href="{{ route('schedule.edit',$schedule->id) }}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>

                                    <form class="form-inline" method="post" action="{{ route('schedule.destroy',$schedule->id) }}" onsubmit="return confirm('Are you sure you want to delete this?')">
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
   
</script>
@endsection
