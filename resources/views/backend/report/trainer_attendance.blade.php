@extends('backend.layouts.master')
@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-header">
            <form action="{{ route('trainer.report') }}" enctype="" method="post">
                @csrf
                <div class="row p-0">
                    <div class="col-md-4">
                        <label for="">Trainer</label>
                        <select name="trainer_id" id="" class="form-control form-control-sm border-dark">
                            <option value="">--select trainer--</option>
                            @foreach ($trainers as $trainer)
                            <option value="{{ $trainer->id }}" {{ $trainer->id == $trainerId ? 'selected':'' }}>{{ $trainer->user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <?php
                    $months = [
                        1 => "January",
                        2 => "February",
                        3 => "March",
                        4 => "April",
                        5 => "May",
                        6 => "June",
                        7 => "July",
                        8 => "August",
                        9 => "September",
                        10 => "October",
                        11 => "November",
                        12 => "December"
                    ];
                    ?>
                    <div class="col-md-2">
                        <label for="month_id">Year</label>
                        <input type="text" name="year" value="{{ date('Y') }}" class="form-control form-control-sm border-dark">
                    </div>
                    <div class="col-md-2">
                        <label for="month_id">Month</label>
                        <select name="month_id" id="month_id" class="form-control form-control-sm border-dark">
                            <option value="">Select Month</option>
                            @foreach ($months as $key=>$month)
                            <option value="{{ $key }}" {{ $key == $monthId ? 'selected':'' }}>{{ $month }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 mt-3">
                        <button type="submit" name="button" value="search" class="btn btn-primary">Search</button>
                        <button type="submit" name="button" value="download" class="btn btn-success">Download Report</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-body">
            <p>Trainer Attendance</p>
            <div class="card-body ">
                <table id="DataTable" class="table table-striped table-bordered table-sm">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Check-In Time</th>
                            <th>Check-Out Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for ($day = 1; $day <= $daysInMonth; $day++) @php $attendanceOfDay=$attendance->where('attendance_date', $year.'-'.str_pad($monthId, 2, '0', STR_PAD_LEFT).'-'.str_pad($day, 2, '0', STR_PAD_LEFT))->first();
                            @endphp
                            <tr>
                                <td>{{ $year }}-{{ str_pad($monthId, 2, '0', STR_PAD_LEFT) }}-{{ str_pad($day, 2, '0', STR_PAD_LEFT) }}</td>
                                <td>{{ $attendanceOfDay ? \Carbon\Carbon::createFromTimeString($attendanceOfDay->check_in_time)->format('h:i:s A') : 'N/A' }}</td>
                                <td>{{ $attendanceOfDay ? \Carbon\Carbon::createFromTimeString($attendanceOfDay->check_out_time)->format('h:i:s A') : 'N/A' }}</td>
                            </tr>
                        @endfor
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>

</script>
@endsection
