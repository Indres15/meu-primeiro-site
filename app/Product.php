<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'description', 'bory', 'price', 'slug'];
    
    public function store()
    {
        return $this->belongsTo(store::class);
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
