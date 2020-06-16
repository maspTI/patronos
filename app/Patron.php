<?php

namespace App;

use Illuminate\Support\Str;
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
        'pointed_by', 'bio', 'status', 'addresses'
    ];

    protected $casts = [
        'phones' => 'array',
        'emails' => 'array',
        'dependents' => 'array',
        'social_medias' => 'array',
        'secretaries' => 'array',
        'marital_status' => 'array',
        'addresses' => 'array',
    ];

    /**
     *
     */
    public function getNameAttribute($value)
    {
        return Str::title($value);
    }

    /**
     *
     */
    public function getOccupationAttribute($value)
    {
        return Str::title($value);
    }

    // /**
    //  *
    //  */
    // public function getCpfAttribute($value)
    // {
    //     $value = substr_replace($value, '.', 3, 0);
    //     $value = substr_replace($value, '.', 7, 0);
    //     return substr_replace($value, '-', -2, 0);
    // }

    /**
     *
     */
    public function copatron()
    {
        return $this->hasOne(Copatron::class);
    }

    /**
     *
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    /**
     *
     */
    public function search(array $search = null)
    {
        return $this->where(function ($query) use ($search) {
            $query->where('name', 'LIKE', $search['search'] == '' ? '%%' : "%{$search['search']}%")
                ->orWhere('cpf', 'LIKE', $search['search'] == '' ? '%%' : "%{$search['search']}%");
        })
        ->whereHas('categories', function ($query) use ($search) {
            $query->where('name', 'LIKE', $search['category'] == 'all' ? '%%' : "%{$search['category']}%");
        })
        ->where(function ($query) use ($search) {
            if ($search['status'] == '1') {
                return $query->where('status', $search['status']);
            }
            if ($search['status'] == '0') {
                return $query->where('status', $search['status']);
            }
        })
        ->with(['copatron', 'categories'])
        ->orderBy('name')
        ->paginate($search['paginate']);
    }
}
