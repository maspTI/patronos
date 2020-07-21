<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['category_id','paymentable','type','payment_method','value','payment_info','due_date'];

    protected $casts = [
        'type' => 'array',
        'payment_info' => 'array'
    ];

    /**
     *
     */
    public function paymentable()
    {
        return $this->morphTo();
    }

    /**
     *
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     *
     */
    public function search(array $filter)
    {
        return $this->with(['paymentable', 'category'])
        ->orderBy('id', 'desc')
        ->paginate($filter['paginate']);
    }
}
