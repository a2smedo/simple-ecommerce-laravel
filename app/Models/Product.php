<?php

namespace App\Models;

use Illuminate\Support\Facades\App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $guarded = ["id", "created_at", "updated_at"];

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class)
            ->withPivot('unite_price', 'quantity_orderd', 'total_price')
            ->withTimestamps();
    }

    public function reviews ()
    {
        return $this->hasMany(Review::class);
    }


    public function wishLists()
    {
        return $this->hasMany(Wishlist::class);
    }


    public function name($lang = null)
    {
        $lang = $lang ?? App::getLocale();

        return json_decode($this->name)->$lang;

    }

    public function desc($lang = null)
    {
        $lang = $lang ?? App::getLocale();

        return json_decode($this->desc)->$lang;

    }

    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }
}
