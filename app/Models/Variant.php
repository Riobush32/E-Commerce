<?php

namespace App\Models;

use App\Models\Cart;
use App\Models\Product;
use App\Models\VariantPhotos;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Variant extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function product(): BelongsTo{
        return $this->belongsTo(Product::class);
    }

    public function carts(): HasMany {
        return $this->hasMany(Cart::class);
    }

    public function variant_photos(): HasMany {
        return $this->hasMany(VariantPhotos::class);
    }
}