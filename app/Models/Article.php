<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        "title",
        "slug",
        "image",
        "description",
        "status",
        "meta_title",
        "meta_description",
        "meta_keywords",
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
