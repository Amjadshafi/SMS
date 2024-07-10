<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Committe extends Model
{

    protected $fillable = [
        'name',
        'organization_id',
    ];
    public function users()
    {
        return $this->belongsToMany(User::class, 'committe_user', 'committe_id','user_id');
    }
}
