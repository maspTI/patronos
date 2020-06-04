<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    protected $connection = 'mysql2';
    protected $table = 'admin.users';

    protected $fillable = [
        'department_id', 'subdepartment_id','name','email','avatar','username','status',
    ];

    protected $hidden = ['remember_token'];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    /**
     * @Route("/")
     */
    public function subdepartment()
    {
        return $this->belongsTo(Subdepartment::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function devices()
    {
        return $this->hasMany(Device::class, 'holder_id');
    }

    /**
     * @param integer Department's id
     * @return App\User
     */
    public function manager($departmentId)
    {
        return $this->where('department_id', $departmentId)
            ->whereHas('roles', function ($query) {
                $query->whereId(2);
            })->first();
    }

    public function search(array $filters = null)
    {
        if ($filters) {
            return [];
        }
        return $this->whereNotNull('status')->get();
    }
}
