<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subdepartment extends Model
{
    protected $connection = 'mysql2';
    protected $table = 'admin.subdepartments';

    protected $fillable = ['department_id','name','status'];

    /**
     *
     */
    public function department()
    {
        return $this->belongsTo(Department::class)->with(['subdepartments']);
    }

    /**
     *
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
