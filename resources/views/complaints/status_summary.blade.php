@extends('layouts.app-master')

@section('pageTitle', __("trans.Status Summary"))

@section('content')
<div class="container-fluid">
<div id="status-summary-container" class="card ml-1 mr-1">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-9">
                <h3 class="mb-4"><b>{{ __("trans.Complaint Status Summary Report")}}</b></h3>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="StartDate">{{ __("trans.Start Date")}}</label>
                    <input type="date" id="StartDate" class="form-control" required="">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="EndDate">{{ __("trans.End Date")}}</label>
                    <input type="date" id="EndDate" class="form-control" required="">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <div class="btn-toolbar" role="toolbar">
                        <div class="btn-group mr-2">
                            <button type="button" onclick="ComplaintStatusSummaryReportCustomRange(document.getElementById('StartDate').value,document.getElementById('EndDate').value)" class="btn btn-primary">Submit</button>
                            <button type="button" onclick="ResetStatusSummaryReport()" class="btn btn-success">Reset</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-10">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>{{ __("trans.Current Status")}}</th>
                        <th>{{ __("trans.Number of Complaints")}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($statusCounts as $status => $count)
                        <tr>
                            <td>{{ $status }}</td>
                            <td>{{ $count }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function ComplaintStatusSummaryReportCustomRange(startDate, endDate) {
        $.ajax({
            type: 'GET',
            url: '{{ route("complaints.status_summary") }}',
            data: {
                StartDate: startDate,
                EndDate: endDate
            },
            success: function(data) {
                $('#status-summary-container').html(data);
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }

    function ResetStatusSummaryReport() {
        $('#StartDate').val('');
        $('#EndDate').val('');
        $('#status-summary-container').empty();
    }
</script>
@endsection
