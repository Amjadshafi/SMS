<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{


    protected $fillable = [
        'name',
        'email',
    ];



    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function complaints()
    {
        return $this->hasMany(Complaint::class);
    }
    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function committees()
    {
        return $this->hasMany(Committe::class);
    }
}
