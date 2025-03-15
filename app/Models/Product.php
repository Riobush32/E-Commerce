<?php

namespace App\Models;

use App\Models\Cart;
use App\Models\Brand;
use App\Models\Coment;
use App\Models\Variant;
use App\Models\Category;
use App\Models\ProductPhoto;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function category(): BelongsTo{
        return $this->belongsTo(Category::class);
    }

    public function brand(): BelongsTo{
        return $this->belongsTo(Brand::class);
    }

    public function product_photos(): HasMany {
        return $this->hasMany(ProductPhoto::class);
    }

    public function variants(): HasMany {
        return $this->hasMany(Variant::class);
    }
    public function coments(): HasMany
    {
        return $this->hasMany(Coment::class);
    }

}
