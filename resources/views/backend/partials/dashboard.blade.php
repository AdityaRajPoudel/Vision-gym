@extends('backend.layouts.master')
@section('stylesheet')
<style>
    .bmi-calculator {
        max-width: 500px;
        margin: auto;
    }

    #bmi-result {
        margin-top: 20px;
    }

    .intensity-bar {
        height: 20px;
        border-radius: 10px;
        background-color: #e4e4e4;
        margin-top: 10px;
        overflow: hidden;
    }

    .intensity-level {
        height: 100%;
        background-color: #36ebd3;
        text-align: center;
        color: #fff;
        font-weight: bold;
        line-height: 20px;
    }

    .progress-card {
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        max-width: 400px;
    }

    .progress-card-title {
        color: #333;
        text-align: center;
    }

    .progress-details {
        margin-top: 20px;
    }

    .progress-item {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
    }

    .progress-item .icon {
        font-size: 24px;
        margin-right: 10px;
        color: #007bff;
    }

    .progress-label {
        font-weight: bold;
        margin-right: 10px;
    }

    .progress-value {
        font-weight: bold;
        color: #333;
    }

</style>
@endsection
@section('content')
<div class="row">
    {{-- <div class="col-md-12 grid-margin">
        <div class="d-flex justify-content-between flex-wrap">
            <div class="d-flex align-items-end flex-wrap">
                <div class="me-md-3 me-xl-5">
                    <h2>Welcome {{ Auth::user()->name }}</h2>
    <p class="mb-md-0">Your analytics dashboard template.</p>
</div>
</div>
</div>
</div> --}}
{{-- @if (auth()->user()->user_type_id == 1 || auth()->user()->user_type_id == 0) --}}
@if (auth()->user()->user_type_id == 1 )
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body dashboard-tabs p-0">
                <ul class="nav nav-tabs px-4" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="overview-tab" data-bs-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-selected="true">Overview</a>
                    </li>
                </ul>
                <div class="tab-content py-0 px-0">
                    <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">
                        <div class="d-flex flex-wrap justify-content-xl-between">
                            <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                <i class="mdi mdi-account-multiple icon-lg text-success"></i>
                                <div class="d-flex flex-column justify-content-around">
                                    <small class="mb-1 text-muted">Active Members</small>
                                    <h5 class="me-2 mb-0">{{ $active_members }}</h5>
                                </div>
                            </div>
                            <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                <i class="mdi mdi-account-supervisor icon-lg text-success"></i>
                                <div class="d-flex flex-column justify-content-around">
                                    <small class="mb-1 text-muted">Present Members</small>
                                    <h5 class="me-2 mb-0">{{ $present_members }}</h5>
                                </div>
                            </div>
                            <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                <i class="mdi mdi-dumbbell icon-lg text-warning"></i>
                                <div class="d-flex flex-column justify-content-around">
                                    <small class="mb-1 text-muted">Total Trainers</small>
                                    <h5 class="me-2 mb-0">{{ $total_trainers }}</h5>
                                </div>
                            </div>
                            <div class="d-flex py-3 border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                <i class="mdi mdi-currency-usd icon-lg text-success"></i>
                                <div class="d-flex flex-column justify-content-around">
                                    <small class="mb-1 text-muted">Total Revenue</small>
                                    <h5 class="me-2 mb-0">Rs. {{ $total_revenue }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="sales" role="tabpanel" aria-labelledby="sales-tab">
                        <div class="d-flex flex-wrap justify-content-xl-between">
                            <div class="d-none d-xl-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                <i class="mdi mdi-calendar-heart icon-lg me-3 text-primary"></i>
                                <div class="d-flex flex-column justify-content-around">
                                    <small class="mb-1 text-muted">Start date</small>
                                    <div class="dropdown">
                                        <a class="btn btn-secondary dropdown-toggle p-0 bg-transparent border-0 text-dark shadow-none font-weight-medium" href="#" role="button" id="dropdownMenuLinkA" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <h5 class="mb-0 d-inline-block">26 Jul 2018</h5>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLinkA">
                                            <a class="dropdown-item" href="#">12 Aug 2018</a>
                                            <a class="dropdown-item" href="#">22 Sep 2018</a>
                                            <a class="dropdown-item" href="#">21 Oct 2018</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                <i class="mdi mdi-download me-3 icon-lg text-warning"></i>
                                <div class="d-flex flex-column justify-content-around">
                                    <small class="mb-1 text-muted">Downloads</small>
                                    <h5 class="me-2 mb-0">2233783</h5>
                                </div>
                            </div>
                            <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                <i class="mdi mdi-eye me-3 icon-lg text-success"></i>
                                <div class="d-flex flex-column justify-content-around">
                                    <small class="mb-1 text-muted">Total views</small>
                                    <h5 class="me-2 mb-0">9833550</h5>
                                </div>
                            </div>
                            <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                <i class="mdi mdi-currency-usd me-3 icon-lg text-danger"></i>
                                <div class="d-flex flex-column justify-content-around">
                                    <small class="mb-1 text-muted">Revenue</small>
                                    <h5 class="me-2 mb-0">$577545</h5>
                                </div>
                            </div>
                            <div class="d-flex py-3 border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                <i class="mdi mdi-flag me-3 icon-lg text-danger"></i>
                                <div class="d-flex flex-column justify-content-around">
                                    <small class="mb-1 text-muted">Flagged</small>
                                    <h5 class="me-2 mb-0">3497843</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Revenue Chart</h4>
                <canvas id="revenueChart" height="120"></canvas>
            </div>
        </div>
    </div>
</div>
@endif
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card progress-card">
            <div class="card-body">
                <div class="tab-class">
                    <div class="tab-content">
                        <div id="" class="container tab-pane p-0 active">
                            <div class="table-responsive">
                                <table class="table table-bordered table-lg m-0">
                                    <thead class="bg-success text-white text-center border-dark">
                                        <tr>
                                            <th>Time</th>
                                            <th>Monday</th>
                                            <th>Tuesday</th>
                                            <th>Wednesday</th>
                                            <th>Thursday</th>
                                            <th>Friday</th>
                                            <th>Saturday</th>
                                            <th>Sunday</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        @foreach($timeSlots as $timeSlot)
                                        <tr class="border-dark">
                                            <th class="bg-success text-white align-middle">{{ date('h:i a', strtotime($timeSlot['start_time'])) }} - {{ date('h:i a', strtotime($timeSlot['end_time'])) }}</th>
                                            @foreach($daysOfWeek as $day)
                                            <td class=" border-dark ">
                                                @foreach($schedules[$day][$timeSlot['id']] as $schedule)
                                                <h5>{{ $schedule->category->name }}</h5>
                                                {{ $schedule->trainer->user->name }}
                                                @endforeach
                                            </td>
                                            @endforeach
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if (auth()->user()->user_type_id == 0 && $today_progress )
    <div class="col-lg-6 grid-margin stretch-card">
        <div class="card progress-card">
            <div class="card-body">
                <h4 class="card-title progress-card-title">Today's Progress</h4>
                <div class="progress-details">
                    <div class="progress-item">
                        <i class="mdi mdi-clock-outline icon"></i>
                        <span class="progress-label">Work Duration:</span>
                        <span class="progress-value">{{ $today_progress->work_duration }} kg</span>
                    </div><div class="progress-item">
                        <i class="mdi mdi-sitemap icon"></i>
                        <span class="progress-label">Intensity Level:</span>
                        <span class="progress-value">{{ $today_progress->intensity_level }} kg</span>
                    </div><div class="progress-item">
                        <i class="fa-solid fa-fire icon"></i>
                        <span class="progress-label">Calories Burned:</span>
                        <span class="progress-value">{{ $today_progress->calories_burned }} kg</span>
                    </div><div class="progress-item">
                        <i class="mdi mdi-weight icon"></i>
                        <span class="progress-label">Weight:</span>
                        <span class="progress-value">{{ $today_progress->weight }} kg</span>
                    </div>
                    {{-- <div class="progress-item">
                        <i class="mdi mdi-ruler icon"></i>
                        <span class="progress-label">Height:</span>
                        <span class="progress-value">175 cm</span>
                    </div> --}}
                    <div class="progress-item">
                        <i class="mdi mdi-chart-line icon"></i>
                        <span class="progress-label">BMI:</span>
                        <span class="progress-value">{{ $today_progress->bmi }}</span>
                    </div>
                    <div class="progress-item">
                        <i class="mdi mdi-human icon"></i>
                        <span class="progress-label">Body Fat Percentage:</span>
                        <span class="progress-value">{{ $today_progress->body_fat_percentage }}%</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    <div class="col-lg-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">BMI Calculator</h4>
                <div class="bmi-calculator">
                    <div class="form-group">
                        <label for="age">Age:</label>
                        <input type="number" class="form-control form-control-sm border-dark" id="age" placeholder="Enter Age">
                    </div>
                    <div class="form-group">
                        <label for="gender">Gender:</label>
                        <select class="form-control form-control-sm border-dark" id="gender">
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="height">Height (cm):</label>
                        <input type="number" class="form-control form-control-sm border-dark" id="height" placeholder="Enter Height">
                    </div>
                    <div class="form-group">
                        <label for="weight">Weight (kg):</label>
                        <input type="number" class="form-control form-control-sm border-dark" id="weight" placeholder="Enter Weight">
                    </div>
                    <button type="button" class="btn btn-primary" onclick="calculateBMI()">Calculate BMI</button>
                    <div id="bmi-result" class="mt-3"></div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('scripts')
<script>
    var ctx = document.getElementById('revenueChart').getContext('2d');
    var chartData = @json(array_values($sales_array));
    var myChart = new Chart(ctx, {
        type: 'line'
        , data: {
            labels: @json(array_values($dates)), // Replace with your specific dates
            datasets: [{
                    label: 'InComes'
                    , data: chartData, // Replace with your "cash in" data
                    borderColor: 'rgba(0, 100, 0, 1)'
                    , borderWidth: 2
                    , backgroundColor: 'rgba(0, 99, 132, 0.2)'
                    , tension: 0.4
                    , pointRadius: 6
                    , pointBackgroundColor: 'rgba(0, 99, 132, 1)'
                , },

                {
                    label: 'Expenses'
                    , data: @json(array_values($exp_array)), // Replace with your "cash out" data
                    borderColor: 'rgba(255, 99, 132, 1)', // Different color for "cash out"
                    borderWidth: 2
                    , backgroundColor: 'rgba(255, 99, 132, 0.2)'
                    , tension: 0.4
                    , pointRadius: 6
                    , pointBackgroundColor: 'rgba(255, 99, 132, 1)'
                , }

            ]
        }
        , options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    function calculateBMI() {
        var age = parseInt(document.getElementById('age').value);
        var gender = document.getElementById('gender').value;
        var height = parseInt(document.getElementById('height').value);
        var weight = parseInt(document.getElementById('weight').value);

        var bmi = weight / ((height / 100) * (height / 100));
        var intensityLevel = "";
        var intensityColor = "";

        if (bmi < 18.5) {
            intensityLevel = "Underweight";
            intensityColor = "#ffc107"; // Yellow color for Underweight
        } else if (bmi >= 18.5 && bmi < 25) {
            intensityLevel = "Normal";
            intensityColor = "#28a745"; // Green color for Normal
        } else if (bmi >= 25 && bmi < 30) {
            intensityLevel = "Overweight";
            intensityColor = "#007bff"; // Blue color for Overweight
        } else {
            intensityLevel = "Obese";
            intensityColor = "#dc3545"; // Red color for Obese
        }

        var bmiResult = "BMI: " + bmi.toFixed(2) + " (" + intensityLevel + ")";
        document.getElementById('bmi-result').innerHTML = bmiResult;

        var intensityBar = '<div class="progress">' +
            '<div class="progress-bar" role="progressbar" style="width: ' + bmi.toFixed(2) + '%; background-color: ' + intensityColor + ';" aria-valuenow="' + bmi.toFixed(2) + '" aria-valuemin="0" aria-valuemax="100"></div>' +
            '</div>';

        document.getElementById('bmi-result').innerHTML += intensityBar;
    }

</script>
@endsection
