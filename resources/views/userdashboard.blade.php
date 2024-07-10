@extends('layouts.app-master')
@section('pageTitle', __("trans.User Dashboard"))
@section('content')

<div class="card card-default">
        <div class="card-header">
          <h2>{{$totalAssignedComplaints}}</h2>
          <p class="flex-basis-100 text-dark">{{ __("trans.Total Complaints")}}</p>
        </div>
</div>
<div class="content"> <!-- Analytics Status -->
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
            <span class="text-dark text-capitalize">{{ __("trans.Pending Complaints")}}</span>
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
            <span class="text-dark text-capitalize">{{ __("trans.in progress complaints")}}</span>
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
            <span class="text-dark text-capitalize">{{ __("trans.Cancelled Complaints")}}</span>
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
            <span class="text-dark text-capitalize">{{ __("trans.Completed Complaints")}}</span>
            <span class="text-dark text-capitalize">{{round(($completed/(($totalComplaints > 0) ? $totalComplaints : 1))*100,2)}}%</span>
          </div>
        </div>
      </div>
    </div>
  </div>
    <div class="col-12">
      <div class="card card-default">
        <div class="card-header">
          <h2>{{ __("trans.Complaints")}}</h2>
        </div>
        <div class="card-body">
          <table class="table table-hover table-product data-table" style="width:100%">
            <thead>
              <tr>
                <th>#</th>
                <th>{{ __("trans.Complaint Email")}}</th>
                <th>{{ __("trans.Complaint Phone No")}}</th>
                <th>{{ __("trans.Complaint Firstname")}}</th>
                <th>{{ __("trans.Deadline")}}</th>
                <th>{{ __("trans.Remaining Days")}}</th>
                <th>{{ __("trans.Assigned To")}}</th>

              </tr>
            </thead>
            <tbody>
            @foreach($allComplaints as $key => $value)
            @if (!empty($value->assigned_to_user) && $value->assigned_to_user->id === Auth::user()->id)
        <tr>
            <td>{{++$key}}</td>
            <td>{{$value->complaint_email}}</td>
            <td>{{$value->complaint_phone_no}}</td>
            <td>{{$value->complaint_fname}}</td>
            <td>{{$value->deadline}}</td>
            <td>{{$value->days}}</td>
            <td>{{(!empty($value->assigned_to_user)) ? $value->assigned_to_user->name : ''}}</td>
        </tr>
    @endif
    @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

