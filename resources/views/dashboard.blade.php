@extends('layouts.app-master')
@section('pageTitle', __("trans.Dashboard"))
@section('content')

<head>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">

  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
</head>
<div class="content"> <!-- Analytics Status -->
  <div class="row">
    <div class="col-12">
      <div class="card card-default">
        <div class="card-header">
          <h2>Total Complaints: {{ $totalComplaints }}</h2>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-6 col-xl-3">
      <div class="card card-default">
        <div class="card-header">
          <h2>{{$pending}}</h2>
          <p class="flex-basis-100 text-dark">{{ __("trans.Pending Complaints")}}</p>
        </div>
        <div class="card-body">
          <div class="progress progress-sm rounded-0 mb-1">
            <div class="progress-bar bg-secondary" role="progressbar" style="width: {{($pending/(($totalComplaints > 0) ? $totalComplaints : 1))*100}}%" aria-valuenow="{{($pending/(($totalComplaints > 0) ? $totalComplaints : 1))*100}}" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
          <div class="d-flex justify-content-between">
            <!-- <span class="text-dark text-capitalize">{{ __("trans.Pending Complaints")}}</span> -->
            <span class="text-dark text-capitalize">{{round(($pending/(($totalComplaints > 0) ? $totalComplaints : 1))*100,2)}}%</span>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-6 col-xl-3">
      <div class="card card-default">
        <div class="card-header">
          <h2>{{$in_process}}</h2>
          <p class="flex-basis-100 text-dark">{{ __("trans.in progress complaints")}}</p>
        </div>
        <div class="card-body">
          <div class="progress progress-sm rounded-0 mb-1">
            <div class="progress-bar bg-success" role="progressbar" style="width: {{($in_process/(($totalComplaints > 0) ? $totalComplaints : 1))*100}}%" aria-valuenow="{{($in_process/(($totalComplaints > 0) ? $totalComplaints : 1))*100}}" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
          <div class="d-flex justify-content-between">
            <!-- <span class="text-dark text-capitalize">{{ __("trans.in progress complaints")}}</span> -->
            <span class="text-dark text-capitalize">{{round(($in_process/(($totalComplaints > 0) ? $totalComplaints : 1))*100,2)}}%</span>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-6 col-xl-3">
      <div class="card card-default">
        <div class="card-header">
          <h2>{{$canceled}}</h2>
          <p class="flex-basis-100 text-dark">{{ __("trans.Cancelled Complaints")}}</p>
        </div>
        <div class="card-body">
          <div class="progress progress-sm rounded-0 mb-1">
            <div class="progress-bar bg-primary" role="progressbar" style="width: {{($canceled/(($totalComplaints > 0) ? $totalComplaints : 1))*100}}%" aria-valuenow="{{($canceled/(($totalComplaints > 0) ? $totalComplaints : 1))*100}}" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
          <div class="d-flex justify-content-between">
            <!-- <span class="text-dark text-capitalize">{{ __("trans.Cancelled Complaints")}}</span> -->
            <span class="text-dark text-capitalize">{{round(($canceled/(($totalComplaints > 0) ? $totalComplaints : 1))*100,2)}}%</span>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-6 col-xl-3">
      <div class="card card-default">
        <div class="card-header">
          <h2>{{$completed}}</h2>
          <p class="flex-basis-100 text-dark">{{ __("trans.Completed Complaints")}}</p>
        </div>
        <div class="card-body">
          <div class="progress progress-sm rounded-0 mb-1">
            <div class="progress-bar bg-info" role="progressbar" style="width: {{($completed/(($totalComplaints > 0) ? $totalComplaints : 1))*100}}%" aria-valuenow="{{($completed/(($totalComplaints > 0) ? $totalComplaints : 1))*100}}" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
          <div class="d-flex justify-content-between">
            <!-- <span class="text-dark text-capitalize">{{ __("trans.Completed Complaints")}}</span> -->
            <span class="text-dark text-capitalize">{{round(($completed/(($totalComplaints > 0) ? $totalComplaints : 1))*100,2)}}%</span>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Bar Chart -->
  <div class="row">
    <div class="col-4">
      <div class="card card-default">
        <div class="card-header">
          <h2> Complaint Status Wise Details </h2>
        </div>
        <div class="card-body">
          <!-- Add a container for the pie chart -->
          <div id="complaintsChartContainer" class="d-flex justify-content-center">
            <canvas id="complaintsChart" width="250" height="250"></canvas>
          </div>
        </div>
      </div>
    </div>
    <!-- Script Section -->
    <script>
      // Get the data for the pie chart from your backend or wherever it's stored
      var pending = <?php echo $pending; ?>;
      var in_process = <?php echo $in_process; ?>;
      var canceled = <?php echo $canceled; ?>;
      var completed = <?php echo $completed; ?>;

      // Calculate total complaints
      var totalComplaints = pending + in_process + canceled + completed;

      // Initialize the pie chart after the DOM is loaded
      document.addEventListener("DOMContentLoaded", function(event) {
        var ctx = document.getElementById('complaintsChart').getContext('2d');
        var complaintsChart = new Chart(ctx, {
          type: 'bar',
          data: {
            labels: ['Pending', 'In Process', 'Canceled', 'Completed'],
            datasets: [{
              label: 'Complaints by Status',
              data: [pending, in_process, canceled, completed],
              backgroundColor: [
                '#FF6384', // Red
                '#36A2EB', // Blue
                '#FFCE56', // Yellow
                '#4BC0C0' // Green
              ],
              borderWidth: 0,
              barThickness: 25 // Adjust the bar thickness as needed
            }]
          },
          options: {
            plugins: {
              datalabels: {
                color: '#fff',
                formatter: (value, ctx) => {
                  let percentage = (value * 100 / totalComplaints).toFixed(2) + "%";
                  return percentage;
                },
                font: {
                  weight: 'bold'
                }
              }
            },
            responsive: true,
            maintainAspectRatio: false,
            legend: {
              display: true,
              position: 'right'
            },
            tooltips: {
              callbacks: {
                label: function(tooltipItem, data) {
                  let label = data.labels[tooltipItem.index] || '';
                  let value = data.datasets[0].data[tooltipItem.index] || '';
                  return label + ': ' + value;
                }
              }
            }
          }
        });
      });
    </script>
    <!-- Script Section -->
    <?php

    use App\Models\Organization;

    // Assuming $organizationData is already populated
    $organizations = Organization::with('complaints')->get();
    $organizationData = [];
    foreach ($organizations as $organization) {
      $organizationData[$organization->name] = $organization->complaints->count();
    }
    ?>

    <head>
      <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    </head>
    <div class="col-4">
      <div class="card card-default">
        <div class="card-header">
          <h2> Organization Complaints Wise Details </h2>
        </div>
        <div class="card-body">
          <!-- Add a container for the pie chart -->
          <div id="organizationsChartContainer" class="d-flex justify-content-center">
            <canvas id="organizationsChart" width="250" height="250"></canvas>
          </div>
        </div>
      </div>
    </div>
    <script>
      var organizationData = <?php echo json_encode($organizationData); ?>;
      var ctx = document.getElementById('organizationsChart').getContext('2d');
      var organizationsChart = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: Object.keys(organizationData),
          datasets: [{
            label: 'Complaints by Organization',
            data: Object.values(organizationData),
            backgroundColor: [
              '#FF6384', // Red
              '#36A2EB', // Blue
              '#FFCE56', // Yellow
              '#4BC0C0' // Green
              // Add more colors if needed
            ],
            borderWidth: 0,
            barThickness: 25 // Adjust the bar thickness as needed
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          legend: {
            display: true,
            position: 'right'
          },
          tooltips: {
            callbacks: {
              label: function(tooltipItem, data) {
                var label = data.labels[tooltipItem.index] || '';
                var value = data.datasets[0].data[tooltipItem.index] || '';
                return label + ': ' + value;
              }
            }
          }
        }
      });
    </script>
    <div class="col-4">
      <div class="card card-default">
        <div class="card-header">
          <h2> Resolution Completed Rate Wise Organization </h2>
        </div>
        <div class="card-body">
          <!-- Add a container for the bar chart -->
          <div id="organizationsCompletedChartContainer" class="d-flex justify-content-center">
            <canvas id="organizationsCompletedChart" width="250" height="250"></canvas>
          </div>
        </div>
      </div>
    </div>

    @php
    // Assuming $organizationData is already populated
    $organizations = Organization::with('complaints')->get();
    $organizationData = [];
    foreach ($organizations as $organization) {
    $organizationData[$organization->name] = $organization->complaints->count();
    }

    // Calculate the completed complaints percentage ratio for each organization
    $completedComplaintsPercentageByOrganization = [];
    foreach ($organizations as $organization) {
    $totalComplaints = $organizationData[$organization->name];
    $completedComplaints = $organization->complaints->where('status', 3)->count();
    $completedComplaintsPercentage = $totalComplaints > 0 ? ($completedComplaints / $totalComplaints) * 100 : 0;
    $completedComplaintsPercentageByOrganization[$organization->name] = $completedComplaintsPercentage;
    }
    @endphp

    <script>
      var completedComplaintsPercentageByOrganization = @json($completedComplaintsPercentageByOrganization);
      var ctx = document.getElementById('organizationsCompletedChart').getContext('2d');
      var organizationsCompletedChart = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: Object.keys(completedComplaintsPercentageByOrganization),
          datasets: [{
            label: 'Completed Complaints Percentage by Organization',
            data: Object.values(completedComplaintsPercentageByOrganization),
            backgroundColor: '#4BC0C0', // Green
            borderWidth: 0,
            barThickness: 25 // Adjust the bar thickness as needed
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          legend: {
            display: true,
            position: 'right'
          },
          tooltips: {
            callbacks: {
              label: function(tooltipItem, data) {
                var label = data.labels[tooltipItem.index] || '';
                var value = data.datasets[0].data[tooltipItem.index] || '';
                return label + ': ' + value.toFixed(2) + '%';
              }
            }
          }
        }
      });
    </script>


  </div>
  <!-- Table Complaints -->
  <div class="row">
    <div class="col-12">
      <div class="card card-default">
        <h2>{{ __("trans.Complaints with Deadlines") }}</h2>
        <div class="card-body">
          <table class="table table-hover table-product data-table" style="width:100%">
            <thead>
              <tr>
                <th>#</th>
                <th>{{ __("trans.Complaint ID")}}</th>
                <th>{{ __("trans.Complaint Name") }}</th>
                <th>{{ __("trans.Complaint Email") }}</th>
                <th>{{ __("trans.Accused Name") }}</th>
                <th>{{ __("trans.Accused Email") }}</th>
                <th>{{ __("trans.Deadline") }}</th>
                <th>{{ __("trans.Current Status") }}</th>
                <th>{{ __("trans.Remaining Days") }}</th>
                <th>{{ __("trans.Assigned To") }}</th>
                <th>{{ __("trans.Organizations") }}</th>
                <th>{{ __("trans.Complaint Details") }}</th>
              </tr>
            </thead>
            <tbody>
              @foreach($allComplaints as $key => $value)
              <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{'CA-'.padNumber($value->id)}}</td>
                <td>{{ $value->complaint_fname }}</td>
                <td>{{ $value->complaint_email }}</td>
                <td>{{ $value->accused_name }}</td>
                <td>{{ $value->accused_email }}</td>
                <td>{{ $value->deadline }}</td>
                <?php
                $status = "Pending";
                if ($value->status == 1)
                  $status = "In Process";
                else if ($value->status == 2)
                  $status = "Canceled";
                else if ($value->status == 3)
                  $status = "Completed";
                ?>
                <td>{{ $status }}</td>
                <td>{{ $value->days }}</td>
                <td>{{ $value->assigned_to_user ? $value->assigned_to_user->name : '' }}</td>
                <td>{{ $value->organization->name }}</td>
                <td>
                  <a data-toggle="modal" data-target="#complaintDetailsModal{{ $value->id }}" title="Show" class="edit-complaint" href="#">
                    <i class="mdi mdi-eye-outline" style="color: black;"></i>
                  </a>
                </td>
              </tr>

              <!-- Modal -->
              <div class="modal fade" id="complaintDetailsModal{{ $value->id }}" tabindex="-1" role="dialog" aria-labelledby="complaintDetailsModal{{ $value->id }}Label" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                      <h5 class="modal-title" id="complaintDetailsModal{{ $value->id }}Label">Complaint Details</h5>
                      <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="container">
                        <div class="row">
                          <div class="col-md-6">
                            <p><strong>Complaint ID:</strong> {{ 'CA-'.padNumber($value->id) }}</p>
                            <p><strong>Complaint Name:</strong> {{ $value->complaint_fname }}</p>
                            <p><strong>Accused Name:</strong> {{ $value->accused_name }}</p>
                            <p><strong>Deadline:</strong> {{ $value->deadline }}</p>
                            <p><strong>Current Status:</strong> {{ $status }}</p>
                          </div>
                          <div class="col-md-6">
                            <p><strong>Assigned To Name:</strong> {{ $value->assigned_to_user ? $value->assigned_to_user->name : '' }}</p>
                            <p><strong>Organization Name:</strong> {{ $value->organization->name }}</p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
              </div>

              <!-- End Modal -->
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  @endsection