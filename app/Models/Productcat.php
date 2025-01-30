<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productcat extends Model
{
    /** @use HasFactory<\Database\Factories\ProductcatFactory> */
    use HasFactory;

    protected static function booted()
    {
        static::deleting(function ($productcat) {
            if ($productcat->id !== 1) {
                Product::where('productcat_id', $productcat->id)->update(['productcat_id' => 1]);
            } else {
                throw new \Exception('Default product category cannot be deleted.');
            }
        });
    }

    protected $fillable = ['name', 'slug'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
