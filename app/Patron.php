<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Patron extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name', 'avatar', 'birthday',
        'cpf', 'marital_status', 'emails',
        'occupation', 'company', 'phones',
        'secretaries', 'dependents', 'social_medias',
        'pointed_by', 'bio', 'status'
    ];

    protected $casts = [
        'phones' => 'array',
        'secretaries' => 'array',
        'dependents' => 'array',
        'social_medias' => 'array',
    ];
}
