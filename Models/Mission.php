<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mission extends Model
{
    use HasFactory;

    protected $fillable = [
        'description_id',
        'description_en',
    ];
    public function scopeSelectByLocale($query)
    {
        $locale = session('language') ? session('language') : app()->getLocale() ;
        return $query->select(
            '*',
            // 'title_'.$locale.' as title',
            'description_'.$locale.' as description',
            // 'description_'.$locale.'_plain as description_plain',
            // 'description_'.$locale.'_plain_short as description_plain_short',
        );
    }
}
