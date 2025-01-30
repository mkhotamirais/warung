<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'price_details',
        'banner',
        'productcat_id',
        // 'user_id'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function productcat()
    {
        return $this->belongsTo(Productcat::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
