<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    public function user()
    {
       return $this->belonsTo(User::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
