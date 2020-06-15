<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Copatron extends Model
{
    protected $fillable = ['patron_id','name','email','birthday'];

    /**
     *
     */
    public function patron()
    {
        return $this->belongsTo(Patron::class);
    }
}
