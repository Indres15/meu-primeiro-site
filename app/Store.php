<?php

namespace App;

use App\Notifications\StoreReceiveNewOrder;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use App\Notifications\notifyStoreOwners;

class Store extends Model
{
    use HasSlug;
    protected $fillable = ['name', 'description', 'phone', 'mobile_phone', 'slug', 'logo'];


    /**
     * get the options for gererating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function user()
    {
        return $this->belonsTo(User::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function orders()
    {
        return $this->belongsToMany(UserOrder::class, 'order_store', null, 'order_id');
    }

    public function notifyStoreOwners(array $storesId = [])
    {
        $stores = \App\Store::whereIn('id', $storesId)->get();

        return $stores->map(function($store){
            return $store->user;
        })->each->notify(new StoreReceiveNewOrder);
    }
}
