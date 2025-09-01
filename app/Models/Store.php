<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $fillable = [
        'user_id', 'name', 'domain', 'theme_id', 'logo_path', 'description', 'multi_channel_sales',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function theme()
    {
        return $this->belongsTo(Theme::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
