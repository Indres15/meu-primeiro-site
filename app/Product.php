<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Product extends Model
{
    use HasSlug;
    protected $fillable = ['name', 'description', 'bory', 'price', 'slug'];

        /**
     * get the options for gererating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function getthumbAttribute()
    {
        return $this->photos->first()->image;
    }
    
    public function store()
    {
        return $this->belongsTo(Store::class);
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class,'categories_products');
    }

    public function photos()
    {
        return $this->hasMany(ProductPhoto::class);
    }
}
