<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Complaint;

class ComplaintFile extends Model
{
    use HasFactory;
    

    function complaint(){
        return $this->belongsTo(Complaint::class);
    }
    

}



