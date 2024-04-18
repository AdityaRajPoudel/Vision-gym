@extends('backend.layouts.master')
@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-header">
            <div class="float-right">
                <a href="{{ route('progress.create') }}" class="btn btn-info btn-rounded btn-fw">Add New</a>
            </div>
        </div>
        <div class="card-body">
            <p>Member Progress</p>
            <div class="table-responsive table-sm">
                <table id="DataTable" class="table table-striped table-bordered table-sm">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Member Code</th>
                            <th>Weight (kg)</th>
                            <th>Height (cm)</th>
                            <th>BMI</th>
                            <th>Body Fat Percentage</th>
                            <th>Muscle Mass</th>
                            <th>Target Weight (kg)</th>
                            <th>Target Date</th>
                            <th>Workout Duration (minutes)</th>
                            <th>Exercise Type</th>
                            <th>Intensity Level</th>
                            <th>Calories Burned</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($progress as $entry)
                        <tr>
                            <td>{{ $entry->date }}</td>
                            <td>{{ $entry->member->member_code }}</td>
                            <td>{{ $entry->weight }}</td>
                            <td>{{ $entry->height }}</td>
                            <td>{{ $entry->bmi }}</td>
                            <td>{{ $entry->body_fat_percentage }}</td>
                            <td>{{ $entry->muscle_mass }}</td>
                            <td>{{ $entry->target_weight }}</td>
                            <td>{{ $entry->target_date }}</td>
                            <td>{{ $entry->workout_duration }}</td>
                            <td>{{ $entry->exercise_type }}</td>
                            <td>{{ $entry->intensity_level }}</td>
                            <td>{{ $entry->calories_burned }}</td>
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
