<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'store_id',
        'name',
        'description',
        'price',
    ];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function inventory()
    {
        return $this->hasOne(Inventory::class)->whereNull('variant_id');
    }

    public function variantInventories()
    {
        return $this->hasManyThrough(Inventory::class, ProductVariant::class);
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
