<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'addresstable_id','addrestable_type',
        'name','zip_code','street','number',
        'neighborhood','additional_info',
        'city','state','country'
    ];

    protected $casts = ['country' => 'array'];

    /**
     * Get the owning addresstable model.
     */
    public function addresstable()
    {
        return $this->morphTo();
    }
}
