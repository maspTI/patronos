<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Copatron extends Model
{
    protected $fillable = ['patron_id','name','email','birthday'];

    /**
     *
     */
    public function getBirthdayAttribute($value)
    {
        return Carbon::create($value, 'America/Sao_Paulo');
    }

    /**
     *
     */
    public function patron()
    {
        return $this->belongsTo(Patron::class);
    }
}
