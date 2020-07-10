<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['category_id','paymentable','type','payment_method','value','payment_info','due_date'];
    public $casts = ['type' => 'array', 'payment_info' => 'array'];

    /**
     *
     */
    public function paymentable()
    {
        return $this->morphTo();
    }
}
