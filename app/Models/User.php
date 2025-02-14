<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        // 'lang',
        'organization_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function complaint()
    {
        return $this->hasOne(Complaint::class);
    }

    public function complaints()
    {
        return $this->hasMany(Complaint::class, 'assigned_to', 'id');
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }
    public function view(User $user, User $model)
    {
        return $user->id === $model->id;
    }

    // public function committe(){
    //     return $this->belongsToMany(Committe::class, 'committe_user');
    // }
}
