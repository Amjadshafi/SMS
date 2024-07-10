@extends('layouts.app-master')

@section('pageTitle', __("trans.Assigned Complaint Summary"))

@section('content')

<div class="card ml-1 mr-1">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h3 class="mb-4"><b>{{ __("trans.Assigned Complaint Summary") }}</b></h3>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="StartDate">{{ __("trans.Start Date") }}</label>
                <input type="date" id="StartDate" name="StartDate" class="form-control" required="">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="EndDate">{{ __("trans.End Date") }}</label>
                <input type="date" id="EndDate" name="EndDate" class="form-control" required="">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <button type="button" onclick="filterComplaints()" class="btn btn-primary">{{ __("trans.Submit") }}</button>
                <button type="button" onclick="resetFilters()" class="btn btn-success">{{ __("trans.Reset") }}</button>
            </div>
        </div>
    </div>
    <div class="col-md-10">
        <table class="ItemTranTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{ __("trans.Assigned User") }}</th>
                    <th>{{ __("trans.Total Assigned") }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($assignedComplaints as $index => $assignedComplaint)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $assignedComplaint->assigned_user }}</td>
                    <td>{{ $assignedComplaint->total }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>

<script>
    function filterComplaints() {
        var startDate = document.getElementById('StartDate').value;
        var endDate = document.getElementById('EndDate').value;
        window.location.href = "{{ route('complaints.assigned_complaint_summary') }}?StartDate=" + startDate + "&EndDate=" + endDate;
    }

    function resetFilters() {
        document.getElementById('StartDate').value = '';
        document.getElementById('EndDate').value = '';
        filterComplaints();
    }
</script>
@endsection

































<style>
    .ItemTranTable {
        width: 100%;
        border-collapse: collapse;
    }

    .ItemTranTable th,
    .ItemTranTable td {
        border: 1px solid #dddddd;
        padding: 8px;
        text-align: left;
    }

    .ItemTranTable th {
        background-color: #f2f2f2;
    }

    .ItemTranTable tbody tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    .ItemTranTable tbody tr:hover {
        background-color: #ddd;
    }
</style>