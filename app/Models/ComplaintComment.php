<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Complaint;

class ComplaintComment extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'comment',
        'comment_by',
        'complaint_id',
        'of_the_accused'
    ];

    public function comment_by_user(){
        return $this->belongsTo(User::class,'comment_by', 'id');
    }
    

}



