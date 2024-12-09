<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function products(): HasMany {
        return $this->hasMay(Product::class, 'category_id');
    }

    public function icon(): BelongsTo{
        return $this->belongsTo(Icon::class);
    }
}
