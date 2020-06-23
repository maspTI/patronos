<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name','email','applicable_to'];

    /**
     *
     */
    public function patrons()
    {
        return $this->belongsTo(Patron::class);
    }

    /**
     *
     */
    public function sponsors()
    {
        return $this->hasMany(Sponsor::class);
    }
}
