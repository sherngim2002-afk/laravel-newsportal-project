<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        "title",
        "slug",
        "status",
        "meta_title",
        "meta_description",
        "meta_keywords",
    ];

    public function articles()
    {
        return $this->belongsToMany(Article::class);
    }
}
