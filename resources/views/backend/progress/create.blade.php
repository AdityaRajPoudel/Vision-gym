@extends('backend.layouts.master')
@section('stylesheet')
@endsection
@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Progress Create</h4>
            <form action="{{ route('progress.store') }}" id="progress_form" class="forms-sample" method="post">
                @csrf
                <div class="row">
                    <div class="card col-md-12">
                        <div class="card-header">
                            <label for="">Member Progress Detail</label>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="member_id">Member ID</label>
                                    {{-- <input type="text" class="form-control form-control-sm border-dark" id="member_id" name="member_id" placeholder="Enter Member ID"> --}}
                                    <select name="member_id" id="" class="form-control form-control-sm border-dark" >
                                        <option value="">-Select Member-</option>
                                        @foreach ($members as $member)
                                            <option value="{{ $member->id }}">{{ $member->user->name }}</option> 
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="date">Date</label>
                                    <input type="date" class="form-control form-control-sm border-dark" id="date" value="{{ date('Y-m-d') }}" name="date">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="weight">Weight (kg)</label>
                                    <input type="number" class="form-control form-control-sm border-dark" id="weight" name="weight" placeholder="Enter Weight" onchange="calculateBMI()">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="height">Height (cm)</label>
                                    <input type="number" class="form-control form-control-sm border-dark" id="height" name="height" placeholder="Enter Height" onchange="calculateBMI()">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="bmi">BMI (Body Mass Index)</label>
                                    <input type="number" class="form-control form-control-sm border-dark" id="bmi" name="bmi" placeholder="BMI" readonly>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="body_fat_percentage">Body Fat Percentage</label>
                                    <input type="number" class="form-control form-control-sm border-dark" id="body_fat_percentage" name="body_fat_percentage" placeholder="Enter Body Fat Percentage">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="muscle_mass">Muscle Mass</label>
                                    <input type="number" class="form-control form-control-sm border-dark" id="muscle_mass" name="muscle_mass" placeholder="Enter Muscle Mass">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="target_weight">Target Weight (kg)</label>
                                    <input type="number" class="form-control form-control-sm border-dark" id="target_weight" name="target_weight" placeholder="Enter Target Weight">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="target_date">Target Date</label>
                                    <input type="date" class="form-control form-control-sm border-dark" id="target_date" name="target_date">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="workout_duration">Workout Duration (minutes)</label>
                                    <input type="number" class="form-control form-control-sm border-dark" id="workout_duration" name="workout_duration" placeholder="Enter Workout Duration">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="exercise_type">Exercise Type</label>
                                    <input type="text" class="form-control form-control-sm border-dark" id="exercise_type" name="exercise_type" placeholder="Enter Exercise Type">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="intensity_level">Intensity Level</label>
                                    <input type="text" class="form-control form-control-sm border-dark" id="intensity_level" name="intensity_level" placeholder="Enter Intensity Level">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="calories_burned">Calories Burned</label>
                                    <input type="number" class="form-control form-control-sm border-dark" id="calories_burned" name="calories_burned" placeholder="Enter Calories Burned">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="justify-content-around">
                                <button type="submit" class="btn btn-primary me-2">Save</button>
                                <a href="{{ route('progress.index') }}" class="btn btn-danger ">Cancel</a>
                            </div>
                        </div>
                    </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    $(document).ready(function() {
        
        $('#progress_form').validate({
            rules: {
                member_id: {
                    required: true
                },
                date: {
                    required: true
                },
                weight: {
                    required: true,
                    min: 0
                },
                height: {
                    required: true,
                    min: 0
                },
                body_fat_percentage: {
                    required: true,
                    min: 0
                },
                muscle_mass: {
                    required: true,
                    min: 0
                },
                target_weight: {
                    required: true,
                    min: 0
                },
                target_date: {
                    required: true
                },
                workout_duration: {
                    required: true,
                    min: 0
                },
                calories_burned: {
                    required: true,
                    min: 0
                },
                // Add validation rules for other fields
            },
            messages: {
                member_id: {
                    required: "Please enter the member ID"
                },
                date: {
                    required: "Please select a date"
                },
                weight: {
                    required: "Please enter the weight",
                    min: "Weight must be a positive number"
                },
                height: {
                    required: "Please enter the height",
                    min: "Height must be a positive number"
                },
                body_fat_percentage: {
                    required: "Please enter the body fat percentage",
                    min: "Body fat percentage must be a positive number"
                },
                muscle_mass: {
                    required: "Please enter the muscle mass",
                    min: "Muscle mass must be a positive number"
                },
                target_weight: {
                    required: "Please enter the target weight",
                    min: "Target weight must be a positive number"
                },
                target_date: {
                    required: "Please select a target date"
                },
                workout_duration: {
                    required: "Please enter the workout duration",
                    min: "Workout duration must be a positive number"
                },
                calories_burned: {
                    required: "Please enter the calories burned",
                    min: "Calories burned must be a positive number"
                },
                // Add custom messages for other fields
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    });
</script>
<script>
    function calculateBMI() {
        var weight = parseFloat(document.getElementById('weight').value);
        var height = parseFloat(document.getElementById('height').value);
        if (weight > 0 && height > 0) {
            var bmi = weight / ((height / 100) * (height / 100));
            document.getElementById('bmi').value = bmi.toFixed(2);
        }
    }
</script>
@endsection
