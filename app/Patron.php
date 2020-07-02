<?php

namespace App;

use Carbon\Carbon;
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
    public function changeStatus()
    {
        $this->update([
            'status' =>  $this->status ? 0 : 1
        ]);

        return $this;
    }

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
    public function detachCategories()
    {
        $this->categories()->detach($this->categories()->pluck('id')->all());
        return $this;
    }

    /**
     *
     */
    public function attachCategories(array $categoriesIds)
    {
        $this->categories()->attach($categoriesIds);
        return $this;
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
