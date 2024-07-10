<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Complaint;
use Barryvdh\DomPDF\Facade\PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\ComplaintFile;
use App\Models\Organization;
use App\Models\User;
use App\Models\Comment;
use App\Models\ComplaintCategory;
use Exception;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\View;


class ComplaintsController extends Controller
{
    public function __construct(Complaint $complaint)
    {
        $this->complaint = $complaint;
    }

    public function createComplaint()
    {
        $obj = new Organization();
        $categories = ComplaintCategory::get();
        $organizations = $obj->get();
        return view("complaint", compact('organizations','categories'));
    }

    public function storecomplaint(Request $req)
    {
        try {

            if (!empty($req->File)) {
                $file = $req->File;
                $file_extension = $file->getClientOriginalExtension();
                $filename = Carbon::now()->timestamp . "." . $file_extension;
                $file_location = "uploads";
                $file->move('public/' . $file_location, $filename);
            }

            $data = new Complaint;
            $data->complaint_email = $req->complaint_email;
            $data->complaint_phone_no = $req->complaint_phone_no;
            $data->complaint_fname = $req->complaint_fname;
            $data->complaint_lname = $req->complaint_lname;
            $data->complaint_city = $req->complaint_city;
            $data->complaint_country = $req->complaint_country;
            $data->complaint_address = $req->complaint_address;
            $data->accused_email = $req->accused_email;
            $data->accused_phone_no = $req->accused_phone_no;
            $data->accused_name = $req->accused_name;
            $data->accused_department = $req->accused_department;
            $data->accused_city = $req->accused_city;
            $data->accused_country = $req->accused_country;
            $data->accident_place = $req->accident_place;
            $data->accident_date = $req->accident_date;
            $data->complaint_body = $req->complaint_body;
            $data->organization_id = $req->organization_id;
            $data->save();
            if ($data && !empty($req->File)) {
                $complaint_files = new ComplaintFile();
                $complaint_files->complaint_id = $data->id;
                $complaint_files->name = $filename;
                $complaint_files->file_type = $file_extension;
                $complaint_files->file_location = $file_location;
                $complaint_files->save();
                if (!empty($complaint_files))
                    return redirect()->back()->withSuccess(__('trans.Complaint Submit Success'));
                else
                    return redirect()->back()->withError(__('trans.Error Message'));
            } elseif ($data && empty($req->File)) {
                return redirect()->back()->withSuccess(__('trans.Complaint Submit Success'));
            } else {
                return redirect()->back()->withError(__('trans.Error Message'));
            }
        } catch (Exception $e) {
            dd($e);
        }
    }

    public function index()
    {
        $complaint = new Complaint();
        $user = new User();
        $users = $user->with('roles')->get();
        $complaints = [];
        if (in_array(Auth::user()->roles->first()->name, ['Super Admin'])) {
            $complaints = $complaint->with(['complaint_files', 'accused_files','comments.comment_by_user', 'organization'])->get();
        } else {
            $complaints = $complaint->where('organization_id', Auth::user()->organization_id)->with(['complaint_files', 'accused_files', 'organization'])->get();
        }
        // dd($complaints->toArray());
        return view("complaints.index", compact('complaints', 'users'));
    }
    public function file()
    {
        // Assuming you want to retrieve all complaints along with their files
        $complaints = Complaint::with('complaint_files')->get();
        return view('complaints.file', compact('complaints'));
    }
    public function pending()
    {
        $complaint = new Complaint();
        $complaint = $complaint->where('status', "0");
        if (in_array(Auth::user()->roles->first()->name, ['Super Admin'])) {
            $complaints = $complaint->with(['complaint_files', 'organization'])->get();
        } else {
            $complaints = $complaint->where('organization_id', Auth::user()->organization_id)->with(['complaint_files', 'organization'])->get();
        }

        return view('complaints.pending', ['complaints' => $complaints]);
    }
    public function inprocess()
    {

        $complaint = new Complaint();
        $complaint = $complaint->where('status', "1");
        if (in_array(Auth::user()->roles->first()->name, ['Super Admin'])) {
            $complaints = $complaint->with(['complaint_files', 'organization'])->get();
        } else {
            $complaints = $complaint->where('organization_id', Auth::user()->organization_id)->with(['complaint_files', 'organization'])->get();
        }

        return view('complaints.inprocess', ['complaints' => $complaints]);
    }
    public function cancelled()
    {

        $complaint = new Complaint();
        $complaint = $complaint->where('status', "2");
        if (in_array(Auth::user()->roles->first()->name, ['Super Admin'])) {
            $complaints = $complaint->with(['complaint_files', 'organization'])->get();
        } else {
            $complaints = $complaint->where('organization_id', Auth::user()->organization_id)->with(['complaint_files', 'organization'])->get();
        }

        return view('complaints.cancelled', ['complaints' => $complaints]);
    }
    public function completed()
    {

        $complaint = new Complaint();
        $complaint = $complaint->where('status', "3");
        if (in_array(Auth::user()->roles->first()->name, ['Super Admin'])) {
            $complaints = $complaint->with(['complaint_files', 'organization'])->get();
        } else {
            $complaints = $complaint->where('organization_id', Auth::user()->organization_id)->with(['complaint_files', 'organization'])->get();
        }

        return view('complaints.completed', ['complaints' => $complaints]);
    }
    public function generatePDF()
    {
        $complaint = new Complaint();
        $complaints = $complaint->with('user')->get();
        $pdf = PDF::loadview('complaints.pdf', compact('complaints'))->setPaper('a4', 'landscape');
        return $pdf->download('complaints.pdf');
    }


    public function editComplaint(Request $request)
    {
        $data = [
            'assigned_to' => $request['assigned_to'],
            'status'        => $request['status'],
            'assigned_by'   => Auth::user()->id
        ];
        $update = $this->complaint->updateComplaint($data, $request['complaint_id']);
        if ($update) {
            return redirect()->back()->withSuccess("Success");
        } else {
            return redirect()->back() - withError(__('trans.Error Message'));
        }
    }

    public function getComplaintData(Request $request)
    {
        $user = new User();
        $users = [];
        if (in_array(Auth::user()->roles->first()->name, ['Super Admin', 'Admin'])) {
            $users = $user->with('roles')->get();
        } else {
            $users = $user->where('organization_id', Auth::user()->organization_id)->with('roles')->get();
        }

        $complaint = $this->complaint->find($request->id);
        $status = '<option value="">Select Status</option>
        <option value="0"' . ($complaint['status'] == 0 ? "selected" : "") . '>Pending</option>
        <option value="1"' . ($complaint['status'] == 1 ? "selected" : "") . '>In Process</option>
        <option value="2"' . ($complaint['status'] == 2 ? "selected" : "") . '>Cancelled</option>
        <option value="3"' . ($complaint['status'] == 3 ? "selected" : "") . '>Completed</option>';


        $assigned_to = '<option value="">Select Status</option>';
        foreach ($users as $user) {
            $assigned_to .= '<option value="' . $user->id . '" ' . ($user->id == $complaint['assigned_to'] ? "selected" : "") . '>' . $user->name . ' (' . $user->roles['0']->name . ')</option>';
        }
        return json_encode(['status' => $status, 'assigned_to' => $assigned_to]);
    }

    public function show($id)
    {
        $complaint = Complaint::findOrFail($id);
        return view('complaints.show', compact('complaint'));
    }
    public function statusSummary(Request $request)
    {
        $startDate = $request->input('StartDate');
        $endDate = $request->input('EndDate');

        $formattedStartDate = date('Y-m-d 00:00:00', strtotime($startDate));
        $formattedEndDate = date('Y-m-d 23:59:59', strtotime($endDate));

        $complaints = Complaint::whereBetween('created_at', [$formattedStartDate, $formattedEndDate])->get();

        $statusCounts = [
            'Pending' => $complaints->where('status', 0)->count(),
            'In Process' => $complaints->where('status', 1)->count(),
            'Canceled' => $complaints->where('status', 2)->count(),
            'Completed' => $complaints->where('status', 3)->count(),
        ];

        return view('complaints.status_summary', compact('statusCounts'));
    }


    public function assignedComplaintSummary(Request $request)
    {
        $startDate = $request->input('StartDate');
        $endDate = $request->input('EndDate');

        $assignedComplaints = DB::table('complaints')
            ->join('users', 'complaints.assigned_to', '=', 'users.id')
            ->select('users.name as assigned_user', DB::raw('count(*) as total'))
            ->whereBetween('complaints.created_at', [Carbon::parse($startDate)->startOfDay(), Carbon::parse($endDate)->endOfDay()])
            ->groupBy('complaints.assigned_to', 'users.name')
            ->get();

        return view('complaints.assigned_complaint_summary', compact('assignedComplaints'));
    }
    public function manage_complaint()
    {

        $complaints = Complaint::all();
        return view('complaints.manage_complaint', compact('complaints'));
    }
}
