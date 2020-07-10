<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sponsor extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'category_id','project_id','razao_social',
        'nome_fantasia','cnpj','occupation_area',
        'proxy','social_medias','addresses',
        'people_to_contact', 'avatar', 'logo',
        'status'
    ];

    protected $casts = [
        'proxy' => 'array',
        'social_medias' => 'array',
        'addresses' => 'array',
        'people_to_contact' => 'array'
    ];

    /**
     *
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
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
    public function payments()
    {
        return $this->morphMany(Payment::class, 'paymentable');
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
    public function search(array $search = null)
    {
        return $this->where(function ($query) use ($search) {
            $query->where('razao_social', 'LIKE', $search['search'] == '' ? '%%' : "%{$search['search']}%")
                ->orWhere('nome_fantasia', 'LIKE', $search['search'] == '' ? '%%' : "%{$search['search']}%")
                ->orWhere('cnpj', 'LIKE', $search['search'] == '' ? '%%' : "%{$search['search']}%");
        })
        ->whereHas('category', function ($query) use ($search) {
            $query->where('name', 'LIKE', $search['category'] == 'all' ? '%%' : "%{$search['category']}%");
        })
        ->whereHas('project', function ($query) use ($search) {
            $query->where('name', 'LIKE', $search['project'] == 'all' ? '%%' : "%{$search['project']}%");
        })
        ->where(function ($query) use ($search) {
            if ($search['status'] == '1') {
                return $query->where('status', $search['status']);
            }
            if ($search['status'] == '0') {
                return $query->where('status', $search['status']);
            }
        })
        ->with(['category', 'project'])
        ->orderBy('nome_fantasia')
        ->paginate($search['paginate']);
    }
}
