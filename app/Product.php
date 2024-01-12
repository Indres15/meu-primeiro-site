<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use League\CommonMark\Extension\Attributes\Node\Attributes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Support\Str;

class Product extends Model
{
    // use HasSlug;
    protected $fillable = ['name', 'description', 'bory', 'price', 'slug'];

        /**
     * get the options for gererating the slug.
     */
    // public function getSlugOptions() : SlugOptions
    // {
    //     return SlugOptions::create()
    //         ->generateSlugsFrom('name')
    //         ->saveSlugsTo('slug');
    // }

    public function getthumbAttribute()
    {
        return $this->photos->first()->image;
    }

    public function setSlugAttribute($value)
    {
        $slug = Str::slug($value);
        $matchs = $this->uniqueSlug($slug);

        $this->attributes['name'] = $value;
        $this->attributes['slug'] = $matchs ? $matchs . '-' . $matchs : $slug;
    }

    public function uniqueSlug($slug)
    {
        $matchs = $this->whereRaw("slug REGEXP '^{$slug}(-[0-9]*)?$'")->count();
dd($matchs);
        return $matchs;
    }
    
    /**
     * Relations
     */
    
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
