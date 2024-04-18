@extends('backend.layouts.master')

@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Schedule Update</h4>
            <form action="{{ route('schedule.update',$schedule->id) }}" id="schedule_form" class="forms-sample" method="post">
                @csrf
                @method('put')
                <div class="row schedule-container">
                    <!-- Single Schedule Fields -->
                    <div class="col-md-12 row single-schedule">
                        <div class="form-group col-2">
                            <label for="class_type">Fitness Category</label>
                            <select name="fitness_category" class="form-control form-control-sm border-dark">
                                @foreach ($fitness_categories as $category)
                                <option value="{{ $category->id }}" {{ $schedule->fitness_category_id == $category->id ? 'selected':'' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-2">
                            <label for="instructor">Trainer</label>
                            <select name="trainer_id" class="form-control form-control-sm border-dark">
                                @foreach ($trainers as $trainer)
                                <option value="{{ $trainer->id }}" {{ $trainer->id == $schedule->trainer_id ? 'selected':'' }}>{{ $trainer->user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-2">
                            <label for="day">Day</label>
                            <select class="form-control form-control-sm border-dark" name="day">
                                <option value="">Select Day</option>
                                @php
                                    $daysOfWeek = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
                                @endphp
                                @foreach ($daysOfWeek as $day)
                                    <option value="{{ $day }}" {{ $day==$schedule->day_of_week }}>{{ $day }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-3">
                            <label for="instructor">Time Slot</label>
                            <select name="time_slot_id" class="form-control form-control-sm border-dark">
                                @foreach ($time_slots as $slot)
                                <option value="{{ $slot->id }}" {{ $schedule->time_slot_id == $slot->id ? 'selected':'' }}>{{ date('h:i a', strtotime($slot->start_time)).' - '. date('h:i a', strtotime($slot->end_time)) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-success">Update</button>
            </form>
        </div>
    </div>    
</div>
@endsection

@section('scripts')
<script>
</script>

@endsection
