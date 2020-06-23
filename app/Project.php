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
}
