<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Complaint;
use App\Models\ComplaintCategory;
use App\Models\ComplaintComment;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\ComplaintFile;
use App\Models\Organization;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;

class ComplaintUsersController extends Controller
{
    public function __construct(Complaint $complaint)
    {
        $this->complaint = $complaint;
    }

    public function createComplaint()
    {
        $obj = new Organization();
        $organizations = $obj->get();
        return view("complaint", compact('organizations'));
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
        $userId = auth()->id(); // Get the current authenticated user's ID
        $complaint = new Complaint();

        // Fetch complaints assigned to the current user
        $complaints = $complaint->with(['complaint_files', 'organization'])
            ->where('assigned_to', $userId)
            ->get();

        return view("otheruser.index", compact('complaints'));
    }
    public function pending()
    {
        $complaints = DB::table('complaints')
            ->where('status', "0")->get();
        return view('complaints.pending', ['complaints' => $complaints]);
    }
    public function inprocess()
    {

        $complaints = DB::table('complaints')
            ->where('status', "1")->get();
        return view('complaints.inprocess', ['complaints' => $complaints]);
    }

    public function cancelled()
    {

        $complaints = DB::table('complaints')
            ->where('status', "2")->get();
        return view('complaints.cancelled', ['complaints' => $complaints]);
    }
    public function completed()
    {

        $complaints = DB::table('complaints')
            ->where('status', "3")->get();
        return view('complaints.completed', ['complaints' => $complaints]);
    }
    public function generatePDF()
    {

        $complaint = new Complaint();
        $complaints = $complaint->with('user')->get();
        $pdf = Pdf::loadview('complaints.pdf', compact('complaints'))->setPaper('a4', 'landscape');
        return $pdf->stream();
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
        $users = $user->with('roles')->get();
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

    public function getComplaintComments(Request $request)
    {
        $obj = new ComplaintComment();
        $comments = $obj->where('complaint_id', $request['id'])->get();
        $forComplainant = "";
        $forAccused = "";

        foreach ($comments as $key => $val) {
            if ($val['of_the_accused']  == 0) {
                $forComplainant .= "<tr>
                                <td> " . $val['comment'] . " </td>
                                <td> " . Auth()->user()->name . " </td>
                                <td> " . date('Y-m-d', strtotime($val['created_at'])) . " </td> </tr>";
            } else {
                $forAccused .= "<tr>
                                <td> " . $val['comment'] . " </td>
                                <td> " . Auth()->user()->name . " </td>
                                <td> " . date('Y-m-d', strtotime($val['created_at'])) . " </td> </tr>";
            }
        }


        $cat_obj = new ComplaintCategory();
        $complaint_obj = new Complaint();
        $user_obj = new User();
        $des_obj = new Complaint();
        $stat_obj = new Complaint();
        $update_obj = new Complaint();

        $users = $user_obj->where('organization_id', Auth()->user()->organization_id)->get();
        $complaint = $complaint_obj->find($request['id']);
        $categories = $cat_obj->get();
        $descriptions = $des_obj->get();
        $status = $stat_obj->get();
        $updated = $update_obj->get();
        // return json_encode(['status' => 'true', 'data' => $users, 'assigned_id' => $complaint['assigned_to']]);
        ob_start();
?>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="category_id">Category</label>
                    <select id="category_id" class="form-control">
                        <option value="">Select Category</option>
                        <?php
                        foreach ($categories as $key => $category) {
                            if ($category['id'] == $complaint['assigned_to']) {
                        ?>
                                <option value="<?= $category['id'] ?>" selected><?= $category['name'] ?></option>
                            <?php
                            } else {
                            ?>
                                <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
                        <?php
                            }
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="Description">Complaint Description</label>
                    <select id="Description" class="form-control" name="Description">
                        <option value="">Complaint Description</option>
                        <?php
                        foreach ($descriptions as $key => $describe) {
                            if ($describe['id'] == $complaint['assigned_to']) {
                        ?>
                                <option value="{{$describe['id']}}" selected><?= $describe['complaint_body'] ?></option>
                            <?php } else { ?>
                                <option value="{{$describe['id']}}"><?= $describe['complaint_body'] ?></option>
                        <?php
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="updated"> Updated At</label>
                    <select id="updated" class="form-control" name="updated">
                        <option value="">Select Date</option>
                        <?php
                        foreach ($updated as $key => $date) {
                            if ($date['id'] == $complaint['assigned_to']) {
                        ?>
                                <option value="{{$date['id']}}" selected><?= $date['updated_at'] ?></option>
                            <?php } else { ?>
                                <option value="{{$date['id']}}"><?= $date['updated_at'] ?></option>
                        <?php
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="AssignTo">Assign To</label>
                    <select id="AssignTo" class="form-control" name="AssignTo">
                        <option value="">Select User</option>
                        <?php
                        foreach ($users as $key => $user) {
                            if ($user['id'] == $complaint['assigned_to']) {
                        ?>
                                <option value="{{$user['id']}}" selected><?= $user['name'] ?></option>
                            <?php } else { ?>
                                <option value="{{$user['id']}}"><?= $user['name'] ?></option>
                        <?php
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="Status">Current Status</label>
                    <select id="Status" class="form-control" name="Status">
                        <option value="">Current Status</option>
                        <?php
                        foreach ($status as $key => $stu) {
                            if ($stu['id'] == $complaint['assigned_to']) {
                        ?>
                                <option value="{{$stu['id']}}" selected><?= $stu['status'] ?></option>
                            <?php } else { ?>
                                <option value="{{$stu['id']}}"><?= $stu['status'] ?></option>
                        <?php
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="Remarks">Remarks</label>
                    <textarea class="form-control" id="Remarks" name="Remarks">TEST</textarea>
                </div>
                <div class="form-group">
                    <button type="button" id="btnUpdate" class="btn btn-info">Update</button>
                    <button type="button" id="btnClose" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>

<?php
        $form = ob_get_clean();

        return json_encode(['status' => 'true', 'forAccused' => $forAccused, 'forComplainant' => $forComplainant, 'form' => $form]);
    }


    public function addComment(Request $request)
    {
        $data = [
            'comment' => $request['comment'],
            'comment_by' => Auth()->user()->id,
            'complaint_id' => $request['complaint_id'],
            'of_the_accused' => ($request['type'] == 'complainant') ? 0 : 1,
        ];

        $complaint = ComplaintComment::create($data);
        if ($complaint) {
            $newRow = "<tr>
            <td> " . $request['comment'] . " </td>
            <td> " . Auth()->user()->name . " </td>
            <td> " . date('Y-m-d') . " </td> <tr>";

            return json_encode(['status' => 'true', 'newRow' => $newRow]);
        } else {
            return json_encode(['status' => 'fase', 'msg' => 'Something Went wrong!']);
        }
    }
}
