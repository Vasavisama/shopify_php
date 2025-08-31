<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'background_color',
        'font_style',
        'font_color',
        'font_size',
        'logo_path',
        'custom_css',
    ];

    /**
     * Get the stores that belong to the theme.
     */
    public function stores()
    {
        return $this->hasMany(Store::class);
    }
}
