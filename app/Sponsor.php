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
        'people_to_contact', 'avatar', 'logo'
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
}
