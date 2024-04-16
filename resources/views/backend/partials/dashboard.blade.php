@extends('backend.layouts.master')
@section('content')
<div class="row">
    <div class="col-md-12 grid-margin">
      <div class="d-flex justify-content-between flex-wrap">
        <div class="d-flex align-items-end flex-wrap">
          <div class="me-md-3 me-xl-5">
            <h2>Welcome {{ Auth::user()->name }}</h2>
            <p class="mb-md-0">Your analytics dashboard template.</p>
          </div>
      </div>
    </div>
  </div>
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
                {{-- <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                  <i class="mdi mdi-account-multiple-check icon-lg text-success"></i>
                  <div class="d-flex flex-column justify-content-around">
                    <small class="mb-1 text-muted">Present Members</small>
                    <h5 class="me-2 mb-0">200</h5>
                  </div>
                </div> --}}
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
    {{-- <div class="col-lg-6 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Package Info</h4>
          <canvas id="doughnutChart"></canvas>
        </div>
      </div>
    </div> --}}
  </div>
@endsection
@section('scripts')
<script>
  var ctx = document.getElementById('revenueChart').getContext('2d');
  var chartData=@json(array_values($sales_array));
  var myChart = new Chart(ctx, {
      type: 'line',
      data: {
          labels: @json(array_values($dates)), // Replace with your specific dates
          datasets: [
              {
                  label: 'InComes',
                  data: chartData, // Replace with your "cash in" data
                  borderColor: 'rgba(0, 100, 0, 1)',
                  borderWidth: 2,
                  backgroundColor: 'rgba(0, 99, 132, 0.2)',
                  tension: 0.4,
                  pointRadius: 6,
                  pointBackgroundColor: 'rgba(0, 99, 132, 1)',
              },
              
              {
                  label: 'Expenses',
                  data: @json(array_values($exp_array)), // Replace with your "cash out" data
                  borderColor: 'rgba(255, 99, 132, 1)', // Different color for "cash out"
                  borderWidth: 2,
                  backgroundColor: 'rgba(255, 99, 132, 0.2)',
                  tension: 0.4,
                  pointRadius: 6,
                  pointBackgroundColor: 'rgba(255, 99, 132, 1)',
              }

          ]
      },
      options: {
          scales: {
              y: {
                  beginAtZero: true
              }
          }
      }
  });
</script>
@endsection