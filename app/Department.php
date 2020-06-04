<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $connection = 'mysql2';
    protected $table = 'admin.departments';

    protected $fillable = ['name', 'email', 'status'];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function devices()
    {
        return $this->hasMany(Device::class);
    }

    public function search(array $filters = null)
    {
        if ($filters) {
            return [];
        }
        return $this->all();
    }
}
