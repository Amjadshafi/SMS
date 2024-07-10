<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ComplaintFile;
use Illuminate\Support\Facades\DB;

class Complaint extends Model
{
    use HasFactory;

    protected $fillable = ['complaint_email', 'assigned_to', 'complaint_phone_no', 'complaint_fname', 'complaint_lname', 'complaint_city', 
    'complaint_country', 'complaint_address', 'accused_email', 'accused_phone_no', 'accused_name', 'accused_department', 'accused_city', 
    'accused_country', 'accident_place', '	accident_date', 'complaint_body', 'status', 'file', 'organization_id', 'complaint_category_id', 'remarks'];


    public function files()
    {
        return $this->hasMany(ComplaintFile::class);
    }

    public function accused_files(){
        return $this->files()->where('of_the_accused',1);
    }

    public function complaint_files(){
        return $this->files()->where('of_the_accused',0);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function assigned_to_user()
    {
        return $this->belongsTo(User::class, 'assigned_to', 'id');
    }

    public function comments(){
        return $this->hasMany(ComplaintComment::class);
    }

    public function updateComplaint($data, $id)
    {
        return Complaint::where('id', $id)->update($data);
    }


    public function getCountsGroupByEmail()
    {
        return Complaint::select('accused_email', 'complaint_fname', 'accused_name', 'organization_id', DB::raw('COUNT(id) as count'))
            ->with('organization')
            ->groupBy('accused_email', 'complaint_fname', 'accused_name', 'organization_id')
            ->orderBy('count', 'desc')
            ->get();
    }
    public function getAllComplaintsWithDeadlines()
    {
        return Complaint::select(
            'id',
            'complaint_email',
            'complaint_phone_no',
            'complaint_fname',
            'complaint_lname',
            'assigned_to',
            'organization_id',
            'accused_name',
            'accused_email',
            'status',
            DB::raw('DATE_ADD(created_at, INTERVAL 15 DAY) AS deadline, DATEDIFF(DATE_ADD(created_at, INTERVAL 15 DAY), now()) as days')
        )
            ->with(['assigned_to_user', 'organization']) 
            ->orderBy('days', 'asc')
            ->get();
        return $this->with('organization')->get();
    }
    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }
}
