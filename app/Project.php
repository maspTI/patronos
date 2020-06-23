<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['name','status'];

    /**
     *
     */
    public function sponsors()
    {
        return $this->hasMany(Sponsor::class);
    }

    /**
     *
     */
    public function search(array $search = null)
    {
        return $this->where('status', $search['status'])
            ->get();
    }
}
