<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShortUrl extends Model
{
    use HasFactory;

    protected $fillable = [
        'url',
        'shortcode'
    ];

    public static function searchShortUrls($search)
    {
        return empty($search) ? static::query()
            : static::query()->where('id', 'like', '%' . $search . '%')
            ->orWhere('url', 'like', '%' . $search . '%')
            ->orWhere('shortcode', 'like', '%' . $search . '%');
            
    }
}
