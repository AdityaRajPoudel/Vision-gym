@extends('backend.layouts.master')

@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Schedule Create</h4>
            <form action="{{ route('schedule.store') }}" id="schedule_form" class="forms-sample" method="post">
                @csrf
                <div class="row schedule-container">
                    <!-- Single Schedule Fields -->
                    <div class="col-md-12 row single-schedule">
                        <div class="form-group col-2">
                            <label for="class_type">Fitness Category</label>
                            <select name="fitness_category[]" class="form-control form-control-sm border-dark">
                                @foreach ($fitness_categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-2">
                            <label for="instructor">Trainer</label>
                            <select name="trainer_id[]" class="form-control form-control-sm border-dark">
                                @foreach ($trainers as $trainer)
                                <option value="{{ $trainer->id }}">{{ $trainer->user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-2">
                            <label for="day">Day</label>
                            <select class="form-control form-control-sm border-dark" name="day[]">
                                <option value="">Select Day</option>
                                @php
                                    $daysOfWeek = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
                                @endphp
                                @foreach ($daysOfWeek as $day)
                                    <option value="{{ $day }}">{{ $day }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-3">
                            <label for="instructor">Time Slot</label>
                            <select name="time_slot_id[]" class="form-control form-control-sm border-dark">
                                @foreach ($time_slots as $slot)
                                <option value="{{ $slot->id }}">{{ date('h:i a', strtotime($slot->start_time)).' - '. date('h:i a', strtotime($slot->end_time)) }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        {{-- <div class="form-group col-2">
                            <label for="start_time">Start Time</label>
                            <input type="time" class="form-control form-control-sm border-dark" name="start_time[]">
                        </div>
                        <div class="form-group col-2">
                            <label for="end_time">End Time</label>
                            <input type="time" class="form-control form-control-sm border-dark" name="end_time[]">
                        </div> --}}
                        <div class="form-group col-2 mt-4">
                            <label for="end_time">&nbsp;</label>
                            <button type="button" class="btn btn-danger btn-sm remove-schedule">Remove Row</button>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-primary" id="add_schedule">Add Schedule</button>
                <button type="submit" class="btn btn-success">Submit</button>
            </form>
        </div>
    </div>    
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('#add_schedule').click(function() {
            var newSchedule = $('.single-schedule').first().clone();
            newSchedule.find('input').val(''); // Clear input values
            newSchedule.find('select').val(''); // Clear select values
            $('.schedule-container').append(newSchedule);
        });

        $(document).on('click', '.remove-schedule', function() {
            $(this).closest('.single-schedule').remove();
        });

        // Automatically set end time based on start time
        // $(document).on('change', 'input[name^="start_time"]', function() {
        //     var startTime = $(this).val();
        //     var endTimeInput = $(this).closest('.single-schedule').find('input[name^="end_time"]');
        //     if (startTime) {
        //         var endTime = new Date('1970-01-01T' + startTime); // Convert to Date object
        //         endTime.setHours(endTime.getHours() + 2); // Add 2 hours
        //         var formattedEndTime = endTime.toTimeString().substring(0, 5); // Get formatted time
        //         endTimeInput.val(formattedEndTime); // Set end time input value
        //     } else {
        //         endTimeInput.val(''); // Clear end time input value if start time is empty
        //     }
        // });
    });
</script>

@endsection
