<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductPhoto extends Model
{
    protected $fillable = ['image'];
    
    public function ptoduct()
    {
        return $this->brlongsTo(product::class);
    }
}
